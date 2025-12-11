<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>{{ $trek->trekname }}</title>

  <!-- Tailwind CDN (for quick dev) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Lucide icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    /* small custom styles */
    .bg-gradient-hero {
      background: linear-gradient(to bottom, rgba(0,0,0,0.08), rgba(0,0,0,0.82));
    }
    .shadow-soft { box-shadow: 0 6px 18px rgba(8, 15, 29, 0.06); }
    .shadow-elevated { box-shadow: 0 10px 40px rgba(8,15,29,0.12); }
    /* itinerary collapse animation */
    .collapse-enter { max-height: 0; overflow: hidden; transition: max-height 300ms ease; }
    .collapse-enter.open { max-height: 2000px; }
    
    /* Add fade-in animation for images */
    .fade-in {
      animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

  @php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\File;
    
    // Get hero image - handle null case
    $heroImage = optional($trek->trekImages->sortBy('id')->first())->photo ?? optional($trek->trekImages->sortBy('id')->first())->image_path;
    $heroImageUrl = null;
    
    if ($heroImage) {
        // Try Storage::url first (for 'trek_images/...' paths)
        $heroImageUrl = Storage::url($heroImage);
        
        // If that doesn't work, try asset path
        if (!$heroImageUrl || !filter_var($heroImageUrl, FILTER_VALIDATE_URL)) {
            $heroImageUrl = asset('storage/' . $heroImage);
        }
    }
    
    // Fallback to a default image
    $defaultHeroImage = asset('images/alpine.png');
    $finalHeroImage = $heroImageUrl ?: $defaultHeroImage;
  @endphp

  <div class="min-h-screen">

    <!-- HERO -->
    <section class="relative h-[85vh] min-h-[600px] overflow-hidden">
      <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image:url('{{ $finalHeroImage }}'); background-attachment: fixed;">
        <div class="absolute inset-0 bg-gradient-hero"></div>
      </div>

      <div class="relative z-10 flex h-full flex-col justify-end pb-16">
        <div class="container mx-auto px-4">
          <div class="max-w-3xl">
            <div class="mb-4 flex items-center gap-3">
              <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">
                {{ $trek->difficultylevel ?? 'N/A' }}
              </span>

              <div class="flex items-center gap-2 text-yellow-300">
                <i data-lucide="star" class="w-4 h-4 fill-yellow-300"></i>
                <span class="text-sm font-medium">4.9</span>
                <span class="text-sm text-gray-200">(reviews)</span>
              </div>
            </div>

            <h1 class="mb-3 font-serif text-5xl font-bold tracking-tight text-white md:text-6xl lg:text-7xl">
              {{ $trek->trekname }}
            </h1>

            <p class="mb-4 text-xl text-gray-200 md:text-2xl">{{ $trek->tagline ?? 'Trek with us' }}</p>

            <div class="mb-8 flex items-center gap-2 text-gray-200">
              <i data-lucide="map-pin" class="w-5 h-5"></i>
              <span class="text-lg">{{ $trek->region ?? 'Unknown location' }}</span>
            </div>

            <div class="flex flex-wrap gap-4">
              <button class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700 transition-colors">
                Book This Trek
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
              </button>

              <button class="inline-flex items-center gap-2 rounded-lg border border-white/40 bg-white/10 px-6 py-3 text-white hover:bg-white hover:text-black transition-colors">
                Download Itinerary
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- QUICK STATS -->
    <section class="-mt-12 relative z-20 pb-16">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-6">
          <!-- Duration -->
          <div class="flex flex-col items-center gap-2 rounded-xl bg-white p-4 shadow-soft transition hover:shadow-elevated">
            <div class="rounded-full bg-blue-50 p-3">
              <i data-lucide="clock" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs font-medium uppercase tracking-wider text-gray-500">Duration</span>
            <span class="font-serif text-lg font-semibold text-gray-800">{{ $trek->duration ?? 'N/A' }}</span>
          </div>

          <!-- Max Elevation -->
          <div class="flex flex-col items-center gap-2 rounded-xl bg-white p-4 shadow-soft transition hover:shadow-elevated">
            <div class="rounded-full bg-blue-50 p-3">
              <i data-lucide="trending-up" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs font-medium uppercase tracking-wider text-gray-500">Max Elevation</span>
            <span class="font-serif text-lg font-semibold text-gray-800">{{ $trek->elevation ?? 'N/A' }}</span>
          </div>

          <!-- Difficulty -->
          <div class="flex flex-col items-center gap-2 rounded-xl bg-white p-4 shadow-soft transition hover:shadow-elevated">
            <div class="rounded-full bg-blue-50 p-3">
              <i data-lucide="mountain" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs font-medium uppercase tracking-wider text-gray-500">Difficulty</span>
            <span class="font-serif text-lg font-semibold text-gray-800">{{ $trek->difficultylevel ?? 'N/A' }}</span>
          </div>

          <!-- Best Season -->
          <div class="flex flex-col items-center gap-2 rounded-xl bg-white p-4 shadow-soft transition hover:shadow-elevated">
            <div class="rounded-full bg-blue-50 p-3">
              <i data-lucide="calendar" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs font-medium uppercase tracking-wider text-gray-500">Best Season</span>
            <span class="font-serif text-lg font-semibold text-gray-800">{{ $trek->season ?? 'N/A' }}</span>
          </div>

          <!-- Group Size -->
          <div class="flex flex-col items-center gap-2 rounded-xl bg-white p-4 shadow-soft transition hover:shadow-elevated">
            <div class="rounded-full bg-blue-50 p-3">
              <i data-lucide="users" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs font-medium uppercase tracking-wider text-gray-500">Group Size</span>
            <span class="font-serif text-lg font-semibold text-gray-800">{{ $trek->group_size ?? 'N/A' }}</span>
          </div>
        </div>
      </div>
    </section>

    <!-- DESCRIPTION & HIGHLIGHTS -->
    <section class="py-16">
      <div class="container mx-auto px-4">
        <div class="grid gap-12 lg:grid-cols-2">

          <!-- Description -->
          <div>
            <h2 class="mb-6 font-serif text-3xl font-bold text-gray-900 md:text-4xl">About This Trek</h2>
            <div class="space-y-4 text-lg leading-relaxed text-gray-600">
              <p>{{ $trek->description ?? 'No description available for this trek yet.' }}</p>
            </div>
          </div>

          <!-- Highlights -->
          <div>
            <h2 class="mb-6 font-serif text-3xl font-bold text-gray-900 md:text-4xl">Trek Highlights</h2>
            <ul class="space-y-4">
              @forelse($trek->highlights->sortBy('day') as $highlight)
              <li class="flex items-start gap-4 rounded-lg bg-white p-4 shadow-soft transition hover:shadow-elevated">
                <div class="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white">{{ $highlight->day }}</div>
                <span class="text-gray-800">{{ $highlight->description }}</span>
              </li>
              @empty
              <li class="text-muted-foreground">No highlights added yet.</li>
              @endforelse
            </ul>
          </div>

        </div>
      </div>
    </section>

    <!-- WEATHER SECTION -->
    <section class="bg-gradient-to-br from-blue-50 to-cyan-50 py-16">
      <div class="container mx-auto px-4">
        <h2 class="mb-8 text-center font-serif text-3xl font-bold text-gray-900 md:text-4xl">
          Current Weather
        </h2>

        @if(isset($weatherData['error']))
          <div class="rounded-xl bg-white p-8 text-center shadow-soft max-w-md mx-auto">
            <i data-lucide="cloud-off" class="w-12 h-12 mx-auto text-gray-400 mb-3"></i>
            <p class="text-gray-600">{{ $weatherData['error'] }}</p>
          </div>
        @elseif(isset($weatherData['current']))
          <div class="max-w-4xl mx-auto">
            <!-- Location Card -->
            <div class="bg-white rounded-xl shadow-soft p-6 mb-6">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-xl font-bold text-gray-900">{{ $weatherData['location']['name'] }}</h3>
                  <p class="text-gray-600">
                    {{ $weatherData['location']['region'] }}, {{ $weatherData['location']['country'] }}
                  </p>
                </div>
                <div class="text-right">
                  <p class="text-sm text-gray-500">Updated just now</p>
                </div>
              </div>
            </div>
            
            <!-- Main Weather Card -->
            <div class="bg-white rounded-xl shadow-soft p-8">
              <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                
                <!-- Weather Condition & Temperature -->
                <div class="text-center md:text-left">
                  <div class="flex items-center justify-center md:justify-start gap-6 mb-4">
                    @if($weatherData['current']['condition_icon'])
                      <img src="{{ $weatherData['current']['condition_icon'] }}" 
                           alt="{{ $weatherData['current']['condition_text'] }}" 
                           class="w-28 h-28 fade-in">
                    @endif
                    <div>
                      <p class="text-6xl font-bold text-gray-900">{{ round($weatherData['current']['temp_c']) }}°C</p>
                      <p class="text-xl text-gray-600 mt-2">{{ $weatherData['current']['condition_text'] }}</p>
                      <p class="text-gray-500">Feels like {{ round($weatherData['current']['feelslike_c']) }}°C</p>
                    </div>
                  </div>
                </div>

                <!-- Weather Details Grid -->
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 flex-1">
                  <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <i data-lucide="droplets" class="w-6 h-6 mx-auto text-blue-500 mb-2"></i>
                    <p class="text-sm font-semibold text-gray-600">Humidity</p>
                    <p class="text-xl font-bold text-gray-900">{{ $weatherData['current']['humidity'] }}%</p>
                  </div>
                  
                  <div class="text-center p-4 bg-teal-50 rounded-lg">
                    <i data-lucide="wind" class="w-6 h-6 mx-auto text-teal-500 mb-2"></i>
                    <p class="text-sm font-semibold text-gray-600">Wind Speed</p>
                    <p class="text-xl font-bold text-gray-900">{{ $weatherData['current']['wind_kph'] }} km/h</p>
                    @if($weatherData['current']['wind_dir'])
                      <p class="text-xs text-gray-500">{{ $weatherData['current']['wind_dir'] }}</p>
                    @endif
                  </div>
                  
                  <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <i data-lucide="gauge" class="w-6 h-6 mx-auto text-purple-500 mb-2"></i>
                    <p class="text-sm font-semibold text-gray-600">Pressure</p>
                    <p class="text-xl font-bold text-gray-900">{{ $weatherData['current']['pressure_mb'] }} mb</p>
                  </div>
                  
                  <div class="text-center p-4 bg-green-50 rounded-lg">
                    <i data-lucide="eye" class="w-6 h-6 mx-auto text-green-500 mb-2"></i>
                    <p class="text-sm font-semibold text-gray-600">Visibility</p>
                    <p class="text-xl font-bold text-gray-900">{{ $weatherData['current']['vis_km'] }} km</p>
                  </div>
                </div>
              </div>
              
              <!-- Additional Weather Info -->
              <div class="mt-8 grid grid-cols-2 gap-4">
                @if($weatherData['current']['precip_mm'] > 0)
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <i data-lucide="cloud-rain" class="w-5 h-5 text-blue-400 mr-3"></i>
                  <div>
                    <p class="text-sm text-gray-600">Precipitation</p>
                    <p class="font-semibold">{{ $weatherData['current']['precip_mm'] }} mm</p>
                  </div>
                </div>
                @endif
                
                @if($weatherData['current']['cloud'] > 0)
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <i data-lucide="cloud" class="w-5 h-5 text-gray-400 mr-3"></i>
                  <div>
                    <p class="text-sm text-gray-600">Cloud Cover</p>
                    <p class="font-semibold">{{ $weatherData['current']['cloud'] }}%</p>
                  </div>
                </div>
                @endif
              </div>
              
              <!-- Trekking Tips -->
              <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex items-start">
                  <i data-lucide="info" class="w-5 h-5 text-yellow-600 mt-0.5 mr-3"></i>
                  <div>
                    <h4 class="font-semibold text-yellow-800 mb-1">Trekking Tips Based on Current Weather</h4>
                    <ul class="text-sm text-yellow-700 space-y-1">
                      @if($weatherData['current']['temp_c'] < 10)
                      <li>• Temperatures below 10°C: Wear thermal layers</li>
                      @elseif($weatherData['current']['temp_c'] > 25)
                      <li>• Temperatures above 25°C: Stay hydrated, wear sun protection</li>
                      @endif
                      
                      @if($weatherData['current']['humidity'] > 70)
                      <li>• High humidity: Pace yourself, drink extra water</li>
                      @endif
                      
                      @if($weatherData['current']['wind_kph'] > 20)
                      <li>• Windy conditions: Secure loose items, be cautious on ridges</li>
                      @endif
                      
                      @if($weatherData['current']['precip_mm'] > 5)
                      <li>• Rain expected: Waterproof gear recommended</li>
                      @endif
                      
                      @if($weatherData['current']['vis_km'] < 5)
                      <li>• Limited visibility: Stay on marked trails</li>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @else
          <div class="text-center py-12">
            <p class="text-gray-500">Weather data not available for this trek.</p>
          </div>
        @endif
      </div>
    </section>

    <!-- GALLERY -->
    <section class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-20">
      <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="mb-12">
          <div class="flex items-center gap-3 mb-3">
            <i data-lucide="images" class="w-8 h-8 text-green-400"></i>
            <span class="text-green-400 font-semibold text-sm uppercase tracking-widest">Photo Gallery</span>
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Experience the Beauty</h2>
          <p class="text-lg text-gray-300 max-w-2xl">Discover stunning moments from {{ $trek->trekname }}. Each image tells a story of adventure and natural wonder.</p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse($trek->trekImages as $index => $image)
            <div class="group relative overflow-hidden rounded-2xl shadow-xl transition-all duration-500 {{ $index === 0 ? 'md:col-span-2 md:row-span-2' : '' }}">
              <!-- Image -->
              <img 
                src="{{ asset('storage/' . $image->photo) }}" 
                alt="Trek Photo"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                style="{{ $index === 0 ? 'aspect-ratio: 2/2' : 'aspect-ratio: 1/1' }}"
              >
              
              <!-- Overlay -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end justify-between p-6">
                <div class="flex-1">
                  <p class="text-white font-semibold text-lg mb-1">Photo #{{ $index + 1 }}</p>
                  <p class="text-gray-300 text-sm flex items-center gap-2">
                    <i data-lucide="mountain" class="w-4 h-4"></i>
                    {{ $trek->trekname }}
                  </p>
                </div>
                <button class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full transition-all duration-300 transform group-hover:scale-110">
                  <i data-lucide="expand" class="w-5 h-5"></i>
                </button>
              </div>

              <!-- Badge -->
              @if($index === 0)
                <div class="absolute top-4 left-4 z-10 bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold flex items-center gap-2">
                  <i data-lucide="star" class="w-4 h-4 fill-white"></i>
                  Featured
                </div>
              @endif
            </div>
          @empty
            <div class="col-span-full py-16">
              <div class="text-center">
                <i data-lucide="image-off" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                <p class="text-gray-400 text-lg">No photos available for this trek yet.</p>
              </div>
            </div>
          @endforelse
        </div>

       
       
      </div>
    </section>

    <!-- ITINERARY (FULL) -->
    <section class="py-16">
      <div class="container mx-auto px-4">
        <h2 class="mb-8 text-center font-serif text-3xl font-bold text-gray-900 md:text-4xl">Itinerary</h2>

        <div class="mx-auto max-w-3xl space-y-4">
          @forelse($trek->itinerary->sortBy('day') as $item)
          <div class="group flex items-start gap-6 rounded-xl bg-white p-6 shadow-soft transition hover:shadow-elevated">
            <div class="flex h-14 w-14 shrink-0 flex-col items-center justify-center rounded-xl bg-blue-600 text-white">
              <span class="text-xs uppercase">Day</span>
              <span class="font-serif text-xl font-bold">{{ $item->day }}</span>
            </div>
            <div>
              <h3 class="mb-1 font-serif text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $item->title ?? 'Day ' . $item->day }}</h3>
              <p class="text-gray-600">{{ $item->description }}</p>
            </div>
          </div>
          @empty
          <p class="text-center text-muted-foreground">No itinerary added yet.</p>
          @endforelse
        </div>
      </div>
    </section>

    <!-- BOOKING CTA -->
    <section class="relative overflow-hidden py-20">
      <div class="absolute inset-0 bg-cover bg-center fade-in" style="background-image: url('https://images.unsplash.com/photo-1536152470826-0d7162a72f8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')">
        <div class="absolute inset-0 bg-black/70"></div>
      </div>

      <div class="container relative z-10 mx-auto px-4 text-center">
        <h2 class="mb-4 font-serif text-4xl font-bold text-white md:text-5xl">Ready for Your Adventure?</h2>
        <p class="mx-auto mb-8 max-w-2xl text-lg text-white/80">
          Join thousands of adventurers who have experienced the magic of this legendary trek.
          Book now and secure your spot on the journey of a lifetime.
        </p>

        <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
          <div class="text-center sm:text-left">
            <p class="text-sm text-white/70">Starting from</p>
            <p class="font-serif text-4xl font-bold text-white">
              {{ $trek->price ?? '$ -' }}
              <span class="text-lg font-normal text-white/70"> / person</span>
            </p>
          </div>

          <button class="sm:ml-8 inline-flex items-center gap-2 rounded-lg bg-yellow-500 px-6 py-3 font-semibold text-white hover:bg-yellow-600 transition-colors">
            Book Now
            <i data-lucide="chevron-right" class="w-5 h-5"></i>
          </button>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 py-8 text-center text-white/70">
      <div class="container mx-auto px-4">
        <p class="text-sm">© 2024 Trek Adventures. All rights reserved.</p>
      </div>
    </footer>

  </div>

  <script>
    // Lucide icons init
    lucide.createIcons();

    // Itinerary toggle logic
    (function () {
      const toggleBtn = document.getElementById('toggleItinerary');
      const collapseBtn = document.getElementById('collapseItinerary');
      const fullItinerary = document.getElementById('full-itinerary');

      if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
          fullItinerary.classList.add('open');
          fullItinerary.style.maxHeight = fullItinerary.scrollHeight + 'px';
          toggleBtn.classList.add('hidden');
          collapseBtn.classList.remove('hidden');
        });
      }

      if (collapseBtn) {
        collapseBtn.addEventListener('click', function () {
          fullItinerary.style.maxHeight = 0;
          fullItinerary.classList.remove('open');
          collapseBtn.classList.add('hidden');
          toggleBtn.classList.remove('hidden');
          // scroll back to itinerary top for better UX
          setTimeout(() => {
            fullItinerary.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }, 200);
        });
      }
    })();

    // Image lazy loading enhancement
    document.addEventListener('DOMContentLoaded', function() {
      const images = document.querySelectorAll('img');
      
      images.forEach(img => {
        // If image fails to load, set a placeholder
        img.addEventListener('error', function() {
          this.src = 'https://via.placeholder.com/800x600?text=Image+Not+Available';
          this.classList.add('fade-in');
        });
        
        // Add fade-in when loaded
        if (img.complete) {
          img.classList.add('fade-in');
        } else {
          img.addEventListener('load', function() {
            this.classList.add('fade-in');
          });
        }
      });
    });
  </script>
</body>
</html>