@extends('layout')

@section('content')
<div class="min-h-screen bg-background">

    {{-- HERO SECTION --}}
    <header class="relative h-[40vh] min-h-[320px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1920&q=80');">
        </div>

        <div class="absolute inset-0 bg-gradient-to-b from-background/60 via-background/40 to-background"></div>

        <div class="relative z-10 text-center px-4">
            <i data-lucide="mountain" class="h-10 w-10 text-primary mx-auto mb-4"></i>
            <h1 class="text-4xl md:text-5xl font-bold text-foreground mb-4">Explore Our Treks</h1>
            <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                Discover breathtaking adventures through the world's most spectacular mountain ranges.
            </p>
        </div>
    </header>


    {{-- MAIN CONTENT --}}
    <main class="container mx-auto px-4 py-12">

        {{-- FILTER CARD --}}
        <section class="mb-10">
          <div class="bg-white/90 backdrop-blur-md border border-green-100 shadow-lg rounded-2xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 items-center">

              {{-- Search --}}
              <div class="col-span-1 md:col-span-2">
                <label class="text-sm font-semibold text-emerald-800 mb-2 block">Search Treks</label>
                <div class="relative w-full">
                  <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-emerald-500"></i>
                  <input id="searchInput" type="search" placeholder="Search by trek name or region"
                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-emerald-100 bg-white focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200 text-gray-800 shadow-sm transition" />
                </div>
              </div>

              {{-- Filters --}}
              <div class="col-span-1 flex flex-wrap md:flex-nowrap gap-3">
                <div class="flex-1 min-w-[140px]">
                  <label class="text-sm font-semibold text-emerald-800 mb-2 block">Difficulty</label>
                  <select id="difficultyFilter" class="w-full px-3 py-3 border rounded-xl bg-white border-emerald-100 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200 text-gray-800 shadow-sm">
                    <option value="all">All Levels</option>
                    <option value="Easy">Easy</option>
                    <option value="Moderate">Moderate</option>
                    <option value="Hard">Hard</option>
                    <option value="Extreme">Extreme</option>
                  </select>
                </div>

                <div class="flex-1 min-w-[140px]">
                  <label class="text-sm font-semibold text-emerald-800 mb-2 block">Sort By</label>
                  <select id="sortBy" class="w-full px-3 py-3 border rounded-xl bg-white border-emerald-100 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-200 text-gray-800 shadow-sm">
                    <option value="rating">Highest Rated</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="duration">Duration</option>
                  </select>
                </div>
              </div>

            </div>
          </div>
        </section>

        {{-- Result Count --}}
        <p class="text-sm text-muted-foreground mb-4">
            Showing <span id="resultCount" class="font-semibold text-foreground">{{ $treks->count() }}</span> treks
        </p>
 @php
      use App\Models\trek;
      use Illuminate\Support\Facades\Storage;
      use Illuminate\Support\Facades\File;
      $treks = trek::with('trekImages')->latest()->take(50)->get();

      $treksData = $treks->map(function($trek) {
        $img = $trek->trekImages->sortBy('id')->first();
        $photoPath = $img?->photo ?? $img?->image_path;
        $imgUrl = $photoPath ? (Storage::url($photoPath) ?: asset('storage/' . $photoPath)) : asset('image/alpine.png');
        return [
          'id' => $trek->id,
          'name' => $trek->trekname,
          'region' => $trek->region,
          'difficulty' => $trek->difficultylevel,
          'duration' => $trek->duration,
          'group_size' => $trek->group_size,
          'elevation' => $trek->elevation,
          'season' => $trek->season,
          'price' => $trek->price ?? 0,
          'image_url' => $imgUrl,
          'rating' => $trek->rating ?? 0,
          'reviews' => $trek->reviews ?? 0,
        ];
      });
    @endphp
        {{-- Trek Grid --}}
        <div id="trekGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      @forelse($treks as $trek)
      <article class="trek-card group bg-white/90 backdrop-blur-lg rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-green-100" data-id="{{ $trek->id }}">
        <div class="relative h-64 overflow-hidden bg-gradient-to-tr from-green-50 to-emerald-100">
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
          @endphp
          <img src="{{ $finalImg }}" alt="{{ $trek->trekname }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>
          <div class="absolute top-4 left-4 flex gap-2">
            <span class="px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 {{ $trek->difficultylevel === 'Easy' ? 'bg-green-500 text-white' : ($trek->difficultylevel === 'Moderate' ? 'bg-amber-500 text-white' : 'bg-red-500 text-white') }}">
              <i data-lucide="mountain" class="w-3 h-3"></i>
              {{ $trek->difficultylevel ?? 'N/A' }}
            </span>
            @if($trek->season)
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/80 text-emerald-700 border border-white/50">
              {{ $trek->season }}
            </span>
            @endif
          </div>
          <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur rounded-lg px-3 py-2 text-xs font-medium text-emerald-800 flex items-center gap-2 shadow">
            <i data-lucide="map-pin" class="w-4 h-4"></i>
            <span>{{ $trek->region ?? 'Unknown region' }}</span>
          </div>
        </div>

        <div class="p-6 space-y-4">
          <h3 class="font-display text-xl font-bold text-gray-900 group-hover:text-emerald-700 transition-colors">
            {{ $trek->trekname }}
          </h3>

          <div class="grid grid-cols-3 gap-3 text-sm text-gray-700">
            <div class="p-3 rounded-lg bg-emerald-50 text-emerald-700 flex items-center gap-2">
              <i data-lucide="clock" class="w-4 h-4"></i>
              <span>{{ $trek->duration ?? 'N/A' }}</span>
            </div>
            <div class="p-3 rounded-lg bg-teal-50 text-teal-700 flex items-center gap-2">
              <i data-lucide="users" class="w-4 h-4"></i>
              <span>{{ $trek->group_size ?? 'N/A' }}</span>
            </div>
            <div class="p-3 rounded-lg bg-amber-50 text-amber-700 flex items-center gap-2">
              <i data-lucide="trending-up" class="w-4 h-4"></i>
              <span>{{ $trek->elevation ?? '—' }}</span>
            </div>
          </div>

          <div class="flex items-center justify-between pt-2">
            <div>
              <span class="text-sm text-gray-500">Starting from</span>
              <p class="text-2xl font-bold text-emerald-700">₹{{ $trek->price ?? '-' }}</p>
            </div>
            <a href="{{ route('treks.show', $trek->id) }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition flex items-center gap-1 shadow">
              <span>Details</span>
              <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
          </div>
        </div>
      </article>
      @empty
      <div class="col-span-3 text-center py-12">
        <i data-lucide="trees" class="w-16 h-16 mx-auto text-gray-300 mb-4"></i>
        <p class="text-gray-500 text-lg">No treks available yet. Check back soon!</p>
      </div>
      @endforelse

    </div>

        {{-- Empty State --}}
        <div id="emptyState" class="hidden text-center py-16">
            <i data-lucide="mountain" class="h-16 w-16 text-muted-foreground/50 mx-auto mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">No treks found</h3>
            <p class="text-muted-foreground mb-4">Try adjusting your search or filters</p>
            <button id="clearBtn" 
                class="px-4 py-2 border rounded-lg hover:bg-accent bg-background transition">
                Clear Filters
            </button>
        </div>

    </main>


    {{-- FOOTER --}}
    <footer class="border-t bg-muted/30">
        <div class="container mx-auto px-4 py-8 text-center">
            <p class="text-sm text-muted-foreground">
                © 2024 Trek Adventures. All rights reserved.
            </p>
        </div>
    </footer>

