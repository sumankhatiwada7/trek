@extends('layout')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .trek-container {
        max-width: 1000px;
        margin: 30px auto;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.1);
    }

    .trek-header h1 {
        font-size: 2.3rem;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .trek-header p {
        color: #666;
        font-size: 1.1rem;
    }

    .trek-image img {
        width: 100%;
        border-radius: 12px;
        margin-top: 20px;
    }

    .trek-details {
        display: flex;
        justify-content: space-between;
        margin-top: 25px;
        flex-wrap: wrap;
    }

    .detail-box {
        width: 48%;
        background: #f7f7f7;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .detail-box i {
        font-size: 28px;
        color: #1e88e5;
    }

    .trek-description {
        margin-top: 25px;
    }

    .trek-description p {
        line-height: 1.7;
        font-size: 1.05rem;
        color: #444;
    }

    .gallery {
        margin-top: 25px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .gallery img {
        width: 32%;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s;
    }

    .gallery img:hover {
        transform: scale(1.05);
    }

    /* Itinerary Section */
    .itinerary {
        margin-top: 35px;
    }

    .itinerary h2 {
        margin-bottom: 15px;
    }

    .itinerary-box {
        background: #f7f7f7;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .itinerary-box span {
        font-weight: bold;
        color: #1e88e5;
    }
</style>

<div class="trek-container">

    <div class="trek-header">
        <h1>{{ $treks->trekname }}</h1>
        <p>{{ $treks->region }}</p>
    </div>

    {{-- Main Image --}}
    <div class="trek-image">
        <img src="{{ asset('images/treks/' . $treks->image) }}" alt="{{ $treks->trekname }}">
    </div>

    {{-- Trek Info --}}
    <div class="trek-details">

        <div class="detail-box">
            <i class="fa-solid fa-mountain"></i>
            <div>
                <strong>Difficulty:</strong>
                <p>{{ ucfirst($treks->difficulty) }}</p>
            </div>
        </div>

        <div class="detail-box">
            <i class="fa-solid fa-clock"></i>
            <div>
                <strong>Duration:</strong>
                <p>{{ $treks->duration }} Days</p>
            </div>
        </div>

        <div class="detail-box">
            <i class="fa-solid fa-location-dot"></i>
            <div>
                <strong>Altitude:</strong>
                <p>{{ $treks->altitude }} m</p>
            </div>
        </div>

        <div class="detail-box">
            <i class="fa-solid fa-map"></i>
            <div>
                <strong>Region:</strong>
                <p>{{ $treks->region }}</p>
            </div>
        </div>
    </div>

    {{-- Description --}}
    <div class="trek-description">
        <h2>About the Trek</h2>
        <p>{{ $treks->description }}</p>
    </div>

    {{-- Image Gallery --}}
    @if($treks->gallery)
    <h2 style="margin-top: 30px;">Gallery</h2>
    <div class="gallery">
        @foreach(json_decode($treks->gallery) as $img)
            <img src="{{ asset('images/treks/gallery/' . $img) }}" alt="">
        @endforeach
    </div>
    @endif

    {{-- Itinerary --}}
    @if($treks->itinerary)
    <div class="itinerary">
        <h2>Itinerary</h2>

        @foreach(json_decode($treks->itinerary) as $day => $plan)
            <div class="itinerary-box">
                <span>Day {{ $day + 1 }}:</span> {{ $plan }}
            </div>
        @endforeach
    </div>
    @endif

</div>

@endsection
