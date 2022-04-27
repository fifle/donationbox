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
<meta name="image" property="og:image" content="/img/db-social.jpg"/>
<meta property="article:author" content=""/>
<meta property="og:locale" content="en_UK"/>
<!--Twitter Tags-->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="{{ '@' . config('app.name') }}"/>
<meta name="twitter:title" content="@yield('title', config('app.name'))"/>
<meta name="twitter:description" content="@yield('description', config('app.description'))"/>
<meta name="twitter:image" content="/img/db-social.jpg"/>

<title>DonationBox</title>

<!-- Fonts -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap');
</style>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
{{--<script defer src="{{ asset('js/alpine.js') }}"></script>--}}
<script src="//kit.fontawesome.com/6940ba20ce.js" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

@if(env('COUNTRY') == 'ee')
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
@elseif(env('COUNTRY') == 'lv')
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
@elseif(env('COUNTRY') == 'lt')
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
        font-family: 'Space Grotesk', 'Source Sans Pro', sans-serif;
    }
    input {
        font-family: 'Space Grotesk', 'Source Sans Pro', sans-serif;
    }
    body {
        font-family: 'Source Sans Pro', sans-serif;
    }
    .d-font {
        font-family: 'Space Grotesk', 'Source Sans Pro', sans-serif;
    }
</style>
