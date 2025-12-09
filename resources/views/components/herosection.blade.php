<section class="relative h-screen flex items-center justify-center overflow-hidden">
  <!-- Background Image -->
  <div class="absolute inset-0">
    <img
      src="/image/front.png"
      alt="Mountain landscape at sunrise"
      class="w-full h-full object-cover"
    />
    <div class="absolute inset-0 hero-overlay"></div>
  </div>

  <!-- Content -->
  <div class="relative z-10 container mx-auto px-4 text-center">
    <div class="max-w-4xl mx-auto">

      <span class="inline-block px-4 py-2 bg-primary/20 backdrop-blur-sm rounded-full text-white text-lg font-medium mb-6 animate-fade-in">
        Adventure Awaits
      </span>

      <h1 class="font-display text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 animate-fade-in"
        style="animation-delay: 0.1s;">
        Discover the World's <br />
        <span class="text-white">Most Epic Trails</span>
      </h1>

      <p class="text-white text-lg md:text-xl max-w-2xl mx-auto mb-8 animate-fade-in"
        style="animation-delay: 0.2s;">
        Curated trekking experiences across breathtaking landscapes.
        From alpine meadows to remote wilderness, find your perfect adventure.
      </p>

      <!-- Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in"
        style="animation-delay: 0.3s;">

        <button class="px-8 py-4 bg-primary text-white rounded-xl font-medium flex items-center justify-center text-lg hover:bg-primary/90 transition">
          Explore Treks
          <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </button>

        <button class="px-8 py-4 border border-white/30 text-white rounded-xl text-lg hover:bg-white/10 transition">
          View Map
        </button>
      </div>

      <!-- Stats -->
      <div class="flex flex-wrap justify-center gap-8 md:gap-12 mt-16 animate-fade-in"
        style="animation-delay: 0.4s;">

        <!-- Destinations -->
        <div class="flex items-center gap-2 text-white">
          <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <circle cx="12" cy="10" r="3"></circle>
            <path d="M12 2a8 8 0 0 0-8 8c0 7 8 12 8 12s8-5 8-12a8 8 0 0 0-8-8z"></path>
          </svg>
          <span class="text-lg"><strong class="font-bold">50+</strong> Destinations</span>
        </div>

        <!-- Guided Tours -->
        <div class="flex items-center gap-2 text-white">
          <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
          </svg>
          <span class="text-lg"><strong class="font-bold">200+</strong> Guided Tours</span>
        </div>

        <!-- Rating -->
        <div class="flex items-center gap-2 text-white">
          <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <polygon points="12 2 15 9 23 9 17 14 19 22 12 18 5 22 7 14 1 9 9 9"></polygon>
          </svg>
          <span class="text-lg"><strong class="font-bold">4.9</strong> Rating</span>
        </div>

      </div>
    </div>
  </div>

  <!-- Scroll Indicator -->
  <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-float">
    <div class="w-6 h-10 border-2 border-white/50 rounded-full flex items-start justify-center p-2">
      <div class="w-1 h-2 bg-white/70 rounded-full animate-pulse"></div>
    </div>
  </div>
</section>
