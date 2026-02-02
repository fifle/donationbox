<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="@yield('description', config('app.description'))"/>
<meta name="keywords" content="@yield('keywords', config('app.keywords'))"/>
<meta name="copyright" content="{{ config('app.name') }}">
<meta name="author" content="{{ config('app.name') }}"/>
<meta name="application-name" content="@yield('title', config('app.name'))">
<!--Facebook Tags-->
<meta property="og:type" content="website"/>
<meta property="og:url" content="{{ request()->fullUrl() }}"/>
<meta property="og:description" content="@yield('description', config('app.description'))"/>
@if(env('COUNTRY') == 'ee')
    <meta name="image" property="og:image" content="/img/db-social.jpg"/>
    <meta name="twitter:image" content="/img/db-social.jpg"/>
@elseif(env('COUNTRY') == 'lv')
    <meta name="image" property="og:image" content="/img/db-social-lv.jpg"/>
    <meta name="twitter:image" content="/img/db-social-lv.jpg"/>
@elseif(env('COUNTRY') == 'lt')
    <meta name="image" property="og:image" content="/img/db-social-lt.jpg"/>
    <meta name="twitter:image" content="/img/db-social-lt.jpg"/>
@endif

<meta property="article:author" content=""/>
<meta property="og:locale" content="en_UK"/>
<!--Twitter Tags-->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="{{ '@' . config('app.name') }}"/>
<meta name="twitter:title" content="@yield('title', config('app.name'))"/>
<meta name="twitter:description" content="@yield('description', config('app.description'))"/>

<title>DonationBox</title>

<!-- Fonts -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Wix+Madefor+Text:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap');
</style>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}?v={{ time() }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}?v={{ time() }}" rel="stylesheet">
<script>
// #region agent log
(function() {
    const logData = {
        location: 'head.blade.php:42',
        message: 'CSS files loaded',
        data: {
            appCss: '{{ asset("css/app.css") }}',
            customCss: '{{ asset("css/custom.css") }}',
            timestamp: Date.now()
        },
        timestamp: Date.now(),
        sessionId: 'debug-session',
        runId: 'run1',
        hypothesisId: 'B'
    };
    fetch('http://127.0.0.1:7245/ingest/cbb2d726-84f8-44ce-a87b-1dd0a453eccc', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(logData)
    }).catch(() => {});
})();
// #endregion
</script>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
<script defer src="{{ asset('js/alpine.js') }}"></script>
<script src="//kit.fontawesome.com/6940ba20ce.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>

@if(env('COUNTRY') == 'ee' and env('APP_ENV') != 'local')
    <!-- Matomo EE -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//analytics.fleisher.ee/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '2']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->
@elseif(env('COUNTRY') == 'lv' and env('APP_ENV') != 'local')
    <!-- Matomo LV -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//analytics.fleisher.ee/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '3']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->
@elseif(env('COUNTRY') == 'lt' and env('APP_ENV') != 'local')
    <!-- Matomo LT -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//analytics.fleisher.ee/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '4']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->
@endif

<style>
    /* Fonts */
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Wix Madefor Text', sans-serif;
    }
    input {
        font-family: 'Wix Madefor Text', sans-serif;
    }
    body {
        font-family: 'Wix Madefor Text', sans-serif;
    }
    .d-font {
        font-family: 'Wix Madefor Text', sans-serif;
    }
</style>
