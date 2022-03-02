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
                <img class="mx-auto" src="/img/db-logo-fl.png">
            </a>
        </div>
        @include('form')
        <div class="bg-white rounded-lg p-5 mt-8 shadow justify-between">
            <div class="content-center">
                <p class="mt-2 mb-2 text-center text-1xl font-bold text-gray-600">
                    Scan QR-code and easily share donation box!
                </p>
                <img src="data:image/png;base64, {!! base64_encode($qrcode) !!}" class="p-3.5">

                <div class="p-1 mt-2 text-center">
                    {{--                    <a href="#" class="no-underline text-mg text-blue-800">--}}
                    {{--                        <div class="transition duration-150 ease-in-out bg-white--}}
                    {{--                                                     px-5 py-3 text-sm shadow-sm font-medium--}}
                    {{--                                                     tracking-wider border text-gray-600 rounded-full hover:shadow-lg--}}
                    {{--                                                     hover:bg-gray-50 inline-flex items-center">--}}
                    {{--                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"--}}
                    {{--                                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>--}}
                    {{--                            Download QR-code as PDF--}}
                    {{--                        </div>--}}
                    {{--                    </a>--}}
                    <a href="data:image/png;base64, {!! base64_encode($qrcode) !!}" class="no-underline text-mg
                    text-blue-800" download="donationbox-{{$iban}}.png">
                        <div class="mt-2 transition duration-150 ease-in-out bg-white
                                                     px-5 py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-gray-600 rounded-full hover:shadow-lg
                                                     hover:bg-gray-50 inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Download QR-code as an PNG image
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-5 mt-10 shadow justify-between">
            <div class="content-center">
                <p class="mt-2 mb-2 text-center text-1xl font-bold text-gray-600">
                    Share this donation box with your friends!
                </p>
                <div class="mt-2 inline-flex items-center">
                {!! Share::page(url()->full(), urldecode($campaign_title))->facebook()->twitter()->linkedin()->whatsapp() !!}
                <!-- Trigger -->
                    <button href="#_" class="btn px-4 py-2.5 ml-2 font-medium bg-blue-50 hover:bg-blue-100
                            hover:text-blue-600
                text-blue-500 rounded-lg text-sm inline-flex items-center" data-clipboard-text="{{ $link }}" >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg> Copy link to clipboard
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-5 mt-10 shadow justify-between">
            <p class="mt-2 mb-2 text-center text-1xl font-bold text-gray-600">
                Embed your donation box to your webpage
            </p>

            <!-- Target -->
            <input id="foo"
                   class="shadow appearance-none border rounded py-2 px-3 w-auto text-gray-700 leading-tight
                       focus:outline-none focus:shadow-outline"
                   value="{{ sprintf("<iframe src='%s' width='500' height='800' style='border:none;overflow:hidden'
                        scrolling='no' frameborder='0' allowfullscreen='true' allow='autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share'></iframe>", $embedlink) }}">

            <!-- Trigger -->
            <button href="#_" class="btn px-3 py-2.5 font-medium bg-blue-50 hover:bg-blue-100 hover:text-blue-600
                text-blue-500 rounded-lg text-sm inline-flex items-center" data-clipboard-target="#foo">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                Copy to clipboard
            </button>

            <script type="text/javascript">
                var Clipboard = new ClipboardJS('.btn');
            </script>
        </div>


        @include('footer')
    </div>
</div>

</div>

</body>
</html>
