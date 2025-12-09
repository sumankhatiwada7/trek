<section class="py-20 md:py-32 bg-gradient-to-br from-primary/5 via-white to-accent/5">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

      <!-- Content -->
      <div>
        <span class="inline-block px-4 py-2 bg-primary/10 rounded-full text-primary text-sm font-medium mb-4">
          Interactive Map
        </span>

        <h2 class="font-display text-3xl md:text-5xl font-bold text-foreground mb-6">
          Explore Trails <br />
          <span class="text-primary">Worldwide</span>
        </h2>

        <p class="text-muted-foreground text-lg mb-8 leading-relaxed">
          Discover trekking destinations across the globe with our interactive map. 
          Filter by difficulty, duration, or region to find your perfect adventure. 
          Each trail includes detailed elevation profiles, weather data, and real-time conditions.
        </p>

        <!-- Features -->
        <div class="space-y-4 mb-8">

          <!-- Real-time Trail Updates -->
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
              <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M12 6v6l4 2"></path>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-foreground mb-1">Real-time Trail Updates</h3>
              <p class="text-muted-foreground text-sm">
                Get live conditions, closures, and weather forecasts before you go.
              </p>
            </div>
          </div>

          <!-- Offline Navigation -->
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-accent/20 flex items-center justify-center shrink-0">
              <svg class="h-6 w-6 text-accent" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="6" x2="16" y2="12"></line>
                <line x1="16" y1="12" x2="12" y2="18"></line>
                <line x1="12" y1="18" x2="8" y2="12"></line>
                <line x1="8" y1="12" x2="12" y2="6"></line>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-foreground mb-1">Offline Navigation</h3>
              <p class="text-muted-foreground text-sm">
                Download maps for offline use with GPS tracking on your device.
              </p>
            </div>
          </div>
        </div>

        <button class="px-8 py-4 bg-primary text-trek-cream rounded-xl font-medium hover:bg-primary/90 transition">
          Open Interactive Map
        </button>
      </div>

      <!-- Map Placeholder -->
      <div class="relative">
        <div class="aspect-square rounded-3xl bg-card shadow-elevated overflow-hidden">

          <!-- Stylized Map Background -->
          <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-accent/5">
            <svg class="w-full h-full opacity-30" viewBox="0 0 400 400">
              <ellipse cx="200" cy="200" rx="180" ry="120" fill="none" stroke="currentColor" stroke-width="1" class="text-primary/40" />
              <ellipse cx="200" cy="200" rx="150" ry="100" fill="none" stroke="currentColor" stroke-width="1" class="text-primary/40" />
              <ellipse cx="200" cy="200" rx="120" ry="80" fill="none" stroke="currentColor" stroke-width="1" class="text-primary/40" />
              <ellipse cx="200" cy="200" rx="90" ry="60" fill="none" stroke="currentColor" stroke-width="1" class="text-primary/40" />
              <ellipse cx="200" cy="200" rx="60" ry="40" fill="none" stroke="currentColor" stroke-width="1" class="text-primary/40" />
              <ellipse cx="200" cy="200" rx="30" ry="20" fill="none" stroke="currentColor" stroke-width="1" class="text-primary/40" />
            </svg>
          </div>

          <!-- Map Pins -->
          <div class="absolute inset-0 p-8">

            <div class="absolute top-1/4 left-1/4 animate-bounce">
              <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center shadow-lg">
                <svg class="h-5 w-5 text-primary-foreground" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M12 21s-6-4.35-6-10a6 6 0 1 1 12 0c0 5.65-6 10-6 10z" />
                  <circle cx="12" cy="11" r="2.5" />
                </svg>
              </div>
            </div>

            <div class="absolute top-1/3 right-1/3 animate-bounce">
              <div class="w-10 h-10 bg-accent rounded-full flex items-center justify-center shadow-lg">
                <svg class="h-5 w-5 text-accent-foreground" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M12 21s-6-4.35-6-10a6 6 0 1 1 12 0c0 5.65-6 10-6 10z" />
                  <circle cx="12" cy="11" r="2.5" />
                </svg>
              </div>
            </div>

            <div class="absolute bottom-1/4 right-1/4 animate-bounce">
              <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center shadow-lg">
                <svg class="h-5 w-5 text-primary-foreground" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M12 21s-6-4.35-6-10a6 6 0 1 1 12 0c0 5.65-6 10-6 10z" />
                  <circle cx="12" cy="11" r="2.5" />
                </svg>
              </div>
            </div>

            <div class="absolute bottom-1/3 left-1/3 animate-bounce">
              <div class="w-10 h-10 bg-accent rounded-full flex items-center justify-center shadow-lg">
                <svg class="h-5 w-5 text-accent-foreground" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M12 21s-6-4.35-6-10a6 6 0 1 1 12 0c0 5.65-6 10-6 10z" />
                  <circle cx="12" cy="11" r="2.5" />
                </svg>
              </div>
            </div>

          </div>

          <!-- Center Label -->
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
              <p class="font-display text-4xl font-bold text-foreground">50+</p>
              <p class="text-muted-foreground text-sm">Destinations</p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
