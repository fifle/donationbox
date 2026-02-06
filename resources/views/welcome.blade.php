<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        @if(env('COUNTRY') == 'ee')
                <title>@lang("Create your virtual donation box for Estonian banks for free - DonationBox.ee")</title>
        @endif
        @if(env('COUNTRY') == 'lv')
                <title>@lang("Create your virtual donation box for Latvian banks for free - DonationBox.lv")</title>
        @endif
        @if(env('COUNTRY') == 'lt')
                <title>@lang("Create your virtual donation box for Lithuanian banks for free - DonationBox.lt")</title>
        @endif
    @include('head')
</head>
<body class="antialiased">
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-white focus:text-gray-900 focus:underline">@lang("Skip to main content")</a>

<style>
/* Homepage: pink and yellow gradient mesh */
.home-page {
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.home-page-bg {
    position: fixed;
    inset: 0;
    z-index: 0;
    background:
        radial-gradient(ellipse 80% 60% at 20% 30%, rgba(253, 242, 248, 0.95) 0%, transparent 55%),
        radial-gradient(ellipse 70% 50% at 80% 20%, rgba(255, 251, 235, 0.7) 0%, transparent 50%),
        radial-gradient(ellipse 60% 70% at 60% 70%, rgba(251, 207, 232, 0.7) 0%, transparent 50%),
        radial-gradient(ellipse 50% 60% at 10% 80%, rgba(254, 249, 215, 0.6) 0%, transparent 50%),
        radial-gradient(ellipse 40% 50% at 50% 50%, rgba(253, 242, 248, 0.5) 0%, transparent 55%),
        linear-gradient(165deg, #fffffe 0%, #fffef5 50%, #fffffe 100%);
    background-size: 100% 100%;
    background-attachment: fixed;
}
/* Liquid Glass */
.glass {
    background: rgba(255, 255, 255, 0.72);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
}
.glass-strong {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid rgba(255, 255, 255, 0.6);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
}
/* Ensure footer is always visible and above fixed bottom nav when they overlap */
.home-page .home-page-footer {
    position: relative;
    z-index: 60;
    isolation: isolate;
    color: #4b5563;
    transform: translateZ(0); /* force own layer so backdrop-filter above doesn’t hide it */
}
.home-page .home-page-footer footer {
    color: inherit;
}
.home-page .home-page-footer a {
    color: #1e40af; /* blue-800 for links */
}
/* Security block: own layer so it isn’t obscured by glass elements above */
.home-page .secure-block {
    position: relative;
    z-index: 15;
    isolation: isolate;
}
.home-page .main-form-card {
    position: relative;
    z-index: 0;
}
.home-page .bottom-nav-bar {
    z-index: 50;
}
/* Bank tags: endless horizontal scroll */
.bank-tags-scroll {
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    touch-action: pan-x;
    mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent);
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.bank-tags-scroll::-webkit-scrollbar {
    display: none;
}
.bank-tags-scroll-inner {
    display: flex;
    gap: 0;
    width: max-content;
    animation: bank-tags-scroll 35s linear infinite;
    will-change: transform;
}
.bank-tags-scroll-group {
    display: flex;
    gap: 0.5rem;
    padding-right: 0.5rem;
    flex-shrink: 0;
}
.bank-tags-scroll:hover .bank-tags-scroll-inner,
.bank-tags-scroll:focus-within .bank-tags-scroll-inner,
.bank-tags-scroll:active .bank-tags-scroll-inner {
    animation-play-state: paused;
}
@keyframes bank-tags-scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(calc(-100% / 3)); }
}
.bank-tag {
    flex-shrink: 0;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.35rem 0.75rem;
    border-radius: 9999px;
    text-transform: uppercase;
    letter-spacing: 0.02em;
    white-space: nowrap;
}
</style>

