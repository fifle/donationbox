<div>
    <h2 class="mt-0 ml-3 mr-3 text-center text-2xl font-semibold text-gray-700">
        {!! urldecode($campaign_title) !!}
    </h2>
    <div class="mt-2 mb-4 ml-3 mr-3 text-center text-sm text-gray-500 align-middle">
        {!! urldecode($payee) !!}
        @if($iban)
            / {!! urldecode($iban) !!}
        @endif
        @if($pp)
            / <i class="fa-brands fa-paypal text-gray-400"></i> {!! urldecode($pp) !!}
        @endif<br>
        {!! urldecode($detail) !!}
        <!-- Trigger -->
        <button data-tooltip-target="tooltip-click" data-tooltip-trigger="click" type="button" class="btn "
        data-clipboard-text="{{
                urldecode($payee)
                }} / {{ urldecode($iban) }} / Payment description: {{ urldecode($detail) }}">
            <div class="inline-flex items-center text-xs text-gray-500">
            (<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> Copy)</div>
        </button>
        <div id="tooltip-click" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            Copied!
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div><br>
        <a href="{{ $bg_check }}" class="no-underline
                 hover:underline text-xs text-blue-800" target="_blank">
            <div class="inline-flex items-center mt-2">
                Check payee's background
                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3
                .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0
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

    <div class="bg-white rounded-lg p-5 pt-0 shadow justify-between mb-4">
        <div x-show.transition="step != 'complete'">

            <!-- Step Content -->
            <div class="py-1">
                <!-- Step 1 -->
                <div>
                    <div class="mb-1">
                        <div class="rounded-md -space-y-px">
                            <div class="grid gap-6">
                                <div class="col-span-12">
                                    <div x-data="{ tab: 'onetime' }">
                                        <div class="flex items-center justify-center mt-8 mb-2">
                                            <div class="rounded-full h-6 w-6 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">1</div>
                                            <div class="text-xs text-gray-500 text-center">Enter the amount of your donation</div>
                                        </div>
                                        <div x-data="{ preamount: '' }">
                                            <div class="w-48 max-w-xs mr-auto ml-auto">
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
                                                        type="number"
                                                        name="donationsum"
                                                        id="donationsum"
                                                        value="{{ $amount }}"
                                                        class="transition duration-150 ease-in-out w-full
                                                                pl-7 pr-7 px-3 py-3 border border-gray-300
                                                        placeholder-gray-500 text-gray-900 rounded-md
                                                        focus:outline-none focus:ring-1 focus:ring-offset-0
                                                        focus:ring-pink-700 focus:z-10 text-5xl text-center"
                                                        placeholder="0.00" min="0" step="any" maxlength="4"
                                                        x-model="preamount"
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
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="pp"
                                                        id="pp"
                                                        value="{{ $pp }}"
                                                    >
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="pphb"
                                                        id="pphb"
                                                        value="{{ $pphb }}"
                                                    >
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="db"
                                                        id="db"
                                                        value="{{ $db }}"
                                                    >
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="sebuid_st"
                                                        id="sebuid_st"
                                                        value="{{ $sebuid_st }}"
                                                    >
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="sebuid"
                                                        id="sebuid"
                                                        value="{{ $sebuid }}"
                                                    >
                                                    <input
                                                        form="sumforbank"
                                                        type="hidden"
                                                        name="rev"
                                                        id="rev"
                                                        value="{{ $rev }}"
                                                    >
                                                </div>
                                            </div>
                                            <div class="p-1 mt-1 mb-4 text-center space-y-2">
                                                <button class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                        @click="preamount = '5'">
                                                    5€
                                                </button>
                                                <button class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                        @click="preamount = '10'">
                                                    10€
                                                </button>
                                                <button class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-5 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                        @click="preamount = '25'">
                                                    25€
                                                </button>
                                            </div>

                                        </div>

                                        <div class="flex items-center justify-center">
                                            <div class="rounded-full h-6 w-6 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">2</div>
                                            <div class="text-xs text-gray-500 text-center">Select
                                                payment type</div>
                                        </div>

                                        <div class="flex items-center justify-center mt-2 mb-4">
                                            <button
                                                class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-4 rounded-lg
                                                        shadow-sm text-center text-sm text-gray-600 bg-white
                                                        hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                @click="tab = 'onetime'"
                                                :class="{'bg-gray-100' : tab === 'onetime', 'font-normal' :
                                                !tab === 'onetime'}"
                                            >
                                                One-time payment
                                            </button>
                                            @if($iban or $db)
                                            <button
                                                class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-4 ml-2 rounded-lg
                                                        shadow-sm text-center text-sm text-gray-600 bg-white
                                                        hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                @click="tab = 'standing'"
                                                :class="{'bg-gray-100' : tab === 'standing', 'font-normal' :
                                                !tab === 'standing'}"
                                            >
                                                Recurring payment
                                            </button>
                                            @endif
                                        </div>

                                        @if($tax and env('COUNTRY') == 'ee')
                                        <div class="flex items-center justify-center">
                                            <div class="rounded-full h-6 w-6 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">3</div>
                                            <div class="text-xs text-gray-500 text-center">Apply for a tax return (valid only for Estonian banks)</div>
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
                                                        class="w-4 h-4
                                                     bg-red-100 border-red-300 text-red-500 focus:ring-red-200 "
                                                        >
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="ikcheckbox" class="font-medium text-gray-600
                                                    dark:text-gray-300">I'd like to have a tax return</label>
                                                </div>
                                            </div>
                                        </div>
                                            <div x-show="show" x-transition:enter.duration.500ms>
                                                <div class="mb-1 text-xs text-gray-500 text-center">
                                                    Please type your identity code (isikukood)
                                                </div>
                                                <div class="flex items-center justify-center mt-0 mb-4">
                                                    <input
                                                        form="sumforbank"
                                                        type="number"
                                                        name="taxik"
                                                        id="taxik"
                                                        value="{{ $ik }}"
                                                        class="appearance-none rounded-none relative block
                                                               w-1/2 px-2 py-1 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 text-normal
                                                               transition duration-150 ease-in-out text-center"
                                                        placeholder="eg. 38001085718">
                                                </div>
                                            </div>
                                    </div>
                                        @endif

                                        <div>
                                            <div x-show="tab === 'onetime'" class="p-1 mt-2 text-center space-x-1
                                                    space-y-2" x-transition:enter.duration.500ms>
                                                @if($iban)
                                                    <div>
                                                        <div class="flex items-center justify-center">
                                                            <div class="rounded-full h-6 w-6 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">
                                                                @if($tax and env('COUNTRY') == 'ee')
                                                                    4
                                                                @else
                                                                    3
                                                                @endif
                                                            </div>
                                                            <div class="mt-3 mb-2 text-xs text-gray-500 text-center">Donate via internet-bank</div>
                                                        </div>
                                                        @if(!$swt)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="swed"
                                                            class="d-font transition duration-150 ease-in-out
                                                            bg-yellow-500 px-5 py-3
                                                            text-sm shadow-sm font-medium
                                                                tracking-wider border text-yellow-100 rounded-full
                                                                hover:shadow-lg hover:bg-yellow-600">Swedbank
                                                        </button>
                                                        @endif
                                                    @if($sebuid)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="seb"
                                                            class="d-font transition duration-150 ease-in-out bg-green-500 px-5 py-3
                                                         text-sm shadow-sm
                                                        font-medium tracking-wider border text-green-100 rounded-full
                                                        hover:shadow-lg hover:bg-green-600">SEB
                                                        </button>
                                                    @endif
                                                        @if(env('COUNTRY') == 'ee' and !$lhvt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="lhv"
                                                        class="d-font transition duration-150 ease-in-out bg-gray-700 px-5 py-3
                                                        text-sm shadow-sm
                                                        font-medium tracking-wider border text-gray-100 rounded-full
                                                        hover:shadow-lg hover:bg-gray-800">LHV
                                                    </button>
                                                        @endif
                                                        @if(env('COUNTRY') == 'ee' and !$coopt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="coop"
                                                        class="d-font transition duration-150 ease-in-out  bg-blue-600 px-5 py-3
                                                        text-sm shadow-sm
                                                        font-medium tracking-wider border text-blue-100 rounded-full
                                                        hover:shadow-lg hover:bg-blue-700">Coop
                                                    </button>
                                                        @endif
                                                    </div>
                                                @endif

                                                <div>
                                                @if($rev or $pp or $pphb or $db)
                                                    <div class="flex items-center justify-center">
                                                        @if(!$iban)
                                                        <div class="rounded-full h-6 w-6 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">3</div>
                                                        @endif
                                                        <div class="mt-3 mb-2 text-xs text-gray-500 text-center">Donate by credit card</div>
                                                    </div>
                                                    @endif
                                                    @if($rev)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="rev"
                                                            class="d-font transition duration-150 ease-in-out bg-white px-5
                                                             py-3
                                                        text-sm shadow-sm
                                                        font-medium tracking-wider border text-blue-500 rounded-full
                                                        hover:shadow-lg hover:bg-gray-100 mb-2">
                                                            Revolut <span class="text-xs tracking-tight">(Visa/MC)</span>
                                                        </button>
                                                    @endif
                                                @if($pp)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="paypal"
                                                        class="d-font transition duration-150 ease-in-out bg-blue-800 px-5
                                                py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-blue-100 rounded-full hover:shadow-lg
                                                     hover:bg-blue-900 mb-2">Paypal
                                                    </button>
                                                @endif
                                                    @if($pphb)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="pphb"
                                                            class="d-font transition duration-150 ease-in-out bg-blue-800 px-5
                                                py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-blue-100 rounded-full hover:shadow-lg
                                                     hover:bg-blue-900 mb-2">
                                                            Paypal <span class="text-xs tracking-tight">(Visa/MC)</span>
                                                        </button>
                                                    @endif
                                                @if($db)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="donorbox"
                                                        class="d-font transition duration-150 ease-in-out bg-red-600 px-5
                                                py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-white rounded-full hover:shadow-lg
                                                     hover:bg-red-700 inline-flex items-center mb-2">
                                                        Donorbox <span class="text-xs tracking-tight ml-1">(Visa/MC)</span>
                                                    </button>
                                                @endif
                                                </div>
                                            </div>
                                            <div x-show="tab === 'standing'" class="p-1 mt-2 text-center space-x-1
                                            space-y-2" x-transition:enter.duration.500ms>
                                                @if($iban)
                                                    <div>
                                                    <div class="flex items-center justify-center">
                                                        <div class="rounded-full h-6 w-6 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">3</div>
                                                        <div class="mt-3 mb-2 text-xs text-gray-500 text-center">Donate via internet-bank</div>
                                                    </div>
                                                        @if(!$swt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="swed-standing"
                                                        class="d-font transition duration-150 ease-in-out bg-yellow-500 px-5 py-3
                                                        text-sm shadow-sm font-medium
                                                            tracking-wider border text-yellow-100 rounded-full
                                                            hover:shadow-lg hover:bg-yellow-600">Swedbank
                                                    </button>
                                                        @endif
                                                    @if($sebuid_st)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="seb-standing"
                                                            class="d-font transition duration-150 ease-in-out bg-green-500 px-5 py-3
                                                         text-sm shadow-sm
                                                        font-medium tracking-wider border text-green-100 rounded-full
                                                        hover:shadow-lg hover:bg-green-600">SEB
                                                        </button>
                                                    @endif
                                                        @if(env('COUNTRY') == 'ee' and !$lhvt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="lhv-standing"
                                                        class="d-font transition duration-150 ease-in-out bg-gray-700 px-5 py-3
                                                        text-sm shadow-sm
                                                        font-medium tracking-wider border text-gray-100 rounded-full
                                                        hover:shadow-lg hover:bg-gray-800">LHV
                                                    </button>
                                                        @endif
                                                        @if(env('COUNTRY') == 'ee' and !$coopt)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="coop-standing"
                                                        class="d-font transition duration-150 ease-in-out  bg-blue-600 px-5 py-3
                                                        text-sm shadow-sm
                                                        font-medium tracking-wider border text-blue-100 rounded-full
                                                        hover:shadow-lg hover:bg-blue-700">Coop
                                                    </button>
                                                        @endif
                                                    </div>
                                                @endif
                                                <div>
                                                    @if($db)
                                                    <div class="flex items-center justify-center">
                                                        @if(!$iban)
                                                            <div class="rounded-full h-6 w-6 mr-2 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">3</div>
                                                        @endif
                                                        <div class="mt-3 mb-2 text-xs text-gray-500 text-center">Donate by credit card</div>
                                                    </div>
                                                    @endif
                                                @if($db)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="donorbox-standing"
                                                        class="d-font transition duration-150 ease-in-out bg-red-600 px-5
                                                py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-white rounded-full hover:shadow-lg
                                                     hover:bg-red-700 inline-flex items-center">
                                                        Donorbox <span class="text-xs tracking-tight ml-1">(Visa/MC)</span>
                                                    </button>
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
        </div>
    </div>

    @include('secure')

</div>

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
