<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="embed-page">
<head>
    <title>{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}</title>
    <meta property="og:title" content="{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.{{ env('COUNTRY') }}">
    @include('head')
    <style>html.embed-page, html.embed-page body { background: transparent !important; }</style>

    {{-- Dark mode styles for embed page --}}
    <style>
    /* ── Base ─────────────────────────────────────────────── */
    html.embed-dark, html.embed-dark body {
        color-scheme: dark;
    }

    /* ── Text colors ──────────────────────────────────────── */
    html.embed-dark .text-gray-900 { color: #f3f4f6 !important; }
    html.embed-dark .text-gray-700 { color: #e5e7eb !important; }
    html.embed-dark .text-gray-600 { color: #d1d5db !important; }
    html.embed-dark .text-gray-500 { color: #9ca3af !important; }
    html.embed-dark .text-gray-400 { color: #9ca3af !important; }

    /* Links */
    html.embed-dark .text-blue-700  { color: #93c5fd !important; }
    html.embed-dark .text-blue-600  { color: #93c5fd !important; }
    html.embed-dark a.text-blue-700:hover,
    html.embed-dark .hover\:text-blue-800:hover { color: #bfdbfe !important; }

    /* Hover text overrides */
    html.embed-dark .hover\:text-gray-700:hover { color: #e5e7eb !important; }
    html.embed-dark .hover\:text-gray-800:hover { color: #f3f4f6 !important; }

    /* ── Glass card (form container) ──────────────────────── */
    html.embed-dark .donation-form-card {
        background: rgba(30, 30, 40, 0.82) !important;
        border-color: rgba(255, 255, 255, 0.10) !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4) !important;
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
    }

    /* ── Step number circles ──────────────────────────────── */
    html.embed-dark .bg-yellow-100 {
        background-color: rgba(202, 138, 4, 0.25) !important;
    }

    /* ── Donation amount input ────────────────────────────── */
    html.embed-dark #donationsum {
        background: rgba(255, 255, 255, 0.07) !important;
        border-color: rgba(255, 255, 255, 0.15) !important;
        color: #f3f4f6 !important;
    }
    html.embed-dark #donationsum::placeholder {
        color: #6b7280 !important;
    }
    html.embed-dark #taxik {
        background: rgba(255, 255, 255, 0.07) !important;
        border-color: rgba(255, 255, 255, 0.15) !important;
        color: #f3f4f6 !important;
    }

    /* Euro sign */
    html.embed-dark .pointer-events-none .text-gray-500 {
        color: #9ca3af !important;
    }

    /* ── Preset amount buttons & inactive payment-type buttons */
    html.embed-dark .bg-white\/70,
    html.embed-dark [class*="bg-white/70"] {
        background: rgba(255, 255, 255, 0.08) !important;
    }
    html.embed-dark .border-gray-200\/80,
    html.embed-dark [class*="border-gray-200/80"] {
        border-color: rgba(255, 255, 255, 0.12) !important;
    }
    html.embed-dark .border-gray-200 {
        border-color: rgba(255, 255, 255, 0.12) !important;
    }
    html.embed-dark .hover\:bg-white:hover {
        background: rgba(255, 255, 255, 0.15) !important;
    }
    html.embed-dark .hover\:bg-gray-100\/80:hover,
    html.embed-dark [class*="hover:bg-gray-100/80"]:hover {
        background: rgba(255, 255, 255, 0.10) !important;
    }
    html.embed-dark .hover\:bg-gray-50:hover {
        background: rgba(255, 255, 255, 0.10) !important;
    }

    /* ── Active payment-type tab (pink) ───────────────────── */
    html.embed-dark .bg-pink-100\/80,
    html.embed-dark [class*="bg-pink-100/80"] {
        background-color: rgba(236, 72, 153, 0.20) !important;
    }
    html.embed-dark .text-pink-800 { color: #f9a8d4 !important; }
    html.embed-dark .border-pink-200\/80,
    html.embed-dark [class*="border-pink-200/80"] {
        border-color: rgba(236, 72, 153, 0.30) !important;
    }

    /* ── Revolut button (white bg in light mode) ──────────── */
    html.embed-dark button[value="rev"] {
        background: rgba(255, 255, 255, 0.08) !important;
        border-color: rgba(255, 255, 255, 0.15) !important;
    }
    html.embed-dark button[value="rev"]:hover {
        background: rgba(255, 255, 255, 0.14) !important;
    }

    /* ── Error / no-payment-methods box ───────────────────── */
    html.embed-dark .bg-red-50  { background-color: rgba(239, 68, 68, 0.12) !important; }
    html.embed-dark .border-red-200 { border-color: rgba(239, 68, 68, 0.30) !important; }
    html.embed-dark .text-red-800 { color: #fca5a5 !important; }
    html.embed-dark .text-red-700 { color: #fca5a5 !important; }

    /* ── Tax-return checkbox label ─────────────────────────── */
    html.embed-dark label[for="ikcheckbox"] { color: #d1d5db !important; }

    /* ── Secure block ─────────────────────────────────────── */
    html.embed-dark .secure-block,
    html.embed-dark .secure-block a {
        color: #9ca3af !important;
    }
    html.embed-dark .secure-block a:hover {
        color: #d1d5db !important;
    }

    /* ── Skip-to-content link (when focused) ──────────────── */
    html.embed-dark a[href="#main-content"]:focus {
        background: #1f2937 !important;
        color: #f3f4f6 !important;
    }

    /* ── Tooltip ──────────────────────────────────────────── */
    html.embed-dark #tooltip-click {
        background-color: #4b5563 !important;
    }
    </style>

    {{-- Dark mode detection script (runs before paint to prevent flash) --}}
    <script>
    (function() {
        var params = new URLSearchParams(window.location.search);
        var themeParam = params.get('theme');

        function applyTheme(isDark) {
            if (isDark) {
                document.documentElement.classList.add('embed-dark');
            } else {
                document.documentElement.classList.remove('embed-dark');
            }
        }

        // Priority: query param > OS / browser preference
        if (themeParam === 'dark') {
            applyTheme(true);
        } else if (themeParam === 'light') {
            applyTheme(false);
        } else {
            // Auto-detect via prefers-color-scheme (best proxy for host site dark mode)
            var mq = window.matchMedia('(prefers-color-scheme: dark)');
            applyTheme(mq.matches);

            // React to live OS theme changes
            mq.addEventListener('change', function(e) {
                if (!themeParam) applyTheme(e.matches);
            });
        }

        // Listen for postMessage from parent page for dynamic switching
        // Usage: iframe.contentWindow.postMessage({ type: 'donationbox-theme', theme: 'dark' }, '*')
        window.addEventListener('message', function(event) {
            if (event.data && event.data.type === 'donationbox-theme') {
                if (event.data.theme === 'dark' || event.data.theme === 'light') {
                    applyTheme(event.data.theme === 'dark');
                }
            }
        });
    })();
    </script>
</head>
<body class="antialiased relative embed-page">
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-50 focus:p-2 focus:bg-white focus:text-gray-900 focus:underline">@lang("Skip to main content")</a>
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">
        <main id="main-content" role="main">
            @include('form')
        </main>
        <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-center gap-4 sm:gap-6">
            <a href="/" target="_blank" aria-label="@lang('Return to homepage')" class="flex justify-center flex-shrink-0">
                <img class="h-6 w-auto sm:h-7" src="/img/db-logo-fl-{{ env('COUNTRY') }}.png" alt="@lang('DonationBox')">
            </a>
        </div>
    </div>
</div>

</body>
</html>
