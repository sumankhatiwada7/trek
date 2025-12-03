<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TrekController;
Route::get('/', function () {
     return redirect('/treks');
});
Route::controller(TrekController::class)->group(function () {
    route::get('/treks','index')->name('treks.index');
    route::get('/treks/{id}','show')->name('treks.show');
});
 //Route::get('/dashboard','index')->name('admin');

