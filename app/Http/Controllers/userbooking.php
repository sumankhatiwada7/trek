<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\booking;
use Carbon\Carbon;

class userbooking extends Controller
{
   public function index(){
    $activeBookings = booking::with('trek')
        ->where('email', auth()->user()->email)
        ->whereIn('status', ['pending', 'accepted', 'paid'])
        ->latest()
        ->get();

    $rejectedBookings = booking::with('trek')
        ->where('email', auth()->user()->email)
        ->whereIn('status', ['cancelled', 'rejected'])
        ->latest()
        ->get();
    
        return view('user.dashboard', compact('activeBookings', 'rejectedBookings'));

   }
   public function cancelBooking($id){
    $booking = Booking::where('id', $id)
        ->where('email', auth()->user()->email)
        ->whereNotIn('status', ['rejected', 'cancelled'])
        ->firstOrFail();
    
    // Only accepted bookings can be cancelled
    if ($booking->status !== 'accepted') {
        return back()->with('error', 'Only accepted bookings can be cancelled.');
    }

    // Check if booking is within 2 days
    $bookingdate = Carbon::parse($booking->created_at);
    $now = Carbon::now();
    
    if($bookingdate->diffInDays($now) > 2){
        return back()->with('error', 'Booking cancellation period expired. For more details contact customer care.');
    }
    
    $booking->status = 'cancelled';
    $booking->save();
    
    return back()->with('success', 'Booking has been cancelled successfully.');
   }
}
