
<div class="pb-6">
    <h1 class="mt-0 text-center text-2xl font-semibold text-gray-700">
        {!! urldecode($campaign_title) !!}
    </h1>
    <div class="mt-3 text-center text-sm text-gray-500 align-middle">
        {!! urldecode($payee) !!}
        @if($iban)
            / {!! urldecode($iban) !!}
        @endif
        @if($pp)
            / <i class="fa-brands fa-paypal text-gray-400"></i> {!! urldecode($pp) !!}
        @endif<br>
        {!! urldecode($detail) !!}
        <!-- Trigger -->
        <button data-tooltip-target="tooltip-click" data-tooltip-trigger="click" type="button" class="btn inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs text-gray-500 hover:bg-gray-100/80 hover:text-gray-700 transition-colors"
        data-clipboard-text="{{
                urldecode($payee)
                }} / {{ urldecode($iban) }} / @lang('Payment description:') {{ urldecode($detail) }}">
            <div class="inline-flex items-center">
            (<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>@lang("Copy"))</div>
        </button>
        <div id="tooltip-click" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            Copied!
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div><br>
        <a href="{{ $bg_check }}" class="no-underline hover:underline text-xs text-blue-700 hover:text-blue-800 transition-colors" target="_blank">
            <div class="inline-flex items-center mt-2">
                @lang("Check payee's background")
                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3
                .org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0
                 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </div>
        </a><br>
    </div>

