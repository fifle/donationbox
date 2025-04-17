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

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">

        @include('components.lang-switcher')

        <div class="items-center justify-center mt-8 mb-6">
            <div class="w-1/2 mx-auto mb-4">
                <a href="/">
                    <img class="mx-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png">
                </a>
            </div>

            <h2 class="text-center text-xl text-gray-700">
                @lang("Start your virtual donation box")
                 <br>
                @if(env('COUNTRY') == 'ee')
                    @lang("for 🇪🇪 Estonian banks for free")
                @endif
                @if(env('COUNTRY') == 'lv')
                    @lang("for 🇱🇻 Latvian banks for free")
                @endif
                @if(env('COUNTRY') == 'lt')
                    @lang("for 🇱🇹 Lithuanian banks for free")
                @endif
            </h2>

            @if(env('COUNTRY') == 'ee')
                <p class="text-center text-xs mt-2 text-gray-600 mb-6">(Swedbank, SEB, LHV, Coop, Stripe, Revolut, Donorbox,
                    Paypal)</p>
            @endif
            @if(env('COUNTRY') == 'lv')
                <p class="text-center text-xs mt-2 text-gray-600 mb-6">(Swedbank, SEB, Stripe, Revolut, Donorbox, Paypal)</p>
            @endif
            @if(env('COUNTRY') == 'lt')
                <p class="text-center text-xs mt-2 text-gray-600 mb-6">(Swedbank, SEB, Stripe, Revolut, Donorbox, Paypal)</p>
            @endif
        </div>

        <div x-data="app()" x-cloak>
            <div x-show.transition="step != 'complete'">
                <!-- Top Navigation -->
                <!-- /Top Navigation -->
            </div>

            <div class="bg-white rounded-lg p-5 shadow justify-between">
                <div class="">
                    <div x-show.transition="step != 'complete'">

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
                                          id="generator" onsubmit="return validateFormBeforeSubmit()"></form>
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
                                                    required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div x-show="step === 2"
                             x-transition:enter.duration.500ms>
                            <div class="mb-4 flex items-center">
                                <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-semibold">2
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
                            <div class="mb-4 flex items-center">
                                <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-semibold">3
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
                                        <div class="col-span-12" x-data="{ 
                                            checkIbanRequired() {
                                                const swedEnabled = document.getElementById('swt')?.checked || false;
                                                const sebEnabled = document.getElementById('sebt')?.checked || false;
                                                const lhvEnabled = document.getElementById('lhvt')?.checked || false;
                                                const coopEnabled = document.getElementById('coopt')?.checked || false;
                                                
                                                return swedEnabled || sebEnabled || lhvEnabled || coopEnabled;
                                            },
                                            validateIban() {
                                                const ibanField = document.getElementById('iban-field');
                                                const errorMsg = document.getElementById('iban-error');
                                                
                                                if (this.checkIbanRequired() && (!ibanField.value || ibanField.value.trim() === '')) {
                                                    // Show error
                                                    ibanField.classList.add('border-red-500');
                                                    errorMsg.classList.remove('hidden');
                                                } else {
                                                    // Hide error
                                                    ibanField.classList.remove('border-red-500');
                                                    errorMsg.classList.add('hidden');
                                                }
                                            }
                                        }"
                                        @iban-check="validateIban()"
                                        >
                                            <label for="iban-field" class="d-font font-semibold text-gray-700 block mb-2">
                                                @lang("Payee's bank account (IBAN) number")
                                                <span x-show="checkIbanRequired()" class="font-normal text-red-500"><sup>*</sup></span>
                                            </label>
                                            <input
                                                form="generator"
                                                type="text"
                                                name="iban"
                                                id="iban-field"
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
                                                @blur="validateIban()"
                                                x-bind:required="checkIbanRequired()"
                                            />
                                            <div id="iban-error" class="text-red-500 text-xs mt-1 hidden">
                                                @lang("IBAN is required when any internet-bank method is enabled")
                                            </div>
                                        </div>

                                        <div class="col-span-12">
                                            <label for="campaign_title" class="d-font font-semibold text-gray-700 mb-2">
                                                @lang("Choose banking methods")
                                            </label>
                                            <h3 class="text-sm text-gray-600 leading-5 col-span-12">@lang('For private individuals, non-profits, and businesses. Supports both one-time and recurring payments')</h3>
                                        </div>
                                        {{--Swedbank--}}
                                        <div class="col-span-12" x-data="{swt: true}">
                                            <div class="grid grid-cols-2 gap-4 space-y-0">
                                            <div>
                                                <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-yellow-100 bg-yellow-500 uppercase">Swedbank</h2 >
                                            </div>
                                            <div>
                                                <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                     :class="[swt ? 'bg-pink-500' : 'bg-gray-300']">
                                                    <label
                                                        for="swt"
                                                        class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                        :class="[swt ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                    <input
                                                        form="generator"
                                                        type="checkbox"
                                                        id="swt"
                                                        name="swt"
                                                        x-model="swt"
                                                        @click="$dispatch('iban-check')"
                                                        class="w-full h-full appearance-none focus:outline-none"
                                                    />
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        {{--SEB--}}
                                        <div class="col-span-12" x-data="{
                                            sebt: false
                                        }">
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
                                                        @click="$dispatch('iban-check'); window.validateSebUids()"
                                                        class="w-full h-full appearance-none focus:outline-none"
                                                    />
                                                </div>
                                            </div>
                                            </div>
                                            <div x-show="sebt">
                                                <div id="seb-uid-error" class="text-red-500 text-sm mt-2 hidden">
                                                    @lang("At least one SEB UID token is required when SEB bank is enabled")
                                                </div>
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
                                                        @blur="$dispatch('iban-check'); window.validateSebUids()"
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
                                                            @blur="$dispatch('iban-check'); window.validateSebUids()"
                                                        />
                                                </div>
                                            </div>
                                        </div>
                                        @if(env('COUNTRY') == 'ee')
                                        {{--LHV--}}
                                        <div class="col-span-12" x-data="{lhvt: true}">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-gray-200 bg-gray-700 uppercase">LHV bank</h2>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[lhvt ? 'bg-pink-500' : 'bg-gray-300']">
                                                        <label
                                                            for="lhvt"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[lhvt ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                        <input
                                                            form="generator"
                                                            type="checkbox"
                                                            id="lhvt"
                                                            name="lhvt"
                                                            x-model="lhvt"
                                                            @click="$dispatch('iban-check')"
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
                                        <div class="col-span-12" x-data="{coopt: true}">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-blue-100 bg-blue-600 uppercase">Coop bank</h2>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[coopt ? 'bg-pink-500' : 'bg-gray-300']">
                                                        <label
                                                            for="coopt"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[coopt ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                        <input
                                                            form="generator"
                                                            type="checkbox"
                                                            id="coopt"
                                                            name="coopt"
                                                            x-model="coopt"
                                                            @click="$dispatch('iban-check')"
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
                            <div class="mb-4 flex items-center">
                                <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-semibold">4
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
                                        <div class="col-span-12" x-data="{
                                            strptoggle: false,
                                            validateStripe() {
                                                if (!this.strptoggle) return true;
                                                
                                                const stripeField = document.querySelector('input[name="strp"]');
                                                const errorMsg = document.getElementById('stripe-error');
                                                
                                                if (!stripeField.value || stripeField.value.trim() === '') {
                                                    errorMsg.classList.remove('hidden');
                                                    stripeField.classList.add('border-red-500');
                                                    return false;
                                                } else {
                                                    errorMsg.classList.add('hidden');
                                                    stripeField.classList.remove('border-red-500');
                                                    return true;
                                                }
                                            }
                                        }">
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
                                                            @click="validateStripe()"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="strptoggle">
                                                <div id="stripe-error" class="text-red-500 text-sm mt-2 hidden">
                                                    @lang("Stripe Payment Link ID is required when Stripe is enabled")
                                                </div>
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
                                                            @blur="validateStripe()"
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
            <div class="fixed bottom-0 left-0 right-0 py-5 bg-white bg-opacity-90 shadow-md z-10" x-show="step !=
            'complete'">
                <div class="max-w-3xl mx-auto px-4">
                    <div class="flex justify-between">
                        <div class="w-1/2 text-right">
                            <button
                                x-show="step == 1"
                                class="d-font w-32 focus:outline-none py-2 px-5 mr-2 rounded-lg shadow-sm text-center
                                    text-gray-600 bg-white hover:bg-gray-100 font-medium border transition
                                    duration-150 ease-in-out cursor-not-allowed opacity-50"
                                disabled
                            >@lang("Previous")
                            </button>
                            <button
                                x-show="step > 1"
                                @click="step--"
                                class="d-font w-32 focus:outline-none py-2 px-5 mr-2 rounded-lg shadow-sm text-center
                                    text-gray-600 bg-white hover:bg-gray-100 font-medium border transition duration-150 ease-in-out"
                            >@lang("Previous")
                            </button>
                        </div>

                        <div class="w-1/2 ">
                            <button
                                x-show="step === 1"
                                @click="validateCampaignDetailsAndContinue()"
                                class="d-font w-32 focus:outline-none border border-transparent py-2 px-5 ml-2 rounded-lg
                                    border border-transparent font-medium rounded-md text-white bg-pink-500
                                    hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                    focus:ring-pink-700 transition duration-150 ease-in-out">
                                @lang("Next")
                            </button>
                            
                            <button
                                x-show="step === 2"
                                @click="validatePersonalDataAndContinue()"
                                class="d-font w-32 focus:outline-none border border-transparent py-2 px-5 ml-2 rounded-lg
                                    border border-transparent font-medium rounded-md text-white bg-pink-500
                                    hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                    focus:ring-pink-700 transition duration-150 ease-in-out">
                                @lang("Next")
                            </button>
                            
                            <button
                                x-show="step === 3"
                                @click="validateBankDetailsAndContinue()"
                                class="d-font w-32 focus:outline-none border border-transparent py-2 px-5 ml-2 rounded-lg
                                    border border-transparent font-medium rounded-md text-white bg-pink-500
                                    hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                    focus:ring-pink-700 transition duration-150 ease-in-out">
                                @lang("Next")
                            </button>

                            <button
                                type="button"
                                x-show="step === 4"
                                @click="validateAndSubmitForm()"
                                class="d-font w-32 focus:outline-none border border-transparent py-2 px-5 ml-2 rounded-lg
                                    border border-transparent font-medium rounded-md text-white bg-pink-500
                                    hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                    focus:ring-pink-700 transition duration-150 ease-in-out">
                                @lang("Complete")
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex-1">
                        <div class="uppercase tracking-normal text-xs font-normal text-gray-400 mb-4 leading-tight"
                             x-text="`@lang("Step:") ${step} @lang("of") 4`"></div>
                    </div>

                    <div class="flex items-center md:w-64">
                        <div class="w-full bg-white rounded-full mr-2">
                            <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white"
                                 :style="'width: '+ parseInt(step / 4 * 100) +'%'"></div>
                        </div>
                        <div class="text-xs w-10 text-gray-600 transition duration-150 ease-in-out" x-text="parseInt
                        (step / 4 * 100) +'%'"></div>
                    </div>
                </div>
            </div>

        </div>
        @include('secure')

        @if(env('COUNTRY') == 'lv')
            <div class="pt-10">
                <a href="https://yf.donationbox.lv/?db" target="_blank">
                    <img class="mx-auto rounded-xl hover:opacity-90" src="/img/yf-og-img-main-01.jpg">
                </a>
            </div>
        @endif

        @if(env('COUNTRY') == 'ee')
            <div class="pt-10">
                <a href="https://2024.donationbox.ee/?db" target="_blank">
                    <img class="mx-auto rounded-xl hover:opacity-90" src="/img/df-2024-fb-cover-01.jpg">
                </a>
            </div>
        @endif

        @include('footer')
    </div>

</div>
</div>

</div>

<style>
    .error-border {
        border-color: #f56565 !important;
    }
    .validation-error {
        animation: fadeIn 0.3s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
<script src="/js/form-validation.js"></script>
<script>
    function app() {
        return {
            step: 1,
            init() {
                // Watch for step changes
                this.$watch('step', (value) => {
                    // If step is 3 (bank details), trigger IBAN validation
                    if (value === 3) {
                        console.log('Step changed to 3, triggering IBAN validation');
                        // Dispatch the iban-check event
                        document.dispatchEvent(new CustomEvent('iban-check'));
                    }
                });
                
                // Add a small delay to ensure Alpine.js has fully initialized
                setTimeout(() => {
                    // If we're already on step 3, trigger IBAN validation
                    if (this.step === 3) {
                        console.log('Already on step 3, triggering initial IBAN validation');
                        document.dispatchEvent(new CustomEvent('iban-check'));
                    }
                }, 100);
            },
            validateAndSubmitForm() {
                // Clear previous validation errors
                clearValidationErrors();
                
                console.log('Validating form before submission');
                
                // Trigger IBAN validation
                document.dispatchEvent(new CustomEvent('iban-check'));
                
                // Update IBAN required status and get validation result
                const ibanValid = updateIbanRequiredStatus();
                console.log('IBAN validation result:', ibanValid);
                
                // Validate SEB UIDs if SEB is enabled
                const sebToggle = document.getElementById('sebt');
                const sebEnabled = sebToggle?.checked || false;
                let sebValid = true;
                
                if (sebEnabled) {
                    sebValid = window.validateSebUids();
                    console.log('SEB validation result:', sebValid);
                }
                
                // Validate IBAN if any internet-bank is enabled
                if (isIbanRequired()) {
                    const ibanField = document.querySelector('input[name="iban"]');
                    if (ibanField && !ibanField.value.trim()) {
                        // Add error styling
                        ibanField.classList.add('error-border');
                        
                        // Create error message
                        const errorElement = document.createElement('div');
                        errorElement.className = 'validation-error text-red-500 text-xs mt-1';
                        errorElement.textContent = translateErrorMessage('validation.iban_required');
                        ibanField.parentNode.insertBefore(errorElement, ibanField.nextSibling);
                        
                        // Navigate to bank details step
                        this.step = 3;
                        return; // Stop validation if IBAN is required but empty
                    }
                }
                
                // If either IBAN or SEB validation failed, navigate to bank details step
                if (!ibanValid || !sebValid) {
                    console.log('Validation failed, navigating to bank details step');
                    this.step = 3;
                    return;
                }
                
                // Validate form with our custom validation
                const errors = validateDonationForm();
                
                // If there are errors, display them and return
                if (errors.length > 0) {
                    displayValidationErrors(errors, this);
                    
                    // Navigate to the step with the first error
                    if (errors.length > 0) {
                        const firstErrorStep = errors[0].step;
                        if (firstErrorStep !== this.step) {
                            this.step = firstErrorStep;
                        }
                    }
                    return;
                }
                
                // Check HTML5 validation for all required fields
                const form = document.getElementById('generator');
                const requiredFields = form.querySelectorAll('[required]');
                let hasInvalidFields = false;
                let firstInvalidStep = null;
                
                requiredFields.forEach(field => {
                    if (!field.checkValidity()) {
                        hasInvalidFields = true;
                        
                        // Add error styling
                        field.classList.add('error-border');
                        
                        // Create error message if it has a data-required-message
                        if (field.dataset.requiredMessage) {
                            const errorElement = document.createElement('div');
                            errorElement.className = 'validation-error text-red-500 text-xs mt-1';
                            errorElement.textContent = field.dataset.requiredMessage;
                            field.parentNode.insertBefore(errorElement, field.nextSibling);
                            
                            // Track the step of the first invalid field
                            if (!firstInvalidStep && field.dataset.requiredStep) {
                                firstInvalidStep = parseInt(field.dataset.requiredStep);
                            }
                        }
                    }
                });
                
                if (hasInvalidFields) {
                    // Navigate to the step with the first invalid field
                    if (firstInvalidStep && firstInvalidStep !== this.step) {
                        this.step = firstInvalidStep;
                    }
                    return;
                }
                
                // Perform one final validation for payment methods
                const paymentMethodErrors = validatePaymentMethods();
                if (paymentMethodErrors.length > 0) {
                    displayValidationErrors(paymentMethodErrors, this);
                    
                    // Navigate to the step with the first error
                    if (paymentMethodErrors.length > 0) {
                        const firstErrorStep = paymentMethodErrors[0].step;
                        if (firstErrorStep !== this.step) {
                            this.step = firstErrorStep;
                        }
                    }
                    return;
                }
                
                // If no errors, submit the form
                form.submit();
            },
            validateCampaignDetailsAndContinue() {
                // Clear previous validation errors
                clearValidationErrors();
                
                // Validate only campaign details with our custom validation
                const errors = validateDonationForm().filter(error => error.step === 1);
                
                // If there are errors, display them and return
                if (errors.length > 0) {
                    displayValidationErrors(errors, this);
                    return;
                }
                
                // Check HTML5 validation for required fields in this step
                const requiredFields = document.querySelectorAll('[x-show="step === 1"] [required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.checkValidity()) {
                        isValid = false;
                        
                        // Add error styling
                        field.classList.add('error-border');
                        
                        // Create error message if it has a data-required-message
                        if (field.dataset.requiredMessage) {
                            const errorElement = document.createElement('div');
                            errorElement.className = 'validation-error text-red-500 text-xs mt-1';
                            errorElement.textContent = field.dataset.requiredMessage;
                            field.parentNode.insertBefore(errorElement, field.nextSibling);
                        }
                    }
                });
                
                if (!isValid) {
                    return;
                }
                
                // If no errors, proceed to next step
                this.step++;
            },
            validatePersonalDataAndContinue() {
                // Clear previous validation errors
                clearValidationErrors();
                
                // Validate only personal data with our custom validation
                const errors = validateDonationForm().filter(error => error.step === 2);
                
                // If there are errors, display them and return
                if (errors.length > 0) {
                    displayValidationErrors(errors, this);
                    return;
                }
                
                // Check HTML5 validation for required fields in this step
                const requiredFields = document.querySelectorAll('[x-show="step === 2"] [required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.checkValidity()) {
                        isValid = false;
                        
                        // Add error styling
                        field.classList.add('error-border');
                        
                        // Create error message if it has a data-required-message
                        if (field.dataset.requiredMessage) {
                            const errorElement = document.createElement('div');
                            errorElement.className = 'validation-error text-red-500 text-xs mt-1';
                            errorElement.textContent = field.dataset.requiredMessage;
                            field.parentNode.insertBefore(errorElement, field.nextSibling);
                        }
                    }
                });
                
                if (!isValid) {
                    return;
                }
                
                // If no errors, proceed to next step
                this.step++;
            },
            validateBankDetailsAndContinue() {
                // Clear previous validation errors
                clearValidationErrors();
                
                // Trigger IBAN validation event
                document.dispatchEvent(new CustomEvent('iban-check'));
                
                // Update IBAN required status and get validation result
                const ibanValid = updateIbanRequiredStatus();
                
                // Validate SEB UIDs if SEB is enabled
                let sebValid = true;
                if (document.getElementById('sebt')?.checked) {
                    sebValid = window.validateSebUids();
                }
                
                // If either validation failed, stop here
                if (!ibanValid || !sebValid) {
                    return;
                }
                
                // Validate only bank details with our custom validation
                const errors = validateDonationForm().filter(error => error.step === 3);
                
                // If there are errors, display them and return
                if (errors.length > 0) {
                    displayValidationErrors(errors, this);
                    return;
                }
                
                // Check HTML5 validation for required fields in this step
                const requiredFields = document.querySelectorAll('[x-show="step === 3"] [required], [data-required-step="3"][required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.checkValidity()) {
                        isValid = false;
                        
                        // Add error styling
                        field.classList.add('error-border');
                        
                        // Create error message if it has a data-required-message
                        if (field.dataset.requiredMessage) {
                            const errorElement = document.createElement('div');
                            errorElement.className = 'validation-error text-red-500 text-xs mt-1';
                            errorElement.textContent = field.dataset.requiredMessage;
                            field.parentNode.insertBefore(errorElement, field.nextSibling);
                        }
                    }
                });
                
                if (!isValid) {
                    return;
                }
                
                // Perform specific validation for internet-bank methods and SEB
                const internetBankErrors = validatePaymentMethods();
                if (internetBankErrors.length > 0) {
                    displayValidationErrors(internetBankErrors, this);
                    return;
                }
                
                // If no errors, proceed to next step
                this.step++;
            }
        }
    }

    function clearValidationErrors() {
        // Remove all error messages
        document.querySelectorAll('.validation-error').forEach(el => el.remove());
        
        // Remove error classes from input fields
        document.querySelectorAll('.error-border').forEach(el => {
            el.classList.remove('error-border');
        });
    }
    
    function displayValidationErrors(errors, app) {
        if (errors.length === 0) {
            return true;
        }
        
        // Group errors by step
        const errorsByStep = {};
        errors.forEach(error => {
            if (!errorsByStep[error.step]) {
                errorsByStep[error.step] = [];
            }
            errorsByStep[error.step].push(error);
        });
        
        // Display errors in the UI
        errors.forEach(error => {
            const field = document.querySelector(`[name="${error.field}"]`) || 
                         document.getElementById(error.field);
            
            if (field) {
                // Add error class to the field
                field.classList.add('error-border');
                
                // Create error message element
                const errorElement = document.createElement('div');
                errorElement.className = 'validation-error text-red-500 text-xs mt-1';
                errorElement.textContent = error.message;
                
                // Insert error message after the field
                field.parentNode.insertBefore(errorElement, field.nextSibling);
            }
        });
        
        // Create summary error message at the top of the current step
        const currentStep = app.step;
        if (errorsByStep[currentStep] && errorsByStep[currentStep].length > 0) {
            const stepContainer = document.querySelector(`[x-show="step === ${currentStep}"]`);
            if (stepContainer) {
                const summaryElement = document.createElement('div');
                summaryElement.className = 'validation-error bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4';
                
                const summaryTitle = document.createElement('strong');
                summaryTitle.className = 'font-bold';
                summaryTitle.textContent = '@lang("Please fix the following errors:")';
                
                const summaryList = document.createElement('ul');
                summaryList.className = 'mt-2 list-disc list-inside';
                
                errorsByStep[currentStep].forEach(error => {
                    const listItem = document.createElement('li');
                    listItem.textContent = error.message;
                    summaryList.appendChild(listItem);
                });
                
                summaryElement.appendChild(summaryTitle);
                summaryElement.appendChild(summaryList);
                
                // Insert at the beginning of the step container
                stepContainer.insertBefore(summaryElement, stepContainer.firstChild);
            }
        }
        
        return false;
    }
    
    function validateFormBeforeSubmit() {
        // Clear previous validation errors
        clearValidationErrors();
        
        // Validate required fields
        const campaignTitle = document.querySelector('input[name="campaign_title"]');
        const payeeName = document.querySelector('input[name="payee_name"]');
        const bankName = document.querySelector('input[name="bank_name"]');
        
        const errors = [];
        
        // Check campaign details (step 1)
        if (!campaignTitle || !campaignTitle.value || campaignTitle.value.trim() === '') {
            errors.push({
                field: 'campaign_title',
                message: '@lang("Campaign title is required")',
                step: 1
            });
        }
        
        // Check bank details (step 3)
        if (!payeeName || !payeeName.value || payeeName.value.trim() === '') {
            errors.push({
                field: 'payee_name',
                message: '@lang("Payee\'s name is required")',
                step: 3
            });
        }
        
        if (!bankName || !bankName.value || bankName.value.trim() === '') {
            errors.push({
                field: 'bank_name',
                message: '@lang("Bank name is required")',
                step: 3
            });
        }
        
        // Get payment method validation errors
        const paymentMethodErrors = validatePaymentMethods();
        
        // Combine all errors
        const allErrors = [...errors, ...paymentMethodErrors];
        
        if (allErrors.length > 0) {
            // Display validation errors
            displayValidationErrors(allErrors, { step: 1 }); // Start at step 1
            
            // Navigate to the first step with errors
            const firstErrorStep = Math.min(...allErrors.map(error => error.step));
            const stepElement = document.querySelector(`[data-step="${firstErrorStep}"]`);
            if (stepElement) {
                // Show the step with the first error
                const stepButtons = document.querySelectorAll('.step-button');
                stepButtons.forEach(button => {
                    if (parseInt(button.getAttribute('data-step')) === firstErrorStep) {
                        button.click();
                    }
                });
            }
            
            return false;
        }
        
        return true;
    }
    
    function validatePaymentMethods() {
        const errors = [];
        
        // Check if any internet-bank methods are enabled
        const swedEnabled = document.getElementById('swt')?.checked || false;
        const sebEnabled = document.getElementById('sebt')?.checked || false;
        const lhvEnabled = document.getElementById('lhvt')?.checked || false;
        const coopEnabled = document.getElementById('coopt')?.checked || false;
        
        // If any internet-bank methods are enabled, IBAN is required
        const iban = document.querySelector('input[name="iban"]');
        if ((swedEnabled || sebEnabled || lhvEnabled || coopEnabled) && 
            (!iban.value || iban.value.trim() === '')) {
            errors.push({
                field: 'iban',
                message: '@lang("IBAN is required when internet-bank methods are enabled")',
                step: 3
            });
        }
        
        // Check SEB UID tokens if SEB is enabled
        if (sebEnabled) {
            const sebuid = document.querySelector('input[name="sebuid"]');
            const sebuid_st = document.querySelector('input[name="sebuid_st"]');
            
            if (!sebuid.value && !sebuid_st.value) {
                errors.push({
                    field: 'sebuid',
                    message: '@lang("At least one SEB UID token is required when SEB bank is enabled")',
                    step: 3
                });
            }
        }
        
        // Check Stripe if enabled
        const stripeEnabled = document.getElementById('strptoggle')?.checked || false;
        if (stripeEnabled) {
            const stripeField = document.querySelector('input[name="strp"]');
            
            if (!stripeField.value || stripeField.value.trim() === '') {
                errors.push({
                    field: 'strp',
                    message: '@lang("Stripe Payment Link ID is required when Stripe is enabled")',
                    step: 4
                });
            }
        }
        
        return errors;
    }
</script>
</body>
</html>
