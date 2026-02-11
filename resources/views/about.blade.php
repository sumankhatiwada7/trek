@extends('layout')

@section('content')
<div>
    <!-- Hero -->
    <section class="relative h-72 md:h-96 flex items-center justify-center overflow-hidden bg-slate-950">
        <img src="{{ asset('image/front.png') }}" alt="Himalayan mountains" class="absolute inset-0 w-full h-full object-cover scale-[1.02]" />
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/50 via-slate-900/40 to-slate-950/90"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.18),transparent_55%)]"></div>
        <div class="relative z-10 text-center px-4">
            <h1 class="font-serif text-4xl md:text-5xl font-bold text-white drop-shadow-[0_10px_30px_rgba(0,0,0,0.35)]">About TrekNepal</h1>
            <p class="text-white/75 mt-3 text-base md:text-lg">Our story, our passion, our mountains</p>
        </div>
    </section>

    <!-- Story -->
    <section class="py-20">
        <div class="container mx-auto px-4 max-w-3xl text-center">
            <p class="text-emerald-600 font-medium text-xs sm:text-sm tracking-[0.35em] uppercase mb-3">Our Story</p>
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                Born in the Mountains
            </h2>
            <p class="text-slate-600 leading-relaxed text-base sm:text-lg">
                TrekNepal was founded by a team of passionate trekkers and local Sherpa guides who believe that the Himalayas should be accessible to everyone. From the bustling streets of Kathmandu to the serene silence of base camp, we curate journeys that connect you with Nepal's soul — its people, landscapes, and timeless traditions. Every trail we walk, we walk with purpose: to share Nepal's magic while preserving it for future generations.
            </p>
        </div>
    </section>

    <!-- Values -->
    <section class="py-20 bg-gradient-to-br from-emerald-50 via-white to-cyan-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <p class="text-emerald-600 font-medium text-xs sm:text-sm tracking-[0.35em] uppercase mb-2">What We Stand For</p>
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-slate-900">Our Values</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 text-center hover:shadow-xl transition">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-emerald-100 mb-4">
                        <svg class="h-7 w-7 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V7l-8-4-8 4v5c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <h3 class="font-serif font-semibold text-slate-900 mb-2">Safety First</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Every trek is led by certified, experienced guides with emergency protocols and satellite communication.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 text-center hover:shadow-xl transition">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-emerald-100 mb-4">
                        <svg class="h-7 w-7 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.8 6.6a5.5 5.5 0 0 0-7.8 0L12 7.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 23l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"></path>
                        </svg>
                    </div>
                    <h3 class="font-serif font-semibold text-slate-900 mb-2">Community Impact</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">We invest in local communities, hire local guides, and support sustainable tourism practices.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 text-center hover:shadow-xl transition">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-emerald-100 mb-4">
                        <svg class="h-7 w-7 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
                        </svg>
                    </div>
                    <h3 class="font-serif font-semibold text-slate-900 mb-2">Authentic Experiences</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">We go beyond the trail — cultural exchanges, homestays, and genuine Himalayan hospitality.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-100 text-center hover:shadow-xl transition">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-emerald-100 mb-4">
                        <svg class="h-7 w-7 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M3 12h18"></path>
                            <path d="M12 3c2.5 2.7 4 6 4 9s-1.5 6.3-4 9c-2.5-2.7-4-6-4-9s1.5-6.3 4-9z"></path>
                        </svg>
                    </div>
                    <h3 class="font-serif font-semibold text-slate-900 mb-2">Sustainability</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Eco-conscious treks with a zero-waste policy and environmental conservation partnerships.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
