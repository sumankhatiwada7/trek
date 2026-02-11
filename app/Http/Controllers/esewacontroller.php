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
        $totalAmount = number_format($amount, 2, '.', '');
        $signedFieldNames = 'total_amount,transaction_uuid,product_code';
        $signaturePayload = "total_amount={$totalAmount},transaction_uuid={$transactionId},product_code=" . config('services.esewa.merchant_id');
        $signature = base64_encode(hash_hmac('sha256', $signaturePayload, config('services.esewa.secret'), true));

        Payment::create([
            'transaction_uuid' => $transactionId,
            'amount' => $amount,
            'status' => 'PENDING',
            'booking_id' => $booking_id,
        ]);

        return view('esewa.pay', compact('transactionId', 'amount', 'totalAmount', 'signedFieldNames', 'signature'));
    }

    public function success(Request $request)
    {
        $decoded = null;
        $data = $request->input('data');

        if ($data) {
            $decodedJson = base64_decode($data, true);
            if ($decodedJson !== false) {
                $decoded = json_decode($decodedJson, true);
            }
        }

        $transactionUuid = $decoded['transaction_uuid'] ?? $request->transaction_uuid;
        $totalAmount = $decoded['total_amount'] ?? $request->total_amount;
        $productCode = $decoded['product_code'] ?? config('services.esewa.merchant_id');

        if ($decoded) {
            $signedFieldNames = $decoded['signed_field_names'] ?? 'total_amount,transaction_uuid,product_code';
            $fields = array_map('trim', explode(',', $signedFieldNames));
            $payloadParts = [];
            foreach ($fields as $field) {
                $payloadParts[] = $field . '=' . ($decoded[$field] ?? '');
            }
            $payload = implode(',', $payloadParts);
            $expectedSignature = base64_encode(
                hash_hmac('sha256', $payload, config('services.esewa.secret'), true)
            );

            if (!hash_equals($expectedSignature, $decoded['signature'] ?? '')) {
                return redirect()->route('user.bookings')->with('error', 'Payment verification failed. Invalid signature.');
            }
        }

        if (!$transactionUuid || !$totalAmount) {
            return redirect()->route('user.bookings')->with('error', 'Payment verification failed. Missing transaction data.');
        }

        $response = Http::get(config('services.esewa.status_url'), [
            'product_code' => $productCode,
            'total_amount' => $totalAmount,
            'transaction_uuid' => $transactionUuid,
        ]);

        if ($response->json('status') === 'COMPLETE') {

            Payment::where('transaction_uuid', $transactionUuid)
                ->update([
                    'status' => 'COMPLETE',
                    'reference_id' => $decoded['transaction_code'] ?? $request->refId ?? null,
                    'response' => $response->json(),
                ]);

            // Update booking status to paid
            $payment = Payment::where('transaction_uuid', $transactionUuid)->first();
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
