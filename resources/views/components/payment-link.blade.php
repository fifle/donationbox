<div>
{{--    <h2 class="mt-0 ml-3 mr-3 text-center text-2xl font-semibold text-gray-700">--}}
{{--        {!! urlencode($campaign_title) !!}--}}
{{--    </h2>--}}
{{--    <div class="mt-2 mb-4 ml-3 mr-3 text-center text-sm text-gray-500 align-middle">--}}
{{--        {!! urlencode($payee) !!}--}}
{{--        @if($iban)--}}
{{--            / {!! urlencode($iban) !!}--}}
{{--        @endif--}}
{{--        @if($pp)--}}
{{--            / <i class="fa-brands fa-paypal text-gray-400"></i> {!! urlencode($pp) !!}--}}
{{--        @endif<br>--}}
{{--    {!! urldecode($detail) !!}--}}
{{--    <!-- Trigger -->--}}
{{--        <button data-tooltip-target="tooltip-click" data-tooltip-trigger="click" type="button" class="btn "--}}
{{--                data-clipboard-text="{{--}}
{{--                urldecode($payee)--}}
{{--                }} / {{ urldecode($iban) }} / @lang('Payment description:') {{ urldecode($detail) }}">--}}
{{--            <div class="inline-flex items-center text-xs text-gray-500">--}}
{{--                (<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3--}}
{{--            .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>@lang("Copy"))</div>--}}
{{--        </button>--}}
{{--        <div id="tooltip-click" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">--}}
{{--            Copied!--}}
{{--            <div class="tooltip-arrow" data-popper-arrow></div>--}}
{{--        </div><br>--}}
{{--    </div>--}}

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

        <!-- QR CODE & COPY LINK -->
        <div class="glass-strong rounded-2xl p-6 md:p-8 mt-4 justify-between">
            <div class="content-center">
                <h3 class="mb-4 text-center text-1xl font-bold text-gray-600">
                    @lang("Scan this QR-code for payment")
                </h3>
                <div class="" x-data="app()" x-cloak>
                    <div id="qrcode">{{ $qrcode }}</div>
                </div>
                <h3 class="mt-8 mb-2 text-center text-1xl font-bold text-gray-600">
                    @lang("Or copy direct link for payment form")
                </h3>

                <!-- Trigger -->
                <div class="p-1 mt-2 text-center space-x-1 space-y-2">
                <a href="#" class="d-font btn transition duration-150 ease-in-out
                                                        focus:outline-none py-3 px-4 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        text-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center"
                   data-clipboard-text="{{ $link }}" >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    @lang("Copy link")
                </a>
                </div>

                <div class="p-1 mt-4 text-center space-x-1 space-y-2">
                    <a href="{{ $link }}" class="d-font btn transition duration-150 ease-in-out
                                                        focus:outline-none py-3 px-4 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        text-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center"
                       target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        @lang("Open the link")
                    </a>
                    <a href="{{ $cashierLink }}" class="d-font btn transition duration-150 ease-in-out
                                                        focus:outline-none py-3 px-4 rounded-lg font-medium
                                                        shadow-sm text-center text-white bg-pink-500 hover:bg-pink-700
                                                        text-sm focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center"
                       >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        @lang('Start over')
                    </a>
                </div>
            </div>
        </div>

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
