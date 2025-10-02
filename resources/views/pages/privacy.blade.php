@extends('layouts.app')

@section('title', 'Privacy Policy — Sofa')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-16">
        <h1 class="text-3xl font-bold mb-6">Privacy Policy</h1>
        <p class="text-slate-600 mb-6">
            At Sofa, your privacy is very important to us. This Privacy Policy explains how we collect, use, and protect your personal information when you use our website, mobile applications, and services (the “Services”).
            By using Sofa, you agree to the terms of this Privacy Policy.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">1. Information We Collect</h2>
        <ul class="list-disc pl-6 space-y-2 text-slate-600 mb-4">
            <li><strong>Account Information:</strong> Name, phone number, email, and password.</li>
            <li><strong>Profile Details:</strong> Agency name, website, address (if provided).</li>
            <li><strong>Property Listings:</strong> Photos, descriptions, pricing, and related data you upload.</li>
            <li><strong>Usage Data:</strong> Log files, device information, app version, and interactions within Sofa.</li>
            <li><strong>Location Data:</strong> If you choose to enable location services, we may collect your approximate location for property searches.</li>
        </ul>

        <h2 class="text-xl font-semibold mt-8 mb-4">2. How We Use Your Information</h2>
        <p class="text-slate-600 mb-4">We use your information to:</p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600 mb-4">
            <li>Provide and improve our Services.</li>
            <li>Verify your identity and maintain account security.</li>
            <li>Display property listings and enable communication between buyers, renters, and agents.</li>
            <li>Send important notifications (e.g., account updates, listing status changes).</li>
            <li>Show promotional messages or offers, where legally permitted.</li>
        </ul>

        <h2 class="text-xl font-semibold mt-8 mb-4">3. Sharing of Information</h2>
        <p class="text-slate-600 mb-4">
            Sofa does not sell your personal information. We may share limited data with:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600 mb-4">
            <li><strong>Service Providers:</strong> Hosting, storage (e.g., Backblaze B2), analytics, and payment processors.</li>
            <li><strong>Legal Authorities:</strong> If required by law or to protect our rights.</li>
            <li><strong>Business Transfers:</strong> In case of a merger, acquisition, or sale of assets.</li>
        </ul>

        <h2 class="text-xl font-semibold mt-8 mb-4">4. Cookies & Tracking</h2>
        <p class="text-slate-600 mb-4">
            Sofa may use cookies and similar technologies to improve functionality, analyze traffic, and personalize the experience.
            You can control cookie preferences in your browser or device settings.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">5. Data Storage & Security</h2>
        <p class="text-slate-600 mb-4">
            We use secure servers and encryption to protect your data. However, no method of transmission over the Internet is completely secure.
            By using Sofa, you acknowledge this risk.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">6. Your Rights</h2>
        <p class="text-slate-600 mb-4">Under GDPR and Albanian law, you have the right to:</p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600 mb-4">
            <li>Access the data we hold about you.</li>
            <li>Request correction or deletion of your data.</li>
            <li>Object to or restrict processing of your data.</li>
            <li>Withdraw consent at any time.</li>
            <li>Request a copy of your data in a portable format.</li>
        </ul>
        <p class="text-slate-600 mb-4">
            To exercise these rights, please <a href="{{ route('contact') }}" class="text-indigo-600 hover:underline">contact us</a>.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">7. Children’s Privacy</h2>
        <p class="text-slate-600 mb-4">
            Sofa is not intended for children under 16. We do not knowingly collect personal data from minors.
            If you believe a child has provided information, please contact us for deletion.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">8. Data Retention</h2>
        <p class="text-slate-600 mb-4">
            We keep your personal data only as long as necessary for the purposes described in this policy, or as required by law.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">9. Third-Party Services</h2>
        <p class="text-slate-600 mb-4">
            Sofa may link to third-party services (e.g., Google Maps, payment gateways). We are not responsible for the privacy practices of these services.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">10. Changes to This Policy</h2>
        <p class="text-slate-600 mb-4">
            Sofa may update this Privacy Policy from time to time. We will notify users of significant changes via the app or website.
            Continued use of Sofa means you accept the updated policy.
        </p>

        <h2 class="text-xl font-semibold mt-8 mb-4">11. Contact Us</h2>
        <p class="text-slate-600 mb-4">
            If you have any questions or concerns about this Privacy Policy, please reach us through our
            <a href="{{ route('contact') }}" class="text-indigo-600 hover:underline">Contact Page</a>.
        </p>
    </div>
@endsection