</div>


{{-- TREKS DATA + JS --}}
<script>
    const treksData = @json($treksData ?? []);

    const searchInput = document.getElementById("searchInput");
    const difficultyFilter = document.getElementById("difficultyFilter");
    const sortBy = document.getElementById("sortBy");
    const trekGrid = document.getElementById("trekGrid");
    const emptyState = document.getElementById("emptyState");
    const resultCount = document.getElementById("resultCount");
    const clearBtn = document.getElementById("clearBtn");

    function renderTreks() {
        const query = searchInput.value.trim().toLowerCase();
        const diff = difficultyFilter.value;

        let treks = treksData.filter(trek => {
            const matchesSearch =
                trek.name?.toLowerCase().includes(query) ||
                trek.region?.toLowerCase().includes(query);

            const matchesDifficulty =
                diff === "all" || trek.difficulty === diff;

            return matchesSearch && matchesDifficulty;
        });

        treks.sort((a, b) => {
            switch (sortBy.value) {
                case "price-low": return (a.price || 0) - (b.price || 0);
                case "price-high": return (b.price || 0) - (a.price || 0);
                case "duration": return (a.duration || 0) - (b.duration || 0);
                case "rating": return (b.rating || 0) - (a.rating || 0);
                default: return (b.reviews || 0) - (a.reviews || 0);
            }
        });

        trekGrid.innerHTML = "";
        treks.forEach(trek => {
            trekGrid.innerHTML += `
      <article class="group bg-white/90 backdrop-blur-lg rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-green-100">
        <div class="relative h-64 overflow-hidden bg-gradient-to-tr from-green-50 to-emerald-100">
          <img src="${trek.image_url}" alt="${trek.name}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>
          <div class="absolute top-4 left-4 flex gap-2">
            <span class="px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 ${trek.difficulty === 'Easy' ? 'bg-green-500 text-white' : (trek.difficulty === 'Moderate' ? 'bg-amber-500 text-white' : 'bg-red-500 text-white')}">
              <i data-lucide="mountain" class="w-3 h-3"></i>
              ${trek.difficulty ?? 'N/A'}
            </span>
            ${trek.season ? `<span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/80 text-emerald-700 border border-white/50">${trek.season}</span>` : ''}
          </div>
          <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur rounded-lg px-3 py-2 text-xs font-medium text-emerald-800 flex items-center gap-2 shadow">
            <i data-lucide="map-pin" class="w-4 h-4"></i>
            <span>${trek.region ?? 'Unknown region'}</span>
          </div>
        </div>

        <div class="p-6 space-y-4">
          <h3 class="font-display text-xl font-bold text-gray-900 group-hover:text-emerald-700 transition-colors">
            ${trek.name}
          </h3>

          <div class="grid grid-cols-3 gap-3 text-sm text-gray-700">
            <div class="p-3 rounded-lg bg-emerald-50 text-emerald-700 flex items-center gap-2">
              <i data-lucide="clock" class="w-4 h-4"></i>
              <span>${trek.duration ?? 'N/A'}</span>
            </div>
            <div class="p-3 rounded-lg bg-teal-50 text-teal-700 flex items-center gap-2">
              <i data-lucide="users" class="w-4 h-4"></i>
              <span>${trek.group_size ?? 'N/A'}</span>
            </div>
            <div class="p-3 rounded-lg bg-amber-50 text-amber-700 flex items-center gap-2">
              <i data-lucide="trending-up" class="w-4 h-4"></i>
              <span>${trek.elevation ?? '—'}</span>
            </div>
          </div>

          <div class="flex items-center justify-between pt-2">
            <div>
              <span class="text-sm text-gray-500">Starting from</span>
              <p class="text-2xl font-bold text-emerald-700">₹${trek.price ?? '-'}</p>
            </div>
            <a href="/treks/${trek.id}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition flex items-center gap-1 shadow">
              <span>Details</span>
              <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
          </div>
        </div>
      </article>
            `;
        });

        resultCount.textContent = treks.length;
        emptyState.classList.toggle("hidden", treks.length !== 0);
        lucide.createIcons();
    }

    searchInput.addEventListener("input", renderTreks);
    difficultyFilter.addEventListener("change", renderTreks);
    sortBy.addEventListener("change", renderTreks);

    clearBtn.addEventListener("click", () => {
        searchInput.value = "";
        difficultyFilter.value = "all";
        renderTreks();
    });

    renderTreks();
</script>

<script>
    lucide.createIcons();
</script>

@endsection
