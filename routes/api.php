<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrekController;
use App\Http\Controllers\DestinationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/treks', [TrekController::class, 'list']);
Route::get('/destinations/{id}', [DestinationController::class, 'list']);