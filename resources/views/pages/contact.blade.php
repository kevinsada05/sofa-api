@extends('layouts.app')

@section('title', 'Contact — Sofa')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-16">
        <h1 class="text-3xl font-bold mb-6">Contact Us</h1>
        <p class="text-slate-600 mb-10">
            Have a question about Sofa, need help with your account, or want to partner with us?
            Fill out the form below or reach out using our contact details.
        </p>

        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Contact Form --}}
        <div class="bg-white shadow rounded-xl p-6 mb-12">
            <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           required>
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Phone (optional)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Message</label>
                    <textarea name="message" rows="5"
                              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                              required>{{ old('message') }}</textarea>
                    @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <button type="submit"
                            class="w-full md:w-auto px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Send Message
                    </button>
                </div>
            </form>
        </div>

        {{-- Contact Info --}}
        <div class="grid md:grid-cols-3 gap-8 text-slate-700">
            <div>
                <h2 class="font-semibold text-lg mb-2">📍 Address</h2>
                <p class="text-slate-600">Tirana, Albania</p>
            </div>
            <div>
                <h2 class="font-semibold text-lg mb-2">📞 Phone</h2>
                <p class="text-slate-600">+355 69 260 4998</p>
            </div>
            <div>
                <h2 class="font-semibold text-lg mb-2">✉️ Email</h2>
                <p class="text-slate-600">support@sofa.al</p>
            </div>
        </div>
    </div>
@endsection
