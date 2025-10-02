<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Sofa — Real Estate in Albania')</title>
    <meta name="description" content="@yield('meta_description','Sofa helps you discover and list properties across Albania — fast, transparent, and mobile-first.')">
    <meta property="og:title" content="@yield('title','Sofa — Real Estate in Albania')">
    <meta property="og:description" content="@yield('meta_description','Sofa helps you discover and list properties across Albania — fast, transparent, and mobile-first.')">
    <meta property="og:type" content="website">
    <link rel="icon" href="/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-900 antialiased flex flex-col min-h-screen">

<header class="sticky top-0 z-40 backdrop-blur bg-white/70 border-b border-slate-200/60">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-2">
            <img src="https://img.icons8.com/emoji/48/house-emoji.png" class="h-7 w-7" alt="Sofa Logo">
            <span class="font-bold text-lg">Sofa</span>
        </a>
        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a href="{{ route('landing') }}" class="hover:text-indigo-600">Home</a>
            <a href="{{ route('faq') }}" class="hover:text-indigo-600">FAQ</a>
            <a href="{{ route('terms') }}" class="hover:text-indigo-600">Terms</a>
            <a href="{{ route('privacy') }}" class="hover:text-indigo-600">Privacy</a>
            <a href="{{ route('contact') }}" class="inline-flex items-center rounded-lg bg-indigo-600 text-white px-3 py-2 hover:bg-indigo-700">
                Contact
            </a>
        </nav>
        <button class="md:hidden inline-flex items-center rounded-lg border px-3 py-2"
                onclick="document.getElementById('mnav').classList.toggle('hidden')">
            Menu
        </button>
    </div>
    <div id="mnav" class="md:hidden hidden border-t">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-3 space-y-2 text-sm">
            <a href="{{ route('landing') }}" class="block">Home</a>
            <a href="{{ route('faq') }}" class="block">FAQ</a>
            <a href="{{ route('terms') }}" class="block">Terms</a>
            <a href="{{ route('privacy') }}" class="block">Privacy</a>
            <a href="{{ route('contact') }}" class="block">Contact</a>
        </div>
    </div>
</header>

<main class="flex-1">
    @yield('content')
</main>

<footer class="border-t">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10 grid md:grid-cols-4 gap-8 text-sm">
        <div>
            <div class="flex items-center gap-2 mb-3">
                <img src="https://img.icons8.com/emoji/48/house-emoji.png" class="h-6 w-6" alt="Sofa Logo">
                <span class="font-semibold">Sofa</span>
            </div>
            <p class="text-slate-600 text-sm">Real estate for Albania. List properties with confidence.</p>
        </div>
        <div>
            <div class="font-semibold mb-3">Company</div>
            <ul class="space-y-2">
                <li><a class="hover:text-indigo-600" href="{{ route('landing') }}">Home</a></li>
                <li><a class="hover:text-indigo-600" href="{{ route('faq') }}">FAQ</a></li>
                <li><a class="hover:text-indigo-600" href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
        <div>
            <div class="font-semibold mb-3">Legal</div>
            <ul class="space-y-2">
                <li><a class="hover:text-indigo-600" href="{{ route('terms') }}">Terms</a></li>
                <li><a class="hover:text-indigo-600" href="{{ route('privacy') }}">Privacy Policy</a></li>
            </ul>
        </div>
        <div>
            <div class="font-semibold mb-3">Get the app</div>
            <div class="flex flex-col gap-3">
                <a href="#" class="inline-flex items-center justify-center rounded-lg border px-3 py-2 hover:bg-slate-50">App Store</a>
                <a href="#" class="inline-flex items-center justify-center rounded-lg border px-3 py-2 hover:bg-slate-50">Google Play</a>
            </div>
        </div>
    </div>
    <div class="text-center text-xs text-slate-500 py-6">© {{ date('Y') }} Sofa. All rights reserved.</div>
</footer>
</body>
</html>
