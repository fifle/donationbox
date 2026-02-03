<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head')
</head>
<body class="antialiased faq-page">
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-white focus:text-gray-900 focus:underline">@lang("Skip to main content")</a>

<style>
/* Smooth scrolling for anchor links */
html {
    scroll-behavior: smooth;
}
/* FAQ page: same layout as main – pink/yellow gradient mesh + liquid glass */
.faq-page {
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.faq-page .home-page-bg {
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
.faq-page .home-page-footer {
    position: relative;
    z-index: 60;
    isolation: isolate;
    color: #4b5563;
}
.faq-page .home-page-footer footer { color: inherit; }
.faq-page .home-page-footer a { color: #1e40af; }
/* TOC slide panel (desktop) */
.faq-toc-panel {
    transform: translateX(100%);
    transition: transform 0.3s ease-out, opacity 0.2s ease-out;
}
.faq-toc-panel.open {
    transform: translateX(0);
}
/* TOC popup (mobile) */
.faq-toc-popup {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.2s ease-out, visibility 0.2s;
}
.faq-toc-popup.open {
    opacity: 1;
    visibility: visible;
}
.faq-toc-popup .faq-toc-popup-inner {
    transform: scale(0.95) translateY(10px);
    transition: transform 0.25s ease-out;
}
.faq-toc-popup.open .faq-toc-popup-inner {
    transform: scale(1) translateY(0);
}
.faq-toc-scroll {
    overflow-y: scroll;
    -webkit-overflow-scrolling: touch;
    overscroll-behavior-y: contain;
    min-height: 0;
    touch-action: pan-y;
}
/* Mobile TOC: grid + min-height for reliable scroll on iOS */
@media (max-width: 1023px) {
    .faq-toc-popup-inner {
        display: grid;
        grid-template-rows: auto auto minmax(0, 1fr);
    }
    .faq-toc-popup .faq-toc-nav-scroll {
        min-height: 0;
        overflow-y: scroll;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
        touch-action: pan-y;
    }
}
</style>

<div class="faq-page flex flex-col min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="home-page-bg" aria-hidden="true"></div>

    <div class="max-w-xl lg:max-w-2xl w-full mx-auto flex-1 flex flex-col relative z-10 min-h-[calc(100vh-6rem)] pb-8" x-data="faqPage()" x-init="init()">
        {{-- Fixed header --}}
        <header role="banner" class="fixed top-4 right-4 sm:top-6 sm:right-6 left-auto z-20">
            <div class="glass rounded-xl px-3 py-2">
                @include('components.lang-switcher')
            </div>
        </header>

        {{-- Floating TOC button (mobile/tablet) - fixed bottom right, icon only --}}
        <button type="button"
                @click="tocOpen = true"
                class="fixed bottom-6 right-6 lg:hidden z-30 flex items-center justify-center glass rounded-full p-3 shadow-lg hover:shadow-xl transition-shadow text-gray-700"
                aria-label="@lang('Table of contents')">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        {{-- TOC overlay: popup on mobile, slide panel on desktop --}}
        <div class="fixed inset-0 z-40"
             x-show="tocOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click.self="tocOpen = false"
             :aria-hidden="!tocOpen"
             style="display: none;">
            {{-- Backdrop (click to close) --}}
            <div class="absolute inset-0 bg-black/45 backdrop-blur-sm" @click="tocOpen = false" aria-hidden="true"></div>

            {{-- Mobile: popup aligned to top --}}
            <div class="faq-toc-popup lg:hidden absolute inset-4 flex items-start justify-center pt-4 z-50"
                 :class="{ 'open': tocOpen }">
                <div class="w-full max-w-md flex flex-col min-h-0 overflow-hidden" style="height: 85vh; height: 85dvh; max-height: 600px;">
                <div class="faq-toc-popup-inner glass-strong rounded-2xl h-full flex flex-col min-h-0 overflow-hidden" style="box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 12px 24px -8px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(0, 0, 0, 0.06);">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200/50 flex-shrink-0">
                        <h2 class="text-lg font-semibold text-gray-800">@lang("Table of contents")</h2>
                        <button type="button" @click="tocOpen = false" class="p-2 rounded-lg hover:bg-gray-200/50 transition-colors" aria-label="@lang('Close')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="p-4 flex-shrink-0">
                        <label for="faq-search" class="block text-sm font-medium text-gray-700 mb-2">@lang("Search FAQ")</label>
                        <div class="relative">
                            <input type="text"
                                   id="faq-search"
                                   x-model="searchQuery"
                                   x-on:input.debounce.200ms="filterCards()"
                                   placeholder="@lang('Search FAQ')"
                                   class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-200 bg-white/80 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-pink-300 focus:border-pink-400 text-sm">
                            <button type="button"
                                    x-show="searchQuery.length > 0"
                                    x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    @click="searchQuery = ''; filterCards()"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-200/50 transition-colors"
                                    aria-label="@lang('Clear search')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">@lang("Search works in all languages")</p>
                    </div>
                    <nav aria-label="@lang('Table of contents')" class="faq-toc-nav-scroll flex-1 min-h-0 overflow-y-auto overflow-x-hidden flex flex-col faq-toc-scroll" style="-webkit-overflow-scrolling: touch; touch-action: pan-y;">
                        <ul class="space-y-1 pr-2 -mr-2 pb-4">
                            @foreach($faqToc as $item)
                            <li>
                                <a href="#{{ $item['id'] }}"
                                   @click="tocOpen = false"
                                   class="faq-toc-link block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-white/60 hover:text-gray-900 transition-colors"
                                   :class="{ 'bg-pink-100/80 text-pink-800 font-medium': highlightedCard === '{{ $item['id'] }}' }"
                                   x-show="visibleCards.includes('{{ $item['id'] }}')"
                                   x-transition:enter="transition ease-out duration-150"
                                   x-transition:enter-start="opacity-0"
                                   x-transition:enter-end="opacity-100">
                                    {{ $item['title'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                </div>
            </div>

            {{-- Desktop: slide panel from right --}}
            <div class="hidden lg:flex absolute top-0 right-0 h-full w-80 max-w-[90vw] justify-end">
                <div class="faq-toc-panel h-full w-80 glass-strong rounded-l-2xl shadow-2xl flex flex-col overflow-hidden pointer-events-auto"
                     :class="{ 'open': tocPanelOpen }">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200/50 flex-shrink-0">
                        <h2 class="text-lg font-semibold text-gray-800">@lang("Table of contents")</h2>
                        <button type="button" @click="tocOpen = false" class="p-2 rounded-lg hover:bg-gray-200/50 transition-colors" aria-label="@lang('Close')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="p-4 flex-shrink-0">
                        <label for="faq-search-desk" class="block text-sm font-medium text-gray-700 mb-2">@lang("Search FAQ")</label>
                        <div class="relative">
                            <input type="text"
                                   id="faq-search-desk"
                                   x-model="searchQuery"
                                   x-on:input.debounce.200ms="filterCards()"
                                   placeholder="@lang('Search FAQ')"
                                   class="w-full pl-3 pr-10 py-2 rounded-lg border border-gray-200 bg-white/80 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-pink-300 focus:border-pink-400 text-sm">
                            <button type="button"
                                    x-show="searchQuery.length > 0"
                                    x-transition:enter="transition ease-out duration-150"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    @click="searchQuery = ''; filterCards()"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-200/50 transition-colors"
                                    aria-label="@lang('Clear search')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">@lang("Search works in all languages")</p>
                    </div>
                    <nav aria-label="@lang('Table of contents')" class="flex-1 min-h-0 overflow-hidden flex flex-col">
                        <ul class="faq-toc-scroll space-y-1 flex-1 min-h-0 pr-2 -mr-2 pb-4">
                            @foreach($faqToc as $item)
                            <li>
                                <a href="#{{ $item['id'] }}"
                                   @click="tocOpen = false"
                                   class="faq-toc-link block px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-white/60 hover:text-gray-900 transition-colors"
                                   :class="{ 'bg-pink-100/80 text-pink-800 font-medium': highlightedCard === '{{ $item['id'] }}' }"
                                   x-show="visibleCards.includes('{{ $item['id'] }}')"
                                   x-transition:enter="transition ease-out duration-150"
                                   x-transition:enter-start="opacity-0"
                                   x-transition:enter-end="opacity-100">
                                    {{ $item['title'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        {{-- Main FAQ content --}}
        <main id="main-content" role="main" class="flex-1 min-w-0">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div class="flex justify-center sm:justify-start">
                    <a href="/" aria-label="@lang('Return to homepage')" class="inline-block">
                        <img class="h-8 w-auto sm:h-9 object-contain" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox') logo - @lang('Return to homepage')">
                    </a>
                </div>
                {{-- Desktop: TOC button at top --}}
                <button type="button"
                        @click="tocOpen = true"
                        class="hidden lg:flex items-center gap-2 glass rounded-xl px-4 py-2.5 shadow-sm hover:shadow-md transition-all font-medium text-gray-700 hover:text-gray-900"
                        aria-label="@lang('Table of contents')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    @lang("Table of contents")
                </button>
            </div>
            <h1 class="text-center text-2xl sm:text-3xl font-semibold text-gray-700 mb-10">
                @lang("FAQ")
            </h1>

            @if(env('COUNTRY') == 'ee')
                @php $cc = 'Estonia'; @endphp
            @elseif(env('COUNTRY') == 'lv')
                @php $cc = 'Latvia'; @endphp
            @elseif(env('COUNTRY') == 'lt')
                @php $cc = 'Lithuania'; @endphp
            @endif

            @php $cc_domain = env('COUNTRY'); @endphp
            @php
                $countryAdjective = __('Estonian');
                if (env('COUNTRY') === 'lv') {
                    $countryAdjective = __('Latvian');
                } elseif (env('COUNTRY') === 'lt') {
                    $countryAdjective = __('Lithuanian');
                }
            @endphp

            <div class="faq-cards space-y-4">
                @component('components.faq-card')
                    @slot('cardName') whatIsDonationBox @endslot
                    @slot('cardTitle') @lang("What is a DonationBox?") @endslot
                    @slot('cardContent')
                        <p>@lang("This is a web application for generating links to direct or regular donation forms for :country and international payment methods. The app allows you to create your own virtual donation box for donations without having to write code or link your website or app to contracts and integrations with banklink.", ['country' => $countryAdjective])</p> <br> <p>
                        @lang("We provide a convenient interface for donors so that they don't have to enter data manually or copy it. The donor only has to follow a link by scanning a QR-code or going to a direct URL-address, enter the amount of donation, choose the transfer type - one-time or regular payment (single or standing order), and choose your bank, Paypal or credit card payment type.")</p>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') free @endslot
                    @slot('cardTitle') @lang("Why is DonationBox free?") @endslot
                    @slot('cardContent')
                        <p>
                        @lang("The feature of passing payment form parameters through URLs is provided by banks free of charge. DonationBox is the app that brings those banking methods together under one simple donation form, without the need for any coding. That's also the reason why this app is free.")<br><br>
                        @lang("Currently connecting solutions related to accepting donations is either quite difficult for a person who does not have technical skills, or has a monthly fee, which may be inappropriate in cases where the collection is organized by a private person or an NGO that does not have regular donors.")<br><br>
                        @lang("We believe it is important to make organizing fundraisers in :country a quick, convenient, and, most importantly, fee free method for fundraisers.", ['country' => $cc])
                        </p>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') security @endslot
                    @slot('cardTitle') @lang("Is this website secure? Isn't it phishing?") @endslot
                    @slot('cardContent')
                        <p>
                        @lang("In short: Yes, it's safe.")<br><br>
                        @lang("DonationBox is just an intermediary that sends a request to your bank's web page with the account number, the name of the recipient, an explanation, and the amount of the payment. The bank chosen by the user is responsible for the security of the transfer and all actions related to user authentication.")<br><br>
                        @lang("According to all modern standards, we use a secure SSL connection, but we advise you to use additional data encryption tools such as incognito mode, VPN, etc. for anonymity.")
                        </p>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') checkYourBank @endslot
                    @slot('cardTitle') @lang("How do you check that you really got to your bank's website and not some fake page asking for banking information?") @endslot
                    @slot('cardContent')
                        <p>
                        <p><span style="font-weight: 400;">@lang("After selecting your banking method, you may want to pay attention to the URL of the web page to which you were redirected when you click. To do this, open the address bar of the browser window with the bank's website and note that it matches the following domains and is listed by your browser as a ")</span><em><span style="font-weight: 400;">@lang("Secure")</span></em><span style="font-weight: 400;"> @lang("website (in this case, Chrome, Safari and Firefox will show a closed padlock icon next to the address).")</span></p>
                        <h1 style="color: #5e9ca0;">&nbsp;</h1>
                        <p><span style="font-weight: 400;">Swedbank - </span><a href="https://www.swedbank.ee/"><span style="font-weight: 400;">https://www.swedbank.ee/</span></a></p>
                        <p><span style="font-weight: 400;">SEB -</span><a href="https://e.seb.ee/"> <span style="font-weight: 400;">https://e.seb.ee/</span></a></p>
                        <p><span style="font-weight: 400;">LHV - </span><a href="https://www.lhv.ee/"><span style="font-weight: 400;">https://www.lhv.ee/</span></a><span style="font-weight: 400;">&nbsp;</span></p>
                        <p><span style="font-weight: 400;">Coop - </span><a href="https://i.cooppank.ee/"><span style="font-weight: 400;">https://i.cooppank.ee/</span></a><span style="font-weight: 400;">&nbsp;</span></p>
                        <p><span style="font-weight: 400;">Revolut -</span><a href="https://revolut.me"> <span style="font-weight: 400;">https://revolut.me</span></a></p>
                        <p><span style="font-weight: 400;">Paypal - </span><a href="https://www.paypal.com/"><span style="font-weight: 400;">https://www.paypal.com/</span></a></p>
                        <p><span style="font-weight: 400;">Donorbox - </span><a href="https://donorbox.org/"><span style="font-weight: 400;">https://donorbox.org/</span></a><span style="font-weight: 400;">&nbsp;</span></p>
                        </p>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') dataSecurity @endslot
                    @slot('cardTitle') @lang("Okay, but how do you protect and store my data? Will my transactions be visible to others?") @endslot
                    @slot('cardContent')
                        <p>
                        @lang("In short, we do our best to make sure that no one besides you, your bank, and payee knows about your transfer. To make sure it works, we do the following:")<br> <br>
                        <ul class="list-decimal ml-6 break-words">
                            <li>@lang("We don't store your data in a database. Instead, we generate a special link that already contains all the data related to the campaign. The parameters from this link are read by the DonationBox application. Parameters include the campaign name, payment detail, payee's name, IBAN account number / your Revolut.me username / your Paypal.me username / slug for your Donorbox campaign / your UID from SEB.")<br><br>
                                <b>@lang("Example link with parameters:")</b> <a href="https://donationbox.ee/donation?campaign_title=Donate+Estonian+Jewish+Museum&detail=Annetus&payee=Eesti+Juudi+Muuseum+MT%C3%9C&iban=EE312200221037561773&pp=&db=support-estonian-jewish-museum&sebuid=f0233a8a-2c62-414d-a8e0-868d5ca345cb" class="no-underline hover:underline text-blue-800">
                                    https://donationbox.ee/donation?campaign_title=Donate+Estonian+Jewish+Museum&detail=Annetus&payee=Eesti+Juudi+Muuseum+MT%C3%9C&iban=EE312200221037561773&pp=&db=support-estonian-jewish-museum&sebuid=f0233a8a-2c62-414d-a8e0-868d5ca345cb</a><br><br>
                            </li>
                            <li>@lang("We only redirect you to the bank page. After logging into the bank, you will see the pre-filled for the transfer. All you have to do is to make sure the data is correct and proceed as usually.")
                            </li>
                        </ul><br>
                        @lang("Donationbox is not responsible for the data exchanged between your payment provider and the recipient. Fundraiser, donor and recipient are responsible for the information they provide.")<br><br>
                        @lang("DonationBox code is publicly available in the Github repository:") <a href="https://github.com/fifle/donationbox" class="no-underline hover:underline text-blue-800" target="_blank">https://github.com/fifle/donationbox</a>
                        </p>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') bankDetails @endslot
                    @slot('cardTitle') @lang("Why is it important to keep payment details serious and clear?") @endslot
                    @slot('cardContent')
                        @lang("According to various international regulations, banks in :country and other countries are obliged to monitor payments in real time and ensure that no suspicious transactions pass through them. Otherwise, the bank has the right to freeze funds for transfer from your bank account until the investigation is completed. Therefore, be honest and state the real purpose for the transfer in the explanation.", ['country' => $cc]) <br><br>
                        <a href="https://arileht.delfi.ee/artikkel/92451593/lisasid-makseselgitusse-midagi-kahtlast-ole-valmis-et-pank-votab-sinuga-uhendust" class="no-underline hover:underline text-blue-800">@lang("Read more about this on Delfi.ee (in Estonian)")</a>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') sebUID @endslot
                    @slot('cardTitle') @lang("What is SEB UID token? How do I get it?") @endslot
                    @slot('cardContent')
                        @lang("The UID token is necessary for initiating payments in SEB's online bank. This way SEB improves the security of pre-filled forms on the payment transfer pages.")<br><br>
                        <b>@lang("SEB UID is available for non-profits and businesses only. Private individuals cannot obtain this token.")</b><br><br>
                        @lang("To get the UID, send a free-form application with a request for UID to the email:") <a href="mailto:eservice{{ '@' }}seb.ee" class="no-underline hover:underline text-blue-800" target="_blank">eservice{{ '@' }}seb.ee</a>. @lang("Please note that the person representing a legal entity must be a member of the board.")<br><br>
                        <i>@lang("Obtaining a UID does not require you to open an account or sign a contract with SEB.")</i>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') donorbox @endslot
                    @slot('cardTitle') @lang("What is Donorbox and how can I find my campaign slug?") @endslot
                    @slot('cardContent')
                        @lang("Donorbox is an international online donation platform for non-profits. It allows you to start receiving donations for international payments systems. Donorbox integrates with payment processing platform Stripe, which allows automatically receive money directly to :country_adj IBAN bank account. Also, Donorbox allows you to make anonymous, recurring payments, connect CRM systems to process donor data, etc.", ['country_adj' => $countryAdjective])<br><br>
                        @lang("In order to connect Donorbox, you need to register your account. You can do this here:")
                        <a href="https://donorbox.org/orgs/new" class="no-underline hover:underline text-blue-800" target="_blank">https://donorbox.org/orgs/new</a>. @lang("After that, you will need to create a new campaign through the dashboard.")<br><br>
                        @lang("After, open campaign page in Preview mode and pay attention to the page address. Anything after the \"/\" (slash) symbol is a campaign slug. Copy it and place it while creating a new form on DonationBox.")<br><br>
                        @lang("Example: https://donorbox.org/your-slug")
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') stripe @endslot
                    @slot('cardTitle') @lang("What is Stripe and how do I set up a Payment Link for DonationBox?") @endslot
                    @slot('cardContent')
                        <p>@lang("Stripe is a global payment processing platform that allows businesses and nonprofits to accept credit card payments (Visa, Mastercard, etc.) online.")</p><br>
                        <p>@lang("Using Stripe alongside local bank payment methods is beneficial because local donors can use familiar bank transfers, while international donors or those who prefer credit cards can donate via Stripe. This way you reach more donors—both those with local bank accounts and those without.")</p><br>
                        <p>@lang("If your business or non-profit has a Stripe account, you can generate a Payment Link to accept donations via credit cards. Please insert the Payment Link ID to include this method in your DonationBox. You can find the ID in the Payment Link URL right after the slash. For example: https://donate.stripe.com/[YOUR-ID].")
                        <a href="https://docs.stripe.com/payment-links/create" class="no-underline hover:underline text-blue-800" target="_blank">@lang("Read more on how to create new Stripe Payment Link >")</a></p>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') paypal @endslot
                    @slot('cardTitle') @lang("What is Paypal and how do I find my paypal.me username?") @endslot
                    @slot('cardContent')
                        @lang("PayPal provides an easy and quick way to send and request money online. Payments can be sent from one Paypal account to another, as well as by using credit card payment. You can register Paypal account here:") <a href="https://www.paypal.com/ee/webapps/mpp/account-selection" class="no-underline hover:underline text-blue-800" target="_blank">https://www.paypal.com/ee/webapps/mpp/account-selection</a><br><br>
                        @lang("Once you have Paypal account, you can generate your page to accept payments on Paypal.me. You can read more about creating your own Paypal.me page here:") <a href="https://www.paypal.com/paypalme/" class="no-underline hover:underline text-blue-800" target="_blank">https://www.paypal.com/paypalme/</a><br><br>
                        @lang("You can find out your username from generated Paypal.me link. Copy it and place it while creating a new form on DonationBox.")<br><br>
                        @lang("Example: https://paypal.me/username")
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') revolut @endslot
                    @slot('cardTitle') @lang("What is Revolut? How can I find my Revolut.me link?") @endslot
                    @slot('cardContent')
                        @lang("Revolut is a European virtual bank that allows to open your own IBAN bank account for private and corporate clients. You can read more about the service and registration at") <a href="https://www.revolut.com." class="no-underline hover:underline text-blue-800" target="_blank">https://www.revolut.com</a>.<br><br>
                        @lang("If you already have a registered Revolut account, you can generate your Revolut.me link. It will allow to accept payments from donors who don't have Revolut via credit card payments.")<br><br>
                        @lang("To start using Revolut with DonationBox, follow these instructions:"):
                        <ul class="list-decimal ml-6">
                            <li>@lang("Open the Revolut app")</li>
                            <li>@lang("Click on the circle with your name's initials, which is in the upper left corner.")</li>
                            <li>@lang("Under your own name you will see blue text indicating your Revolut username (@@username).")</li>
                            <li>@lang("Copy the username and enter it when you create a new DonationBox.")</li>
                        </ul>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') estBanks @endslot
                    @slot('cardTitle') @lang("Which banks operating in the Baltics are currently supported?") @endslot
                    @slot('cardContent')
                        @lang("DonationBox is available for Swedbank (EE, LV, LT), SEB (EE, LV, LT), LHV (EE), Coop (EE). All of them support one-time and recurring payments. We hope that this list may be expanded in the future.")
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') fraud @endslot
                    @slot('cardTitle') @lang("I see that fraudsters are using the service or spreading false information. What should I do?") @endslot
                    @slot('cardContent')
                        @lang("Click the \"Report fraud\" button at the bottom of the page or email us at") <a href="mailto:donationbox.{{$cc_domain}}@@gmail.com" class="no-underline hover:underline text-blue-800" target="_blank">donationbox.{{$cc_domain}}@@gmail.com</a>. @lang("Provide a link to the donation box that seems suspicious to you and specify in the message what exactly confuses you. For our part, we will do our best to respond to your request as soon as possible. When checking, we rely on the opening of data on the company or individual. If a violation is detected, the link may be blocked.")
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') widget @endslot
                    @slot('cardTitle') @lang("I want to put a donation form widget on my website. How can I do this?") @endslot
                    @slot('cardContent')
                        @lang("Each DonationBox page has a field with a code for an automatically generated widget. Copy this code and paste it into the HTML code of your page.")<br><br>
                        @lang("Read more about how you can add code to a page using Wordpress as an example here:"):
                        <a href="https://wordpress.com/support/wordpress-editor/blocks/custom-html-block/" class="no-underline hover:underline text-blue-800" target="_blank">https://wordpress.com/support/wordpress-editor/blocks/custom-html-block/</a>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') foreignIBAN @endslot
                    @slot('cardTitle') @lang("Can payee use a foreign IBAN account number?") @endslot
                    @slot('cardContent')
                        @lang("Currently the service works only with local IBAN accounts. In the near future the logic for European payments through :country_adj banks will be finalized.", ['country_adj' => $countryAdjective])
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') withoutEstBanks @endslot
                    @slot('cardTitle') @lang("Can I use DonationBox only for Revolut, Donorbox and Paypal?") @endslot
                    @slot('cardContent')
                        @lang("Yes, it is possible. Just leave the IBAN field blank and the selection with :country_adj banks will not appear on the donation form.", ['country_adj' => $countryAdjective])
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') paymentTypeDiff @endslot
                    @slot('cardTitle') @lang("What is the difference between a one-time donation and a regular donation? Where is this configured?") @endslot
                    @slot('cardContent')
                        @lang("You can choose between these two payment types for bank methods except Revolut and Paypal. You can set the regular donation interval on your bank's payment transfer page.")
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') editForm @endslot
                    @slot('cardTitle') @lang("Can I change the data in an existing form?") @endslot
                    @slot('cardContent')
                        @lang("Yes. Just change the value of the parameter in the URL, open the webpage and copy the newly generated URL.")
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') bugs @endslot
                    @slot('cardTitle') @lang("I found a bug or other inaccuracy. Where do I report it?") @endslot
                    @slot('cardContent')
                        @lang("Email us at") <a href="mailto:donationbox.{{$cc_domain}}@@gmail.com" class="no-underline hover:underline text-blue-800" target="_blank">donationbox.{{$cc_domain}}@@gmail.com</a>. @lang("Specify the address where the problem was found and briefly describe it. Thank you for your contribution to the project!")
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') payeeBg @endslot
                    @slot('cardTitle') @lang("What does the \"Check payee's background\" link mean?") @endslot
                    @slot('cardContent')
                        @lang("This link leads to Teatmik.ee or Lursoft.lv services, which collects information about known reports of companies, organizations, as well as individuals and their participation in the boards or ownership of companies. This is an additional method that was created for security purposes to combat fraudsters.")<br><br>
                        @lang("We recommend that you check your organization's information before sending money and be aware of the responsibility of transferring funds to third parties.")
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') anonymous @endslot
                    @slot('cardTitle') @lang("Can I remain anonymous when making a payment?") @endslot
                    @slot('cardContent')
                        @lang("Shortly, no, if you donate through local banks, Revolut or Paypal.")<br><br>
                        @lang("Your name as well as bank details such as IBAN account can be seen by the recipient of the funds. In fact, this is the same as would be the case with a manual direct transfer of funds through your online bank.")<br><br>
                        @lang("Currently, the only method to connect anonymous payments is to use the Donorbox.org service that you can also connect to DonationBox. You can read more about anonymous donations at Donorbox.org FAQ page:"): <a href="https://donorbox.zendesk.com/hc/en-us/articles/360020559851-How-do-I-enable-anonymous-donations- " class="no-underline hover:underline text-blue-800" target="_blank">https://donorbox.zendesk.com/hc/en-us/articles/360020559851-How-do-I-enable-anonymous-donations- </a>
                    @endslot
                @endcomponent

                @component('components.faq-card')
                    @slot('cardName') needHelp @endslot
                    @slot('cardTitle') @lang("I need help creating my DonationBox. Who can I contact?") @endslot
                    @slot('cardContent')
                        @lang("Please write us to") <a href="mailto:donationbox.{{$cc_domain}}@@gmail.com" class="no-underline hover:underline text-blue-800" target="_blank">donationbox.{{$cc_domain}}@@gmail.com</a>. @lang("We will be happy to help you set up all the integrations with payment systems, design your page at donationbox.ee, and add our widget to your website.")
                    @endslot
                @endcomponent
            </div>
        </main>
    </div>

    <div class="home-page-footer mt-auto pt-8">
        @include('footer')
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    const searchIndex = @json($faqSearchIndex);

    function normalizeForSearch(text) {
        return String(text).toLowerCase().replace(/[\s\p{P}]+/gu, ' ').trim();
    }

    Alpine.data('faqPage', () => ({
        searchQuery: '',
        visibleCards: Object.keys(searchIndex),
        highlightedCard: null,
        tocOpen: false,
        tocPanelOpen: false,

        filterCards() {
            const q = normalizeForSearch(this.searchQuery);
            if (!q) {
                this.visibleCards = Object.keys(searchIndex);
                document.querySelectorAll('.faq-card').forEach(el => {
                    el.style.display = '';
                });
                return;
            }
            const matched = [];
            Object.entries(searchIndex).forEach(([cardId, searchStrings]) => {
                const found = searchStrings.some(s => s.includes(q));
                if (found) matched.push(cardId);
            });
            this.visibleCards = matched;
            document.querySelectorAll('.faq-card').forEach(el => {
                const id = el.getAttribute('data-faq-id');
                el.style.display = matched.includes(id) ? '' : 'none';
            });
        },

        init() {
            const self = this;
            this.$watch('tocOpen', (val) => {
                if (val) {
                    document.body.style.overflow = 'hidden';
                    document.body.style.position = 'fixed';
                    document.body.style.width = '100%';
                } else {
                    document.body.style.overflow = '';
                    document.body.style.position = '';
                    document.body.style.width = '';
                }
                if (val) {
                    self.tocPanelOpen = false;
                    this.$nextTick(() => {
                        setTimeout(() => { self.tocPanelOpen = true; }, 20);
                    });
                } else {
                    self.tocPanelOpen = false;
                }
            });
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        self.highlightedCard = entry.target.getAttribute('data-faq-id');
                    }
                });
            }, { rootMargin: '-20% 0px -60% 0px', threshold: 0 });
            this.$nextTick(() => {
                document.querySelectorAll('.faq-card').forEach(card => observer.observe(card));
            });
        }
    }));
});
</script>
</body>
</html>
