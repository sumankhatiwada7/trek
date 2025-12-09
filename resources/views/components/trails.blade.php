<section class="py-20 md:py-32 bg-background">
  <div class="container mx-auto px-4">

    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto mb-16">
      <span class="inline-block px-4 py-2 bg-secondary rounded-full text-primary text-sm font-medium mb-4">
        Featured Treks
      </span>
      <h2 class="font-display text-3xl md:text-5xl font-bold text-foreground mb-4">
        Popular Adventures
      </h2>
      <p class="text-muted-foreground text-lg">
        Hand-picked trails offering unforgettable experiences for every skill level
      </p>
    </div>

    @php
      use App\Models\trek;
      use Illuminate\Support\Facades\Storage;
      $treks = trek::with('trekImages')->latest()->take(6)->get();
    @endphp

    <!-- Trek Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      @forelse($treks as $trek)
      <article class="group bg-card rounded-2xl overflow-hidden shadow-card hover:shadow-elevated transition-all duration-500 hover:-translate-y-2 border border-border">
        <div class="relative h-64 overflow-hidden">
          @php $img = $trek->trekImages->sortBy('id')->first(); @endphp
          <img src="{{ $img ? Storage::url($img->image_path) : asset('image/alpine.png') }}" alt="{{ $trek->trekname }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
          <div class="absolute top-4 left-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $trek->difficultylevel === 'Easy' ? 'bg-green-100 text-green-700' : ($trek->difficultylevel === 'Moderate' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
              {{ $trek->difficultylevel ?? 'N/A' }}
            </span>
          </div>
        </div>

        <div class="p-6">
          <div class="flex items-center gap-2 text-muted-foreground text-sm mb-2">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <path d="m8 3 4 8 5-5 5 13H2L8 3z" />
            </svg>
            <span>{{ $trek->region ?? 'Unknown region' }}</span>
          </div>

          <h3 class="font-display text-xl font-bold text-foreground mb-4 group-hover:text-primary transition-colors">
            {{ $trek->trekname }}
          </h3>

          <div class="flex items-center gap-4 text-sm text-muted-foreground mb-6">
            <div class="flex items-center gap-1">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 6v6l4 2"></path>
              </svg>
              <span>{{ $trek->duration ?? 'N/A' }}</span>
            </div>
            <div class="flex items-center gap-1">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
              </svg>
              <span>{{ $trek->group_size ?? 'N/A' }}</span>
            </div>
          </div>

          <div class="flex items-center justify-between pt-4 border-t border-border">
            <div>
              <span class="text-sm text-muted-foreground">From</span>
              <p class="text-2xl font-bold text-foreground">{{ $trek->price ?? '$ -' }}</p>
            </div>
            <a href="{{ route('treks.show', $trek->id) }}" class="px-4 py-2 bg-primary text-trek-cream rounded hover:bg-primary/90 transition">View Details</a>
          </div>
        </div>
      </article>
      @empty
      <p class="text-center text-muted-foreground col-span-3">No treks available.</p>
      @endforelse

    </div>

    <!-- View All CTA -->
    <div class="text-center mt-12">
      <button class="px-6 py-3 border border-primary text-primary rounded hover:bg-primary/10 transition">View All Treks</button>
    </div>

  </div>
</section>
