
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bookings</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
 <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<div class="flex items-center justify-between mb-6">
		<h1 class="text-2xl font-semibold text-gray-800">Bookings</h1>
	</div>

	@if(session('success'))
		<div class="mb-4 rounded-md bg-green-50 p-4 text-green-700">
			{{ session('success') }}
		</div>
	@endif

	@if(isset($bookings) && $bookings->count())
		<div class="overflow-x-auto bg-white shadow sm:rounded-lg">
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-50">
					<tr>
						<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking Date</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">People</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trek ID</th>
						<th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
					</tr>
				</thead>
				<tbody class="bg-white divide-y divide-gray-200">
					@foreach($bookings as $booking)
						<tr>
							<td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $booking->name }}</td>
							<td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $booking->email }}</td>
							<td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $booking->phone }}</td>
							<td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ \Illuminate\Support\Carbon::parse($booking->booking_date)->format('M d, Y') }}</td>
							<td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $booking->number_of_people }}</td>
							<td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $booking->trek_id }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ ucfirst($booking->status) }}</td>
							<td class="px-4 py-3 whitespace-nowrap text-sm">
								<a href="{{ route('bookings.show', $booking->id) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">View details</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@else
		<div class="rounded-md bg-yellow-50 p-4 text-yellow-800">No bookings found.</div>
	@endif
</div>   
</body>
</html>


