<section class="relative min-h-[85vh] flex items-center justify-center overflow-hidden bg-slate-950">
  <!-- Background image -->
  <div class="absolute inset-0">
    <img
      src="{{ asset('image/front.png') }}"
      alt="Himalayan mountain landscape with prayer flags"
      class="w-full h-full object-cover scale-[1.02]"
    />
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/60 via-slate-900/40 to-slate-950/90"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.18),transparent_55%)]"></div>
  </div>
  <div class="pointer-events-none absolute -top-20 -right-20 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl"></div>
  <div class="pointer-events-none absolute -bottom-24 -left-10 h-80 w-80 rounded-full bg-cyan-400/20 blur-3xl"></div>

  <!-- Content -->
  <div class="relative z-10 container mx-auto px-4 text-center">
    <p class="animate-fade-in text-white/80 font-medium tracking-[0.35em] uppercase text-xs sm:text-sm mb-4">
      Discover Nepal's Majestic Trails
    </p>
    <h1 class="animate-fade-in font-display text-4xl sm:text-5xl md:text-7xl font-bold text-white leading-tight mb-6 drop-shadow-[0_10px_30px_rgba(0,0,0,0.35)]" style="animation-delay: 0.1s;">
      Explore the Heart of
      <br />
      <span class="italic text-emerald-200">the Himalayas</span>
    </h1>
    <p class="animate-fade-in text-white/80 text-base sm:text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed" style="animation-delay: 0.2s;">
      From Everest's towering peaks to Annapurna's lush valleys — experience the adventure of a lifetime with expert Nepali guides.
    </p>

    <div class="animate-fade-in flex flex-wrap items-center justify-center gap-4 mb-12" style="animation-delay: 0.3s;">
      <a href="{{ route('treks.index') }}" class="text-base px-8 py-4 font-semibold shadow-lg bg-emerald-500 text-white rounded-xl hover:bg-emerald-400 transition ring-1 ring-emerald-300/40">
        Explore Treks
      </a>
      <a href="{{ route('booking.form') }}" class="text-base px-8 py-4 font-semibold border border-white/30 text-white rounded-xl hover:bg-white/10 transition backdrop-blur">
        Book a Trek
      </a>
    </div>

    <!-- Search Bar -->
    <div class="animate-fade-in max-w-4xl mx-auto bg-white/95 backdrop-blur-md rounded-2xl p-2 shadow-xl ring-1 ring-white/40" style="animation-delay: 0.4s;">
      <div class="flex flex-col sm:flex-row items-stretch gap-2">
        <div class="flex-1 flex items-center gap-2 px-4 py-3 rounded-xl hover:bg-slate-100 transition-colors">
          <svg class="h-4 w-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 21s-6-5.33-6-10a6 6 0 0 1 12 0c0 4.67-6 10-6 10z"></path>
            <circle cx="12" cy="11" r="2.5"></circle>
          </svg>
          <select class="w-full bg-transparent text-sm text-slate-900 outline-none cursor-pointer">
            <option value="">All Regions</option>
            <option value="everest">Everest</option>
            <option value="annapurna">Annapurna</option>
            <option value="langtang">Langtang</option>
            <option value="manaslu">Manaslu</option>
          </select>
        </div>
        <div class="hidden sm:block w-px bg-slate-200"></div>
        <div class="flex-1 flex items-center gap-2 px-4 py-3 rounded-xl hover:bg-slate-100 transition-colors">
          <svg class="h-4 w-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="9"></circle>
            <path d="M12 7v5l3 3"></path>
          </svg>
          <select class="w-full bg-transparent text-sm text-slate-900 outline-none cursor-pointer">
            <option value="">Any Duration</option>
            <option value="short">1-7 Days</option>
            <option value="medium">8-14 Days</option>
            <option value="long">15+ Days</option>
          </select>
        </div>
        <div class="hidden sm:block w-px bg-slate-200"></div>
        <div class="flex-1 flex items-center gap-2 px-4 py-3 rounded-xl hover:bg-slate-100 transition-colors">
          <svg class="h-4 w-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 3v18h18"></path>
            <rect x="7" y="13" width="3" height="5"></rect>
            <rect x="12" y="9" width="3" height="9"></rect>
            <rect x="17" y="5" width="3" height="13"></rect>
          </svg>
          <select class="w-full bg-transparent text-sm text-slate-900 outline-none cursor-pointer">
            <option value="">Any Difficulty</option>
            <option value="easy">Easy</option>
            <option value="moderate">Moderate</option>
            <option value="challenging">Challenging</option>
            <option value="extreme">Extreme</option>
          </select>
        </div>
        <a href="{{ route('treks.index') }}" class="w-full sm:w-auto px-6 py-3 bg-slate-900 text-white rounded-xl font-semibold flex items-center justify-center gap-2 hover:bg-slate-800 transition">
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="M21 21l-4.3-4.3"></path>
          </svg>
          Search
        </a>
      </div>
    </div>
  </div>
</section>