<div class="home-page flex flex-col min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="home-page-bg" aria-hidden="true"></div>

    <div class="max-w-lg w-full mx-auto flex-1 flex flex-col space-y-4 relative z-10">
        <header role="banner" class="fixed top-4 right-4 sm:top-6 sm:right-6 left-auto">
            <div class="glass rounded-xl px-3 py-2">
                @include('components.lang-switcher')
            </div>
        </header>

        <div class="items-center justify-center mt-36 mb-8 text-center">
            <a href="/" aria-label="@lang('Return to homepage')" class="inline-block">
                <img class="mx-auto h-10 sm:h-12 w-auto object-contain" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox') logo - @lang('Return to homepage')">
            </a>
            <h1 class="mt-6 text-lg sm:text-xl font-medium text-gray-600 tracking-tight">
                @lang("Start your virtual donation box")<br>
                @if(env('COUNTRY') == 'ee')
                    @lang("for 🇪🇪 Estonian banks for free")
                @endif
                @if(env('COUNTRY') == 'lv')
                    @lang("for 🇱🇻 Latvian banks for free")
                @endif
                @if(env('COUNTRY') == 'lt')
                    @lang("for 🇱🇹 Lithuanian banks for free")
                @endif
            </h1>
            <div class="bank-tags-scroll mt-4 w-full max-w-lg mx-auto" aria-hidden="true" data-bank-scroll>
                <div class="bank-tags-scroll-inner">
                    @if(env('COUNTRY') == 'ee')
                        <div class="bank-tags-scroll-group">
                            <span class="bank-tag text-yellow-100 bg-yellow-500">Swedbank</span>
                            <span class="bank-tag text-green-100 bg-green-500">SEB</span>
                            <span class="bank-tag text-gray-200 bg-gray-700">LHV</span>
                            <span class="bank-tag text-blue-100 bg-blue-600">Coop</span>
                            <span class="bank-tag text-white bg-purple-500">Stripe</span>
                            <span class="bank-tag text-white bg-black">Revolut</span>
                            <span class="bank-tag text-white bg-red-500">Donorbox</span>
                            <span class="bank-tag text-white bg-blue-500">Paypal</span>
                        </div>
                        <div class="bank-tags-scroll-group" aria-hidden="true">
                            <span class="bank-tag text-yellow-100 bg-yellow-500" data-bank-focus>Swedbank</span>
                            <span class="bank-tag text-green-100 bg-green-500">SEB</span>
                            <span class="bank-tag text-gray-200 bg-gray-700">LHV</span>
                            <span class="bank-tag text-blue-100 bg-blue-600">Coop</span>
                            <span class="bank-tag text-white bg-purple-500">Stripe</span>
                            <span class="bank-tag text-white bg-black">Revolut</span>
                            <span class="bank-tag text-white bg-red-500">Donorbox</span>
                            <span class="bank-tag text-white bg-blue-500">Paypal</span>
                        </div>
                        <div class="bank-tags-scroll-group" aria-hidden="true">
                            <span class="bank-tag text-yellow-100 bg-yellow-500">Swedbank</span>
                            <span class="bank-tag text-green-100 bg-green-500">SEB</span>
                            <span class="bank-tag text-gray-200 bg-gray-700">LHV</span>
                            <span class="bank-tag text-blue-100 bg-blue-600">Coop</span>
                            <span class="bank-tag text-white bg-purple-500">Stripe</span>
                            <span class="bank-tag text-white bg-black">Revolut</span>
                            <span class="bank-tag text-white bg-red-500">Donorbox</span>
                            <span class="bank-tag text-white bg-blue-500">Paypal</span>
                        </div>
                    @endif
                    @if(env('COUNTRY') == 'lv')
                        <div class="bank-tags-scroll-group">
                            <span class="bank-tag text-yellow-100 bg-yellow-500">Swedbank</span>
                            <span class="bank-tag text-green-100 bg-green-500">SEB</span>
                            <span class="bank-tag text-white bg-purple-500">Stripe</span>
                            <span class="bank-tag text-white bg-black">Revolut</span>
                            <span class="bank-tag text-white bg-red-500">Donorbox</span>
                            <span class="bank-tag text-white bg-blue-500">Paypal</span>
                        </div>
                        <div class="bank-tags-scroll-group" aria-hidden="true">
                            <span class="bank-tag text-yellow-100 bg-yellow-500" data-bank-focus>Swedbank</span>
                            <span class="bank-tag text-green-100 bg-green-500">SEB</span>
                            <span class="bank-tag text-white bg-purple-500">Stripe</span>
                            <span class="bank-tag text-white bg-black">Revolut</span>
                            <span class="bank-tag text-white bg-red-500">Donorbox</span>
                            <span class="bank-tag text-white bg-blue-500">Paypal</span>
                        </div>
                        <div class="bank-tags-scroll-group" aria-hidden="true">
                            <span class="bank-tag text-yellow-100 bg-yellow-500">Swedbank</span>
                            <span class="bank-tag text-green-100 bg-green-500">SEB</span>
                            <span class="bank-tag text-white bg-purple-500">Stripe</span>
                            <span class="bank-tag text-white bg-black">Revolut</span>
                            <span class="bank-tag text-white bg-red-500">Donorbox</span>
                            <span class="bank-tag text-white bg-blue-500">Paypal</span>
                        </div>
                    @endif
                    @if(env('COUNTRY') == 'lt')
                        <div class="bank-tags-scroll-group">
                            <span class="bank-tag text-yellow-100 bg-yellow-500">Swedbank</span>
                            <span class="bank-tag text-green-100 bg-green-500">SEB</span>
                            <span class="bank-tag text-white bg-purple-500">Stripe</span>
                            <span class="bank-tag text-white bg-black">Revolut</span>
                            <span class="bank-tag text-white bg-red-500">Donorbox</span>
                            <span class="bank-tag text-white bg-blue-500">Paypal</span>
                        </div>
                        <div class="bank-tags-scroll-group" aria-hidden="true">
                            <span class="bank-tag text-yellow-100 bg-yellow-500" data-bank-focus>Swedbank</span>
                            <span class="bank-tag text-green-100 bg-green-500">SEB</span>
                            <span class="bank-tag text-white bg-purple-500">Stripe</span>
                            <span class="bank-tag text-white bg-black">Revolut</span>
                            <span class="bank-tag text-white bg-red-500">Donorbox</span>
                            <span class="bank-tag text-white bg-blue-500">Paypal</span>
                        </div>
                        <div class="bank-tags-scroll-group" aria-hidden="true">
                            <span class="bank-tag text-yellow-100 bg-yellow-500">Swedbank</span>
                            <span class="bank-tag text-green-100 bg-green-500">SEB</span>
                            <span class="bank-tag text-white bg-purple-500">Stripe</span>
                            <span class="bank-tag text-white bg-black">Revolut</span>
                            <span class="bank-tag text-white bg-red-500">Donorbox</span>
                            <span class="bank-tag text-white bg-blue-500">Paypal</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <main id="main-content" role="main" x-data="app()" x-cloak>
            <div x-show.transition="step != 'complete'">
                <!-- Top Navigation -->
                <!-- /Top Navigation -->
            </div>

            <!-- Action Selection Step -->
            <div x-show="step === 0 && flow !== 'donation' && flow !== 'cashier' && step !== 'edit-intro'" x-transition:enter.duration.500ms>
                <div class="glass rounded-2xl p-6 mb-2">
                    <div class="grid grid-cols-1 gap-3">
                        <button
                            @click="flow = 'donation'; step = 0"
                            class="d-font w-full focus:outline-none py-4 px-6 rounded-xl text-center font-medium transition duration-200 ease-out bg-pink-500 hover:bg-pink-600 text-white shadow-lg shadow-pink-500/25 hover:shadow-pink-500/30 hover:-translate-y-0.5">
                            <span class="text-xl" aria-hidden="true">✨</span>
                            <div class="font-semibold mt-1">@lang("Create New Donationbox")</div>
                            <div class="text-sm opacity-90 mt-0.5">@lang("Create your donation page in seconds.")</div>
                        </button>
                        <button
                            @click="flow = 'cashier'; step = 0"
                            class="d-font w-full focus:outline-none py-4 px-6 rounded-xl text-center font-medium transition duration-200 ease-out glass hover:bg-white/90 border border-pink-200/70 text-gray-700">
                            <span class="text-xl" aria-hidden="true">💳</span>
                            <div class="font-semibold mt-1">@lang("Cashier mode")</div>
                            <div class="text-sm text-gray-500 mt-0.5">@lang("Accept fixed-amount payments in seconds using a QR code or link.")</div>
                        </button>
                        <button
                            @click="step = 'edit-intro'"
                            class="d-font w-full focus:outline-none py-4 px-6 rounded-xl text-center font-medium transition duration-200 ease-out glass hover:bg-white/90 border border-gray-200/60 text-gray-700">
                            <span class="text-xl" aria-hidden="true">✏️</span>
                            <div class="font-semibold mt-1">@lang("Modify Existing Donationbox")</div>
                            <div class="text-sm text-gray-500 mt-0.5">@lang("Update settings and get a new link.")</div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Donationbox Creation Step 0 - Intro -->
            <div class="main-form-card glass-strong rounded-2xl p-6" x-show="flow === 'donation' && step === 0" x-transition:enter.duration.500ms>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">
                        <span class="text-xl mr-2" aria-hidden="true">✨</span>@lang("Create New Donationbox")
                    </h2>
                    <p class="text-sm text-gray-600 mb-6">
                        @lang("Launch a personal donation page in minutes, then share a link or QR code so people can donate using their preferred payment method.")
                    </p>
                    <div class="space-y-4 mb-6">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-700">@lang("Set up your campaign")</h3>
                                <p class="mt-1 text-sm text-gray-600">@lang("Add the campaign name, payment note, and recipient details, then choose which payment methods to accept.")</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C7.163 13.342 5.75 12.425 4.5 11a2.5 2.5 0 010-3.5c1.25-1.425 2.663-2.342 4.184-2.342m7.632 0C17.837 5.158 19.25 6.075 20.5 7.5a2.5 2.5 0 010 3.5c-1.25 1.425-2.663 2.342-4.184 2.342m-7.632 0c-1.521 0-2.934-.917-4.184-2.342M15.316 13.342c1.521 0 2.934.917 4.184 2.342M8.684 13.342l7.632 0M15.316 5.158l-7.632 0" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-700">@lang("Get your donation link")</h3>
                                <p class="mt-1 text-sm text-gray-600">@lang("We generate a unique URL and QR code for your donation page. Share it on social media, embed it on your site, or print it for offline events.")</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-700">@lang("Start receiving donations")</h3>
                                <p class="mt-1 text-sm text-gray-600">@lang("Donors open your link, choose an amount, pick a payment method, and complete the payment. Funds go directly to your bank account or payment provider.")</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 p-4 bg-pink-50 rounded-lg border border-pink-100">
                        <p class="text-sm text-gray-700">
                            <strong>@lang("Why DonationBox?")</strong> @lang("Free, simple, and secure. No coding required. Works with local banks and international payment methods, and it's ideal for fundraisers, non-profits, and personal causes.")
                        </p>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" @click="flow = ''; step = 0" class="d-font min-w-32 inline-flex items-center justify-center py-2 px-5 mr-2 rounded-lg shadow-sm text-gray-600 bg-white hover:bg-gray-100 font-medium border transition duration-150 ease-in-out">
                            @lang("Back")
                        </button>
                        <button type="button" @click="step = 1" class="d-font min-w-32 inline-flex items-center justify-center border border-transparent py-2 px-5 ml-2 rounded-lg font-medium rounded-md text-white bg-pink-500 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-700 transition duration-150 ease-in-out">
                            @lang("Continue")
                        </button>
                    </div>
                </div>
            </div>

            <!-- Edit Existing Link Intro Step -->
            <div class="main-form-card glass-strong rounded-2xl p-6" x-show="step === 'edit-intro'" x-transition:enter.duration.500ms>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">
                        <span class="text-xl mr-2" aria-hidden="true">✏️</span>@lang("Modify Existing Donationbox")
                    </h2>
                    <p class="text-sm text-gray-600 mb-6">
                        @lang("Update your donation page in minutes. Paste your Donationbox URL to load current settings, then edit what you need.")
                    </p>
                    <div class="space-y-4 mb-6">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-700">@lang("Paste your Donationbox URL")</h3>
                                <p class="mt-1 text-sm text-gray-600">@lang("Enter the full link to your existing Donationbox. We'll load your current setup automatically.")</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-700">@lang("Make your changes")</h3>
                                <p class="mt-1 text-sm text-gray-600">@lang("Edit the campaign name, payment note, recipient details, and payment methods. Everything is prefilled from your current settings.")</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-700">@lang("Get your updated link")</h3>
                                <p class="mt-1 text-sm text-gray-600">@lang("After you save, you'll get a new URL. Replace any shared links or embedded widgets with the new address.")</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <p class="text-sm text-yellow-800">
                            <strong>@lang("Important")</strong> @lang("Editing creates a new URL. The old link will still work, but it won't show your updates, so update links and website widgets.")
                        </p>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" @click="step = 0" class="d-font min-w-32 inline-flex items-center justify-center py-2 px-5 mr-2 rounded-lg shadow-sm text-gray-600 bg-white hover:bg-gray-100 font-medium border transition duration-150 ease-in-out">
                            @lang("Back")
                        </button>
                        <button type="button" @click="step = 'edit'" class="d-font min-w-32 inline-flex items-center justify-center border border-transparent py-2 px-5 ml-2 rounded-lg font-medium rounded-md text-white bg-pink-500 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-700 transition duration-150 ease-in-out">
                            @lang("Continue")
                        </button>
                    </div>
                </div>
            </div>

            <!-- Edit Existing Link Form -->
            <div x-show="step === 'edit'" x-transition:enter.duration.500ms>
                <div class="glass-strong rounded-2xl p-6 mb-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">@lang("Modify Existing Donationbox")</h3>
                        <form action="{{ route('edit') }}" method="get" id="edit-form">
                            <div class="mb-4">
                                <label for="edit_url" class="d-font font-semibold text-gray-700 block mb-1">
                                    @lang("Paste your existing Donationbox URL")
                                    <span class="font-normal text-red-500"><sup>*</sup></span>
                                </label>
                                <div class="tracking-normal text-sm text-gray-500 mb-3 leading-tight">
                                    @lang("Paste the full URL of your existing donationbox link to load its values for editing.")
                                </div>
                                <input
                                    type="url"
                                    name="url"
                                    id="edit_url"
                                    value="{{ request('url') }}"
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                    placeholder="https://donationbox.ee/donation?campaign_title=..."
                                    required>
                            </div>
                            <div class="flex justify-between">
                                <button
                                    type="button"
                                    @click="step = 0"
                                    class="d-font min-w-32 inline-flex items-center justify-center text-sm/6 py-2 px-2 mr-2 rounded-lg shadow-sm text-gray-600 bg-white hover:bg-gray-100 font-medium border transition duration-150 ease-in-out">
                                    @lang("Back")
                                </button>
                                <button
                                    type="submit"
                                    class="d-font min-w-32 inline-flex items-center justify-center text-sm/6 focus:outline-none border border-transparent py-2 px-2 ml-2 rounded-lg font-medium text-white rounded-md bg-pink-500
                                    hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                    focus:ring-pink-700 transition duration-150 ease-in-out">
                                    @lang("Start editing")
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cashier Mode Step 0 - Intro -->
            <div class="main-form-card glass-strong rounded-2xl p-6" x-show="flow === 'cashier' && step === 0" x-transition:enter.duration.500ms>
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">
                        <span class="text-xl mr-2" aria-hidden="true">💳</span>@lang("Cashier mode")
                    </h2>
                    <p class="text-sm text-gray-600 mb-6">
                        @lang("Accept payments instantly by setting a fixed amount and sharing a QR code or link.")
                    </p>
                    <div class="space-y-4 mb-6">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-700">@lang("Set the amount")</h3>
                                <p class="mt-1 text-sm text-gray-600">@lang("Enter the payment sum that your client or donor should pay.")</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-700">@lang("Get QR code & link")</h3>
                                <p class="mt-1 text-sm text-gray-600">@lang("We generate a unique QR code and payment link for this exact amount. Share it on screen, print, or message.")</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-gray-700">@lang("Customer pays")</h3>
                                <p class="mt-1 text-sm text-gray-600">@lang("The customer scans the QR code or opens the link, chooses a payment method, and confirms the payment.")</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 p-4 bg-pink-50 rounded-lg border border-pink-100">
                        <p class="text-sm text-gray-700">
                            <strong>@lang("Perfect for")</strong> @lang("A free alternative to card terminals, quick money requests, and automated payment links.")
                        </p>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" @click="flow = ''; step = 0" class="d-font min-w-32 inline-flex items-center justify-center py-2 px-5 mr-2 rounded-lg shadow-sm text-gray-600 bg-white hover:bg-gray-100 font-medium border transition duration-150 ease-in-out">
                            @lang("Back")
                        </button>
                        <button type="button" @click="step = 1" class="d-font min-w-32 inline-flex items-center justify-center border border-transparent py-2 px-5 ml-2 rounded-lg font-medium rounded-md text-white bg-pink-500 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-700 transition duration-150 ease-in-out">
                            @lang("Continue")
                        </button>
                    </div>
                </div>
            </div>

            <div class="main-form-card glass-strong rounded-2xl p-6" x-show="step !== 0 && step !== 'edit' && step !== 'edit-intro'">
                <div class="">
                    <div x-show.transition="step != 'complete'">
                        <!-- Progress bar (at top) -->
                        <div class="mb-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wide"
                                         x-text="`@lang("Step:") ${step} @lang("of") 5`"></div>
                                    <div class="flex items-center gap-3 flex-1 min-w-0 sm:max-w-xs w-full">
                                        <div class="flex-1 min-w-[4rem] min-h-[6px] h-1.5 rounded-full overflow-hidden bg-gray-300">
                                            <div class="h-full min-h-[6px] rounded-full transition-all duration-300"
                                                 style="background-color: #ec4899; min-width: 2%;"
                                                 :style="{ width: (step / 5 * 100) + '%' }"></div>
                                        </div>
                                        <span class="text-xs text-gray-500 tabular-nums shrink-0" x-text="(step / 5 * 100).toFixed(0) +'%'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step Content -->
                        <div class="py-1">
                            <!-- Step 1 -->
                            <div x-show="step === 1"
                                 x-transition:enter.duration.500ms>

                                <div class="mb-4 flex items-center">
                                    <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-semibold">1
                                    </div>
                                    <div class="ml-2 text-gray-500">@lang("Your campaign page details")</div>
                                </div>

                                <div class="mb-5">
                                    <form class="space-y-4" action="{{ route('donation') }}" method="get"
                                          :action="flow === 'cashier' ? '{{ route('cashier') }}' : '{{ route('donation') }}'"
                                          id="generator"></form>
                                    <div class="rounded-md -space-y-px">
                                        <div class="grid gap-6">
                                            <div class="col-span-12">
                                                <label for="campaign_title" class="d-font font-semibold text-gray-700
                                                        block mb-1">
                                                    @lang("Name your donation box")
                                                    <span class="font-normal text-red-500"><sup>*</sup></span>
                                                </label>
                                                <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                    @lang("This text will be used as the title of your donation box page.")
                                                </div>
                                                <input
                                                    form="generator"
                                                    type="text"
                                                    name="campaign_title"
                                                    id="campaign_title_field"
                                                    value="{{ request('campaign_title') }}"
                                                    class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                    placeholder="@lang("eg. 'Support our community'")"
                                                    aria-required="true"
                                                    required>
                                            </div>

                                            <div class="col-span-12">

                                                <label for="detail" class="d-font font-semibold text-gray-700
                                                        block mb-1">
                                                    @lang("Bank transfer detail") <span
                                                        class="font-normal text-red-500"><sup>*</sup></span>
                                                </label>
                                                <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                    @lang("This will be used as a requisite for the money transfer.")

                                                    <a href="/about#bankDetails" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">
                                                        @lang("Learn more about why it's important to keep details serious and straightforward.")
                                                    </a>
                                                </div>
                                                <input
                                                    form="generator"
                                                    type="text"
                                                    name="detail"
                                                    id="detail_field"
                                                    @if(env('COUNTRY') == 'ee')
                                                    value="Annetus"
                                                    @endif
                                                    @if(env('COUNTRY') == 'lv')
                                                    value="Ziedojums"
                                                    @endif
                                                    @if(env('COUNTRY') == 'lt')
                                                    value="Donorystė"
                                                    @endif
                                                    {{--                                                            value="{{ request('detail') }}"--}}
                                                    class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                    placeholder="eg. Annetus"
                                                    aria-required="true"
                                                    required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 - Preset donation amounts -->
                        <div x-show="step === 2"
                             x-transition:enter.duration.500ms>
                            <div class="mb-4 flex items-center">
                                <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-semibold">2
                                </div>
                                <div class="ml-2 text-gray-500">@lang("Preset donation amounts (optional)")</div>
                            </div>
                            <div class="mb-5">
                                <form class="space-y-4" action="{{ route('donation') }}" method="get"
                                      :action="flow === 'cashier' ? '{{ route('cashier') }}' : '{{ route('donation') }}'"
                                      id="generator"></form>
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <label class="d-font font-semibold text-gray-700 block mb-1">
                                                @lang("Preset donation amounts (optional)")
                                            </label>
                                            <div class="tracking-normal text-sm text-gray-500 mb-3 leading-tight">
                                                @lang("These amounts will appear as quick-select buttons on the donation page.")
                                            </div>
                                            <div class="grid grid-cols-3 gap-4">
                                                <div>
                                                    <label for="s1" class="text-xs text-gray-600 mb-1 block">@lang("Amount 1")</label>
                                                    <input
                                                        form="generator"
                                                        type="number"
                                                        name="s1"
                                                        id="s1"
                                                        value="{{ request('s1') }}"
                                                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm transition duration-150 ease-in-out"
                                                        placeholder="25"
                                                        step="0.01"
                                                        min="0">
                                                </div>
                                                <div>
                                                    <label for="s2" class="text-xs text-gray-600 mb-1 block">@lang("Amount 2")</label>
                                                    <input
                                                        form="generator"
                                                        type="number"
                                                        name="s2"
                                                        id="s2"
                                                        value="{{ request('s2') }}"
                                                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm transition duration-150 ease-in-out"
                                                        placeholder="50"
                                                        step="0.01"
                                                        min="0">
                                                </div>
                                                <div>
                                                    <label for="s3" class="text-xs text-gray-600 mb-1 block">@lang("Amount 3")</label>
                                                    <input
                                                        form="generator"
                                                        type="number"
                                                        name="s3"
                                                        id="s3"
                                                        value="{{ request('s3') }}"
                                                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm transition duration-150 ease-in-out"
                                                        placeholder="100"
                                                        step="0.01"
                                                        min="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div x-show="step === 3"
                             x-transition:enter.duration.500ms>
                            <div class="mb-4 flex items-center">
                                <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-semibold">3
                                </div>
                                <div class="ml-2 text-gray-500">@lang("Your personal data")</div>
                            </div>
                            <div class="mb-5">
                                @csrf
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="d-font font-semibold text-gray-700
                                                        block mb-2">@lang("Payee's name")
                                                <span class="font-normal text-red-500"><sup>*</sup></span>
                                            </label>
                                            <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                @lang("Insert the name of the person or company on whose behalf you want to open a fundraiser. Please make sure that the name is spelled correctly in Latin letters.")
                                            </div>
                                            <input
                                                form="generator"
                                                type="text"
                                                name="payee"
                                                id="payee_field"
                                                value="{{ request('payee') }}"
                                                class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                @if(env('COUNTRY') == 'ee')
                                                placeholder="@lang("eg. 'Tädi Maali' or 'Tavai MTÜ'")"
                                                @endif
                                                @if(env('COUNTRY') == 'lv')
                                                placeholder="@lang("eg. 'Jānis Bērziņš' or 'Biedrība'")"
                                                @endif
                                                @if(env('COUNTRY') == 'lt')
                                                placeholder="@lang("eg. 'Vardenis Pavardenis' or 'VšĮ'")"
                                                @endif
                                                aria-required="true"
                                                required/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(env('COUNTRY') == 'ee')
                            <div class="mb-5">
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="d-font font-semibold text-gray-700
                                                        block mb-2">@lang("Tax return for donors in Estonia")
                                            </label>
                                            <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                @lang("If you'll turn on this checkbox, your donors will be able to request an income tax refund on their donation. NB! Your organization must be on the register of associations eligible for tax incentives.")
{{--                                                <a href="/about#taxfree-ee" class="no-underline hover:underline--}}
{{--                                                    text-blue-800" target="_blank">Learn more ></a>--}}
                                            </div>
                                            <div class="flex items-start mb-2">
                                                <div class="flex items-center h-5">
                                                    <input
                                                        form="generator"
                                                        type="checkbox"
                                                        id="tax"
                                                        name="tax"
                                                        value="1"
                                                        aria-label="@lang("Let my donors apply for a tax refund")"
                                                        class="w-5 h-5
                                                       bg-red-100 border-red-300 text-red-500 focus:ring-red-200"/>
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="tax" class="d-font text-gray-900
                                                    dark:text-gray-300">
                                                        @lang("Let my donors apply for a tax refund")
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- Step 4 -->
                        <div x-show="step === 4"
                             x-transition:enter.duration.500ms>
                            <div class="mb-4 flex items-center">
                                <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-semibold">4
                                </div>
                                <div class="ml-2 text-gray-500">@lang("Details for")
                                    @if(env('COUNTRY') == 'ee')
                                        @lang("Estonian internet-banks")
                                    @endif
                                    @if(env('COUNTRY') == 'lv')
                                        @lang("Latvian internet-banks")
                                    @endif
                                    @if(env('COUNTRY') == 'lt')
                                        @lang("Lithuanian internet-banks")
                                    @endif
                                </div>
                            </div>
                            <div class="mb-5">
                                @csrf
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="d-font font-semibold text-gray-700
                                                        block mb-2">@lang("Payee's bank account (IBAN) number")</label>
                                            <input
                                                form="generator"
                                                type="text"
                                                name="iban"
                                                        id="iban_field"
                                                value="{{ request('iban') }}"
                                                pattern="^(?:(?:IT|SM)\d{2}[A-Z]\d{22}|CY\d{2}[A-Z]\d{23}|NL\d{2}[A-Z]{4}\d{10}|LV\d{2}[A-Z]{4}\d{13}|(?:BG|BH|GB|IE)\d{2}[A-Z]{4}\d{14}|GI\d{2}[A-Z]{4}\d{15}|RO\d{2}[A-Z]{4}\d{16}|KW\d{2}[A-Z]{4}\d{22}|MT\d{2}[A-Z]{4}\d{23}|NO\d{13}|(?:DK|FI|GL|FO)\d{16}|MK\d{17}|(?:AT|EE|KZ|LU|XK)\d{18}|(?:BA|HR|LI|CH|CR)\d{19}|(?:GE|DE|LT|ME|RS)\d{20}|IL\d{21}|(?:AD|CZ|ES|MD|SA)\d{22}|PT\d{23}|(?:BE|IS)\d{24}|(?:FR|MR|MC)\d{25}|(?:AL|DO|LB|PL)\d{26}|(?:AZ|HU)\d{27}|(?:GR|MU)\d{28})$"
                                                class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                @if(env('COUNTRY') == 'ee')
                                                placeholder="eg. EE382200221020145685"
                                                @endif
                                                @if(env('COUNTRY') == 'lv')
                                                placeholder="eg. LV80BANK0000435195001"
                                                @endif
                                                @if(env('COUNTRY') == 'lt')
                                                placeholder="eg. LT121000011101001000"
                                                @endif
                                                        aria-label="@lang("Payee's bank account (IBAN) number")"
                                            />
                                        </div>

                                        <div class="col-span-12">
                                            <label for="campaign_title" class="d-font font-semibold text-gray-700 mb-2">
                                                @lang("Choose banking methods")
                                            </label>
                                            <h3 class="text-sm text-gray-600 leading-5 col-span-12">@lang('For private individuals, non-profits, and businesses. Supports both one-time and recurring payments')</h3>
                                        </div>
                                        {{--Swedbank--}}
                                        <div class="col-span-12" x-data="{swt: false}">
                                            <div class="grid grid-cols-2 gap-4 space-y-0 items-center">
                                            <div class="flex justify-start">
                                                <h2 class="text-sm font-semibold w-fit py-2 px-3 uppercase rounded-full text-yellow-100 bg-yellow-500 uppercase">Swedbank</h2 >
                                            </div>
                                            <div>
                                                <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                     :class="[swt ? 'bg-gray-300' : 'bg-pink-500']">
                                                    <label
                                                        for="swt"
                                                        class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                        :class="[swt ? 'translate-x-0 border-green-400' : 'translate-x-full border-gray-400' ]"></label>
                                                    <input
                                                        form="generator"
                                                        type="checkbox"
                                                        id="swt"
                                                        name="swt"
                                                        x-model="swt"
                                                        @click="swt = !swt"
                                                        aria-label="@lang("Enable Swedbank payment method")"
                                                        class="w-full h-full appearance-none focus:outline-none"
                                                    />
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        {{--SEB--}}
                                        <div class="col-span-12" x-data="{sebt: false}">
                                            <div class="grid grid-cols-2 gap-4 items-center">
                                            <div class="flex justify-start flex-col items-start">
                                                <h2 class="text-sm font-semibold w-fit py-2 px-3 uppercase rounded-full text-green-100 bg-green-500 uppercase">SEB bank</h2>
                                                <span class="text-xs text-gray-500 mt-0.5">@lang("For non-profits and businesses only")</span>
                                            </div>
                                            <div>
                                                <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                     :class="[sebt ? 'bg-pink-500' : 'bg-gray-300']">
                                                    <label
                                                        for="sebt"
                                                        class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                        :class="[sebt ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                    <input
                                                        type="checkbox"
                                                        id="sebt"
                                                        name="sebt"
                                                        x-model="sebt"
                                                        aria-label="@lang("Enable SEB bank payment method")"
                                                        class="w-full h-full appearance-none focus:outline-none"
                                                    />
                                                </div>
                                            </div>
                                            </div>
                                            <div x-show="sebt">
                                                <div class="col-span-12 mt-3 ml-1 mr-1">
                                                    <p class="font-bold text-amber-700 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2 mb-3 text-sm">@lang("SEB UID is available for non-profits and businesses only. Private individuals cannot obtain this token.")</p>
                                                    <label for="campaign_title" class="d-font font-semibold text-gray-700
                                                        block mb-2">@lang("SEB UID token")</label>
                                                    <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                        @lang("If you want to connect SEB bank as part of the payment methods, you need to get your own UID token from SEB.")
                                                        <a href="/about#sebUID" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">
                                                            @lang("Read more about how to obtain UID for non-profits and businesses >") </a>
                                                    </div>
                                                        <div class="tracking-normal text-sm text-gray-500 mt-3 mb-2
                                                            leading-tight">
                                                            @lang("Insert SEB UID for") <b>@lang("One-time direct payments")</b></div>
                                                    <input
                                                        form="generator"
                                                        type="text"
                                                        name="sebuid"
                                                        value="{{ request('sebuid') }}"
                                                        class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                        placeholder="eg. f0233a8a-2c62-414d-a8e0-868d5ca345cb"
                                                    />
                                                        <div class="tracking-normal text-sm text-gray-500 mt-3 mb-2
                                                        leading-tight">
                                                            @lang("Insert SEB UID for") <b>@lang("Standing order")</b></div>
                                                        <input
                                                            form="generator"
                                                            type="text"
                                                            name="sebuid_st"
                                                            value="{{ request('sebuid_st') }}"
                                                            class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                            placeholder="eg. 7d28392a-771e-4128-95ee-a9cc1de7f25e"
                                                        />
                                                </div>
                                            </div>
                                        </div>
                                        @if(env('COUNTRY') == 'ee')
                                        {{--LHV--}}
                                        <div class="col-span-12" x-data="{lhvt: false}">
                                            <div class="grid grid-cols-2 gap-4 items-center">
                                                <div class="flex justify-start">
                                                    <h2 class="text-sm font-semibold w-fit py-2 px-3 uppercase rounded-full text-gray-200 bg-gray-700 uppercase">LHV bank</h2>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[lhvt ? 'bg-gray-300' : 'bg-pink-500']">
                                                        <label
                                                            for="lhvt"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[lhvt ? 'translate-x-0 border-green-400' : 'translate-x-full border-gray-400' ]"></label>
                                                        <input
                                                            form="generator"
                                                            type="checkbox"
                                                            id="lhvt"
                                                            name="lhvt"
                                                            x-model="lhvt"
                                                            @click="lhvt = !lhvt"
                                                            aria-label="@lang("Enable LHV bank payment method")"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="lhvt">
                                            </div>
                                        </div>
                                        @endif
                                        @if(env('COUNTRY') == 'ee')
                                        {{--COOP--}}
                                        <div class="col-span-12" x-data="{coopt: false}">
                                            <div class="grid grid-cols-2 gap-4 items-center">
                                                <div class="flex justify-start">
                                                    <h2 class="text-sm font-semibold w-fit py-2 px-3 uppercase rounded-full text-blue-100 bg-blue-600 uppercase">Coop bank</h2>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[coopt ? 'bg-gray-300' : 'bg-pink-500']">
                                                        <label
                                                            for="coopt"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[coopt ? 'translate-x-0 border-green-400' : 'translate-x-full border-gray-400' ]"></label>
                                                        <input
                                                            form="generator"
                                                            type="checkbox"
                                                            id="coopt"
                                                            name="coopt"
                                                            x-model="coopt"
                                                            @click="coopt = !coopt"
                                                            aria-label="@lang("Enable Coop bank payment method")"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="coopt">
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 5 -->
                        <div x-show="step === 5"
                             x-transition:enter.duration.500ms>
                            <div class="mb-4 flex items-center">
                                <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-semibold">5
                                </div>
                                <div class="ml-2 text-gray-500">@lang("Credit cards")</div>
                            </div>
                            <div class="mb-5">
                                <div class="col-span-12 mb-3">
                                    <label for="campaign_title" class="d-font font-semibold text-gray-700 mb-2">
                                        @lang("Choose banking methods")
                                    </label>
                                </div>
                                @csrf
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        {{--Stripe--}}
                                        <h3 class="text-sm text-gray-600 leading-3 col-span-12">@lang('For non-profits and businesses')</h3>
                                        <div class="col-span-12" x-data="{strptoggle: false}">
                                            <div class="grid grid-cols-4 gap-4 items-center">
                                                <div class="flex flex-col col-span-3 items-start">
                                                    <h2 class="text-sm font-semibold w-fit py-2 px-3 uppercase rounded-full text-white bg-purple-500 uppercase">Stripe</h2>
                                                    <p class="text-xs text-gray-600 leading-3 mt-1">@lang('One-time payments only')</p>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[strptoggle ? 'bg-pink-500' : 'bg-gray-300']">
                                                        <label
                                                            for="strptoggle"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[strptoggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                        <input
                                                            type="checkbox"
                                                            id="strptoggle"
                                                            name="strptoggle"
                                                            x-model="strptoggle"
                                                            aria-label="@lang("Enable Stripe payment method")"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="strptoggle">
                                                <div class="col-span-12 mt-3 ml-1 mr-1">
                                                    <label for="campaign_title" class="font-semibold text-gray-700
                                                        block mb-2">@lang("Stripe's Payment Link ID")</label>
                                                    <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                        @lang("If your business or non-profit has a Stripe account, you can generate a Payment Link to accept donations via credit cards. Please insert the Payment Link ID to include this method in your DonationBox. You can find the ID in the Payment Link URL right after the slash. For example: https://donate.stripe.com/[YOUR-ID].")
                                                        <a href="https://docs.stripe.com/payment-links/create" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">
                                                            @lang("Read more on how to create new Stripe Payment Link >")</a>
                                                        </a>
                                                    </div>
                                                    <div class="flex flex-wrap items-stretch w-full mb-2 relative">
                                                        <input
                                                            form="generator"
                                                            type="text"
                                                            name="strp"
                                                            value="{{ request('strp') }}"
                                                            class="flex-shrink flex-grow flex-auto flex-auto
                                                        leading-normal w-px flex-1 border h-10 border-grey-light rounded px-3 relative transition duration-150 ease-in-out"
                                                            placeholder="Insert Stripe's Payment Link ID"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--Paypal Business Account--}}
                                        <div class="col-span-12" x-data="{ppbusinesstoggle: false}">
                                            <div class="grid grid-cols-4 gap-4 items-center">
                                                <div class="flex flex-col col-span-3 items-start">
                                                    <h2 class="text-sm font-semibold w-fit py-2 px-3 uppercase rounded-full text-blue-700 bg-gray-200 uppercase">Paypal Business</h2>
                                                    <p class="text-xs text-gray-600 leading-3 mt-1">@lang('One-time payments only')</p>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[ppbusinesstoggle ? 'bg-pink-500' : 'bg-gray-300']">
                                                        <label
                                                            for="ppbusinesstoggle"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[ppbusinesstoggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                        <input
                                                            type="checkbox"
                                                            id="ppbusinesstoggle"
                                                            name="ppbusinesstoggle"
                                                            x-model="ppbusinesstoggle"
                                                            aria-label="@lang("Enable PayPal Business payment method")"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="ppbusinesstoggle">
                                                <div class="col-span-12 mt-3 ml-1 mr-1">
                                                    <label for="campaign_title" class="font-semibold text-gray-700
                                                        block mb-2">@lang("PayPal business account's Client ID")</label>
                                                    <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                        @lang("If you have a Paypal Business account, you can generate Client ID to accept donations by credit cards.")
                                                        <a href="/about#paypal" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">
                                                            @lang("How can I create it? >")</a>
                                                        </a>
                                                    </div>
                                                    <div class="flex flex-wrap items-stretch w-full mb-2 relative">
                                                        <input
                                                            form="generator"
                                                            type="text"
                                                            name="paypalClientId"
                                                            value="{{ request('paypalClientId') }}"
                                                            class="flex-shrink flex-grow flex-auto flex-auto
                                                        leading-normal w-px flex-1 border h-10 border-grey-light rounded px-3 relative transition duration-150 ease-in-out"
                                                            placeholder="Insert your PayPal Business Account's Client ID"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--Donorbox--}}
                                        <div class="col-span-12" x-data="{dbtoggle: false}">
                                            <div class="grid grid-cols-4 gap-4 items-center">
                                                <div class="flex flex-col col-span-3 items-start">
                                                    <h2 class="text-sm font-semibold w-fit py-2 px-3 uppercase
                                                     rounded-full text-white bg-red-500 uppercase">Donorbox.org</h2>
                                                    <p class="text-xs text-gray-600 leading-3 mt-1">@lang('One-time and recurring')</p>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[dbtoggle ? 'bg-pink-500' : 'bg-gray-300']">
                                                        <label
                                                            for="dbtoggle"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[dbtoggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                        <input
                                                            type="checkbox"
                                                            id="dbtoggle"
                                                            name="dbtoggle"
                                                            x-model="dbtoggle"
                                                            aria-label="@lang("Enable Donorbox payment method")"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="dbtoggle">
                                                <div class="col-span-12 mt-3 ml-1 mr-1">
                                                    <label for="campaign_title" class="font-semibold text-gray-700
                                                        block mb-2">@lang("Donorbox.org campaign slug")</label>
                                                    <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                        @lang("To start accepting payments for bank cards, you can use the Donorbox service.")
                                                        <a href="/about#donorbox" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">
                                                            @lang("How can I create it? >")</a>
                                                        </a>
                                                    </div>
                                                    <div class="flex flex-wrap items-stretch w-full mb-2 relative">
                                                        <div class="flex -mr-px">
                                                    <span
                                                        class="flex items-center leading-normal bg-grey-lighter rounded rounded-r-none border border-r-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm">donorbox.org/</span>
                                                        </div>
                                                        <input
                                                            form="generator"
                                                            type="text"
                                                            name="db"
                                                            value="{{ request('db') }}"
                                                            class="flex-shrink flex-grow flex-auto flex-auto
                                                        leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative transition duration-150 ease-in-out"
                                                            placeholder="your-campaign-slug"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="text-sm text-gray-600 leading-3 col-span-12">@lang("For private individuals")</h3>
                                        {{--Paypal.me--}}
                                        <div class="col-span-12" x-data="{pptoggle: false}">
                                            <div class="grid grid-cols-4 gap-4 items-center">
                                                <div class="flex flex-col col-span-3 items-start">
                                                    <h2 class="text-sm font-semibold w-fit py-2 px-3 uppercase rounded-full text-white bg-blue-500 uppercase">Paypal.me</h2>
                                                    <p class="text-xs text-gray-600 leading-3 mt-1">@lang('One-time payments only')</p>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[pptoggle ? 'bg-pink-500' : 'bg-gray-300']">
                                                        <label
                                                            for="pptoggle"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[pptoggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                        <input
                                                            type="checkbox"
                                                            id="pptoggle"
                                                            name="pptoggle"
                                                            x-model="pptoggle"
                                                            aria-label="@lang("Enable PayPal.me payment method")"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="pptoggle">
                                                <div class="col-span-12 mt-3 ml-1 mr-1">
                                                    <label for="campaign_title" class="font-semibold text-gray-700
                                                        block mb-2">@lang("PayPal.me username")</label>
                                                    <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                        @lang("If you have a Paypal account, you can create your own Paypal.me page to accept donations from other users.")
                                                        <a href="/about#paypal" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">
                                                            @lang("How can I create it? >")</a>
                                                        </a>
                                                    </div>
                                                    <div class="flex flex-wrap items-stretch w-full mb-2 relative">
                                                        <div class="flex -mr-px">
                                                    <span
                                                        class="flex items-center leading-normal bg-grey-lighter rounded rounded-r-none border border-r-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm">paypal.me/</span>
                                                        </div>
                                                        <input
                                                            form="generator"
                                                            type="text"
                                                            name="pp"
                                                            value="{{ request('pp') }}"
                                                            class="flex-shrink flex-grow flex-auto flex-auto
                                                        leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative transition duration-150 ease-in-out"
                                                            placeholder="your-paypal-me-username"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--Revolut.me--}}
                                        <div class="col-span-12" x-data="{revtoggle: false}">
                                            <div class="grid grid-cols-4 gap-4 items-center">
                                                <div class="flex flex-col col-span-3 items-start">
                                                    <h2 class="text-sm font-semibold w-fit py-2 px-3 uppercase rounded-full text-white bg-black uppercase">Revolut.me</h2>
                                                    <p class="text-xs text-gray-600 leading-3 mt-1">@lang('One-time payments only')</p>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[revtoggle ? 'bg-pink-500' : 'bg-gray-300']">
                                                        <label
                                                            for="revtoggle"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[revtoggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                        <input
                                                            type="checkbox"
                                                            id="revtoggle"
                                                            name="revtoggle"
                                                            x-model="revtoggle"
                                                            aria-label="@lang("Enable Revolut.me payment method")"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="revtoggle">
                                                <div class="col-span-12 mt-3 ml-1 mr-1">
                                                    <label for="campaign_title" class="font-semibold text-gray-700
                                                        block mb-2">@lang("Revolut.me username")</label>
                                                    <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                        @lang("If you have a Revolut account, you can create your own Revolut.me page to accept payments from other users in Revolut or by credit card.")
                                                        <a href="/about#revolut" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">
                                                            @lang("How can I create it? >")</a>
                                                    </div>
                                                    <div class="flex flex-wrap items-stretch w-full mb-2 relative">
                                                        <div class="flex -mr-px">
                                                    <span
                                                        class="flex items-center leading-normal bg-grey-lighter
                                                        rounded rounded-r-none border border-r-0 border-grey-light
                                                        px-3 whitespace-no-wrap text-grey-dark text-sm">revolut.me/</span>
                                                        </div>
                                                        <input
                                                            form="generator"
                                                            type="text"
                                                            name="rev"
                                                            value="{{ request('rev') }}"
                                                            class="flex-shrink flex-grow flex-auto flex-auto
                                                        leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative transition duration-150 ease-in-out"
                                                            placeholder="your-revolut-me-username"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Step Content -->
                    
                    <!-- Navigation buttons (at bottom) -->
                    <div class="mt-6" x-show="step !== 'complete'">
                        <div class="flex justify-between">
                                <div class="w-1/2 flex justify-start">
                                    <button
                                        x-show="step === 1"
                                        type="button"
                                        class="d-font min-w-32 inline-flex items-center justify-center py-2 px-5 mr-2 rounded-lg shadow-sm
                                            text-gray-600 bg-white hover:bg-gray-100 font-medium border transition
                                            duration-150 ease-in-out cursor-not-allowed opacity-50"
                                        disabled
                                    >@lang("Previous")
                                    </button>
                                    <button
                                        x-show="step > 1"
                                        type="button"
                                        @click="step--"
                                        class="d-font min-w-32 inline-flex items-center justify-center py-2 px-5 mr-2 rounded-lg shadow-sm
                                            text-gray-600 bg-white hover:bg-gray-100 font-medium border transition duration-150 ease-in-out"
                                    >@lang("Previous")
                                    </button>
                                </div>

                                <div class="w-1/2 flex justify-end">
                                    <button
                                        x-show="step < 5"
                                        type="button"
                                        @click="step++"
                                        class="d-font min-w-32 inline-flex items-center justify-center border border-transparent py-2 px-5 ml-2 rounded-lg
                                            font-medium rounded-md text-white bg-pink-500
                                            hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                            focus:ring-pink-700 transition duration-150 ease-in-out">
                                        @lang("Next")
                                    </button>

                                    <button
                                        type="submit"
                                        form="generator"
                                        value="submit"
                                        x-show="step === 5"
                                        class="d-font min-w-32 inline-flex items-center justify-center border border-transparent py-2 px-5 ml-2 rounded-lg
                                            font-medium rounded-md text-white bg-pink-500
                                            hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                            focus:ring-pink-700 transition duration-150 ease-in-out">
                                        @lang("Complete")
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </main>

        @include('secure')

        <!-- @if(env('COUNTRY') == 'ee')
            <div class="pt-10">
                <a href="https://2024.donationbox.ee/?db" target="_blank" aria-label="@lang('Visit DonationBox 2024')">
                    <img class="mx-auto rounded-xl hover:opacity-90" src="/img/df-2024-fb-cover-01.jpg" alt="@lang('DonationBox 2024 promotional image')">
                </a>
            </div>
        @endif -->

        <div class="home-page-footer mt-auto flex-shrink-0 pt-4 pb-8">
            @include('footer')
        </div>

    </div>

</div>

<script>
    function app() {
        return {
            step: 0, // Start with action selection
            flow: '',
        }
    }
</script>
</body>
</html>
