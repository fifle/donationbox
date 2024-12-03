<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@lang("Redirecting to payment page...") | DonationBox.{{ env('COUNTRY') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
                    <noscript>
                        <meta http-equiv="refresh" content="0;url={{ $url }}">
                        @lang("If you are not redirected automatically, please") <a href="{{ $url }}" class="text-blue-600 hover:underline">@lang("click here")</a>.
                    </noscript>
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
    // Redirect after a short delay
    setTimeout(function() {
        window.location.href = "{{ $url }}";
    }, 1000);
</script>

</body>
</html>
