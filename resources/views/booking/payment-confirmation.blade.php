<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Payment Confirmation – Nepal Treks</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-900">

<!-- Header -->
<header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b">
  <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
    <a href="{{ route('treks.index') }}" class="text-blue-600 font-medium">← Back to Treks</a>
    <div class="font-bold text-xl text-blue-600">Nepal Treks</div>
  </div>
</header>

<!-- Hero -->
<section class="py-12 bg-gradient-to-br from-green-100 via-white to-blue-100 text-center">
  <h1 class="text-4xl md:text-5xl font-bold mb-2 text-green-700">Payment Confirmation</h1>
  <p class="text-slate-600">Review your booking details and proceed to payment</p>
</section>

<!-- Content -->
<section class="max-w-4xl mx-auto px-4 py-12">
  <div class="grid md:grid-cols-3 gap-8">

    <!-- Booking Summary -->
    <div class="md:col-span-2">
      
      <!-- Booking Details Card -->
      <div class="bg-white border rounded-xl shadow-lg mb-6">
        <div class="p-6 border-b bg-blue-50">
          <h2 class="text-2xl font-bold text-blue-600">Booking Details</h2>
        </div>

        <div class="p-6 space-y-4">
          <!-- Trek Information -->
          <div class="pb-6 border-b">
            <h3 class="text-sm font-semibold text-slate-500 uppercase mb-3">Trek Information</h3>
            <div class="space-y-2">
              <div class="flex justify-between">
                <span class="text-slate-600">Trek Name:</span>
                <span class="font-semibold text-slate-900">{{ $booking->trek->trekname ?? 'N/A' }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-600">Region:</span>
                <span class="font-semibold text-slate-900">{{ $booking->trek->region ?? 'N/A' }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-600">Duration:</span>
                <span class="font-semibold text-slate-900">{{ $booking->trek->duration ?? 'N/A' }} days</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-600">Difficulty Level:</span>
                <span class="font-semibold text-slate-900">{{ ucfirst($booking->trek->difficultylevel ?? 'N/A') }}</span>
              </div>
            </div>
          </div>

          <!-- Traveler Information -->
          <div class="pb-6 border-b">
            <h3 class="text-sm font-semibold text-slate-500 uppercase mb-3">Traveler Information</h3>
            <div class="space-y-2">
              <div class="flex justify-between">
                <span class="text-slate-600">Name:</span>
                <span class="font-semibold text-slate-900">{{ $booking->name }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-600">Email:</span>
                <span class="font-semibold text-slate-900">{{ $booking->email }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-600">Phone:</span>
                <span class="font-semibold text-slate-900">{{ $booking->phone }}</span>
              </div>
            </div>
          </div>

          <!-- Booking Date & Participants -->
          <div>
            <h3 class="text-sm font-semibold text-slate-500 uppercase mb-3">Booking Details</h3>
            <div class="space-y-2">
              <div class="flex justify-between">
                <span class="text-slate-600">Booking Date:</span>
                <span class="font-semibold text-slate-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('F d, Y') }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-slate-600">Number of Participants:</span>
                <span class="font-semibold text-slate-900">{{ $booking->number_of_people }} {{ $booking->number_of_people > 1 ? 'People' : 'Person' }}</span>
              </div>
              @if($booking->additional_infromation)
                <div class="mt-3 p-3 bg-slate-100 rounded">
                  <p class="text-sm text-slate-600"><strong>Additional Information:</strong> {{ $booking->additional_infromation }}</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Price Summary -->
    <div>
      <div class="bg-white border rounded-xl shadow-lg sticky top-24">
        <div class="p-6 border-b bg-green-50">
          <h3 class="text-xl font-bold text-green-700">Price Summary</h3>
        </div>

        <div class="p-6 space-y-4">
          <!-- Price Breakdown -->
          <div class="space-y-3">
            <div class="flex justify-between items-center pb-3 border-b">
              <span class="text-slate-600">Price per Person:</span>
              <span class="font-semibold text-slate-900">Rs. {{ number_format($booking->trek->price ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between items-center pb-3 border-b">
              <span class="text-slate-600">Number of People:</span>
              <span class="font-semibold text-slate-900">× {{ $booking->number_of_people }}</span>
            </div>
            <div class="flex justify-between items-center pt-3 bg-green-50 -mx-6 px-6 py-3 rounded-b">
              <span class="text-lg font-bold text-green-700">Total Amount:</span>
              <span class="text-2xl font-bold text-green-600">Rs. {{ number_format(($booking->trek->price ?? 0) * $booking->number_of_people, 2) }}</span>
            </div>
          </div>

          <!-- Payment Method Info -->
          <div class="mt-6 p-3 bg-blue-50 rounded-lg border border-blue-200">
            <p class="text-xs text-blue-700"><strong>Payment Method:</strong> eSewa</p>
            <p class="text-xs text-blue-600 mt-1">Secure online payment gateway for your convenience</p>
          </div>

          <!-- Action Buttons -->
          <div class="pt-6 space-y-3">
            <a href="{{ route('esewa.pay', $booking->id) }}" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              Proceed to Payment
            </a>

            <a href="{{ route('user.bookings') }}" class="block w-full bg-slate-200 hover:bg-slate-300 text-slate-900 font-bold py-3 px-4 rounded-lg transition duration-200 text-center">
              View My Bookings
            </a>
          </div>

          <!-- Security Badge -->
          <div class="mt-6 pt-6 border-t text-center">
            <div class="flex items-center justify-center gap-2 text-slate-500 text-xs">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
              </svg>
              Secure Payment Gateway
            </div>
          </div>
        </div>
      </div>

      <!-- Terms & Conditions -->
      <div class="mt-6 text-xs text-slate-500 text-center">
        <p>By proceeding to payment, you agree to our</p>
        <p><a href="#" class="text-blue-600 hover:underline">Terms & Conditions</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a></p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="border-t bg-slate-900 text-white py-8 mt-16">
  <div class="max-w-7xl mx-auto px-4 text-center">
    <p class="text-sm text-slate-400">&copy; 2026 Nepal Treks. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
