<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TrekController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('homepage.layout');
});

Route::get('/homepage', function () {
    return view('homepage.layout');
});

Route::controller(TrekController::class)->group(function () {
    route::get('/treks','index')->name('treks.index');
    route::get('/treks/{id}','show')->name('treks.show');
});
 //Route::get('/dashboard','index')->name('admin');

Route::controller(AdminController::class)->group(function () {
    route::get('/admin','index')->name('admin.index');
    route::get('/admin/create','create')->name('admin.create');
    route::post('/admin','store')->name('admin.store');
    

  
});
Route::get('/test-weather-api', function() {
    $apiKey = env('WEATHERAPI_KEY');
    
    // Test coordinates (use your trek's actual coordinates)
    $testLat = 28.6139;  // Example: Delhi
    $testLon = 77.2090;
    
    if (!$apiKey) {
        return "ERROR: WEATHERAPI_KEY is not set in .env file";
    }
    
    try {
        $response = Http::get('http://api.weatherapi.com/v1/current.json', [
            'key' => $apiKey,
            'q' => "{$testLat},{$testLon}",
            'aqi' => 'no'
        ]);
        
        return [
            'api_key_exists' => !empty($apiKey),
            'api_key_first_chars' => substr($apiKey, 0, 6) . '...',
            'status_code' => $response->status(),
            'successful' => $response->successful(),
            'response_body' => $response->json(),
            'error_message' => $response->failed() ? $response->body() : null
        ];
        
    } catch (\Exception $e) {
        return [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ];
    }
});