@extends('layouts.app')

@section('title', 'Sofa — Real Estate in Albania')

@section('content')
    <section class="bg-gradient-to-r from-indigo-50 to-white py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Real estate in Albania, made simple.</h1>
                <p class="mt-4 text-lg text-slate-600">Search apartments, villas, land and more. Post your property in minutes. Built for speed, clarity, and trust.</p>
                <div class="mt-6 flex gap-4">
                    <a href="#" class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Download on App Store</a>
                    <a href="#" class="inline-flex items-center px-4 py-2 rounded-lg border hover:bg-slate-50">Get it on Google Play</a>
                </div>
                <p class="mt-3 text-sm text-slate-500">Available across Albania • Listings reviewed for quality</p>
            </div>
            <div class="relative">
                <img
                    src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                    alt="Sofa App — Real Estate in Albania"
                    class="rounded-xl shadow-lg border"
                >
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-8">Why Sofa?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 rounded-xl border hover:shadow">
                    <h3 class="font-semibold mb-2">Fast & Easy</h3>
                    <p class="text-slate-600 text-sm">Post your property in minutes with a simple, mobile-first experience.</p>
                </div>
                <div class="p-6 rounded-xl border hover:shadow">
                    <h3 class="font-semibold mb-2">Verified Listings</h3>
                    <p class="text-slate-600 text-sm">We review every listing to keep Sofa safe and trustworthy.</p>
                </div>
                <div class="p-6 rounded-xl border hover:shadow">
                    <h3 class="font-semibold mb-2">For Everyone</h3>
                    <p class="text-slate-600 text-sm">Whether you’re buying, selling, or renting — Sofa works for you.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
