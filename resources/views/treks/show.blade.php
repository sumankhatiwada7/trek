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
  </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

  @php
    use Illuminate\Support\Facades\Storage;
    $heroImage = optional($trek->trekImages->sortBy('id')->first())->image_path;
  @endphp

  <div class="min-h-screen">

    <!-- HERO -->
    <section class="relative h-[85vh] min-h-[600px] overflow-hidden">
      <div class="absolute inset-0 bg-cover bg-center" style="background-image:url('{{ $heroImage ? Storage::url($heroImage) : asset('image/alpine.png') }}')">
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
              <button class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">
                Book This Trek
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
              </button>

              <button class="inline-flex items-center gap-2 rounded-lg border border-white/40 bg-white/10 px-6 py-3 text-white hover:bg-white hover:text-black transition">
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
          <!-- Reusable stat -->
          <div class="flex flex-col items-center gap-2 rounded-xl bg-white p-4 shadow-soft transition hover:shadow-elevated">
            <div class="rounded-full bg-blue-50 p-3">
              <i data-lucide="clock" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs font-medium uppercase tracking-wider text-gray-500">Duration</span>
            <span class="font-serif text-lg font-semibold text-gray-800">{{ $trek->duration ?? 'N/A' }}</span>
          </div>

          <div class="flex flex-col items-center gap-2 rounded-xl bg-white p-4 shadow-soft transition hover:shadow-elevated">
            <div class="rounded-full bg-blue-50 p-3">
              <i data-lucide="trending-up" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs font-medium uppercase tracking-wider text-gray-500">Max Elevation</span>
            <span class="font-serif text-lg font-semibold text-gray-800">{{ $trek->elevation ?? 'N/A' }}</span>
          </div>

          <div class="flex flex-col items-center gap-2 rounded-xl bg-white p-4 shadow-soft transition hover:shadow-elevated">
            <div class="rounded-full bg-blue-50 p-3">
              <i data-lucide="mountain" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs font-medium uppercase tracking-wider text-gray-500">Difficulty</span>
            <span class="font-serif text-lg font-semibold text-gray-800">{{ $trek->difficultylevel ?? 'N/A' }}</span>
          </div>

          <div class="flex flex-col items-center gap-2 rounded-xl bg-white p-4 shadow-soft transition hover:shadow-elevated">
            <div class="rounded-full bg-blue-50 p-3">
              <i data-lucide="calendar" class="w-5 h-5 text-blue-600"></i>
            </div>
            <span class="text-xs font-medium uppercase tracking-wider text-gray-500">Best Season</span>
            <span class="font-serif text-lg font-semibold text-gray-800">{{ $trek->season ?? 'N/A' }}</span>
          </div>

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

    <!-- GALLERY -->
    <section class="bg-gray-100 py-16">
      <div class="container mx-auto px-4">
        <h2 class="mb-8 text-center font-serif text-3xl font-bold text-gray-900 md:text-4xl">Gallery</h2>
        <div class="grid gap-4 md:grid-cols-3">
          @php $gallery = $trek->trekImages->take(6); @endphp
          @forelse($gallery as $image)
          <div class="group aspect-[4/3] overflow-hidden rounded-xl shadow-soft transition hover:shadow-elevated">
            <img src="{{ Storage::url($image->image_path) }}" alt="{{ $trek->trekname }} image" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
          </div>
          @empty
          <p class="text-center text-muted-foreground col-span-3">No images available.</p>
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
      <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('./images/trek-camp.jpg')">
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

          <button class="sm:ml-8 inline-flex items-center gap-2 rounded-lg bg-yellow-500 px-6 py-3 font-semibold text-white hover:bg-yellow-600">
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

      toggleBtn.addEventListener('click', function () {
        fullItinerary.classList.add('open');
        fullItinerary.style.maxHeight = fullItinerary.scrollHeight + 'px';
        toggleBtn.classList.add('hidden');
        collapseBtn.classList.remove('hidden');
      });

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
    })();
  </script>
</body>
</html>
