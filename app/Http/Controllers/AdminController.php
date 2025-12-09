<?php

namespace App\Http\Controllers;
use App\Models\trek;
use App\Models\highlights;
use App\Models\itinerary;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $treks = trek::all();
        return view("admin.index", compact('treks'));
    }
    public function create(){
        return view("admin.create");
    }

    // Removed the unused $id parameter from the method signature
    public function store(Request $request){
        
        // 1. Validate Core Trek Data
        // NOTE: These fields must be present in your App\Models\trek $fillable array.
        $validatedTrekData = $request->validate([
            'trekname' => 'required|string|max:255',
            'duration' => 'required|string|max:20', // Changed to string to allow '14 Days' format
            'description' => 'required|string',
            'region' => 'required|string|max:255',
            'difficultylevel' => 'required|string|max:255', // Corrected name to match form
            'group_size' => 'required|string|max:255',
            'elevation' => 'required|string|max:255',
            'season' => 'required|string|max:255',
            // Fields in form but NOT in your current trek model's $fillable:
            // 'tagline' is missing.
            // 'price' is missing.
            // 'status' is missing.
            // If you want to save them, uncomment and add to $fillable (see next section).
        ]);
        
        // 2. Validate Relational Data Structure
        $request->validate([
            // Highlights Validation
            'highlights' => 'nullable|array',
            'highlights.*.day' => 'required_with:highlights|integer|min:1',
            'highlights.*.description' => 'required_with:highlights|string|max:500',
            
            // Itinerary Validation
            'itinerary' => 'nullable|array',
            'itinerary.*.day' => 'required_with:itinerary|integer|min:1',
            'itinerary.*.title' => 'nullable|string|max:255',
            'itinerary.*.description' => 'required_with:itinerary|string', // Matches view field name
            //photos 
            'trek_images' => 'required|array|min:1|max:3', // Must upload at least 1, max 8
            'trek_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        
        // 3. Create the Trek record
        $trek = trek::create($validatedTrekData); 

        // 4. Loop and Create Highlights
        if ($request->has('highlights')) {
            foreach ($request->input('highlights') as $highlightData) {
                // Skip if no description is provided
                if (empty($highlightData['description'])) continue; 

                highlights::create([
                    'trek_id' => $trek->id, // Link with the newly created Trek ID
                    'day' => $highlightData['day'],
                    'description' => $highlightData['description'],
                    // Ensure your Highlights model has 'trek_id', 'day', and 'description' in $fillable
                ]);
            }
        }

        // 5. Loop and Create Itinerary
        if ($request->has('itinerary')) {
            foreach ($request->input('itinerary') as $itineraryData) {
                 // Skip if no description is provided
                 if (empty($itineraryData['description'])) continue;
                 
                itinerary::create([
                    'trek_id' => $trek->id, // Link with the newly created Trek ID
                    'day' => $itineraryData['day'],
                    // Assuming your itinerary table uses 'activities' for the main text column
                    // If your column is 'description', change 'activities' to 'description'.
                    'description' => $itineraryData['description'],
                    'title'=> $itineraryData['title'] 
                    // If you have a 'title' column in the itinerary table:
                    // 'title' => $itineraryData['title'] ?? null, 
                    // Ensure your Itinerary model has 'trek_id', 'day', and 'activities' in $fillable
                ]);
            }
        }
       if ($request->has('trek_images')) {
            foreach ($request->file('trek_images') as $imageFile) {
                $path = $imageFile->store('trek_images', 'public'); // Store in 'storage/app/public/trek_images'
                
                // Assuming you have a trek_images model and table
                \App\Models\trek_images::create([
                    'trek_id' => $trek->id,
                    'photo' => $path,
                ]);
            }
        }
        return redirect()->route('admin.index')->with('success','Trek created successfully');
    } 
   
}