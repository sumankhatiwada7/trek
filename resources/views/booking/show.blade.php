

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <meta name="robots" content="noindex">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Booking Details</h1>
        <p class="text-sm text-gray-500">#{{ $booking->id }}</p>
    </div>
    @if(session('success'))
        <div class="m-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
          {{ session('success') }}
        </div>
      @endif

    <div class="bg-white shadow sm:rounded-lg divide-y divide-gray-200">
        <div class="px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->name }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->email }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->phone }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Booking Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ \Illuminate\Support\Carbon::parse($booking->booking_date)->format('M d, Y') }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Number of People</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->number_of_people }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Trek ID</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->trek_id }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Additional Information</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->additional_infromation ?? '—' }}</dd>
                </div>
                        @if($booking->status == 'pending')
            <form action="{{ route('booking.accepted', $booking->id) }}" method="POST" style="display:inline">
                @csrf
                <button class="bg-green-500 text-white px-3 py-1 rounded">Accept</button>
            </form>

            <form action="{{ route('booking.rejected', $booking->id) }}" method="POST" style="display:inline">
                @csrf
                <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
            </form>
        @endif

            </dl>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('bookings.index') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50">Back to list</a>
    </div>
</div>
</body>
</html>
