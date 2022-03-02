<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.ee</title>
    @include('head')
</head>
<body class="antialiased">
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">
        <div>
            <div class="mt-4 mb-8 w-1/2 mx-auto">
                <a href="/" target="_blank">
                    <img class="mx-auto" src="/img/db-logo-fl.png">
                </a>
            </div>
            <h2 class="mt-0 text-center text-2xl font-bold text-gray-900">
                {!! urldecode($campaign_title) !!}
            </h2>
            <div class="mt-2 mb-4 text-center text-sm text-gray-600">
                {!! urldecode($payee) !!}<br>
                {!! urldecode($iban) !!}<br>
                {!! urldecode($detail) !!}<br>
                @if($pp)
                    Paypal username: {!! urldecode($pp) !!}<br>
                @endif
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

            <div class="bg-white rounded-lg p-5 mt-10 shadow justify-between">
                <div class="content-center">
                    <p class="mt-2 mb-2 text-center text-1xl font-bold text-gray-600">
                        Scan QR-code and easily share donation box!
                    </p>
                    <img src="data:image/png;base64, {!! base64_encode($qrcode) !!}" class="p-3.5">

                    <div class="p-1 mt-2 text-center">
                        <a href="#" class="no-underline text-mg text-blue-800">
                            <div class="transition duration-150 ease-in-out bg-white
                                                     px-5 py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-gray-600 rounded-full hover:shadow-lg
                                                     hover:bg-gray-50 inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                Download QR-code as PDF
                            </div>
                        </a>
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

            <div class="mt-16 mb-4 text-center text-xs text-gray-600">
                Made with ❤ by <a href="//fleisher.ee" class="no-underline
                 hover:underline text-xs text-blue-800" target="_blank">
                    <div class="inline-flex items-center">Pavel<svg class="w-3 h-3 ml-1" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
                .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0
                 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </div>
                </a>
                and inspired by Sheila
                <br>
                <a href="//fleisher.ee" class="no-underline
                 hover:underline text-xs text-blue-800 mt-4" target="_blank">
                    <div class="inline-flex items-center">
                        Buy us a hot chocolate <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0
                        24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>

            </div>
        </div>

    </div>

    <script>
        function app() {
            return {
                step: 1,
                passwordStrengthText: '',
                togglePassword: false,

                password: '',
                gender: 'Male',

                checkPasswordStrength() {
                    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                    let value = this.password;

                    if (strongRegex.test(value)) {
                        this.passwordStrengthText = "Strong password";
                    } else if (mediumRegex.test(value)) {
                        this.passwordStrengthText = "Could be stronger";
                    } else {
                        this.passwordStrengthText = "Too weak";
                    }
                }
            }
        }
    </script>
</body>
</html>
