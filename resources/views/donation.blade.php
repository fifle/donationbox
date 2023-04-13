<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}</title>
    @include('head')

</head>
<body class="antialiased">
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">

        <div class="grid grid-cols-2 items-center mb-4">
            <div class="w-32">
                <a href="/" target="_blank">
                    <img class="mx-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="Donationbox.{{ env('COUNTRY') }}">
                </a>
            </div>
            <div class="">
                @include('components.lang-switcher')
            </div>
        </div>

        @include('form')

    <!-- COPY LINK -->
        @if(!$s0)
        <div class="bg-white rounded-lg p-5 mt-10 shadow justify-between">
            <div class="content-center">
                <h3 class="mb-2 text-center text-1xl font-bold text-gray-600">
                    @lang("Share this donation box with your friends!")
                </h3>
                <div class="mt-2 flex items-center justify-center">
                {!! Share::page(urlencode(url()->full()), urldecode($campaign_title))->facebook()->twitter()
                ->linkedin()
                ->whatsapp() !!}
                <!-- Trigger -->
                    <a href="#_" class="d-font btn transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-3 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        text-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2"
                            data-clipboard-text="{{ $link }}" >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> @lang("Copy link")
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- QR CODE -->
        @if(!$s0)
        <div class="bg-white rounded-lg p-5 mt-8 shadow justify-between">
            <div class="content-center">
                <h3 class="mb-2 text-center text-1xl font-bold text-gray-600">
                    @lang("Download your QR-code")
                </h3>
                <div class="mt-4" x-data="app()" x-cloak>
                        <div id="qrcode">{{ $qrcode }}</div>
                </div>

                <div class="p-1 mt-4 text-center">
{{--                    <a href="{{ route('qrpng.show') }}" class="no-underline text-mg--}}
{{--                    text-blue-800" download="donationbox-qr.png">--}}
{{--                        <div class="d-font transition duration-150 ease-in-out--}}
{{--                                                        focus:outline-none py-2 px-3 rounded-lg--}}
{{--                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100--}}
{{--                                                        text-sm border focus:ring-1 focus:ring-offset-1--}}
{{--                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2">--}}
{{--                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>--}}
{{--                            PNG--}}
{{--                        </div>--}}
{{--                    </a>--}}
                    <a href="data:image/png;base64,{!! base64_encode($qrcode) !!}" class="no-underline text-mg
                    text-blue-800" download="donationbox-qr.svg">
                        <div class="d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-3 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        text-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            SVG
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- EMBED WIDGET -->
        @if(!$s0)
        <div class="bg-white rounded-lg p-5 mt-10 shadow justify-between">
            <h3 class="mb-2 text-center text-1xl font-bold text-gray-600">
                @lang("Embed this donation box to your website")
            </h3>

            <div class="flex items-center justify-center">
                <!-- Target -->
                <input id="foo"
                       class="w-2/3 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight
                       focus:outline-none focus:shadow-outline"
                       value="{{ sprintf("<embed src='%s' width='100%%' height='900' style='border:none;overflow:hidden'></embed>", $embedlink) }}">

                <!-- Trigger -->
                <a href="#_" class="d-font btn transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-3 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        text-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2"
                        data-clipboard-target="#foo">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> @lang("Copy code")
                </a>
            </div>

        </div>
        @endif

        @include('footer')
    </div>
</div>

</body>
</html>
