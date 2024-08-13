<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Payment link for {!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}</title>
    <meta property="og:title" content="{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}">
    @include('head')
</head>
<body class="antialiased">
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">

        <div class="grid grid-cols-2 items-center mb-4">
            <div class="w-32">
                <a href="/" target="_blank">
                    <img class="mx-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png">
                </a>
            </div>
            <div class="">
                @include('components.lang-switcher')
            </div>
        </div>

        @include('components.payment-link')

        @include('footer')
    </div>
</div>

</div>

</body>
</html>
