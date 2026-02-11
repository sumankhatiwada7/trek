@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">My Bookings</h1>
            <p class="text-gray-600">View and manage your trek bookings</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg">
            <div class="flex items-start">
                <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-green-800 font-medium">Success!</p>
                    <p class="text-green-700 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
            <div class="flex items-start">
                <svg class="h-6 w-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-red-800 font-medium">Error!</p>
                    <p class="text-red-700 text-sm">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Validation Errors -->
        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
            <div class="flex items-start">
                <svg class="h-6 w-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1">
                    <p class="text-red-800 font-medium mb-2">Please fix the following errors:</p>
                    <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        @if($activeBookings->isEmpty() && $rejectedBookings->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No bookings yet</h3>
                <p class="text-gray-600 mb-6">Start exploring and book your next adventure</p>
                <a href="{{ route('treks.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Browse Treks
                </a>
            </div>
        @else
            <!-- Active Bookings Section -->
            @if($activeBookings->isNotEmpty())
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Active Bookings</h2>
                    <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">{{ $activeBookings->count() }}</span>
                </div>
                
                <div class="space-y-6">
                @foreach($activeBookings as $booking)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <!-- Booking Card Header -->
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-4 flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold mb-2">{{ $booking->trek->trekname ?? 'Trek' }}</h2>
                                <p class="text-blue-100">Booking ID: #{{ $booking->id }}</p>
                            </div>
                            <!-- Status Badge -->
                            <div class="flex flex-col items-end">
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold 
                                    @if($booking->status === 'pending')
                                        bg-yellow-100 text-yellow-800
                                    @elseif($booking->status === 'accepted')
                                        bg-green-100 text-green-800
                                    @elseif($booking->status === 'rejected')
                                        bg-red-100 text-red-800
                                    @elseif($booking->status === 'cancelled')
                                        bg-gray-100 text-gray-800
                                                                        @elseif($booking->status === 'paid')
                                                                            bg-blue-100 text-blue-800
                                    @endif
                                ">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <p class="text-blue-100 text-sm mt-2">
                                    Booked on {{ $booking->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="px-6 py-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Personal Information -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Personal Information</h3>
                                    <div class="space-y-3">
                                        <div>
                                            <p class="text-gray-600 text-sm">Full Name</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm">Email</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->email }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm">Phone</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->phone }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Booking Information -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Booking Details</h3>
                                    <div class="space-y-3">
                                        <div>
                                            <p class="text-gray-600 text-sm">Booking Date</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->booking_date }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm">Number of People</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->number_of_people }} {{ $booking->number_of_people == 1 ? 'Person' : 'People' }}</p>
                                        </div>
                                        @if($booking->trek)
                                        <div>
                                            <p class="text-gray-600 text-sm">Trek Price</p>
                                            <p class="text-gray-900 font-medium">Rs. {{ number_format($booking->trek->price, 2) }} per person</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Trek Information -->
                            @if($booking->trek)
                            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Trek Information</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div>
                                        <p class="text-gray-600 text-sm">Region</p>
                                        <p class="text-gray-900 font-medium">{{ $booking->trek->region }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm">Duration</p>
                                        <p class="text-gray-900 font-medium">{{ $booking->trek->duration }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm">Difficulty</p>
                                        <p class="text-gray-900 font-medium">{{ $booking->trek->difficultylevel }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm">Elevation</p>
                                        <p class="text-gray-900 font-medium">{{ $booking->trek->elevation }} m</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Additional Information -->
                            @if($booking->additional_infromation)
                            <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Additional Information</h3>
                                <p class="text-gray-700">{{ $booking->additional_infromation }}</p>
                            </div>
                            @endif

                            @php
                                $canCancel = $booking->status === 'accepted' &&
                                            $booking->created_at->addDays(2)->isFuture();
                            @endphp

                            <!-- Cancellation Policy Note -->
                            @if($canCancel)
                            <div class="bg-amber-50 border border-amber-300 p-4 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <svg class="h-5 w-5 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-amber-800 text-sm">
                                        <span class="font-semibold">Cancellation Policy:</span> You can only cancel this booking within 2 days of making it. Cancellation window expires on <strong>{{ $booking->created_at->addDays(2)->format('M d, Y \a\t H:i') }}</strong>.
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Actions Footer -->
                        <div class="bg-gray-50 px-6 py-4 flex justify-between items-center border-t">
                            <div class="text-sm text-gray-600">
                                Status last updated: {{ $booking->updated_at->format('M d, Y \a\t H:i') }}
                            </div>
                            
                            @if($booking->status === 'pending')
                            <span class="text-gray-600 font-medium">
                                Awaiting admin approval
                            </span>
                            @elseif($booking->status === 'accepted')
                            <div class="flex items-center gap-3">
                                <a href="{{ route('booking.payment', $booking->id) }}" 
                                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition font-medium inline-block">
                                    Pay Now
                                </a>
                                @if($canCancel)
                                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" onclick="return confirm('Are you sure you want to cancel this booking?')" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition font-medium">
                                        Cancel Booking
                                    </button>
                                </form>
                                @else
                                <div class="text-sm text-gray-600">
                                    <p class="font-medium text-gray-700">Cancellation period expired</p>
                                    <p class="text-xs text-gray-500">You can no longer cancel this booking</p>
                                </div>
                                @endif
                            </div>
                            @elseif($booking->status === 'paid')
                            <span class="text-blue-600 font-medium">
                                Payment Completed
                            </span>
                            @elseif($booking->status === 'cancelled' || $booking->status === 'rejected')
                            <span class="text-gray-500 font-medium">
                                {{ $booking->status === 'cancelled' ? 'Booking Cancelled' : 'Booking Rejected' }}
                            </span>
                            @endif
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            @endif

            <!-- Rejected/Cancelled Bookings Section -->
            @if($rejectedBookings->isNotEmpty())
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Cancelled & Rejected Bookings</h2>
                    <span class="bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-full">{{ $rejectedBookings->count() }}</span>
                </div>
                
                <div class="space-y-6">
                @foreach($rejectedBookings as $booking)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden opacity-75">
                        <!-- Booking Card Header -->
                        <div class="bg-gradient-to-r from-gray-400 to-gray-500 text-white px-6 py-4 flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold mb-2">{{ $booking->trek->trekname ?? 'Trek' }}</h2>
                                <p class="text-gray-100">Booking ID: #{{ $booking->id }}</p>
                            </div>
                            <!-- Status Badge -->
                            <div class="flex flex-col items-end">
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold 
                                    @if($booking->status === 'rejected')
                                        bg-red-100 text-red-800
                                    @elseif($booking->status === 'cancelled')
                                        bg-gray-100 text-gray-800
                                    @endif
                                ">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <p class="text-gray-100 text-sm mt-2">
                                    Booked on {{ $booking->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="px-6 py-6 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Personal Information -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Personal Information</h3>
                                    <div class="space-y-3">
                                        <div>
                                            <p class="text-gray-600 text-sm">Full Name</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->name }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm">Email</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->email }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm">Phone</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->phone }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Booking Information -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Booking Details</h3>
                                    <div class="space-y-3">
                                        <div>
                                            <p class="text-gray-600 text-sm">Booking Date</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->booking_date }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 text-sm">Number of People</p>
                                            <p class="text-gray-900 font-medium">{{ $booking->number_of_people }} {{ $booking->number_of_people == 1 ? 'Person' : 'People' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Message -->
                            <div class="mt-6 p-4 rounded-lg 
                                @if($booking->status === 'rejected')
                                    bg-red-50 border border-red-200
                                @else
                                    bg-gray-100 border border-gray-300
                                @endif
                            ">
                                <p class="
                                    @if($booking->status === 'rejected')
                                        text-red-800
                                    @else
                                        text-gray-800
                                    @endif
                                    font-medium text-center
                                ">
                                    @if($booking->status === 'rejected')
                                        This booking was rejected by the administrator.
                                    @else
                                        You cancelled this booking on {{ $booking->updated_at->format('M d, Y') }}.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            @endif
        @endif
    </div>
</div>

<style>
    /* Status badge animations */
    .hover\:shadow-lg:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
