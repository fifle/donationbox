<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@lang('Payment link for :campaign', ['campaign' => urldecode($campaign_title)]) | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}</title>
    <meta property="og:title" content="@lang('Payment link for :campaign', ['campaign' => urldecode($campaign_title)]) | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}">
    @include('head')
</head>
<body class="antialiased">
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-white focus:text-gray-900 focus:underline">@lang("Skip to main content")</a>

<style>
    .home-page {
        position: relative;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .home-page-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        background:
            radial-gradient(ellipse 80% 60% at 20% 30%, rgba(253, 242, 248, 0.95) 0%, transparent 55%),
            radial-gradient(ellipse 70% 50% at 80% 20%, rgba(255, 251, 235, 0.7) 0%, transparent 50%),
            radial-gradient(ellipse 60% 70% at 60% 70%, rgba(251, 207, 232, 0.7) 0%, transparent 50%),
            radial-gradient(ellipse 50% 60% at 10% 80%, rgba(254, 249, 215, 0.6) 0%, transparent 50%),
            radial-gradient(ellipse 40% 50% at 50% 50%, rgba(253, 242, 248, 0.5) 0%, transparent 55%),
            linear-gradient(165deg, #fffffe 0%, #fffef5 50%, #fffffe 100%);
        background-size: 100% 100%;
        background-attachment: fixed;
    }
    .glass {
        background: rgba(255, 255, 255, 0.72);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
    }
    .glass-strong {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    }
    .home-page .home-page-footer {
        position: relative;
        z-index: 60;
        isolation: isolate;
        color: #4b5563;
        transform: translateZ(0);
    }
    .home-page .home-page-footer footer {
        color: inherit;
    }
    .home-page .home-page-footer a {
        color: #1e40af;
    }
</style>

<div class="home-page flex flex-col min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="home-page-bg" aria-hidden="true"></div>

    <div class="max-w-lg w-full mx-auto flex-1 flex flex-col space-y-4 relative z-10 min-h-[calc(100vh-6rem)]">
        <header role="banner" class="fixed top-4 right-4 sm:top-6 sm:right-6 left-auto">
            <div class="glass rounded-xl px-3 py-2">
                @include('components.lang-switcher')
            </div>
        </header>

        <div class="items-center justify-center mt-36 mb-8 text-center">
            <a href="/" aria-label="@lang('Return to homepage')" class="inline-block">
                <img class="mx-auto h-10 sm:h-12 w-auto object-contain" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox') logo - @lang('Return to homepage')">
            </a>
            <h1 class="mt-6 text-lg sm:text-xl font-medium text-gray-600 tracking-tight">
                @lang("Cashier mode")
            </h1>
            <div class="mt-2 text-sm text-gray-500">
                @lang("Scan this QR-code for payment")
            </div>
        </div>

        <main id="main-content" role="main" class="space-y-4">
            @include('components.payment-link')
        </main>

        <div class="home-page-footer mt-auto flex-shrink-0 pt-4">
            @include('footer')
        </div>
    </div>
</div>

</body>
</html>
