<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Nepal Treks – Booking</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-900">

<!-- Header -->
<header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b">
  <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
    <a href="#" class="text-blue-600 font-medium">← Back to Treks</a>
    <div class="font-bold text-xl">Nepal Treks</div>
  </div>
</header>

<!-- Hero -->
<section class="py-16 bg-gradient-to-br from-blue-100 via-white to-indigo-100 text-center">
  <h1 class="text-4xl md:text-5xl font-bold mb-4">Book Your Adventure</h1>
  <p class="text-slate-600 max-w-2xl mx-auto">
    Fill out the form below to request a booking. We’ll contact you within 24 hours.
  </p>
</section>

<!-- Content -->
<section class="max-w-7xl mx-auto px-4 py-12">
  <div class="grid md:grid-cols-3 gap-8">

    <!-- Form -->
    <div class="md:col-span-2 bg-white border rounded-xl shadow-lg">
      <div class="p-6 border-b">
        <h2 class="text-xl font-semibold">Booking Details</h2>
        <p class="text-sm text-slate-500">Provide your information and trek preferences</p>
      </div>

      @if(session('success'))
        <div class="m-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div class="m-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
          <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form id="bookingForm" method="POST" action="{{ route('booking.create') }}" class="p-6 space-y-6">
        @csrf

        <!-- Personal -->
        <div>
          <h3 class="font-semibold mb-3">Personal Information</h3>

          <label class="block text-sm font-medium mb-1">Full Name</label>
          <input type="text" name="name" id="name" required placeholder="" value="{{ Auth::check() ? Auth::user()->name : '' }}"
            class="w-full border rounded-lg px-3 py-2 mb-4 focus:ring focus:ring-blue-200">

          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium mb-1">Email</label>
              <input type="email" name="email" id="email" required value="{{ Auth::check() ? Auth::user()->email : '' }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div>
              <label class="block text-sm font-medium mb-1">Phone</label>
              <input type="tel" name="phone" id="phone" required
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>
          </div>
        </div>

        <!-- Trek -->
        <div>
          <h3 class="font-semibold mb-3">Trek Selection</h3>

          <label class="block text-sm font-medium mb-1">Select Trek</label>
          <select name="trek_id" id="trekSelect" required
            class="w-full border rounded-lg px-3 py-2 mb-4 focus:ring focus:ring-blue-200">
            <option value="">Choose your adventure</option>
            @foreach ($treks as $t)
              <option value="{{ $t->id }}">{{ $t->trekname }} – {{ $t->duration }} days</option>
            @endforeach
          </select>

          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium mb-1">Number of People</label>
              <select name="number_of_people" required
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                <option value="">Select</option>
                <option value="1">1</option><option value="2">2</option><option value="3">3</option>
                <option value="4">4</option><option value="5">5</option><option value="10">10+</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium mb-1">Preferred Date</label>
              <input type="date" name="booking_date" required
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>
          </div>
        </div>

        <!-- Special -->
        <div>
          <h3 class="font-semibold mb-3">Additional Information</h3>
          <textarea name="additional_infromation" placeholder="Any special requests..."
            class="w-full border rounded-lg px-3 py-2 min-h-[100px] focus:ring focus:ring-blue-200"></textarea>
        </div>

        <button type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl text-lg font-medium transition">
          Submit Booking Request
        </button>

      </form>
    </div>

    <!-- Trek Preview -->
    <div class="space-y-6">
      <div id="trekPreview" class="bg-white border rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 text-center text-slate-500">
          Select a trek to see details
        </div>
      </div>

      <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
        <h4 class="font-semibold mb-1">Need Help?</h4>
        <p class="text-sm text-slate-600">info@nepaltreks.com</p>
      </div>
    </div>

  </div>
</section>

<script>
  const treks = @json($treks);
  const trekSelect = document.getElementById('trekSelect');
  const numberInput = document.querySelector('select[name="number_of_people"]');
  const preview = document.getElementById('trekPreview');

  function updatePreview() {
    const trek = treks.find(t => String(t.id) === trekSelect.value);
    if (!trek) return;

    const difficulty = trek.difficultylevel || 'N/A';
    const region = trek.region || 'Region not set';
    const elevation = trek.elevation ? `${trek.elevation}m` : '—';
    const duration = trek.duration ? `${trek.duration} days` : '—';
    
    const numberOfPeople = numberInput.value ? parseInt(numberInput.value) : 1;
    const basePrice = trek.price ? parseFloat(trek.price) : 0;
    const totalPrice = basePrice * numberOfPeople;
    
    const priceDisplay = trek.price 
      ? `$${basePrice} × ${numberOfPeople} = $${totalPrice.toFixed(2)}`
      : 'Contact for price';

    preview.innerHTML = `
      <div class="p-4 space-y-2 text-sm">
        <h3 class="font-bold text-lg">${trek.trekname}</h3>
        <p class="text-slate-500">${region}</p>
        <div class="flex justify-between"><span>Duration</span><span>${duration}</span></div>
        <div class="flex justify-between"><span>Difficulty</span><span>${difficulty}</span></div>
        <div class="flex justify-between"><span>Elevation</span><span>${elevation}</span></div>
        <div class="flex justify-between border-t pt-2 font-semibold text-blue-600">
          <span>Total Price</span><span>${priceDisplay}</span>
        </div>
      </div>
    `;
  }

  trekSelect.addEventListener('change', updatePreview);
  numberInput.addEventListener('change', updatePreview);

  
</script>

</body>
</html>
