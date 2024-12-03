<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@lang("Proceeding to") {{ $bankname }} | DonationBox.{{ env('COUNTRY') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @include('head')
    <style>
        .loader {
            border: 3px solid #f3f3f3;
            border-radius: 50%;
            border-top: 3px solid #EC4899; /* Tailwind pink-500 */
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="antialiased">
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">
        <div class="bg-white rounded-lg p-8 shadow justify-between">
            <div class="content-center">
                <h3 class="mb-4 text-center text-1xl font-bold text-gray-600">
                    @lang("Proceeding to") {{ $bankname }}
                </h3>

                <div class="text-center text-sm text-gray-500 mb-6">
                    @if($campaign_title)
                        <div class="mb-4">
                            {!! urldecode($campaign_title) !!}
                        </div>
                    @endif
                    <div class="mb-4">
                        @lang("You will be redirected automatically in") <span id="countdown">5</span> @lang("seconds")
                    </div>
                    <div class="loader mb-4"></div>
                    @lang("Or click the button below to proceed immediately.")
                </div>

                <div class="text-center space-y-4">
                    <!-- Primary action button -->
                    <a href="{{ $url }}" class="d-font btn transition duration-150 ease-in-out
                       focus:outline-none py-3 px-4 rounded-lg
                       shadow-sm text-center text-white bg-pink-500 hover:bg-pink-700
                       text-sm focus:ring-1 focus:ring-offset-1
                       focus:ring-pink-700 w-auto inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                        @lang("Open payment page")
                    </a>
                </div>
            </div>
        </div>

        <!-- Logo at bottom -->
        <div class="mt-8 pt-8 w-1/4 mx-auto">
            <a href="/" target="_blank">
                <img class="mx-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="DonationBox.{{ env('COUNTRY') }}">
            </a>
        </div>
    </div>
</div>

<script>
    // Simple redirect after delay
    const totalTime = 5; // seconds
    let timeLeft = totalTime;
    const countdownElement = document.getElementById('countdown');

    const countdown = setInterval(() => {
        timeLeft--;
        countdownElement.textContent = timeLeft;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            window.location = '{{ $url }}';
        }
    }, 1000);
</script>

</body>
</html>
