<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\destination;

class DestinationController extends Controller
{
    public function index(){
        $destinations =destination::all();
        return view('destination.index', compact('destinations'));
    }

    public function create(){
        return view('destination.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_name' => ['required','string','max:255'],
            'region' => ['required','string','max:255'],
            'description' => ['required','string'],
            'elevation' => ['nullable','string','max:255'],
            'best_season' => ['nullable','string','max:255'],
            'treks_available' => ['nullable','string','max:255'],
            'tagline' => ['nullable','string','max:255'],
            'latitude' => ['nullable','numeric','between:-90,90'],
            'longitude' => ['nullable','numeric','between:-180,180'],
            'path' => ['nullable','image','mimes:jpg,jpeg,png,gif,webp','max:4096'],
        ]);

        $data = $validated;

        if ($request->hasFile('path')) {
            $storedPath = $request->file('path')->store('destinations', 'public');
            $data['path'] = $storedPath;
        } else {
            unset($data['path']);
        }

        destination::create($data);

        return redirect()
            ->route('destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    public function publicIndex()
    {
        $destinations = destination::latest()->get();
        return view('destination.Destination', compact('destinations'));
    }
    public function list($id){
        $destination = destination::findOrFail($id);
        return ($destination);
    }
}
