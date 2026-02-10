<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EsewaController extends Controller
{
    public function pay($booking_id)
    {
        $booking = \App\Models\booking::with('trek')->findOrFail($booking_id);
        
        // Verify booking belongs to logged in user
        if($booking->email !== auth()->user()->email) {
            return redirect()->route('user.bookings')->with('error', 'Unauthorized access.');
        }
        
        // Verify booking is accepted
        if($booking->status !== 'accepted') {
            return redirect()->route('user.bookings')->with('error', 'This booking is not ready for payment.');
        }
        
        $transactionId = uniqid('PAY_');
        $amount = ($booking->trek->price ?? 0) * $booking->number_of_people;

        Payment::create([
            'transaction_uuid' => $transactionId,
            'amount' => $amount,
            'status' => 'PENDING',
            'booking_id' => $booking_id,
        ]);

        return view('esewa.pay', compact('transactionId', 'amount'));
    }

    public function success(Request $request)
    {
        $response = Http::get(config('services.esewa.status_url'), [
            'product_code' => config('services.esewa.merchant_id'),
            'total_amount' => $request->total_amount,
            'transaction_uuid' => $request->transaction_uuid,
        ]);

        if ($response->json('status') === 'COMPLETE') {

            Payment::where('transaction_uuid', $request->transaction_uuid)
                ->update([
                    'status' => 'COMPLETE',
                    'reference_id' => $request->refId ?? null,
                    'response' => $response->json(),
                ]);

            // Update booking status to paid
            $payment = Payment::where('transaction_uuid', $request->transaction_uuid)->first();
            if ($payment && $payment->booking_id) {
                \App\Models\booking::find($payment->booking_id)->update(['status' => 'paid']);
            }
            return redirect()->route('user.bookings')->with('success', 'Payment successful. Your booking is now confirmed.');
        }

        return redirect()->route('user.bookings')->with('error', 'Payment verification failed. Please contact support.');
    }

    public function failure(Request $request)
    {
        Payment::where('transaction_uuid', $request->transaction_uuid)
            ->update(['status' => 'FAILED']);

        return redirect()->route('user.bookings')->with('error', 'Payment failed. Please try again.');
    }
}
