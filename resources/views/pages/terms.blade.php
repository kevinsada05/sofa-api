@extends('layouts.app')

@section('title', 'Terms of Service — Sofa')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-16">
        <h1 class="text-3xl font-bold mb-6">Terms of Service</h1>
        <p class="text-slate-600 mb-6">
            Welcome to Sofa. These Terms of Service (“Terms”) govern your use of the Sofa website, mobile applications, and related services (collectively, the “Services”).
            By accessing or using Sofa, you agree to these Terms. If you do not agree, please do not use our Services.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">1. About Sofa</h2>
        <p class="text-slate-600 mb-4">
            Sofa is a real estate platform designed to help users in Albania discover, list, and manage properties, including apartments, houses, land, and commercial spaces.
            Sofa does not own, sell, or rent properties directly. We provide a digital platform for property owners, agents, and renters to connect.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">2. Eligibility</h2>
        <p class="text-slate-600 mb-4">
            You must be at least 18 years old to use Sofa. By creating an account, you confirm that you have the legal capacity to enter into this agreement and comply with applicable laws in Albania.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">3. Account Registration</h2>
        <ul class="list-disc pl-6 space-y-2 text-slate-600 mb-4">
            <li>You agree to provide accurate, current, and complete information during registration.</li>
            <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
            <li>You are solely responsible for any activity that occurs under your account.</li>
        </ul>

        <h2 class="text-xl font-semibold mt-8 mb-4">4. Listings</h2>
        <p class="text-slate-600 mb-4">
            Users may create property listings on Sofa. By posting a listing, you confirm that:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600 mb-4">
            <li>All information provided (photos, descriptions, pricing) is accurate and not misleading.</li>
            <li>You have the right to offer, rent, or sell the property described.</li>
            <li>Listings must comply with all applicable laws and regulations in Albania.</li>
        </ul>

        <h2 class="text-xl font-semibold mt-8 mb-4">5. Prohibited Activities</h2>
        <p class="text-slate-600 mb-4">You agree not to use Sofa to:</p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600 mb-4">
            <li>Post false, fraudulent, or misleading information.</li>
            <li>Upload harmful, offensive, or illegal content (including discriminatory or hateful speech).</li>
            <li>Violate the rights of others, including intellectual property or privacy rights.</li>
            <li>Attempt to disrupt or damage the platform, servers, or networks.</li>
        </ul>

        <h2 class="text-xl font-semibold mt-8 mb-4">6. Payments & Fees</h2>
        <p class="text-slate-600 mb-4">
            Sofa may offer premium services or paid features. Payments are non-refundable unless required by law.
            All prices are shown in Albanian Lek (ALL) unless otherwise specified. You are responsible for any applicable taxes.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">7. Limitation of Liability</h2>
        <p class="text-slate-600 mb-4">
            Sofa is a platform and is not responsible for transactions between users. We do not verify the ownership of properties or guarantee the accuracy of listings.
            You agree that Sofa is not liable for any disputes, losses, or damages resulting from your use of the platform.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">8. Privacy</h2>
        <p class="text-slate-600 mb-4">
            Your privacy is important to us. Please review our <a href="{{ route('privacy') }}" class="text-indigo-600 hover:underline">Privacy Policy</a>
            to understand how we collect, use, and protect your information.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">9. Termination</h2>
        <p class="text-slate-600 mb-4">
            Sofa reserves the right to suspend or terminate your account at any time if you violate these Terms or engage in harmful behavior.
            You may also close your account at any time by contacting us.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">10. Changes to Terms</h2>
        <p class="text-slate-600 mb-4">
            Sofa may update these Terms from time to time. We will notify users of significant changes through the app or website. Continued use of Sofa means you accept the updated Terms.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">11. Governing Law</h2>
        <p class="text-slate-600 mb-4">
            These Terms are governed by the laws of the Republic of Albania. Any disputes shall be resolved in the competent courts of Tirana, Albania.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">12. Contact Us</h2>
        <p class="text-slate-600 mb-4">
            If you have questions about these Terms, please contact us via our <a href="{{ route('contact') }}" class="text-indigo-600 hover:underline">Contact Page</a>.
        </p>
    </div>
@endsection
