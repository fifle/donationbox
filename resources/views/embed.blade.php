<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.ee</title>
    @include('head')
</head>
<body class="antialiased">
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
{{--    <div class="max-w-md w-full space-y-2">--}}
{{--        <div class="grid grid-cols-2 items-center mb-4">--}}
{{--            <div class="w-32">--}}
{{--                <a href="/" target="_blank">--}}
{{--                    <img class="mx-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png">--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="">--}}
{{--                @include('components.lang-switcher')--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @include('form')--}}
{{--    </div>--}}

    <div class="max-w-md w-full space-y-2">
        @include('form')
        <div class="mt-8 w-1/4 mx-auto">
            <a href="/" target="_blank">
                <img class="mx-auto" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png">
            </a>
        </div>
    </div>

</div>

</body>
</html>
