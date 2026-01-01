<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trek;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class TrekController extends Controller
{
    public function index()
    {
        $treks = trek::all();
        return view('treks.index', compact('treks'));
    }

    // In your TrekController.php
public function show($id)
    {
        $trek = trek::with(['trekImages', 'highlights', 'itinerary'])->findOrFail($id);
        $weatherData = $this->getWeatherAPIWeather($trek);
        
        return view('treks.show', compact('trek', 'weatherData'));
    }
    
    private function getWeatherAPIWeather($trek)
    {
        $apiKey = env('WEATHERAPI_KEY');
        
        if (!$apiKey || empty($trek->latitude) || empty($trek->longitude)) {
            return ['error' => 'Weather data not available'];
        }
        
        try {
            // Make direct call to WeatherAPI.com
            $response = Http::get('http://api.weatherapi.com/v1/current.json', [
                'key' => $apiKey,
                'q' => "{$trek->latitude},{$trek->longitude}",
                'aqi' => 'no' // Disable air quality data to keep it simple
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'current' => [
                        'temp_c' => $data['current']['temp_c'] ?? null,
                        'feelslike_c' => $data['current']['feelslike_c'] ?? null,
                        'humidity' => $data['current']['humidity'] ?? null,
                        'wind_kph' => $data['current']['wind_kph'] ?? null,
                        'wind_dir' => $data['current']['wind_dir'] ?? null,
                        'pressure_mb' => $data['current']['pressure_mb'] ?? null,
                        'precip_mm' => $data['current']['precip_mm'] ?? null, // Precipitation
                        'cloud' => $data['current']['cloud'] ?? null, // Cloud cover percentage
                        'vis_km' => $data['current']['vis_km'] ?? null, // Visibility in km
                        'condition_text' => $data['current']['condition']['text'] ?? 'N/A',
                        'condition_icon' => 'https:' . ($data['current']['condition']['icon'] ?? ''),
                    ],
                    'location' => [
                        'name' => $data['location']['name'] ?? 'Trek Location',
                        'region' => $data['location']['region'] ?? '',
                        'country' => $data['location']['country'] ?? '',
                    ]
                ];
            } else {
                // Log the error for debugging
                \Log::error('WeatherAPI failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return ['error' => 'Unable to fetch weather data'];
            }
            
        } catch (\Exception $e) {
            \Log::error('Weather fetch exception', ['message' => $e->getMessage()]);
            return ['error' => 'Weather service temporarily unavailable'];
        }
    }

    public function list(){
        return trek::all();
    }
    public function booking(){
        $treks = trek::select(
            'id',
            'trekname',
            'duration',
            'region',
            'difficultylevel',
            'elevation',
            'price'
        )->get();

        return view('booking.bookingform', compact('treks'));
    }
    
}


