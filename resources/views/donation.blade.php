<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}</title>
    <meta property="og:title" content="{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}">
    @include('head')
</head>
<body class="antialiased donation-page">
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-white focus:text-gray-900 focus:underline">@lang("Skip to main content")</a>

<style>
/* Donation page: same layout as main – pink/yellow gradient mesh + liquid glass */
.donation-page {
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.donation-page .home-page-bg {
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
.donation-page .home-page-footer {
    position: relative;
    z-index: 60;
    isolation: isolate;
    color: #4b5563;
    transform: translateZ(0);
}
.donation-page .home-page-footer footer { color: inherit; }
.donation-page .home-page-footer a { color: #1e40af; }
/* Donation page banner: scrollable bank tags */
.donation-page .bank-tags-scroll {
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    touch-action: pan-x;
    mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, black 8%, black 92%, transparent);
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.donation-page .bank-tags-scroll::-webkit-scrollbar {
    display: none;
}
.donation-page .bank-tags-scroll-inner {
    display: flex;
    gap: 0;
    width: max-content;
    animation: bank-tags-scroll 35s linear infinite;
    will-change: transform;
}
.donation-page .bank-tags-scroll-group {
    display: flex;
    gap: 0.5rem;
    padding-right: 0.5rem;
    flex-shrink: 0;
}
.donation-page .bank-tags-scroll:hover .bank-tags-scroll-inner,
.donation-page .bank-tags-scroll:focus-within .bank-tags-scroll-inner,
.donation-page .bank-tags-scroll:active .bank-tags-scroll-inner {
    animation-play-state: paused;
}
@keyframes bank-tags-scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(calc(-100% / 3)); }
}
.donation-page .bank-tag {
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

<div class="donation-page flex flex-col min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="home-page-bg" aria-hidden="true"></div>

    <div class="max-w-lg w-full mx-auto flex-1 flex flex-col space-y-6 relative z-10 min-h-[calc(100vh-6rem)] pb-8">
        <header role="banner" class="fixed top-4 right-4 sm:top-6 sm:right-6 left-auto z-20">
            <div class="glass rounded-xl px-3 py-2">
                @include('components.lang-switcher')
            </div>
        </header>

        <div class="flex justify-center mt-6 mb-4">
            <a href="/" target="_blank" aria-label="@lang('Return to homepage')" class="inline-block">
                <img class="h-6 w-auto sm:h-7 object-contain" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox') logo - @lang('Return to homepage')">
            </a>
        </div>

        <main id="main-content" role="main" class="mt-2">
        @include('form')

    <!-- COPY LINK -->
        @if(!$s0)
        <div class="glass-strong rounded-2xl p-6 mt-8">
            <div class="content-center">
                <h3 class="mb-2 text-center text-1xl font-bold text-gray-600">
                    @lang("Share this donation box with your friends!")
                </h3>
                <div class="mt-2 flex items-center justify-center">
                {!! Share::page(urlencode(url()->full()), urldecode($campaign_title))->facebook()->twitter()
                ->linkedin()
                ->whatsapp() !!}
                <!-- Trigger -->
                    <button type="button" class="d-font btn transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-3 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        text-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2"
                            data-clipboard-text="{{ $link }}"
                            aria-label="@lang('Copy donation link to clipboard')">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> @lang("Copy link")
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- QR CODE -->
        @if(!$s0)
        <div class="glass-strong rounded-2xl p-6 mt-8" x-data="{ open: false }">
            <button type="button"
                    @click="open = !open"
                    class="w-full flex items-center justify-between gap-2 text-left focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 rounded-lg py-1 -my-1"
                    :aria-expanded="open">
                <h3 class="text-1xl font-bold text-gray-600">
                    @lang("Download your QR-code")
                </h3>
                <svg class="w-5 h-5 text-gray-500 flex-shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 x-cloak>
                <div class="content-center pt-4">
                <div class="mt-4" x-data="app()" x-cloak>
                        <div id="qrcode">{{ $qrcode }}</div>
                </div>

                <div class="p-1 mt-4 text-center">
{{--                    <a href="{{ route('qrpng.show') }}" class="no-underline text-mg--}}
{{--                    text-blue-800" download="donationbox-qr.png">--}}
{{--                        <div class="d-font transition duration-150 ease-in-out--}}
{{--                                                        focus:outline-none py-2 px-3 rounded-lg--}}
{{--                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100--}}
{{--                                                        text-sm border focus:ring-1 focus:ring-offset-1--}}
{{--                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2">--}}
{{--                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>--}}
{{--                            PNG--}}
{{--                        </div>--}}
{{--                    </a>--}}
                    <a href="data:image/png;base64,{!! base64_encode($qrcode) !!}" class="no-underline text-mg
                    text-blue-800" download="donationbox-qr.svg">
                        <div class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-3 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        text-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            SVG
                        </div>
                    </a>
                </div>
                </div>
            </div>
        </div>
        @endif

        <!-- EMBED WIDGET -->
        @if(!$s0)
        <div class="glass-strong rounded-2xl p-6 mt-8" x-data="{ open: false }">
            <button type="button"
                    @click="open = !open"
                    class="w-full flex items-center justify-between gap-2 text-left focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 rounded-lg py-1 -my-1"
                    :aria-expanded="open">
                <h3 class="text-1xl font-bold text-gray-600">
                    @lang("Embed this donation box to your website")
                </h3>
                <svg class="w-5 h-5 text-gray-500 flex-shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 x-cloak>
            <!-- Widget Language Selector -->
            <div class="pt-4 border-t border-gray-200/60 mt-4">
                @include('components.widget-lang-selector')
            </div>

            <div class="mt-4">
                <label for="embed-code" class="block text-sm font-medium text-gray-700 mb-2">@lang("Embed code")</label>
                <div class="flex flex-col sm:flex-row gap-3">
                    <input id="embed-code"
                           type="text"
                           readonly
                           class="flex-1 min-w-0 px-3 py-2 text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 font-mono"
                           value="{{ sprintf("<embed src='%s' width='100%%' height='900' style='border:none;overflow:hidden'></embed>", $embedlink) }}"
                           aria-label="@lang('Embed code')">
                    <button type="button"
                            class="d-font flex-shrink-0 inline-flex items-center justify-center gap-2 py-2 px-4 rounded-lg shadow-sm text-sm font-medium text-gray-600 bg-white border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-pink-500 transition duration-150 ease-in-out"
                            data-clipboard-target="#embed-code"
                            aria-label="@lang('Copy embed code to clipboard')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        @lang("Copy code")
                    </button>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-gray-200/60 text-sm text-gray-500">
                <p>@lang("The widget will display in the language you select above. You can also change the language by adding a locale parameter to the URL.")</p>
                <p class="mt-2">@lang("Example: Add '?locale=en' to display in English.")</p>
            </div>
            </div>
        </div>
        @endif

        </main>

        <!-- What's DonationBox banner: logo + slogan + scrollable banks -->
        <section class="mt-10 pt-8 border-t border-gray-200/60" aria-labelledby="donationbox-banner-heading">
            <a href="/" class="flex flex-col items-center no-underline group" id="donationbox-banner-heading">
                <img class="h-5 w-auto sm:h-6 object-contain opacity-90 group-hover:opacity-100 transition-opacity" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox')">
                <span class="mt-2 text-sm font-medium text-gray-600 group-hover:text-gray-800 transition-colors text-center">
                    @if(env('COUNTRY') == 'ee')
                        @lang("Start your virtual donation box for 🇪🇪 Estonian banks for free")
                    @endif
                    @if(env('COUNTRY') == 'lv')
                        @lang("Start your virtual donation box for 🇱🇻 Latvian banks for free")
                    @endif
                    @if(env('COUNTRY') == 'lt')
                        @lang("Start your virtual donation box for 🇱🇹 Lithuanian banks for free")
                    @endif
                </span>
            </a>
            <div class="bank-tags-scroll mt-3 w-full max-w-lg mx-auto" aria-hidden="true" data-bank-scroll>
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
        </section>

        <div class="home-page-footer mt-auto flex-shrink-0 pt-6">
            @include('footer')
        </div>
    </div>
</div>

</body>
</html>
