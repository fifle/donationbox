<div>
    <h2 class="mt-0 text-center text-2xl font-semibold text-gray-700">
        {!! urldecode($campaign_title) !!}
    </h2>
    <div class="mt-2 mb-4 text-center text-sm text-gray-600 align-middle">
        {!! urldecode($payee) !!} /
        @if($iban)
            {!! urldecode($iban) !!} /
        @endif
        @if($pp)
            <i class="fa-brands fa-paypal"></i> {!! urldecode($pp) !!}
        @endif<br>
        {!! urldecode($detail) !!}
        <!-- Trigger -->
        <button data-tooltip-target="tooltip-click" data-tooltip-trigger="click" type="button" class="btn focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm  text-center dark:bg-blue-600
         dark:hover:bg-blue-700 dark:focus:ring-blue-800 align-middle"
        data-clipboard-text="{{
                urldecode($payee)
                }} / {{ urldecode($iban) }} / Selgitus: {{ urldecode($detail) }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
        </button>
        <div id="tooltip-click" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            Copied!
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div><br>
        <a href="{{ sprintf("https://www.teatmik.ee/en/search/%s", $payee) }}" class="no-underline
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
                    <div class="mb-5">
                        <div class="rounded-md -space-y-px">
                            <div class="grid gap-6">
                                <div class="col-span-12">
                                    <div x-data="{ tab: 'onetime' }">
                                        <div class="flex items-center justify-center mt-8 mb-4">
                                            <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">1</div>
                                            <div class="ml-3 text-xs text-gray-500 text-center">Enter the amount of your donation</div>
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
                                                        focus:outline-none focus:ring-indigo-500
                                                        focus:border-indigo-500 focus:z-10 text-5xl text-center"
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
                                                        name="iban"
                                                        id="iban"
                                                        value="{{ $iban }}"
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
                                                        name="db"
                                                        id="db"
                                                        value="{{ $db }}"
                                                    >
                                                </div>
                                            </div>
                                            <div class="p-1 mt-1 mb-8 text-center space-y-2">
                                                <button class="transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                        @click="preamount = '5'">
                                                    5€
                                                </button>
                                                <button class="transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                        @click="preamount = '10'">
                                                    10€
                                                </button>
                                                <button class="transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                        @click="preamount = '25'">
                                                    25€
                                                </button>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-center">
                                            <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500    text-xs font-bold">2</div>
                                            <div class="ml-3 text-xs text-gray-500 text-center">Select
                                                payment type</div>
                                        </div>

                                        <div class="flex items-center justify-center mt-2 mb-8">
                                            <button
                                                class="transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-sm text-gray-600 bg-white
                                                        hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                @click="tab = 'onetime'"
                                            >
                                                One-time payment
                                            </button>
                                            <button
                                                class="transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-sm text-gray-600 bg-white
                                                        hover:bg-gray-100
                                                        font-medium border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto"
                                                @click="tab = 'standing'"
                                            >
                                                Recurring payment
                                            </button>
                                        </div>

                                        <div class="flex items-center justify-center">
                                            <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">3</div>
                                            <div class="ml-3 text-xs text-gray-500 text-center">Choose a payment
                                                method</div>
                                        </div>
                                        <div class="">
                                            <div x-show="tab === 'onetime'" class="p-1 mt-2 text-center space-x-1
                                                    space-y-2">
                                                @if($iban)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="swed"
                                                        class="transition duration-150 ease-in-out bg-yellow-500 px-5 py-3
                                                        text-sm shadow-sm font-medium
                                                            tracking-wider border text-yellow-100 rounded-full
                                                            hover:shadow-lg hover:bg-yellow-600">Swedbank
                                                    </button>
                                                    @if($sebuid)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="seb"
                                                            class="transition duration-150 ease-in-out bg-green-500 px-5 py-3
                                                         text-sm shadow-sm
                                                        font-medium tracking-wider border text-green-100 rounded-full
                                                        hover:shadow-lg hover:bg-green-600">SEB
                                                        </button>
                                                    @endif
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="lhv"
                                                        class="transition duration-150 ease-in-out bg-gray-700 px-5 py-3
                                                        text-sm shadow-sm
                                                        font-medium tracking-wider border text-gray-100 rounded-full
                                                        hover:shadow-lg hover:bg-gray-800">LHV
                                                    </button>
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="coop"
                                                        class="transition duration-150 ease-in-out  bg-blue-600 px-5 py-3
                                                        text-sm shadow-sm
                                                        font-medium tracking-wider border text-blue-100 rounded-full
                                                        hover:shadow-lg hover:bg-blue-700">Coop
                                                    </button>
                                                @endif
                                                {{--                                                        <button--}}
                                                {{--                                                            form="sumforbank"--}}
                                                {{--                                                            type="submit"--}}
                                                {{--                                                            name="action"--}}
                                                {{--                                                            value="luminor"--}}
                                                {{--                                                            class="transition duration-150 ease-in-out bg-pink-900 px-5--}}
                                                {{--                                                py-3 text-sm shadow-sm--}}
                                                {{--                                                    font-medium tracking-wider border text-pink-100 rounded-full--}}
                                                {{--                                                    hover:shadow-lg hover:bg-pink-800">Luminor--}}
                                                {{--                                                        </button>--}}
                                                {{--                                                        <button--}}
                                                {{--                                                            form="sumforbank"--}}
                                                {{--                                                            type="submit"--}}
                                                {{--                                                            name="action"--}}
                                                {{--                                                            value="citadele"--}}
                                                {{--                                                            class="transition duration-150 ease-in-out bg-red-600 px-5--}}
                                                {{--                                                py-3 text-sm shadow-sm font-medium--}}
                                                {{--                                                     tracking-wider border text-red-100 rounded-full hover:shadow-lg--}}
                                                {{--                                                     hover:bg-red-700">Citadele--}}
                                                {{--                                                        </button>--}}
                                                @if($pp)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="paypal"
                                                        class="transition duration-150 ease-in-out bg-blue-800 px-5
                                                py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-blue-100 rounded-full hover:shadow-lg
                                                     hover:bg-blue-900">Paypal
                                                    </button>
                                                @endif
                                                @if($db)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="donorbox"
                                                        class="transition duration-150 ease-in-out bg-white px-5
                                                py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-red-400 rounded-full hover:shadow-lg
                                                     hover:bg-gray-50 inline-flex items-center">
                                                        <span>Credit cards (Donorbox)</span>
                                                    </button>
                                                @endif
                                            </div>
                                            <div x-show="tab === 'standing'" class="p-1 mt-2 text-center space-x-1
                                            space-y-2">
                                                @if($iban)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="swed-standing"
                                                        class="transition duration-150 ease-in-out bg-yellow-500 px-5 py-3
                                                        text-sm shadow-sm font-medium
                                                            tracking-wider border text-yellow-100 rounded-full
                                                            hover:shadow-lg hover:bg-yellow-600">Swedbank
                                                    </button>
                                                    @if($sebuid)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="seb-standing"
                                                            class="transition duration-150 ease-in-out bg-green-500 px-5 py-3
                                                         text-sm shadow-sm
                                                        font-medium tracking-wider border text-green-100 rounded-full
                                                        hover:shadow-lg hover:bg-green-600">SEB
                                                        </button>
                                                    @endif
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="lhv-standing"
                                                        class="transition duration-150 ease-in-out bg-gray-700 px-5 py-3
                                                        text-sm shadow-sm
                                                        font-medium tracking-wider border text-gray-100 rounded-full
                                                        hover:shadow-lg hover:bg-gray-800">LHV
                                                    </button>
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="coop-standing"
                                                        class="transition duration-150 ease-in-out  bg-blue-600 px-5 py-3
                                                        text-sm shadow-sm
                                                        font-medium tracking-wider border text-blue-100 rounded-full
                                                        hover:shadow-lg hover:bg-blue-700">Coop
                                                    </button>
                                                @endif
                                                @if($db)
                                                    <button
                                                        form="sumforbank"
                                                        type="submit"
                                                        name="action"
                                                        value="donorbox-standing"
                                                        class="transition duration-150 ease-in-out bg-white px-5
                                                py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-red-400 rounded-full hover:shadow-lg
                                                     hover:bg-gray-50 inline-flex items-center">
                                                        <span>Credit cards (Donorbox)</span>
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