</div>
<div x-data="app()" x-cloak>
    <!-- / Bottom Navigation -->
    <div x-show.transition="step != 'complete'">
        <!-- Top Navigation -->
        <div class="py-1">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            </div>
        </div>
        <!-- /Top Navigation -->
    </div>

    <div class="donation-form-card glass-strong rounded-2xl p-4 justify-between mb-6">
        @if(isset($hasPaymentMethods) && !$hasPaymentMethods)
            <div class="py-8 px-4 text-center">
                <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200">
                    <p class="text-red-800 font-medium">@lang("No payment methods enabled")</p>
                    <p class="text-sm text-red-700 mt-2">@lang("This donation box has no internet banks or other payment methods configured. Please edit the link to enable at least one payment method.")</p>
                </div>
                <a href="{{ $editUrl ?? route('edit') }}"
                   class="d-font inline-flex items-center justify-center px-6 py-3 rounded-xl font-medium text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-150 ease-in-out">
                    @lang("Edit donation box to fix")
                </a>
            </div>
        @else
        <div x-show.transition="step != 'complete'">

            <!-- Step Content -->
            <div class="py-1">
                <!-- Step 1 -->
                <div>
                    <div class="mb-1">
                        <div class="rounded-md -space-y-px">
                            <div class="grid gap-6">
                                <div class="col-span-12">
                                    @php
                                        $showRecurringBtn = isset($hasRecurringPayment) ? $hasRecurringPayment : $recurring;
                                        $defaultTab = (!$onetime && $showRecurringBtn) ? 'standing' : 'onetime';
                                        $showPaymentTypeStep = !$s0 && $onetime && $showRecurringBtn;
                                        $stepForFirstPayment = $s0 ? 2 : (2 + ($showPaymentTypeStep ? 1 : 0));
                                        $stepForSecondPayment = $stepForFirstPayment + 1;
                                    @endphp
                                    <div x-data="{ tab: '{{ $defaultTab }}' }">
                                        <div class="flex items-center justify-center mt-6 mb-2">
                                            <div class="rounded-full h-7 w-7 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-600 text-xs font-semibold">1</div>
                                            <div class="text-xs text-gray-500 text-center">
                                                @if($s0)
                                                    @lang("The amount of your payment")
                                                @else
                                                    @lang("Enter the amount of your donation")
                                                @endif
                                            </div>
                                        </div>
                                        <div x-data="{ preamount: '' }">
                                            <div class="w-60 max-w-xs mr-auto ml-auto">
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                          <span class="text-gray-500 text-lg">
                                                            €
                                                          </span>
                                                    </div>
                                                    <form class="space-y-4" action="{{ route('redirect') }}"
                                                          method="get" id="sumforbank" target="_blank">@csrf</form>
                                                    <input
                                                        form="sumforbank"
                                                        @if($s0)
                                                            type="text"
                                                        @else
                                                            type="number"
                                                        @endif
                                                        name="donationsum"
                                                        id="donationsum"
                                                        @if($s0)
                                                            value="{{ $s0 }}"
                                                        @else
                                                            value="{{ $amount }}"
                                                        @endif
                                                        class="transition duration-150 ease-in-out w-full
                                                                pl-7 pr-7 px-3 py-4 border border-gray-200
                                                        placeholder-gray-400 text-gray-900 rounded-xl
                                                        focus:outline-none focus:ring-2 focus:ring-offset-0
                                                        focus:ring-pink-500 focus:border-pink-400 focus:z-10 text-5xl text-center bg-white/50"
                                                        placeholder="0.00" min="0" step="any" maxlength="4"
                                                        aria-label="@lang('Enter donation amount')"
                                                        aria-required="true"
                                                        @if($s0)
                                                            x-model="preamount = '{{ $s0 }}'"
                                                            disabled
                                                        @else
                                                            x-model="preamount"
                                                        @endif
                                                        required>
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="payee"
                                                        id="payee"
                                                        value="{{ $payee }}"
                                                    >
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="detail"
                                                        id="detail"
                                                        value="{{ $detail }}"
                                                    >
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="iban"
                                                        id="iban"
                                                        value="{{ $iban }}"
                                                    >
                                                    @if($pp)
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="pp"
                                                        id="pp"
                                                        value="{{ $pp }}"
                                                    >
                                                    @endif
                                                    @if($pphb)
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="pphb"
                                                        id="pphb"
                                                        value="{{ $pphb }}"
                                                    >
                                                    @endif
                                                    @if($db)
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="db"
                                                        id="db"
                                                        value="{{ $db }}"
                                                    >
                                                    @endif
                                                    @if($sebuid_st)
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="sebuid_st"
                                                        id="sebuid_st"
                                                        value="{{ $sebuid_st }}"
                                                    >
                                                    @endif
                                                    @if($sebuid)
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="sebuid"
                                                        id="sebuid"
                                                        value="{{ $sebuid }}"
                                                    >
                                                    @endif
                                                    @if($rev)
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="rev"
                                                        id="rev"
                                                        value="{{ $rev }}"
                                                    >
                                                    @endif
                                                    @if($strp)
                                                        <input form="sumforbank" type="hidden" name="strp" id="strp" value="{{ $strp }}">
                                                    @endif
                                                    @if($s0)
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="s0"
                                                        id="s0"
                                                        value="{{ $s0 }}"
                                                    >
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="flex flex-wrap justify-center gap-2 mt-3 mb-4">
                                                @if(!$s0)
                                                <button id="preamount1" class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2.5 px-5 rounded-xl
                                                        text-center text-gray-600 font-medium
                                                        focus:ring-2 focus:ring-offset-0 focus:ring-pink-500 w-auto
                                                        border border-gray-200/80 bg-white/70 hover:bg-white hover:shadow-md backdrop-blur-sm"
                                                        @if($s1)
                                                        @click="preamount = '{{ $s1 }}'">
                                                    {{ $s1 }}€
                                                    @else
                                                        @click="preamount = '{{ $defsum }}'">
                                                        {{ $defsum }}€
                                                    @endif
                                                </button>
                                                <button id="preamount2" class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2.5 px-5 rounded-xl
                                                        text-center text-gray-600 font-medium
                                                        focus:ring-2 focus:ring-offset-0 focus:ring-pink-500 w-auto
                                                        border border-gray-200/80 bg-white/70 hover:bg-white hover:shadow-md backdrop-blur-sm"
                                                    @if($s2)
                                                        @click="preamount = '{{ $s2 }}'">
                                                        {{ $s2 }}€
                                                    @elseif($s1)
                                                        @click="preamount = '{{ $s1 * 2 }}'">
                                                        {{ $s1 * 2 }}€
                                                    @else
                                                        @click="preamount = '{{ $defsum * 2 }}'">
                                                        {{ $defsum * 2 }}€
                                                    @endif
                                                </button>
                                                <button id="preamount3" class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2.5 px-5 rounded-xl
                                                        text-center text-gray-600 font-medium
                                                        focus:ring-2 focus:ring-offset-0 focus:ring-pink-500 w-auto
                                                        border border-gray-200/80 bg-white/70 hover:bg-white hover:shadow-md backdrop-blur-sm"
                                                        @if($s3)
                                                        @click="preamount = '{{ $s3 }}'">
                                                    {{ $s3 }}€
                                                    @elseif($s1)
                                                        @click="preamount = '{{ $s1 * 3 }}'">
                                                        {{ $s1 * 3 }}€
                                                    @else
                                                        @click="preamount = '{{ $defsum * 3 }}'">
                                                        {{ $defsum * 3 }}€
                                                    @endif
                                                </button>
                                                @endif
                                            </div>

                                        </div>

                                        @if($showPaymentTypeStep)
                                        <div class="flex items-center justify-center">
                                            <div class="rounded-full h-7 w-7 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-600 text-xs font-semibold">2</div>
                                            <div class="text-xs text-gray-500 text-center">
                                                @lang("Select payment type")
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap justify-center gap-2 mt-2 mb-4">
                                            @if($onetime)
                                            <button
                                                class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2.5 px-5 rounded-xl text-center text-sm font-medium
                                                        focus:ring-2 focus:ring-offset-0 focus:ring-pink-500"
                                                @click="tab = 'onetime'"
                                                :class="tab === 'onetime' ? 'bg-pink-100/80 text-pink-800 border border-pink-200/80 shadow-sm' : 'text-gray-600 border border-gray-200/80 bg-white/70 hover:bg-white hover:shadow-md backdrop-blur-sm'"
                                            >
                                                @lang("One-time payment")
                                            </button>
                                            @endif
                                            @if($showRecurringBtn)
                                            <button
                                                class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2.5 px-5 rounded-xl text-center text-sm font-medium
                                                        focus:ring-2 focus:ring-offset-0 focus:ring-pink-500"
                                                @click="tab = 'standing'"
                                                :class="tab === 'standing' ? 'bg-pink-100/80 text-pink-800 border border-pink-200/80 shadow-sm' : 'text-gray-600 border border-gray-200/80 bg-white/70 hover:bg-white hover:shadow-md backdrop-blur-sm'"
                                            >
                                                @lang("Recurring payment")
                                            </button>
                                            @endif
                                        </div>
                                        @endif

                                        @if($tax and env('COUNTRY') == 'ee' or $tax and env('COUNTRY') == 'lv')
                                        <div class="flex items-center justify-center">
{{--                                            <div class="rounded-full h-6 w-6 mr-2 flex items-center justify-center bg-yellow-100--}}
{{--                                    text-gray-500 text-xs font-bold">3</div>--}}
{{--                                            <div class="text-xs text-gray-500 text-center">@lang("Apply for a tax return")</div>--}}
                                        </div>

                                        <div x-data="{ show: false }">
                                        <div class="flex items-center justify-center mt-2 mb-2 pl-2">
                                            <div class="flex items-start mb-2">
                                                <div class="flex items-center h-5">
                                                    <input
                                                        form="generator"
                                                        type="checkbox"
                                                        id="ikcheckbox"
                                                        name="ikcheckbox"
                                                        value="true"
                                                        x-model="show"
                                                        aria-label="@lang("I'd like to have a tax return")"
                                                        class="w-4 h-4
                                                     bg-red-100 border-red-300 text-red-500 focus:ring-red-200 "
                                                        >
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="ikcheckbox" class="font-medium text-gray-600
                                                    dark:text-gray-300">@lang("I'd like to have a tax return")</label>
                                                </div>
                                            </div>
                                        </div>
                                            <div x-show="show" x-transition:enter.duration.500ms>
                                                <div class="mb-1 text-xs text-gray-500 text-center">
                                                    @lang("Please type your identity code")
                                                </div>
                                                <div class="flex items-center justify-center mt-0 mb-4">
                                                    <input
                                                        form="sumforbank"
                                                        type="text"
                                                        name="taxik"
                                                        id="taxik"
                                                        pattern="[0-9-]+"
                                                        value="{{ $ik }}"
                                                        class="appearance-none relative block w-1/2 px-3 py-2
                                                               border border-gray-200 text-gray-900 rounded-xl
                                                               focus:outline-none focus:ring-2 focus:ring-pink-500
                                                               focus:border-pink-400 focus:z-10 text-normal
                                                               transition duration-150 ease-in-out text-center"
                                                        placeholder="eg. 38001085718"
                                                    >
                                                </div>
                                            </div>
                                    </div>
                                        @endif

                                        <div>
                                            <div x-show="tab === 'onetime'" class="mt-2 flex flex-col items-center gap-4" x-transition:enter.duration.500ms>
                                                @if($onetime && $iban)
                                                    <div class="w-full">
                                                        <div class="flex items-center justify-center mb-2">
                                                            <div class="rounded-full h-7 w-7 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-600 text-xs font-semibold">{{ $stepForFirstPayment }}</div>
                                                            <div class="text-xs text-gray-500 text-center">@lang("Donate via internet-bank")</div>
                                                        </div>
                                                        <div class="flex flex-wrap justify-center gap-2">
                                                        @if(!$swt)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="swed"
                                                            class="d-font transition duration-150 ease-in-out inline-flex shrink-0
                                                            bg-yellow-500 px-5 py-3 text-sm font-medium
                                                            text-white rounded-full shadow-md whitespace-nowrap
                                                            hover:shadow-lg hover:bg-yellow-600">Swedbank
                                                        </button>
                                                        @endif
                                                    @if($sebuid)
                                                        <div class="flex flex-col items-center shrink-0">
                                                            <button
                                                                form="sumforbank"
                                                                type="submit"
                                                                name="action"
                                                                value="seb"
                                                                class="d-font transition duration-150 ease-in-out inline-flex shrink-0 bg-green-500 px-5 py-3
                                                             text-sm font-medium text-white rounded-full shadow-md whitespace-nowrap
                                                            hover:shadow-lg hover:bg-green-600">SEB
                                                            </button>
                                                        </div>
                                                    @endif
                                                        @if(env('COUNTRY') == 'ee' and !$lhvt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="lhv"
                                                        class="d-font transition duration-150 ease-in-out inline-flex shrink-0 bg-gray-700 px-5 py-3
                                                        text-sm font-medium text-white rounded-full shadow-md whitespace-nowrap
                                                        hover:shadow-lg hover:bg-gray-800">LHV
                                                    </button>
                                                        @endif
                                                        @if(env('COUNTRY') == 'ee' and !$coopt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="coop"
                                                        class="d-font transition duration-150 ease-in-out inline-flex shrink-0 bg-blue-600 px-5 py-3
                                                        text-sm font-medium text-white rounded-full shadow-md whitespace-nowrap
                                                        hover:shadow-lg hover:bg-blue-700">Coop
                                                    </button>
                                                        @endif
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($rev or $pp or $pphb or $db or $paypalClientId or $strp)
                                                <div class="w-full">
                                                    <div class="flex items-center justify-center mb-2">
                                                        @if(!$iban)
                                                        <div class="rounded-full h-7 w-7 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-600 text-xs font-semibold">{{ $stepForFirstPayment }}</div>
                                                        @endif
                                                            @if($iban)
                                                                <div class="rounded-full h-7 w-7 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-600 text-xs font-semibold">{{ $stepForSecondPayment }}</div>
                                                            @endif
                                                        <div class="text-xs text-gray-500 text-center">@lang("Donate by credit card")</div>
                                                    </div>
                                                    <div class="flex flex-wrap justify-center gap-2">
                                                    @if($rev)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="rev"
                                                            class="d-font transition duration-150 ease-in-out bg-white px-5 py-3
                                                        text-sm font-medium border border-gray-200 text-blue-600 rounded-xl shadow-md
                                                        hover:shadow-lg hover:bg-gray-50 mb-2">
                                                            Revolut <span class="text-xs tracking-tight">(Visa/MC)</span>
                                                        </button>
                                                    @endif
                                                @if($pp)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="paypal"
                                                        class="d-font transition duration-150 ease-in-out bg-blue-800 px-5 py-3
                                                text-sm font-medium text-white rounded-xl shadow-md
                                                hover:shadow-lg hover:bg-blue-900 mb-2">Paypal
                                                    </button>
                                                @endif
                                                    @if($pphb)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="pphb"
                                                            class="d-font transition duration-150 ease-in-out bg-blue-800 px-5 py-3
                                                text-sm font-medium text-white rounded-xl shadow-md
                                                hover:shadow-lg hover:bg-blue-900 mb-2">
                                                            Paypal <span class="text-xs tracking-tight">(Visa/MC)</span>
                                                        </button>
                                                    @endif
                                                @if($db)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="donorbox"
                                                        class="d-font transition duration-150 ease-in-out bg-red-600 px-5 py-3
                                                text-sm font-medium text-white rounded-xl shadow-md
                                                hover:shadow-lg hover:bg-red-700 inline-flex items-center mb-2">
                                                        Donorbox <span class="text-xs tracking-tight ml-1">(Visa/MC)</span>
                                                    </button>
                                                @endif
                                                    @if($strp)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="strp"
                                                            class="d-font transition duration-150 ease-in-out bg-blue-600 px-5 py-3
                                                text-sm font-medium text-white rounded-xl shadow-md
                                                hover:shadow-lg hover:bg-blue-700 inline-flex items-center mb-2">
                                                            Stripe <span class="text-xs tracking-tight ml-1">(Visa/MC)</span>
                                                        </button>
                                                    @endif
                                                    @if($paypalClientId)
                                                        <div class="m-auto" id="paypal-button-container"></div>
                                                    @endif
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div x-show="tab === 'standing'" class="mt-2 flex flex-col items-center gap-4" x-transition:enter.duration.500ms>
                                                @if($recurring && $iban)
                                                    <div class="w-full">
                                                        <div class="flex items-center justify-center mb-2">
                                                            <div class="rounded-full h-7 w-7 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-600 text-xs font-semibold">{{ $stepForFirstPayment }}</div>
                                                            <div class="text-xs text-gray-500 text-center">@lang("Donate via internet-bank")</div>
                                                        </div>
                                                        <div class="flex flex-wrap justify-center gap-2">
                                                        @if(!$swt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="swed-standing"
                                                        class="d-font transition duration-150 ease-in-out inline-flex shrink-0 bg-yellow-500 px-5 py-3
                                                        text-sm font-medium text-white rounded-full shadow-md whitespace-nowrap
                                                        hover:shadow-lg hover:bg-yellow-600">Swedbank
                                                    </button>
                                                        @endif
                                                    @if($sebuid_st)
                                                        <div class="flex flex-col items-center shrink-0">
                                                            <button
                                                                form="sumforbank"
                                                                type="submit"
                                                                name="action"
                                                                value="seb-standing"
                                                                class="d-font transition duration-150 ease-in-out inline-flex shrink-0 bg-green-500 px-5 py-3
                                                             text-sm font-medium text-white rounded-full shadow-md whitespace-nowrap
                                                            hover:shadow-lg hover:bg-green-600">SEB
                                                            </button>
                                                        </div>
                                                    @endif
                                                        @if(env('COUNTRY') == 'ee' and !$lhvt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="lhv-standing"
                                                        class="d-font transition duration-150 ease-in-out inline-flex shrink-0 bg-gray-700 px-5 py-3
                                                        text-sm font-medium text-white rounded-full shadow-md whitespace-nowrap
                                                        hover:shadow-lg hover:bg-gray-800">LHV
                                                    </button>
                                                        @endif
                                                        @if(env('COUNTRY') == 'ee' and !$coopt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="coop-standing"
                                                        class="d-font transition duration-150 ease-in-out inline-flex shrink-0 bg-blue-600 px-5 py-3
                                                        text-sm font-medium text-white rounded-full shadow-md whitespace-nowrap
                                                        hover:shadow-lg hover:bg-blue-700">Coop
                                                    </button>
                                                        @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($db)
                                                <div class="w-full">
                                                    <div class="flex items-center justify-center mb-2">
                                                        @if(!$iban)
                                                            <div class="rounded-full h-7 w-7 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-600 text-xs font-semibold">{{ $stepForFirstPayment }}</div>
                                                        @else
                                                            <div class="rounded-full h-7 w-7 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-600 text-xs font-semibold">{{ $stepForSecondPayment }}</div>
                                                        @endif
                                                        <div class="text-xs text-gray-500 text-center">@lang("Donate by credit card")</div>
                                                    </div>
                                                    <div class="flex flex-wrap justify-center gap-2">
                                                @if($db)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="donorbox-standing"
                                                        class="d-font transition duration-150 ease-in-out bg-red-600 px-5 py-3
                                                text-sm font-medium text-white rounded-xl shadow-md
                                                hover:shadow-lg hover:bg-red-700 inline-flex items-center">
                                                        Donorbox <span class="text-xs tracking-tight ml-1">(Visa/MC)</span>
                                                        </button>
                                                @endif
                                                        @if($pphb)
                                                            <button
                                                                form="sumforbank"
                                                                type="submit"
                                                                name="action"
                                                                value="pphb"
                                                                class="d-font transition duration-150 ease-in-out bg-blue-800 px-5 py-3
                                                text-sm font-medium text-white rounded-xl shadow-md
                                                hover:shadow-lg hover:bg-blue-900 mb-2">
                                                            Paypal <span class="text-xs tracking-tight">(Visa/MC)</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>


    @include('secure')

</div>

{{-- Conditional loading of PayPal SDK --}}
@if(isset($paypalClientId) && (!isset($hasPaymentMethods) || $hasPaymentMethods))
    <script src="https://www.paypal.com/sdk/js?client-id={{ $paypalClientId }}&currency=EUR"></script>
@endif

@if(!isset($hasPaymentMethods) || $hasPaymentMethods)
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var donationInput = document.getElementById("donationsum");
        var personalCodeInput = document.getElementById("taxik");

        function sanitizePersonalCode(value) {
            var sanitizedValue = value.replace(/\D/g, ''); // Removes all non-digit characters
            return sanitizedValue;
        }

        function renderPayPalButtons(amount, personalCodeValue) {
            amount = amount || donationInput.value || '1';
            if (personalCodeValue) {
                personalCodeValue = personalCodeValue || personalCodeInput.value || '';
                var sanitizedPersonalCode = sanitizePersonalCode(personalCodeValue);
            } else {
                var sanitizedPersonalCode = '';
            }

            // Remove existing PayPal buttons
            var paypalButtonContainer = document.getElementById("paypal-button-container");
            while (paypalButtonContainer.firstChild) {
                paypalButtonContainer.removeChild(paypalButtonContainer.firstChild);
            }

            // Check if PayPal is loaded and create buttons
            if (window.paypal && window.paypal.Buttons) {
                paypal.Buttons({
                    createOrder: function (data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {value: amount},
                                description: "{{ urldecode($detail) }} " + sanitizedPersonalCode,
                            }],
                        });
                    },
                    onApprove: function (data, actions) {
                        return actions.order.capture().then(function (details) {
                            alert("Donation successful. Thank you for your generosity!");
                        });
                    }
                }).render('#paypal-button-container');
            }
        }

        function setDonationAmount(amount) {
            donationInput.value = amount;
            donationInput.dispatchEvent(new Event('change'));
        }

        // Initialize with default amount and personal code
        if (personalCodeInput) {
            renderPayPalButtons('1', personalCodeInput.value);
        } else {
            renderPayPalButtons('1');
        }

        // Update PayPal buttons on amount change
        if (donationInput) {
            donationInput.addEventListener("change", function (e) {
                const donationAmount = parseFloat(e.target.value) || 1;
                if (personalCodeInput) {
                    renderPayPalButtons(donationAmount.toString(), personalCodeInput.value);
                } else {
                    renderPayPalButtons(donationAmount.toString());
                }
            });
        } else {
            console.error("Element with ID 'donationsum' not found.");
        }

        // Update PayPal buttons on personal code change
        if (personalCodeInput) {
            personalCodeInput.addEventListener("input", function () {
                const donationAmount = parseFloat(donationInput.value) || 1;
                if (personalCodeInput) {
                    renderPayPalButtons(donationAmount.toString(), personalCodeInput.value);
                } else {
                    renderPayPalButtons(donationAmount.toString());
                }
            });
        } else {
            console.error("Element with ID 'taxik' not found.");
        }

        // Event listeners for pre-set amount buttons
        // Add personalCodeValue to these calls as well
        document.getElementById("preamount1").addEventListener("click", function() {
            const donationAmount = parseFloat(donationInput.value) || 1;
            if (personalCodeInput) {
                renderPayPalButtons(donationAmount.toString(), personalCodeInput.value);
            } else {
                renderPayPalButtons(donationAmount.toString());
            }
        });

        document.getElementById("preamount2").addEventListener("click", function() {
            const donationAmount = parseFloat(donationInput.value) || 1;
            if (personalCodeInput) {
                renderPayPalButtons(donationAmount.toString(), personalCodeInput.value);
            } else {
                renderPayPalButtons(donationAmount.toString());
            }
        });

        document.getElementById("preamount3").addEventListener("click", function() {
            const donationAmount = parseFloat(donationInput.value) || 1;
            if (personalCodeInput) {
                renderPayPalButtons(donationAmount.toString(), personalCodeInput.value);
            } else {
                renderPayPalButtons(donationAmount.toString());
            }
        });
    });
</script>
@endif

{{--Init of ClipboardJS--}}
<script type="text/javascript">
    var Clipboard = new ClipboardJS('.btn');
</script>

<script>
    function app() {
        return {
            step: 1,
        }
    }
</script>
