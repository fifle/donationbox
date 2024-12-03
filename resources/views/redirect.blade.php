<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@lang("Redirecting to payment page...") | DonationBox.{{ env('COUNTRY') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Force WebView to handle redirect properly -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    @include('head')
</head>
<body class="antialiased">
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">

        <div class="bg-white rounded-lg p-8 shadow justify-between">
            <div class="content-center">
                <h3 class="mb-4 text-center text-1xl font-bold text-gray-600">
                    @lang("Redirecting to payment page...")
                </h3>

                <div class="flex justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ $url }}" id="redirectLink" class="d-font btn transition duration-150 ease-in-out
                       focus:outline-none py-3 px-4 rounded-lg
                       shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                       text-sm border focus:ring-1 focus:ring-offset-1
                       focus:ring-pink-700 w-auto inline-flex items-center">
                        @lang("Click here to proceed to payment")
                    </a>
                </div>
            </div>
        </div>

        <!-- Logo at bottom -->
        <div class="mt-8 w-1/4 mx-auto">
            <a href="/" target="_blank">
                <img class="mx-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="DonationBox.{{ env('COUNTRY') }}">
            </a>
        </div>

    </div>
</div>

<script>
    // Detect Telegram WebView
    function isTelegramWebView() {
        return navigator.userAgent.toLowerCase().indexOf('telegram') > -1;
    }

    // Handle redirect based on platform
    if (isTelegramWebView() && /Android/i.test(navigator.userAgent)) {
        // For Telegram Android WebView: show manual button and wait for user interaction
        document.getElementById('redirectLink').style.display = 'inline-flex';
    } else {
        // For all other browsers: automatic redirect
        setTimeout(function() {
            window.location.href = "{{ $url }}";
        }, 1000);
    }
</script>

</body>
</html>
