<footer class="bg-slate-900 text-white">
  <div class="container mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
      <a href="/" class="flex items-center gap-2">
        <svg class="h-7 w-7 text-emerald-300" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="m8 3 4 8 5-5 5 13H2L8 3z" />
        </svg>
        <span class="font-serif text-xl font-bold">TrekVenture</span>
      </a>

      <div class="flex flex-wrap items-center justify-center gap-6 text-sm text-white/70">
        <a href="{{ route('treks.index') }}" class="hover:text-white transition-colors">Treks</a>
        <a href="{{ route('front.destinations') }}" class="hover:text-white transition-colors">Destinations</a>
        <a href="{{ route('about') }}" class="hover:text-white transition-colors">About</a>
        <a href="/contact" class="hover:text-white transition-colors">Contact</a>
      </div>

      <p class="text-xs text-white/50">
        © 2026 TrekVenture. All rights reserved.
      </p>
    </div>
  </div>
</footer>
