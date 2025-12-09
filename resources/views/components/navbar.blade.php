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
        <a href="/treks" class="text-gray-600 hover:text-green-700 transition font-medium">Treks</a>
        <a href="/destinations" class="text-gray-600 hover:text-green-700 transition font-medium">Destinations</a>
        <a href="/about" class="text-gray-600 hover:text-green-700 transition font-medium">About</a>
        <a href="/contact" class="text-gray-600 hover:text-green-700 transition font-medium">Contact</a>
      </div>

      <!-- Desktop Buttons -->
      <div class="hidden md:flex items-center gap-4">
        <a href="{{route('admin.index')}}">
        <button  class="px-4 py-2 border border-green-700 text-green-700 rounded-lg hover:bg-green-50 transition" >
          admin
        </button>
        </a>
        <button class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition">
          Book a Trek
        </button>
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
        <a href="/treks" class="text-gray-700 hover:text-green-700 transition py-2">Treks</a>
        <a href="/destinations" class="text-gray-700 hover:text-green-700 transition py-2">Destinations</a>
        <a href="/about" class="text-gray-700 hover:text-green-700 transition py-2">About</a>
        <a href="/contact" class="text-gray-700 hover:text-green-700 transition py-2">Contact</a>

        <div class="flex flex-col gap-2 pt-4 border-t border-gray-200">
          <button class="w-full px-4 py-2 border border-green-700 text-green-700 rounded-lg hover:bg-green-50 transition">Sign In</button>
          <button class="w-full px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition">Book a Trek</button>
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
