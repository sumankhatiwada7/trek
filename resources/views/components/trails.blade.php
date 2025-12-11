<section class="py-20 md:py-32 bg-gradient-to-b from-green-50 via-white to-green-50">
  <div class="container mx-auto px-4">

    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto mb-16">
      <span class="inline-block px-4 py-2 bg-green-100 rounded-full text-green-700 text-sm font-medium mb-4 flex items-center gap-2 mx-auto">
        <i data-lucide="leaf" class="w-4 h-4"></i>
        Featured Treks
      </span>
      <h2 class="font-display text-3xl md:text-5xl font-bold text-gray-900 mb-4">
        Explore Nature's Wonders
      </h2>
      <p class="text-gray-600 text-lg">
        Hand-picked trails where adventure meets pristine wilderness for every explorer
      </p>
    </div>

    @php
      use App\Models\trek;
      use Illuminate\Support\Facades\Storage;
      use Illuminate\Support\Facades\File;
      $treks = trek::with('trekImages')->latest()->take(6)->get();
    @endphp

    <!-- Trek Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      @forelse($treks as $trek)
      <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-green-100">
        <div class="relative h-64 overflow-hidden bg-gray-200">
          @php
            $img = $trek->trekImages->sortBy('id')->first();
            $imgUrl = null;
            if ($img) {
              // Try both 'photo' and 'image_path' columns
              $photoPath = $img->photo ?? $img->image_path;
              if ($photoPath) {
                $imgUrl = Storage::url($photoPath);
                // Fallback to asset path if Storage::url doesn't work
                if (!$imgUrl || strpos($imgUrl, 'undefined') !== false) {
                  $imgUrl = asset('storage/' . $photoPath);
                }
              }
            }
            $finalImg = $imgUrl ?: asset('image/alpine.png');
          @endphp
          <img src="{{ $finalImg }}" alt="{{ $trek->trekname }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
          <div class="absolute top-4 left-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 {{ $trek->difficultylevel === 'Easy' ? 'bg-green-500 text-white' : ($trek->difficultylevel === 'Moderate' ? 'bg-amber-500 text-white' : 'bg-red-500 text-white') }}">
              <i data-lucide="mountain" class="w-3 h-3"></i>
              {{ $trek->difficultylevel ?? 'N/A' }}
            </span>
          </div>
        </div>

        <div class="p-6">
          <div class="flex items-center gap-2 text-green-700 text-sm mb-2 font-medium">
            <i data-lucide="map-pin" class="h-4 w-4"></i>
            <span>{{ $trek->region ?? 'Unknown region' }}</span>
          </div>

          <h3 class="font-display text-xl font-bold text-gray-900 mb-4 group-hover:text-green-600 transition-colors">
            {{ $trek->trekname }}
          </h3>

          <div class="flex items-center gap-4 text-sm text-gray-600 mb-6">
            <div class="flex items-center gap-1">
              <i data-lucide="clock" class="h-4 w-4 text-green-600"></i>
              <span>{{ $trek->duration ?? 'N/A' }}</span>
            </div>
            <div class="flex items-center gap-1">
              <i data-lucide="users" class="h-4 w-4 text-green-600"></i>
              <span>{{ $trek->group_size ?? 'N/A' }}</span>
            </div>
          </div>

          <div class="flex items-center justify-between pt-4 border-t border-green-100">
            <div>
              <span class="text-sm text-gray-500">From</span>
              <p class="text-2xl font-bold text-green-600">₹{{ $trek->price ?? '-' }}</p>
            </div>
            <a href="{{ route('treks.show', $trek->id) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center gap-1">
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

    <!-- View All CTA -->
    <div class="text-center mt-12">
      <button class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:shadow-lg transition flex items-center gap-2 mx-auto font-semibold">
        <i data-lucide="compass" class="w-5 h-5"></i>
        View All Adventures
      </button>
    </div>

  </div>
</section>
