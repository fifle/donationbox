<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        @if(env('COUNTRY') == 'ee')
                <title>Create your virtual donation box for Estonian banks for free - DonationBox.ee</title>
        @endif
        @if(env('COUNTRY') == 'lv')
                <title>Create your virtual donation box for Latvian banks for free - DonationBox.lv</title>
        @endif
        @if(env('COUNTRY') == 'lt')
                <title>Create your virtual donation box for Lithuanian banks for free - DonationBox.lt</title>
        @endif
    @include('head')
</head>
<body class="antialiased">

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">
        <div class="items-center justify-center mt-8 mb-6">
            <div class="w-1/2 mx-auto mb-4">
                <a href="/">
                    <img class="mx-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png">
                </a>
            </div>
            <h2 class="text-center text-xl text-gray-700">
                Start your virtual donation box <br>
                @if(env('COUNTRY') == 'ee')
                    for Estonian banks for free
                @endif
                @if(env('COUNTRY') == 'lv')
                    for Latvian banks for free
                @endif
                @if(env('COUNTRY') == 'lt')
                    for Lithuanian banks for free
                @endif
            </h2>
            @if(env('COUNTRY') == 'ee')
                <p class="text-center text-xs mt-2 text-gray-600">(Swedbank, SEB, LHV, Coop, Revolut, Donorbox,
                    Paypal)</p>
            @endif
            @if(env('COUNTRY') == 'lv')
                <p class="text-center text-xs mt-2 text-gray-600">(Swedbank, SEB, Revolut, Donorbox, Paypal)</p>
            @endif
            @if(env('COUNTRY') == 'lt')
                <p class="text-center text-xs mt-2 text-gray-600">(Swedbank, SEB, Revolut, Donorbox, Paypal)</p>
            @endif
        </div>
        <div x-data="app()" x-cloak>
            <!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->
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
                                    text-gray-500 text-xs font-bold">1
                                    </div>
                                    <div class="ml-2 text-gray-500">Your campaign page details</div>
                                </div>

                                <div class="mb-5">
                                    <form class="space-y-4" action="{{ route('donation') }}" method="get"
                                          id="generator">@csrf</form>
                                    <div class="rounded-md -space-y-px">
                                        <div class="grid gap-6">
                                            <div class="col-span-12">
                                                <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-1">Name your donation box
                                                    <span class="font-normal text-red-500"><sup>*</sup></span>
                                                </label>
                                                <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                    This text will be used as the title of your donation box page.
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
                                                    placeholder="eg. 'Support our community'"
                                                    required>
                                            </div>

                                            <div class="col-span-12">

                                                <label for="detail" class="font-bold text-gray-700
                                                        block mb-1">
                                                    Bank transfer detail <span
                                                        class="font-normal text-red-500"><sup>*</sup></span>
                                                </label>
                                                <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                    This will be used as a requisite for the money transfer.

                                                    <a href="/about#bankDetails" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">
                                                        Learn more about why it's important to keep details serious and
                                                        straightforward.
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

                                                {{--                                                <input type="checkbox" name="duplicateName" id="duplicateName"--}}
                                                {{--                                                       value="Yes" placeholder="test"/>--}}
                                                {{--                                                <label for="duplicateName" class="tracking-normal text-xs--}}
                                                {{--                                                text-gray-500 mb-3 leading-tight">Use the same as the name for the--}}
                                                {{--                                                    donation box?</label>--}}

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
                                    text-gray-500 text-xs font-bold">2
                                </div>
                                <div class="ml-2 text-gray-500">Your personal data</div>
                            </div>
                            <div class="mb-5">
                                @csrf
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">Payee's name
                                                <span class="font-normal text-red-500"><sup>*</sup></span>
                                            </label>
                                            <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                Insert the name of the individual or company you would like
                                                to donate to. Please make sure that the name is spelled correctly and in
                                                Latin letters.
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
                                                placeholder="eg. 'Tädi Maali' or 'Tavai MTÜ'"
                                                @endif
                                                @if(env('COUNTRY') == 'lv')
                                                placeholder="eg. 'Jānis Bērziņš' or 'Biedrība'"
                                                @endif
                                                @if(env('COUNTRY') == 'lt')
                                                placeholder="eg. 'Vardenis Pavardenis' or 'VšĮ'"
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
                                            <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">Tax return for donors
                                            </label>
                                            <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                In this case, your donors will be able to request an income tax
                                                refund on their donation. NB! Your organization must be on the
                                                    register of associations eligible for tax incentives.
                                                <a href="/about#taxfree-ee" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">Learn more ></a>
                                            </div>
                                            <div class="flex items-start mb-2">
                                                <div class="flex items-center h-5">
                                                    <input
                                                        form="generator"
                                                        type="checkbox"
                                                        id="tax"
                                                        name="tax"
                                                        value="true"
                                                        class="w-5 h-5
                                                       bg-red-100 border-red-300 text-red-500 focus:ring-red-200"/>
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="tax" class="font-medium text-gray-900
                                                    dark:text-gray-300">Let my donors apply for a tax refund</label>
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
                                    text-gray-500 text-xs font-bold">3
                                </div>
                                <div class="ml-2 text-gray-500">Details for
                                    @if(env('COUNTRY') == 'ee')
                                        Estonian
                                    @endif
                                    @if(env('COUNTRY') == 'lv')
                                        Latvian
                                    @endif
                                    @if(env('COUNTRY') == 'lt')
                                        Lithuanian
                                    @endif
                                    banks
                                </div>
                            </div>
                            <div class="mb-5">
                                @csrf
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">Payee's bank account (IBAN) number</label>
                                            <input
                                                form="generator"
                                                type="text"
                                                name="iban"
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
                                            />
                                        </div>

                                        <div class="col-span-12">
                                            <label for="campaign_title" class="font-bold text-gray-700 mb-2">
                                                Choose banking methods
                                            </label>
                                        </div>
                                        {{--Swedbank--}}
                                        <div class="col-span-12" x-data="{swedtoggle: false}">
                                            <div class="grid grid-cols-2 gap-4 space-y-0">
                                            <div>
                                                <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-yellow-100 bg-yellow-500 uppercase">Swedbank</h2 >
                                            </div>
                                            <div>
                                                <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                     :class="[swedtoggle ? 'bg-pink-500' : 'bg-gray-300']">
                                                    <label
                                                        for="swedtoggle"
                                                        class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                        :class="[swedtoggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                    <input
                                                        type="checkbox"
                                                        id="swedtoggle"
                                                        name="swedtoggle"
                                                        x-model="swedtoggle"
                                                        value="true"
                                                        class="w-full h-full appearance-none focus:outline-none"
                                                    />
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        {{--SEB--}}
                                        <div class="col-span-12" x-data="{sebtoggle: false}">
                                            <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-green-100 bg-green-500 uppercase">SEB bank</h2>
                                            </div>
                                            <div>
                                                <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                     :class="[sebtoggle ? 'bg-pink-500' : 'bg-gray-300']">
                                                    <label
                                                        for="sebtoggle"
                                                        class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                        :class="[sebtoggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                    <input
                                                        type="checkbox"
                                                        id="sebtoggle"
                                                        name="sebtoggle"
                                                        x-model="sebtoggle"
                                                        class="w-full h-full appearance-none focus:outline-none"
                                                    />
                                                </div>
                                            </div>
                                            </div>
                                            <div x-show="sebtoggle">
                                                <div class="col-span-12 mt-3 ml-2 mr-2">
                                                    <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">SEB UID code</label>
                                                    <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                        If you want to connect SEB bank as part of the payment methods, you
                                                        need to get your own UID code from SEB.
                                                        <a href="/about#sebUID" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">Read more about how to
                                                            obtain a special identifier for private individuals and companies
                                                            > </a>
                                                    </div>
                                                    @if(env('COUNTRY') == 'lv')
                                                        <div class="tracking-normal text-sm text-gray-500 mt-3 mb-2
                                                            leading-tight">
                                                            Insert SEB UID for <b>One-time direct payments</b>.</div>
                                                    @endif
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
                                                    @if(env('COUNTRY') == 'lv')
                                                        <div class="tracking-normal text-sm text-gray-500 mt-3 mb-2
                                                        leading-tight">
                                                            Insert SEB UID for <b>Standing order</b>.</div>
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
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @if(env('COUNTRY') == 'ee')
                                        {{--LHV--}}
                                        <div class="col-span-12" x-data="{lhvtoggle: false}">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-yellow-100 bg-gray-700 uppercase">LHV bank</h2>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[lhvtoggle ? 'bg-pink-500' : 'bg-gray-300']">
                                                        <label
                                                            for="lhvtoggle"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[lhvtoggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                        <input
                                                            type="checkbox"
                                                            id="lhvtoggle"
                                                            name="lhvtoggle"
                                                            x-model="lhvtoggle"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="lhvtoggle">
                                            </div>
                                        </div>
                                        @endif
                                        @if(env('COUNTRY') == 'ee')
                                        {{--COOP--}}
                                        <div class="col-span-12" x-data="{cooptoggle: false}">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-blue-100 bg-blue-600 uppercase">Coop bank</h2>
                                                </div>
                                                <div>
                                                    <div class="float-right relative w-16 h-8 transition duration-200 ease-linear rounded-full"
                                                         :class="[cooptoggle ? 'bg-pink-500' : 'bg-gray-300']">
                                                        <label
                                                            for="cooptoggle"
                                                            class="absolute left-0 w-8 h-8 transition duration-100 ease-linear
                                                    transform bg-gray-100 rounded-full cursor-pointer"
                                                            :class="[cooptoggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"></label>
                                                        <input
                                                            type="checkbox"
                                                            id="cooptoggle"
                                                            name="cooptoggle"
                                                            x-model="cooptoggle"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="cooptoggle">
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
                                    text-gray-500 text-xs font-bold">4
                                </div>
                                <div class="ml-2 text-gray-500">Credit cards</div>
                            </div>
                            <div class="mb-5">
                                <div class="col-span-12 mb-3">
                                    <label for="campaign_title" class="font-bold text-gray-700 mb-2">
                                        Choose banking methods
                                    </label>
                                </div>
                                @csrf
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        {{--Revolut.me--}}
                                        <div class="col-span-12" x-data="{revtoggle: false}">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-white bg-black uppercase">Revolut.me</h2>
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
                                                <div class="col-span-12 mt-3 ml-2 mr-2">
                                                    <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">Revolut.me username</label>
                                                    <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                        If you have a Revolut account, you can create your own Revolut.me page
                                                        to accept payments from other users in Revolut or by credit card.
                                                        <a href="/about#revolut" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">How can I create it? ></a>
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
                                        {{--Paypal.me--}}
                                        <div class="col-span-12" x-data="{pptoggle: false}">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-white bg-blue-500 uppercase">Paypal.me</h2>
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
                                                <div class="col-span-12 mt-3 ml-2 mr-2">
                                                    <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">PayPal.me username</label>
                                                    <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                        If you have a Paypal account, you can create your own Paypal.me page to
                                                        accept donations from other users.
                                                        <a href="/about#paypal" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">How can I create it? ></a>
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
                                        {{--Donorbox--}}
                                        <div class="col-span-12" x-data="{dbtoggle: false}">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <h2 class="text-sm font-semibold inline-block py-2 px-3 uppercase rounded-full text-white bg-red-500 uppercase">Donorbox</h2>
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
                                                <div class="col-span-12 mt-3 ml-2 mr-2">
                                                    <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">Donorbox campaign slug</label>
                                                    <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                        To start accepting payments for bank cards, you can use the Donorbox
                                                        service.
                                                        <a href="/about#donorbox" class="no-underline hover:underline
                                                    text-blue-800" target="_blank">How can I create it? ></a>
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
                                class="w-32 focus:outline-none py-2 px-5 mr-2 rounded-lg shadow-sm text-center
                                    text-gray-600 bg-white hover:bg-gray-100 font-medium border transition
                                    duration-150 ease-in-out cursor-not-allowed opacity-50"
                                disabled
                            >Previous
                            </button>
                            <button
                                x-show="step > 1"
                                @click="step--"
                                class="w-32 focus:outline-none py-2 px-5 mr-2 rounded-lg shadow-sm text-center
                                    text-gray-600 bg-white hover:bg-gray-100 font-medium border transition duration-150 ease-in-out"
                            >Previous
                            </button>
                        </div>

                        <div class="w-1/2 ">
                            <button
                                x-show="step < 4"
                                @click="step++"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 ml-2 rounded-lg
                                    border border-transparent font-medium rounded-md text-white bg-pink-500
                                    hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                    focus:ring-pink-700 transition duration-150 ease-in-out">
                                Next
                            </button>

                            <button
                                type="submit"
                                form="generator"
                                value="submit"
                                x-show="step === 4"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 ml-2 rounded-lg
                                    border border-transparent font-medium rounded-md text-white bg-pink-500
                                    hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                    focus:ring-pink-700 transition duration-150 ease-in-out">
                                Complete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex-1">
                        <div class="uppercase tracking-normal text-xs font-normal text-gray-400 mb-4 leading-tight"
                             x-text="`Step: ${step} of 4`"></div>
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

        @include('footer')
    </div>

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
