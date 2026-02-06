<div class="glass rounded-2xl p-4 mb-4">
    <h2 class="mt-0 text-center text-2xl font-semibold text-gray-700">
        {!! urldecode($campaign_title) !!}
    </h2>
    <div class="mt-2 mb-2 text-center text-sm text-gray-500 align-middle">
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
                }} / {{ urldecode($iban) }} / @lang('Payment description:') {{ urldecode($detail) }}">
            <div class="inline-flex items-center text-xs text-gray-500">
                (<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>@lang("Copy"))</div>
        </button>
        <div id="tooltip-click" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
            @lang("Copied!")
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div><br>
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

    <div class="glass-strong rounded-2xl p-6 pt-4 justify-between mb-4">
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
                                                    <form class="space-y-4" action="{{ route('plink') }}"
                                                          method="get" id="sumforbank"></form>
                                                    <input
                                                        form="sumforbank"
{{--                                                        @if($s0)--}}
{{--                                                        type="text"--}}
{{--                                                        @else--}}
                                                        type="number"
{{--                                                        @endif--}}
                                                        name="s0"
                                                        id="s0"
{{--                                                        @if($s0)--}}
{{--                                                        value="{{ $s0 }}"--}}
{{--                                                        @else--}}
                                                        value="{{ $amount }}"
{{--                                                        @endif--}}
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
                                                        name="campaign_title"
                                                        id="campaign_title"
                                                        value="{{ $campaign_title }}"
                                                    >
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
{{--                                                    @if($s0)--}}
{{--                                                        <input--}}
{{--                                                            form="sumforbank"--}}
{{--                                                            type="hidden"--}}
{{--                                                            name="s0"--}}
{{--                                                            id="s0"--}}
{{--                                                            value="{{ $s0 }}"--}}
{{--                                                        >--}}
{{--                                                    @endif--}}
                                                </div>
                                            </div>


                                        </div>


                                        <div x-data="{ show: false }">
                                            <div class="flex items-center justify-center mt-2 mb-2 pl-2">
                                                <div class="flex items-start mb-2 mt-4">
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
                                                    dark:text-gray-300">@lang("I'd like to edit payment description")</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div x-show="show" x-transition:enter.duration.500ms>
                                                <div class="mb-1 text-xs text-gray-500 text-center">
                                                    @lang("Please type new payment description")
                                                </div>
                                                <div class="flex items-center justify-center mt-0 mb-4">
                                                    <input
                                                        form="sumforbank"
                                                        type="text"
                                                        name="detail"
                                                        id="detail"
                                                        value="{{ $detail }}"
                                                        class="appearance-none rounded-none relative block
                                                                px-3 py-1 border border-gray-300
                                                               text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 text-normal
                                                               transition duration-150 ease-in-out text-center"
                                                        placeholder="{{ $detail }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="p-1 mt-2 text-center space-x-1
                                                    space-y-2" x-transition:enter.duration.500ms>
                                                            <button
                                                                form="sumforbank"
                                                                type="submit"
                                                                name="action"
                                                                value="cashier"
                                                                class="d-font btn transition duration-150 ease-in-out
                                                        focus:outline-none py-3 px-4 rounded-lg font-medium
                                                        shadow-sm text-center text-white bg-pink-500 hover:bg-pink-700
                                                        text-sm focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                                                </svg>
                                                                @lang('Generate payment link & QR-code')
                                                            </button>
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

{{--    <!-- QR CODE & COPY LINK -->--}}
{{--    <div class="bg-white rounded-lg p-8 mt-4 shadow justify-between">--}}
{{--        <div class="content-center">--}}
{{--            <div class="" x-data="app()" x-cloak>--}}
{{--                <div id="qrcode"></div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

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
