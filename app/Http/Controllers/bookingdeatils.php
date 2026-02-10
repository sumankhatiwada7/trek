<?php

namespace App\Http\Controllers;

use App\Models\booking;
use Illuminate\Http\Request;
use App\Mail\BookingStatusMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class bookingdeatils extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = booking::orderByDesc('created_at')->get();
        return view('booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r)
    {
        $validatedbooking = $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'booking_date' => 'required|date',
            'phone' => 'required|string|max:20',
            'trek_id' => 'required|integer|exists:treks,id',
            'number_of_people' => 'required|integer|min:1',
            'additional_infromation' => 'nullable|string|max:1000',
            
        ]);
        booking::create($validatedbooking);
        return redirect()->back()->with('success', 'Booking successful!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = booking::findOrFail($id);
        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // not used currently
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // not used currently
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // not used currently
    }
    public function accepted($id){
        $booking=booking::with('trek')->findorfail($id);
        $booking->status='accepted';
        $booking->save();
        
        try {
            Mail::to($booking->email)->send(new BookingStatusMail($booking, 'accepted'));
        } catch (\Throwable $e) {
            Log::error('Booking accepted email failed', ['booking_id' => $booking->id, 'error' => $e->getMessage()]);
            return redirect()->back()->with('success', 'Booking accepted, but email could not be sent.');
        }

        return redirect()->back()->with('success', 'Booking accepted. User can proceed with payment.');
    }
    public function rejected($id){
        $booking=booking::with('trek')->findorfail($id);
        $booking->status='rejected';
        $booking->save();
        try {
            Mail::to($booking->email)->send(new BookingStatusMail($booking, 'rejected'));
        } catch (\Throwable $e) {
            Log::error('Booking rejected email failed', ['booking_id' => $booking->id, 'error' => $e->getMessage()]);
            return redirect()->back()->with('success', 'Booking rejected, but email could not be sent.');
        }
        return redirect()->back()->with('success','Booking rejected');
    }

    public function showPaymentConfirmation($id)
    {
        $booking = booking::with('trek')->findOrFail($id);

        // Only allow payment for accepted bookings
        if ($booking->status !== 'accepted') {
            return redirect()->route('user.bookings')->with('error', 'This booking is not ready for payment.');
        }

        return view('booking.payment-confirmation', compact('booking'));
    }
}

