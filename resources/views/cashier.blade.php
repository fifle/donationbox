<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@lang('Cashier mode for :campaign', ['campaign' => urldecode($campaign_title)]) | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}</title>
    <meta property="og:title" content="@lang('Cashier mode for :campaign', ['campaign' => urldecode($campaign_title)]) | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}">
    @include('head')
</head>
<body class="antialiased">
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-white focus:text-gray-900 focus:underline">@lang("Skip to main content")</a>

<style>
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
    .home-page .home-page-footer {
        position: relative;
        z-index: 60;
        isolation: isolate;
        color: #4b5563;
        transform: translateZ(0);
    }
    .home-page .home-page-footer footer {
        color: inherit;
    }
    .home-page .home-page-footer a {
        color: #1e40af;
    }
</style>

<div class="home-page flex flex-col min-h-screen py-12 px-4 sm:px-6 lg:px-8" x-data="{ showIntro: false }" @keydown.escape.window="showIntro = false">
    <div class="home-page-bg" aria-hidden="true"></div>

    <div class="max-w-lg w-full mx-auto flex-1 flex flex-col space-y-4 relative z-10 min-h-[calc(100vh-6rem)]">
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
                @lang("Cashier mode")
            </h1>
            <div class="mt-2 text-sm text-gray-500">
                @lang("Set amount and generate payment link")
            </div>
        </div>

        <main id="main-content" role="main" class="space-y-4">
            @include('components.cashier-form')
        </main>

        <div class="home-page-footer mt-auto flex-shrink-0 pt-4">
            @include('footer')
        </div>
    </div>

    <div x-show="showIntro" x-transition.opacity x-cloak class="fixed inset-0 z-50 flex items-center justify-center px-4">
        <div class="absolute inset-0 bg-gray-900/50" @click="showIntro = false" aria-hidden="true"></div>
        <div class="relative w-full max-w-md glass-strong rounded-2xl p-6 shadow-xl" role="dialog" aria-modal="true" aria-labelledby="cashier-intro-title" aria-describedby="cashier-intro-description">
            <div class="flex items-start justify-between">
                <h2 id="cashier-intro-title" class="text-lg font-semibold text-gray-700">
                    @lang("Cashier mode")
                </h2>
                <button type="button" @click="showIntro = false" class="ml-3 inline-flex items-center justify-center rounded-lg p-1.5 text-gray-400 hover:text-gray-600 hover:bg-white/70" aria-label="@lang('Close')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p id="cashier-intro-description" class="mt-3 text-sm text-gray-600">
                @lang("Cashier mode allows you to accept payments by setting a specified amount. Once set and confirmed, you'll get a generated QR code and URL that can be passed to the customer or donor.")
            </p>
            <div class="mt-6 space-y-4">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-gray-700">@lang("Set the amount")</h3>
                        <p class="mt-1 text-sm text-gray-600">@lang("Enter the payment amount together with the customer. This amount will be preset for the payment.")</p>
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
                        <p class="mt-1 text-sm text-gray-600">@lang("We generate a unique QR code and payment link for this specific amount. Share it with the customer via screen, print, or message.")</p>
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
                        <p class="mt-1 text-sm text-gray-600">@lang("Customer scans the QR code or opens the link. The amount is already set, so they just select their payment method and complete the payment.")</p>
                    </div>
                </div>
            </div>
            <div class="mt-6 p-4 bg-pink-50 rounded-lg border border-pink-100">
                <p class="text-sm text-gray-700">
                    <strong>@lang("Perfect for:")</strong> @lang("Free card terminal alternative, virtual money requests, and payment request automations through URL parameters.")
                </p>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" @click="showIntro = false" class="d-font inline-flex items-center justify-center rounded-lg bg-pink-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-1">
                    @lang("Continue to cashier mode")
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
