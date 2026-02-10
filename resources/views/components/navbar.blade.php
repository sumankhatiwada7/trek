<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/70 backdrop-blur-lg shadow-sm border-b border-gray-200">
  <div class="container mx-auto px-4">
    <div class="flex justify-between items-center h-16 md:h-20">

      <!-- Logo -->
      <a href="/" class="flex items-center gap-2">
        <svg class="h-8 w-8 text-green-700" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="m8 3 4 8 5-5 5 13H2L8 3z" />
        </svg>
        <span class="font-serif text-2xl font-bold text-gray-900">TrekVenture</span>
      </a>

      <!-- Desktop Navigation -->
      <div class="hidden md:flex items-center gap-8">
        <a href="/" class="text-gray-600 hover:text-green-700 transition font-medium">Home</a>
        <a href="{{ route('treks.index') }}" class="text-gray-600 hover:text-green-700 transition font-medium">Treks</a>
        <a href="{{ route('front.destinations')}}" class="text-gray-600 hover:text-green-700 transition font-medium">Destinations</a>
        <a href="/about" class="text-gray-600 hover:text-green-700 transition font-medium">About</a>
        <a href="/contact" class="text-gray-600 hover:text-green-700 transition font-medium">Contact</a>
      </div>

      <!-- Desktop Buttons -->
      <div class="hidden md:flex items-center gap-4">
        <a href="{{ route('booking.form') }}" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition">
          Book a Trek
        </a>
        
        @auth
        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
          <button @click="open = !open" @click.away="open = false" 
                  class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
            <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
            <svg class="h-4 w-4 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <!-- Dropdown Menu -->
          <div x-show="open" 
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-150"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50"
               style="display: none;">
            
            <div class="px-4 py-2 border-b border-gray-100">
              <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
              <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>

            <a href="{{ route('user.bookings', Auth::user()->name) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Dashboard
            </a>

           

            <div class="border-t border-gray-100 my-1"></div>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition text-left">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Log Out
              </button>
            </form>
          </div>
        </div>
        @else
        <a href="{{ route('register') }}" class="px-4 py-2 border border-green-700 text-green-700 rounded-lg hover:bg-green-50 transition">
          create a account
        </a>
        @endauth
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-button" class="md:hidden p-2 text-gray-800">
        <svg id="menu-icon" class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <line x1="3" y1="12" x2="21" y2="12" />
          <line x1="3" y1="6" x2="21" y2="6" />
          <line x1="3" y1="18" x2="21" y2="18" />
        </svg>

        <svg id="close-icon" class="h-7 w-7 hidden" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y1="18" />
          <line x1="6" y1="6" x2="18" y1="18" />
        </svg>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden py-4 border-t border-gray-200">
      <div class="flex flex-col gap-4">
        <a href="/" class="text-gray-700 hover:text-green-700 transition py-2">Home</a>
        <a href="{{ route('treks.index') }}" class="text-gray-700 hover:text-green-700 transition py-2">Treks</a>
        <a href="{{ route('front.destinations') }}" class="text-gray-700 hover:text-green-700 transition py-2">Destinations</a>
        <a href="/about" class="text-gray-700 hover:text-green-700 transition py-2">About</a>
        <a href="/contact" class="text-gray-700 hover:text-green-700 transition py-2">Contact</a>

        <div class="flex flex-col gap-2 pt-4 border-t border-gray-200">
          @auth
            <div class="px-4 py-2 bg-gray-50 rounded-lg">
              <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
              <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>
            <a href="{{ route('user.bookings') }}" class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full px-4 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition">Log Out</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="w-full px-4 py-2 border border-green-700 text-green-700 rounded-lg hover:bg-green-50 transition">Sign In</a>
          @endauth
          <a href="{{ route('booking.form') }}" class="w-full text-center px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition">Book a Trek</a>
        </div>
      </div>
    </div>

  </div>
</nav>

<!-- Mobile Menu Script -->
<script>
  const menuBtn = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuIcon = document.getElementById('menu-icon');
  const closeIcon = document.getElementById('close-icon');

  menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    menuIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
  });
</script>
