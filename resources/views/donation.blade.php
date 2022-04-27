<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.ee</title>
    @include('head')
</head>
<body class="antialiased">
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">
        <div class="mb-6 w-1/3 mx-auto">
            <a href="/" target="_blank">
                <img class="mx-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png">
            </a>
        </div>
        @include('form')
        <!-- COPY LINK -->
        <div class="bg-white rounded-lg p-5 mt-10 shadow justify-between">
            <div class="content-center">
                <h3 class="mb-2 text-center text-1xl font-bold text-gray-600">
                    Share this donation box with your friends!
                </h3>
                <div class="mt-2 flex items-center justify-center">
                {!! Share::page(urlencode(url()->full()), urldecode($campaign_title))->facebook()->twitter()
                ->linkedin()
                ->whatsapp() !!}
                <!-- Trigger -->
                    <button href="#_" class="transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-3 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2"
                            data-clipboard-text="{{ $link }}" >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> Copy link
                    </button>
                </div>
            </div>
        </div>

        <!-- QR CODE -->
        <div class="bg-white rounded-lg p-5 mt-8 shadow justify-between">
            <div class="content-center">
                <div class="mt-4" x-data="app()" x-cloak>
                        <div id="qrcode">{{ $qrcode }}</div>
                </div>
                <div class="p-1 mt-4 text-center">
                    <a href="data:image/png;base64, {!! base64_encode($qrcode) !!}" class="no-underline text-mg
                    text-blue-800" download="donationbox-qr.svg">
                        <div class="transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-3 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
                .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            Download QR-code (SVG)
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- EMBED WIDGET -->
        <div class="bg-white rounded-lg p-5 mt-10 shadow justify-between">
            <h3 class="mb-2 text-center text-1xl font-bold text-gray-600">
                Embed this donation box to your website
            </h3>

            <div class="flex items-center justify-center">
                <!-- Target -->
                <input id="foo"
                       class="w-2/3 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight
                       focus:outline-none focus:shadow-outline"
                       value="{{ sprintf("<embed src='%s' width='100%%' height='900' style='border:none;overflow:hidden'></embed>", $embedlink) }}">

                <!-- Trigger -->
                <button href="#_" class="transition duration-150 ease-in-out
                                                        focus:outline-none py-2 px-3 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-sm border focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto inline-flex items-center ml-2"
                        data-clipboard-target="#foo">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
            .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> Copy code
                </button>
            </div>

        </div>

        @include('footer')
    </div>
</div>

</div>

</body>
</html>
