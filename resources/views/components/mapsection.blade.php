@php
  use App\Models\trek;
  use Illuminate\Support\Facades\Storage;
  use Illuminate\Support\Str;

  $featuredTreks = trek::with('trekImages')->latest()->take(4)->get();
  $whyReasons = [
    ['icon' => 'compass', 'title' => 'World-Class Trails', 'desc' => '8 of the 14 highest peaks on earth, with trails for every skill level.'],
    ['icon' => 'heart', 'title' => 'Warm Hospitality', 'desc' => 'Experience the legendary warmth of Nepali culture and Sherpa traditions.'],
    ['icon' => 'tree-pine', 'title' => 'Diverse Landscapes', 'desc' => 'From subtropical jungles to Arctic-like glaciers in a single trek.'],
    ['icon' => 'shield', 'title' => 'Expert Guides', 'desc' => 'Certified, experienced guides who know every trail like the back of their hand.'],
  ];
  $weatherData = [
    ['icon' => '☀️', 'region' => 'Everest', 'condition' => 'clear skies', 'temp' => 8, 'bestSeason' => true],
    ['icon' => '🌤️', 'region' => 'Annapurna', 'condition' => 'partly cloudy', 'temp' => 12, 'bestSeason' => true],
    ['icon' => '🌦️', 'region' => 'Langtang', 'condition' => 'light rain', 'temp' => 10, 'bestSeason' => false],
    ['icon' => '❄️', 'region' => 'Manaslu', 'condition' => 'snow', 'temp' => -2, 'bestSeason' => false],
  ];
@endphp

