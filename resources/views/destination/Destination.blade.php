<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>TrekNepal – Destinations</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            background: "#ffffff",
            foreground: "#0f172a",
            card: "#ffffff",
            border: "#dbeafe",
            primary: "#2563eb",
            accent: "#60a5fa",
            muted: "#64748b"
          }
        }
      }
    }
  </script>
</head>

<body class="bg-background text-foreground">

<!-- ================= NAVBAR ================= -->
<x-navbar />

<!-- ================= HERO ================= -->
<section class="relative h-screen flex items-center justify-center overflow-hidden bg-white">
  <img
    src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=1920&q=80"
    class="absolute inset-0 w-full h-full object-cover"
  />
  <div class="absolute inset-0 bg-gradient-to-b from-white/30 via-white/45 to-white/80"></div>

  <div class="relative z-10 text-center px-6 max-w-4xl">
    <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary mb-8">
      <i data-lucide="map-pin" class="w-4 h-4"></i>
      <span class="text-sm">NEPAL • THE HIMALAYAN KINGDOM</span>
    </div>

    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
      Discover <span class="block text-primary">Nepal's Treasures</span>
    </h1>

    <p class="text-lg text-muted max-w-2xl mx-auto mb-10">
      From the towering peaks of Everest to the ancient kingdoms of Mustang,
      explore the most breathtaking trekking destinations on Earth.
    </p>

    <div class="flex justify-center gap-4">
      <button onclick="scrollToDestinations()"
        class="bg-primary text-white px-8 py-4 rounded-lg flex items-center gap-2 shadow-lg hover:bg-blue-700 transition">
        <i data-lucide="compass"></i> Explore Regions
      </button>
      <button class="border border-blue-200 bg-white/90 text-foreground px-8 py-4 rounded-lg hover:bg-white transition">
        Plan Your Trek
      </button>
    </div>
  </div>

  <button onclick="scrollToDestinations()"
    class="absolute bottom-8 left-1/2 -translate-x-1/2 text-slate-600 flex flex-col items-center">
    <span class="text-xs uppercase">Scroll</span>
    <i data-lucide="chevron-down" class="animate-bounce"></i>
  </button>
</section>

<!-- ================= ALL DESTINATIONS ================= -->
<section id="destinations" class="py-16">
  @foreach($destinations as $index => $d)
    @php
      $bgImg = !empty($d->path) ? asset('storage/'.$d->path) : "https://images.unsplash.com/photo-1509644851169-2acc08aa25b5?q=80&w=2000";
      $bgColor = $index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
    @endphp
    <div class="relative min-h-[90vh] flex items-center {{ $bgColor }} overflow-hidden">
      <!-- Background Image -->
      <div class="absolute inset-0">
        <img
          src="{{ $bgImg }}"
          alt="{{ $d->destination_name }}"
          class="w-full h-full object-cover object-right"
        />
        <!-- White Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 to-white/10"></div>
      </div>

      <!-- Content -->
      <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
        <div class="max-w-3xl">

          <!-- Region -->
          <div class="flex items-center gap-2 text-sm font-medium text-gray-600 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M12 21s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
            {{ strtoupper($d->region ?? 'NEPAL') }}
          </div>

          <!-- Title -->
          <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-3">
            {{ $d->destination_name }}
          </h1>

          <!-- Quote -->
          @if($d->tagline)
            <p class="italic text-lg text-gray-500 mb-6">
              "{{ $d->tagline }}"
            </p>
          @endif

          <!-- Description -->
          <p class="text-gray-600 leading-relaxed max-w-2xl mb-8">
            {{ $d->description }}
          </p>

          <!-- Stats -->
          <div class="flex flex-wrap gap-3 mb-6">
            <span class="px-4 py-2 rounded-full bg-gray-100 text-sm font-medium text-black">
              🏔 {{ $d->elevation ?? '—' }}
            </span>
            <span class="px-4 py-2 rounded-full bg-gray-100 text-sm font-medium text-black">
              📅 {{ $d->best_season ?? '—' }}
            </span>
            <span class="px-4 py-2 rounded-full bg-gray-100 text-sm font-medium text-black">
              🥾 {{ $d->treks_available ?? '—' }}
            </span>
          </div>

          <!-- Tags -->
          <div class="flex flex-wrap gap-2 mb-8">
            @php
              $tags = collect(explode(',', $d->treks_available ?? ''))->filter()->take(6);
            @endphp
            @forelse($tags as $tag)
              <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                {{ trim($tag) }}
              </span>
            @empty
              <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">Popular Trek</span>
            @endforelse
          </div>

          <!-- CTA -->
          <a href="{{ route('treks.index') }}"
            class="inline-flex items-center gap-2 bg-gray-900 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-800 transition">
            Explore Treks
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M5 12h14M13 5l7 7-7 7" />
            </svg>
          </a>

        </div>
      </div>
    </div>
  @endforeach
</section>




<!-- ================= FOOTER ================= -->
<x-footer />

<!-- ================= JS ================= -->
<script>
  function scrollToDestinations() {
    const el = document.getElementById("destinations");
    if (el) el.scrollIntoView({ behavior: "smooth" });
  }
  lucide.createIcons();
</script>

</body>
</html>
