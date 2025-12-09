<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\trek;

class TrekController extends Controller
{
    public function index()
    {
        $treks = trek::all();
        return view('treks.index', compact('treks'));
    }

    public function show($id)
    {
        $trek = trek::with(['trekImages', 'highlights', 'itinerary'])->findOrFail($id);
        return view('treks.show', compact('trek'));
    }
}