<section class="py-20">
  <div class="container mx-auto px-4">
    <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 gap-4">
      <div>
        <p class="text-emerald-600 font-medium text-xs sm:text-sm tracking-[0.35em] uppercase mb-2">Popular Routes</p>
        <h2 class="font-serif text-3xl md:text-4xl font-bold text-slate-900">Featured Treks</h2>
      </div>
      <a href="{{ route('treks.index') }}" class="font-medium border border-emerald-200 text-emerald-700 px-5 py-2.5 rounded-xl hover:bg-emerald-50 transition">
        View All Treks →
      </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($featuredTreks as $trek)
        @php
          $img = $trek->trekImages->sortBy('id')->first();
          $imgUrl = null;
          if ($img) {
            $photoPath = $img->photo ?? $img->image_path;
            if ($photoPath) {
              $imgUrl = Storage::url($photoPath);
              if (!$imgUrl || strpos($imgUrl, 'undefined') !== false) {
                $imgUrl = asset('storage/' . $photoPath);
              }
            }
          }
          $finalImg = $imgUrl ?: asset('image/alpine.png');
          $difficulty = $trek->difficultylevel ?? 'N/A';
        @endphp
        <a href="{{ route('treks.show', $trek->id) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
          <div class="relative h-52 overflow-hidden">
            <img src="{{ $finalImg }}" alt="{{ $trek->trekname }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy" />
            <div class="absolute top-3 left-3">
              <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $difficulty === 'Easy' ? 'bg-emerald-100 text-emerald-700' : ($difficulty === 'Moderate' ? 'bg-amber-100 text-amber-700' : ($difficulty === 'Challenging' ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-700')) }}">
                {{ $difficulty }}
              </span>
            </div>
            <div class="absolute top-3 right-3">
              <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/90 backdrop-blur text-slate-900 border border-white/70">
                Rs. {{ $trek->price ?? '-' }}
              </span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="font-serif text-lg font-semibold text-slate-900 mb-1 group-hover:text-emerald-700 transition-colors">
              {{ $trek->trekname }}
            </h3>
            <p class="text-sm text-slate-600 mb-4 line-clamp-2">
              {{ $trek->tagline ?? $trek->description ?? 'Explore this trek in the heart of the Himalayas.' }}
            </p>
            <div class="grid grid-cols-2 gap-2 text-xs text-slate-600">
              <span class="flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="9"></circle>
                  <path d="M12 7v5l3 3"></path>
                </svg>
                {{ $trek->duration ?? 'N/A' }}
              </span>
              <span class="flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
                </svg>
                {{ $trek->elevation ?? 'N/A' }}
              </span>
              <span class="flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M3 3v18h18"></path>
                  <rect x="7" y="13" width="3" height="5"></rect>
                  <rect x="12" y="9" width="3" height="9"></rect>
                  <rect x="17" y="5" width="3" height="13"></rect>
                </svg>
                {{ $trek->group_size ?? 'N/A' }}
              </span>
              <span class="flex items-center gap-1.5">
                <svg class="h-3.5 w-3.5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                {{ $trek->season ? Str::before($trek->season, ',') : 'All Seasons' }}
              </span>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>

<section class="py-20 bg-gradient-to-br from-amber-50 via-white to-rose-50">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <p class="text-emerald-600 font-medium text-xs sm:text-sm tracking-[0.35em] uppercase mb-2">Why Choose Us</p>
      <h2 class="font-serif text-3xl md:text-4xl font-bold text-slate-900">Why Trek Nepal?</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">
      @foreach($whyReasons as $item)
        <div class="text-center p-6 rounded-2xl bg-white shadow-lg border border-slate-100 hover:shadow-xl transition">
          <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-emerald-100 mb-4">
            @if($item['icon'] === 'compass')
              <svg class="h-7 w-7 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="m16 8-6 2-2 6 6-2 2-6z"></path>
              </svg>
            @elseif($item['icon'] === 'heart')
              <svg class="h-7 w-7 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.8 6.6a5.5 5.5 0 0 0-7.8 0L12 7.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 23l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"></path>
              </svg>
            @elseif($item['icon'] === 'tree-pine')
              <svg class="h-7 w-7 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m12 3 4 6H8l4-6z"></path>
                <path d="m12 9 5 7H7l5-7z"></path>
                <path d="m12 16 6 5H6l6-5z"></path>
                <path d="M12 21v-2"></path>
              </svg>
            @else
              <svg class="h-7 w-7 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V7l-8-4-8 4v5c0 6 8 10 8 10z"></path>
              </svg>
            @endif
          </div>
          <h3 class="font-serif font-semibold text-slate-900 mb-2">{{ $item['title'] }}</h3>
          <p class="text-sm text-slate-600 leading-relaxed">{{ $item['desc'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="py-20 bg-gradient-to-br from-slate-50 via-white to-emerald-50">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <p class="text-emerald-600 font-medium text-xs sm:text-sm tracking-[0.35em] uppercase mb-2">Live Conditions</p>
      <h2 class="font-serif text-3xl md:text-4xl font-bold text-slate-900">Current Trekking Weather</h2>
      <p class="text-slate-600 mt-3 max-w-lg mx-auto">
        Plan your adventure with real-time weather updates from major trekking regions.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-4xl mx-auto">
      @foreach($weatherData as $item)
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 text-center hover:shadow-xl transition">
          <span class="text-4xl mb-3 block">{{ $item['icon'] }}</span>
          <h3 class="font-serif font-semibold text-slate-900 mb-1">{{ $item['region'] }}</h3>
          <p class="text-sm text-slate-600 capitalize mb-3">{{ $item['condition'] }}</p>
          <div class="flex items-center justify-center gap-1 mb-3">
            <svg class="h-4 w-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M14 14a4 4 0 1 1-8 0c0-1.5.7-2.9 2-3.8V6a2 2 0 1 1 4 0v4.2c1.3.9 2 2.3 2 3.8z"></path>
              <line x1="12" y1="6" x2="12" y2="14"></line>
            </svg>
            <span class="text-2xl font-bold text-slate-900">{{ $item['temp'] }}°C</span>
          </div>
          @if($item['bestSeason'])
            <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-700">
              <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M8 12l2.5 2.5L16 9"></path>
              </svg>
              Best Season
            </span>
          @else
            <span class="inline-flex items-center gap-1 text-xs text-slate-500">
              <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M9 9l6 6M15 9l-6 6"></path>
              </svg>
              Off Season
            </span>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="py-20">
  <div class="container mx-auto px-4">
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-500 p-12 md:p-20 text-center">
      <h2 class="font-serif text-3xl md:text-4xl font-bold text-white mb-4">
        Ready for Your Himalayan Adventure?
      </h2>
      <p class="text-white/80 text-lg max-w-xl mx-auto mb-8">
        Join thousands of trekkers who have discovered the magic of Nepal's mountains with our expert team.
      </p>
      <a href="{{ route('booking.form') }}" class="inline-flex items-center justify-center text-base px-10 py-4 font-semibold bg-white text-emerald-700 rounded-xl shadow-lg hover:bg-emerald-50 transition">
        Start Planning Your Trek
      </a>
    </div>
  </div>
</section>
