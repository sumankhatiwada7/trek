<?php

namespace App\Http\Controllers;
use App\Models\trek;
use App\Models\Payment;
use App\Models\highlights;
use App\Models\itinerary;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class AdminController extends Controller
{
    public function index(){
        $treks = trek::withCount('bookings')->get();
        return view("admin.index", compact('treks'));
    }
    public function create(){
        $destinations = \App\Models\destination::all();
        return view("admin.create", compact('destinations'));
    }
    public function payments(){
        $payments = Payment::with(['booking.trek'])
            ->orderByDesc('created_at')
            ->get();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $monthPayments = $payments->whereBetween('created_at', [$monthStart, $monthEnd]);
        $monthTotal = $monthPayments->sum('amount');
        $monthCount = $monthPayments->count();
        $monthComplete = $monthPayments->where('status', 'COMPLETE')->count();
        $monthFailed = $monthPayments->where('status', 'FAILED')->count();
        $monthPending = $monthPayments->where('status', 'PENDING')->count();

        $rangeStart = Carbon::now()->startOfMonth()->subMonths(5);
        $monthlyRows = Payment::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, SUM(amount) as total, COUNT(*) as count")
            ->where('created_at', '>=', $rangeStart)
            ->groupBy('ym')
            ->orderBy('ym')
            ->get()
            ->keyBy('ym');

        $chartLabels = [];
        $chartTotals = [];
        $chartCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->startOfMonth()->subMonths($i);
            $key = $month->format('Y-m');
            $chartLabels[] = $month->format('M Y');
            $chartTotals[] = (float) ($monthlyRows[$key]->total ?? 0);
            $chartCounts[] = (int) ($monthlyRows[$key]->count ?? 0);
        }

        return view("admin.payments", compact(
            'payments',
            'monthTotal',
            'monthCount',
            'monthComplete',
            'monthFailed',
            'monthPending',
            'chartLabels',
            'chartTotals',
            'chartCounts'
        ));
    }

    // Removed the unused $id parameter from the method signature
    public function store(Request $request){
        
        // 1. Validate Core Trek Data
        // NOTE: These fields must be present in your App\Models\trek $fillable array.
        $validatedTrekData = $request->validate([
            'trekname' => 'required|string|max:255',
            'duration' => 'required|string|max:20',
            'description' => 'required|string',
            'region' => 'required|string|max:255',
            'difficultylevel' => 'required|string|max:255',
            'group_size' => 'required|string|max:255',
            'elevation' => 'required|string|max:255',
            'season' => 'required|string|max:255',
           'latitude' => 'required|string|max:255',
           'longitude' => 'required|string|max:255',
           'price' => 'required|integer',
           'tagline' => 'required|string|max:255',
           'destination_id' => 'nullable|exists:destinations,id',
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
