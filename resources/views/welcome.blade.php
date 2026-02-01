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
<!-- Stripe-style animated background -->
<div class="stripe-bg" aria-hidden="true">
    <div class="floating-orb orb-1"></div>
    <div class="floating-orb orb-2"></div>
    <div class="floating-orb orb-3"></div>
</div>

<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-white focus:text-gray-900 focus:underline">@lang("Skip to main content")</a>

<div class="homepage-container">
    <div class="max-w-md w-full space-y-6">

        <header role="banner" class="flex justify-center">
            @include('components.lang-switcher')
        </header>

        <div class="text-center space-y-4">
            <div class="logo-glass mx-auto w-fit">
                <a href="/" aria-label="@lang('Return to homepage')">
                    <img class="h-12 w-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox') logo - @lang('Return to homepage')">
                </a>
            </div>

            <div class="space-y-2">
                <h1 class="headline-minimal text-center">
                    @lang("Start your virtual donation box")
                </h1>
                <p class="subheadline-minimal">
                    @if(env('COUNTRY') == 'ee')
                        @lang("for Estonian banks for free")
                    @endif
                    @if(env('COUNTRY') == 'lv')
                        @lang("for Latvian banks for free")
                    @endif
                    @if(env('COUNTRY') == 'lt')
                        @lang("for Lithuanian banks for free")
                    @endif
                </p>
            </div>

            @if(env('COUNTRY') == 'ee')
                <p class="text-center text-xs text-gray-500">(Swedbank, SEB, LHV, Coop, Stripe, Revolut, Donorbox, Paypal)</p>
            @endif
            @if(env('COUNTRY') == 'lv')
                <p class="text-center text-xs text-gray-500">(Swedbank, SEB, Stripe, Revolut, Donorbox, Paypal)</p>
            @endif
            @if(env('COUNTRY') == 'lt')
                <p class="text-center text-xs text-gray-500">(Swedbank, SEB, Stripe, Revolut, Donorbox, Paypal)</p>
            @endif
        </div>

        <main id="main-content" role="main" x-data="app()" x-cloak>
            <div x-show.transition="step != 'complete'">
                <!-- Top Navigation -->
                <!-- /Top Navigation -->
            </div>

            <!-- Action Selection Step -->
            <div x-show="step === 0" x-transition:enter.duration.500ms>
                <div class="space-y-4">
                    <button
                        @click="step = 1"
                        class="d-font w-full glass-btn-primary text-center">
                        <div class="font-semibold text-lg">@lang("Create New Donationbox")</div>
                        <div class="text-sm text-white text-opacity-80 mt-1">@lang("Start from scratch")</div>
                    </button>
                    <button
                        @click="step = 'edit'"
                        class="d-font w-full glass-btn-secondary text-center">
                        <div class="font-semibold">@lang("Modify Existing Donationbox")</div>
                        <div class="text-sm text-gray-500 mt-1">@lang("Edit an existing link")</div>
                    </button>
                </div>
            </div>

            <!-- Edit Existing Link Form -->
            <div x-show="step === 'edit'" x-transition:enter.duration.500ms>
                <div class="glass-card p-6 space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800">@lang("Modify Existing Donationbox")</h3>
                    <div class="warning-glass p-4">
                        <div class="flex gap-3">
                            <svg class="h-5 w-5 text-amber-500 flex-shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-amber-800">
                                <strong>@lang("Important:")</strong> @lang("Modifying the values will create a new URL. The original URL will remain unchanged. If you've already shared the link or embedded it as a widget on your website, you'll need to update it with the new URL.")
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('edit') }}" method="get" id="edit-form" class="space-y-4">
                        <div>
                            <label for="edit_url" class="d-font font-medium text-gray-700 block mb-1">
                                @lang("Paste your existing Donationbox URL")
                                <span class="text-pink-500">*</span>
                            </label>
                            <p class="text-sm text-gray-500 mb-2">
                                @lang("Paste the full URL of your existing donationbox link to load its values for editing.")
                            </p>
                            <input
                                type="url"
                                name="url"
                                id="edit_url"
                                value="{{ request('url') }}"
                                class="glass-input w-full text-gray-900 lg:text-lg"
                                placeholder="https://donationbox.ee/donation?campaign_title=..."
                                required>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button
                                type="button"
                                @click="step = 0"
                                class="d-font flex-1 glass-btn-secondary text-sm py-3">
                                @lang("Back")
                            </button>
                            <button
                                type="submit"
                                class="d-font flex-1 glass-btn-primary text-sm py-3">
                                @lang("Start editing")
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="glass-card p-6" x-show="step !== 0 && step !== 'edit'">
                <div>
                    <div x-show.transition="step != 'complete'">

                        <!-- Step Content -->
                        <div>
                            <!-- Step 1 -->
                            <div x-show="step === 1"
                                 x-transition:enter.duration.500ms>

                                <div class="mb-5 flex items-center gap-3">
                                    <div class="rounded-full h-7 w-7 flex items-center justify-center step-indicator-glass text-gray-600 text-xs font-semibold">1</div>
                                    <div class="text-gray-600 font-medium">@lang("Your campaign page details")</div>
                                </div>

                                <div class="space-y-5">
                                    <form class="space-y-4" action="{{ route('donation') }}" method="get"
                                          id="generator"></form>
                                    <div>
                                        <label for="campaign_title" class="d-font font-medium text-gray-700 block mb-1">
                                            @lang("Name your donation box")
                                            <span class="text-pink-500">*</span>
                                        </label>
                                        <p class="text-sm text-gray-500 mb-2">
                                            @lang("This text will be used as the title of your donation box page.")
                                        </p>
                                        <input
                                            form="generator"
                                            type="text"
                                            name="campaign_title"
                                            id="campaign_title_field"
                                            value="{{ request('campaign_title') }}"
                                            class="glass-input w-full text-gray-900 lg:text-lg"
                                            placeholder="@lang("eg. 'Support our community'")"
                                            aria-required="true"
                                            required>
                                    </div>

                                    <div>
                                        <label for="detail" class="d-font font-medium text-gray-700 block mb-1">
                                            @lang("Bank transfer detail") <span class="text-pink-500">*</span>
                                        </label>
                                        <p class="text-sm text-gray-500 mb-2">
                                            @lang("This will be used as a requisite for the money transfer.")
                                            <a href="/about#bankDetails" class="text-pink-600 hover:text-pink-700" target="_blank">
                                                @lang("Learn more about why it's important to keep details serious and straightforward.")
                                            </a>
                                        </p>
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
                                            class="glass-input w-full text-gray-900 lg:text-lg"
                                            placeholder="eg. Annetus"
                                            aria-required="true"
                                            required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div x-show="step === 2"
                             x-transition:enter.duration.500ms>
                            <div class="mb-5 flex items-center gap-3">
                                <div class="rounded-full h-7 w-7 flex items-center justify-center step-indicator-glass text-gray-600 text-xs font-semibold">2</div>
                                <div class="text-gray-600 font-medium">@lang("Your personal data")</div>
                            </div>
                            <div class="space-y-5">
                                @csrf
                                <div>
                                    <label for="campaign_title" class="d-font font-medium text-gray-700 block mb-1">
                                        @lang("Payee's name") <span class="text-pink-500">*</span>
                                    </label>
                                    <p class="text-sm text-gray-500 mb-2">
                                        @lang("Insert the name of the person or company on whose behalf you want to open a fundraiser. Please make sure that the name is spelled correctly in Latin letters.")
                                    </p>
                                    <input
                                        form="generator"
                                        type="text"
                                        name="payee"
                                        id="payee_field"
                                        value="{{ request('payee') }}"
                                        class="glass-input w-full text-gray-900 lg:text-lg"
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
                        <!-- Step 3 -->
                        <div x-show="step === 3"
                             x-transition:enter.duration.500ms>
                            <div class="mb-5 flex items-center gap-3">
                                <div class="rounded-full h-7 w-7 flex items-center justify-center step-indicator-glass text-gray-600 text-xs font-semibold">3</div>
                                <div class="text-gray-600 font-medium">@lang("Details for")
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
                            <div class="space-y-5">
                                @csrf
                                <div>
                                    <label for="iban_field" class="d-font font-medium text-gray-700 block mb-2">@lang("Payee's bank account (IBAN) number")</label>
                                    <input
                                        form="generator"
                                        type="text"
                                        name="iban"
                                        id="iban_field"
                                        value="{{ request('iban') }}"
                                        pattern="^(?:(?:IT|SM)\d{2}[A-Z]\d{22}|CY\d{2}[A-Z]\d{23}|NL\d{2}[A-Z]{4}\d{10}|LV\d{2}[A-Z]{4}\d{13}|(?:BG|BH|GB|IE)\d{2}[A-Z]{4}\d{14}|GI\d{2}[A-Z]{4}\d{15}|RO\d{2}[A-Z]{4}\d{16}|KW\d{2}[A-Z]{4}\d{22}|MT\d{2}[A-Z]{4}\d{23}|NO\d{13}|(?:DK|FI|GL|FO)\d{16}|MK\d{17}|(?:AT|EE|KZ|LU|XK)\d{18}|(?:BA|HR|LI|CH|CR)\d{19}|(?:GE|DE|LT|ME|RS)\d{20}|IL\d{21}|(?:AD|CZ|ES|MD|SA)\d{22}|PT\d{23}|(?:BE|IS)\d{24}|(?:FR|MR|MC)\d{25}|(?:AL|DO|LB|PL)\d{26}|(?:AZ|HU)\d{27}|(?:GR|MU)\d{28})$"
                                        class="glass-input w-full text-gray-900 lg:text-lg"
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

                                <div>
                                    <label class="d-font font-medium text-gray-700 block mb-1">
                                        @lang("Choose banking methods")
                                    </label>
                                    <p class="text-sm text-gray-500">@lang('For private individuals, non-profits, and businesses. Supports both one-time and recurring payments')</p>
                                </div>
                                        {{--Swedbank--}}
                                        <div class="col-span-12" x-data="{swt: false}">
                                            <div class="grid grid-cols-2 gap-4 space-y-0">
                                            <div>
                                                <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-yellow-100 bg-yellow-500 uppercase">Swedbank</h2 >
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
                                            <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-green-100 bg-green-500 uppercase">SEB bank</h2>
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
                                                    <label for="campaign_title" class="d-font font-semibold text-gray-700
                                                        block mb-2">@lang("SEB UID token")</label>
                                                    <div class="tracking-normal text-sm text-gray-500 mb-3
                                                        leading-tight">
                                                        @lang("If you want to connect SEB bank as part of the payment methods, you need to get your own UID token from SEB.")
                                                        <a href="/about#sebUID" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">
                                                            @lang("Read more about how to obtain a special identifier for private individuals and companies >") </a>
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
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-gray-200 bg-gray-700 uppercase">LHV bank</h2>
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
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-blue-100 bg-blue-600 uppercase">Coop bank</h2>
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
                        <!-- Step 4 -->
                        <div x-show="step === 4"
                             x-transition:enter.duration.500ms>
                            <div class="mb-5 flex items-center gap-3">
                                <div class="rounded-full h-7 w-7 flex items-center justify-center step-indicator-glass text-gray-600 text-xs font-semibold">4</div>
                                <div class="text-gray-600 font-medium">@lang("Credit cards")</div>
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
                                            <div class="grid grid-cols-4 gap-4">
                                                <div class="flex items-center col-span-3">
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-white bg-purple-500 uppercase">Stripe</h2>
                                                    <p class="text-xs text-gray-600 leading-3 pl-2">One-time payments only</p>
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
                                            <div class="grid grid-cols-4 gap-4">
                                                <div class="flex items-center col-span-3">
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-blue-700 bg-gray-200 uppercase">Paypal Business</h2>
                                                    <p class="text-xs text-gray-600 leading-3 pl-2">One-time payments only</p>
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
                                            <div class="grid grid-cols-4 gap-4">
                                                <div class="flex items-center col-span-3">
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase
                                                     rounded-full text-white bg-red-500 uppercase">Donorbox.org</h2>
                                                    <p class="text-xs text-gray-600 leading-3 pl-2">One-time and recurring</p>
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
                                            <div class="grid grid-cols-4 gap-4">
                                                <div class="flex items-center col-span-3">
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-white bg-blue-500 uppercase">Paypal.me</h2>
                                                    <p class="text-xs text-gray-600 leading-3 pl-2">One-time payments only</p>
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
                                            <div class="grid grid-cols-4 gap-4">
                                                <div class="flex items-center col-span-3">
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-white bg-black uppercase">Revolut.me</h2>
                                                    <p class="text-xs text-gray-600 leading-3 pl-2">One-time payments only</p>
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
                </div>
            </div>

            <!-- Bottom Navigation -->
            <div class="fixed bottom-0 left-0 right-0 py-4 bottom-nav-glass z-10" x-show="step != 'complete' && step !== 0 && step !== 'edit'">
                <div class="max-w-3xl mx-auto px-4">
                    <div class="flex justify-center gap-3">
                        <button
                            x-show="step == 1"
                            class="d-font w-28 glass-btn-secondary py-2 text-sm cursor-not-allowed opacity-50"
                            disabled
                        >@lang("Previous")</button>
                        <button
                            x-show="step > 1"
                            @click="step--"
                            class="d-font w-28 glass-btn-secondary py-2 text-sm"
                        >@lang("Previous")</button>

                        <button
                            x-show="step < 4"
                            @click="step++"
                            class="d-font w-28 glass-btn-primary py-2 text-sm">
                            @lang("Next")
                        </button>

                        <button
                            type="submit"
                            form="generator"
                            value="submit"
                            x-show="step === 4"
                            class="d-font w-28 glass-btn-primary py-2 text-sm">
                            @lang("Complete")
                        </button>
                    </div>
                </div>
            </div>
            <div class="py-4" x-show="step !== 0 && step !== 'edit'">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="text-xs text-gray-500" x-text="`@lang("Step:") ${step} @lang("of") 4`"></div>

                    <div class="flex items-center gap-2 md:w-48">
                        <div class="flex-1 progress-bar-glass h-1.5">
                            <div class="progress-bar-fill h-full" :style="'width: '+ parseInt(step / 4 * 100) +'%'"></div>
                        </div>
                        <div class="text-xs text-gray-500 w-8" x-text="parseInt(step / 4 * 100) +'%'"></div>
                    </div>
                </div>
            </div>

        </div>
        </main>
        @include('secure')

        @if(env('COUNTRY') == 'lv')
            <div class="pt-10">
                <a href="https://yf.donationbox.lv/?db" target="_blank" aria-label="@lang('Visit Youth Fund Latvia')">
                    <img class="mx-auto rounded-xl hover:opacity-90" src="/img/yf-og-img-main-01.jpg" alt="@lang('Youth Fund Latvia promotional image')">
                </a>
            </div>
        @endif

        <!-- @if(env('COUNTRY') == 'ee')
            <div class="pt-10">
                <a href="https://2024.donationbox.ee/?db" target="_blank" aria-label="@lang('Visit DonationBox 2024')">
                    <img class="mx-auto rounded-xl hover:opacity-90" src="/img/df-2024-fb-cover-01.jpg" alt="@lang('DonationBox 2024 promotional image')">
                </a>
            </div>
        @endif -->

        @include('footer')
    </div>

</div>

<script>
    function app() {
        return {
            step: 0, // Start with action selection
        }
    }
</script>
</body>
</html>
