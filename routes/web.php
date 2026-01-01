<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TrekController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DestinationController;

Route::get('/', function () {
    return view('homepage.layout');
});

Route::get('/homepage', function () {
    return view('homepage.layout');
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