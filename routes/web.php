<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userbooking;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrekController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\bookingdeatils;
use App\Http\Controllers\esewacontroller;


Route::get('/', function () {
    return view('homepage\layout');
});

Route::get('/homepage', function () {
    return view('homepage\layout');
})->middleware(['auth', 'verified'])->name('homepage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(TrekController::class)->group(function () {
    route::get('/treks','index')->name('treks.index');
    route::get('/treks/{id}','show')->name('treks.show');
    route::get('/booking','booking')->name('booking.form');
});
 //Route::get('/dashboard','index')->name('admin');

Route::controller(AdminController::class)->group(function () {
    route::get('/admin','index')->name('admin.index');
    route::get('/admin/create','create')->name('admin.create');
    route::post('/admin','store')->name('admin.store');
    

  
});
Route::controller(DestinationController::class)->group(function () {
    route::get('/admin/destinations','index')->name('destinations.index');
    route::get('/admin/destinations/create','create')->name('destinations.create');
    route::post('/admin/destinations','store')->name('destinations.store');
    route::get('/destinations','publicIndex')->name('front.destinations');
});
Route::controller(bookingdeatils::class)->group(function () {
    route::post('/booking','create')->name('booking.create');
    route::get('/admin/bookings','index')->name('bookings.index');
    route::get('/admin/bookings/{id}','show')->name('bookings.show');
    route::post('/admin/bookings/{id}/accepted','accepted')->name('booking.accepted');
    route::post('/admin/bookings/{id}/rejected','rejected')->name('booking.rejected');
    route::get('/booking/{id}/payment','showPaymentConfirmation')->middleware('auth')->name('booking.payment');
});
/*
for testing mail functionality
Route::get('/test-mail', function () {
    $fakeBooking = \App\Models\booking::first();
    Mail::to($fakeBooking->email)->send(new \App\Mail\BookingStatusMail($fakeBooking, 'accepted'));
    return "Mail sent";
});*/
Route::controller(userbooking::class)->group(function(){
    Route::middleware(['auth'])->group(function(){
     Route::get('/user/userdashboard','index')->name('user.bookings');
     Route::post('/user/userdashboard/cancel/{id}','cancelBooking')->name('bookings.cancel');
    });

});
Route::controller(EsewaController::class)->group(function(){
    Route::get('/esewa/pay/{booking_id}','pay')->name('esewa.pay')->middleware('auth');
    Route::get('/esewa/success','success')->name('esewa.success');
    Route::get('/esewa/failure','failure')->name('esewa.failure');
});


require __DIR__.'/auth.php';
