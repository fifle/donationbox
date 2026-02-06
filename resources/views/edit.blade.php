<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        @if(env('COUNTRY') == 'ee')
                <title>@lang("Edit your virtual donation box - DonationBox.ee")</title>
        @endif
        @if(env('COUNTRY') == 'lv')
                <title>@lang("Edit your virtual donation box - DonationBox.lv")</title>
        @endif
        @if(env('COUNTRY') == 'lt')
                <title>@lang("Edit your virtual donation box - DonationBox.lt")</title>
        @endif
    @include('head')
</head>
<body class="antialiased">
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-white focus:text-gray-900 focus:underline">@lang("Skip to main content")</a>

<style>
/* Edit page: same layout as main – pink/yellow gradient mesh + liquid glass */
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
.home-page .home-page-footer footer { color: inherit; }
.home-page .home-page-footer a { color: #1e40af; }
.home-page .secure-block { position: relative; z-index: 15; isolation: isolate; }
.home-page .main-form-card { position: relative; z-index: 0; }
.home-page .bottom-nav-bar { z-index: 50; }
</style>

<div class="home-page flex flex-col min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="home-page-bg" aria-hidden="true"></div>

    <div class="max-w-lg w-full mx-auto flex-1 flex flex-col space-y-4 relative z-10 min-h-[calc(100vh-6rem)]">
        <header role="banner" class="fixed top-4 right-4 sm:top-6 sm:right-6 left-auto">
            <div class="glass rounded-xl px-3 py-2">
                @include('components.lang-switcher')
            </div>
        </header>

        <div class="items-center justify-center mt-28 mb-8 text-center">
            <a href="/" aria-label="@lang('Return to homepage')" class="inline-block">
                <img class="mx-auto h-10 sm:h-12 w-auto object-contain" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox') logo - @lang('Return to homepage')">
            </a>
            <h1 class="mt-6 text-lg sm:text-xl font-medium text-gray-600 tracking-tight">
                @lang("Edit your virtual donation box")
            </h1>
        </div>

        <!-- Important Warning -->
        <div class="glass rounded-xl border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>@lang("Important:")</strong> @lang("Modifying the values below will create a new URL. The original URL will remain unchanged. If you've already shared the link or embedded it as a widget on your website, you'll need to update it with the new URL.")
                    </p>
                    <p class="text-xs text-yellow-600 mt-2">
                        <strong>@lang("Original URL:")</strong> <span class="break-all">{{ $originalUrl }}</span>
                    </p>
                </div>
            </div>
        </div>

        <div x-data="app()" x-cloak>
            <div x-show.transition="step != 'complete'">
                <!-- Top Navigation -->
                <!-- /Top Navigation -->
            </div>

            <div class="main-form-card glass-strong rounded-2xl p-6 justify-between">
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
                                                    value="{{ $campaign_title }}"
                                                    class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                    placeholder="@lang("eg. 'Support our community'")"
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
                                                    value="{{ $detail }}"
                                                    class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                    placeholder="eg. Annetus"
                                                    required/>
                                            </div>
                                            
                                            @if($s0)
                                            <div class="col-span-12">
                                                <label for="s0" class="d-font font-semibold text-gray-700 block mb-1">
                                                    @lang("Fixed donation amount")
                                                </label>
                                                <div class="tracking-normal text-sm text-gray-500 mb-3 leading-tight">
                                                    @lang("If set, donors can only donate this specific amount.")
                                                </div>
                                                <input
                                                    form="generator"
                                                    type="number"
                                                    name="s0"
                                                    id="s0"
                                                    value="{{ $s0 }}"
                                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                    placeholder="0.00"
                                                    step="0.01"
                                                    min="0">
                                            </div>
                                            @endif
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
                                                        value="{{ $s1 }}"
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
                                                        value="{{ $s2 }}"
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
                                                        value="{{ $s3 }}"
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
                                                value="{{ $payee }}"
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
                                            </div>
                                            <div class="flex items-start mb-2">
                                                <div class="flex items-center h-5">
                                                    <input
                                                        form="generator"
                                                        type="checkbox"
                                                        id="tax"
                                                        name="tax"
                                                        value="1"
                                                        {{ $tax ? 'checked' : '' }}
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
                                                value="{{ $iban }}"
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
                                            />
                                        </div>

                                        <div class="col-span-12">
                                            <label for="campaign_title" class="d-font font-semibold text-gray-700 mb-2">
                                                @lang("Choose banking methods")
                                            </label>
                                            <h3 class="text-sm text-gray-600 leading-5 col-span-12">@lang('For private individuals, non-profits, and businesses. Supports both one-time and recurring payments')</h3>
                                        </div>
                                        {{--Swedbank--}}
                                        <div class="col-span-12" x-data="{swt: {{ $swt ? 'true' : 'false' }}}">
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
                                                        {{ $swt ? 'checked' : '' }}
                                                        class="w-full h-full appearance-none focus:outline-none"
                                                    />
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        {{--SEB--}}
                                        <div class="col-span-12" x-data="{sebt: {{ $hasSEB ? 'true' : 'false' }}}">
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
                                                        value="{{ $sebuid }}"
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
                                                            value="{{ $sebuid_st }}"
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
                                        <div class="col-span-12" x-data="{lhvt: {{ $lhvt ? 'true' : 'false' }}}">
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
                                                            {{ $lhvt ? 'checked' : '' }}
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
                                        <div class="col-span-12" x-data="{coopt: {{ $coopt ? 'true' : 'false' }}}">
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
                                                            {{ $coopt ? 'checked' : '' }}
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
                                        <div class="col-span-12" x-data="{strptoggle: {{ $hasStripe ? 'true' : 'false' }}}">
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
                                                            value="{{ $strp }}"
                                                            class="flex-shrink flex-grow flex-auto flex-auto
                                                        leading-normal w-px flex-1 border h-10 border-grey-light rounded px-3 relative transition duration-150 ease-in-out"
                                                            placeholder="Insert Stripe's Payment Link ID"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--Paypal Business Account--}}
                                        <div class="col-span-12" x-data="{ppbusinesstoggle: {{ $hasPaypalBusiness ? 'true' : 'false' }}}">
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
                                                            value="{{ $paypalClientId }}"
                                                            class="flex-shrink flex-grow flex-auto flex-auto
                                                        leading-normal w-px flex-1 border h-10 border-grey-light rounded px-3 relative transition duration-150 ease-in-out"
                                                            placeholder="Insert your PayPal Business Account's Client ID"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--Donorbox--}}
                                        <div class="col-span-12" x-data="{dbtoggle: {{ $hasDonorbox ? 'true' : 'false' }}}">
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
                                                            value="{{ $db }}"
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
                                        <div class="col-span-12" x-data="{pptoggle: {{ $hasPaypalMe ? 'true' : 'false' }}}">
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
                                                            value="{{ $pp }}"
                                                            class="flex-shrink flex-grow flex-auto flex-auto
                                                        leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative transition duration-150 ease-in-out"
                                                            placeholder="your-paypal-me-username"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--Revolut.me--}}
                                        <div class="col-span-12" x-data="{revtoggle: {{ $hasRevolut ? 'true' : 'false' }}}">
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
                                                            value="{{ $rev }}"
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
                    
                    <!-- Convert to Cashier Mode -->
                    <div class="mt-6 mb-6" x-show="step === 5">
                        <div class="border-t border-gray-200 pt-6">
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">@lang("Convert to Cashier Mode")</h3>
                                <p class="text-sm text-gray-600 mb-4">
                                    @lang("Set a fixed amount to convert this donationbox into cashier mode. This will generate a QR code and payment link for the specified amount.")
                                </p>
                                <div class="mb-4">
                                    <label for="s0_cashier" class="d-font font-semibold text-gray-700 block mb-1">
                                        @lang("Fixed donation amount")
                                        <span class="font-normal text-red-500"><sup>*</sup></span>
                                    </label>
                                    <div class="tracking-normal text-sm text-gray-500 mb-3 leading-tight">
                                        @lang("Enter the amount that will be preset for all payments in cashier mode.")
                                    </div>
                                    <div class="relative max-w-xs">
                                        <div class="absolute inset-y-0 right-0 w-7 flex items-center justify-center pointer-events-none">
                                            <span class="text-gray-500 text-lg">€</span>
                                        </div>
                                        <input
                                            type="number"
                                            name="s0"
                                            id="s0_cashier"
                                            value="{{ $s0 }}"
                                            class="appearance-none rounded-none relative block w-full px-3 py-2 pr-7 border border-gray-300 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                            placeholder="0.00"
                                            step="0.01"
                                            min="0"
                                            form="cashier-generator">
                                    </div>
                                </div>
                                <form action="{{ route('plink') }}" method="get" id="cashier-generator">
                                    <input type="hidden" name="action" value="cashier">
                                    <input type="hidden" name="campaign_title" value="{{ $campaign_title }}">
                                    <input type="hidden" name="payee" value="{{ $payee }}">
                                    <input type="hidden" name="detail" value="{{ $detail }}">
                                    @if($iban)
                                        <input type="hidden" name="iban" value="{{ $iban }}">
                                    @endif
                                    @if($pp)
                                        <input type="hidden" name="pp" value="{{ $pp }}">
                                    @endif
                                    @if($pphb)
                                        <input type="hidden" name="pphb" value="{{ $pphb }}">
                                    @endif
                                    @if($db)
                                        <input type="hidden" name="db" value="{{ $db }}">
                                    @endif
                                    @if($sebuid_st)
                                        <input type="hidden" name="sebuid_st" value="{{ $sebuid_st }}">
                                    @endif
                                    @if($sebuid)
                                        <input type="hidden" name="sebuid" value="{{ $sebuid }}">
                                    @endif
                                    @if($rev)
                                        <input type="hidden" name="rev" value="{{ $rev }}">
                                    @endif
                                    @if($strp)
                                        <input type="hidden" name="strp" value="{{ $strp }}">
                                    @endif
                                    @if($paypalClientId)
                                        <input type="hidden" name="paypalClientId" value="{{ $paypalClientId }}">
                                    @endif
                                    @if($s1)
                                        <input type="hidden" name="s1" value="{{ $s1 }}">
                                    @endif
                                    @if($s2)
                                        <input type="hidden" name="s2" value="{{ $s2 }}">
                                    @endif
                                    @if($s3)
                                        <input type="hidden" name="s3" value="{{ $s3 }}">
                                    @endif
                                    @if($tax)
                                        <input type="hidden" name="tax" value="1">
                                    @endif
                                    @if($swt)
                                        <input type="hidden" name="swt" value="1">
                                    @endif
                                    @if($lhvt)
                                        <input type="hidden" name="lhvt" value="1">
                                    @endif
                                    @if($coopt)
                                        <input type="hidden" name="coopt" value="1">
                                    @endif
                                    @if(request()->has('locale'))
                                        <input type="hidden" name="locale" value="{{ request()->input('locale') }}">
                                    @endif
                                </form>
                                <button
                                    type="submit"
                                    form="cashier-generator"
                                    class="d-font inline-flex items-center justify-center border border-transparent py-2 px-4 rounded-lg
                                        font-medium rounded-md text-white bg-pink-500
                                        hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                        focus:ring-pink-700 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                    </svg>
                                    @lang("Convert to Cashier Mode")
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation buttons (at bottom) -->
                    <div class="mt-6" x-show="step !== 'complete'">
                        <div class="flex justify-between">
                                <div class="w-1/2 flex justify-start">
                                    <button
                                        x-show="step == 1"
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
        <div class="secure-block">
            @include('secure')
        </div>

        <div class="home-page-footer mt-auto flex-shrink-0 pt-4">
            @include('footer')
        </div>
    </div>

</div>

<script>
    function app() {
        return {
            step: 1,
        }
    }
</script>
</body>
</html>
