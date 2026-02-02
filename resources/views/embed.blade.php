<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="embed-page">
<head>
    <title>{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}</title>
    <meta property="og:title" content="{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}">
    @include('head')
    <style>html.embed-page, html.embed-page body { background: transparent !important; }</style>
</head>
<body class="antialiased relative embed-page">
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-white focus:text-gray-900 focus:underline">@lang("Skip to main content")</a>
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">
        <main id="main-content" role="main">
            @include('form')
        </main>
        <div class="mt-4 pt-4 border-t border-gray-200/60 flex flex-col sm:flex-row sm:items-center sm:justify-center gap-4 sm:gap-6">
            <a href="/" target="_blank" aria-label="@lang('Return to homepage')" class="flex justify-center flex-shrink-0">
                <img class="h-6 w-auto sm:h-7" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox')">
            </a>
        </div>
    </div>
</div>

</body>
</html>
