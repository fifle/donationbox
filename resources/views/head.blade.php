<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="@yield('description', config('app.description'))"/>
<meta name="keywords" content="@yield('keywords', config('app.keywords'))"/>
<meta name="copyright" content="{{ config('app.name') }}">
<meta name="author" content="{{ config('app.name') }}"/>
<meta name="application-name" content="@yield('title', config('app.name'))">
<!--Facebook Tags-->
<meta property="og:type" content="article"/>
<meta property="og:url" content="{{ request()->fullUrl() }}"/>
<meta property="og:description" content="@yield('description', config('app.description'))"/>
<meta property="og:image" content="{{ request()->root() }}/images/TODO.png"/>
<meta property="article:author" content="https://www.facebook.com/TODO"/>
<meta property="og:locale" content="en_UK"/>
<!--Twitter Tags-->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="{{ '@' . config('app.name') }}"/>
<meta name="twitter:title" content="@yield('title', config('app.name'))"/>
<meta name="twitter:description" content="@yield('description', config('app.description'))"/>
<meta name="twitter:image" content="{{ request()->root() }}/images/TODO.png"/>

<title>DonationBox</title>

<!-- Fonts -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap');
</style>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="//unpkg.com/alpinejs" defer></script>
<script src="//kit.fontawesome.com/6940ba20ce.js" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<!-- Matomo -->
<script>
    var _paq = window._paq = window._paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="https://donationboxee.matomo.cloud/";
        _paq.push(['setTrackerUrl', u+'matomo.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.async=true; g.src='//cdn.matomo.cloud/donationboxee.matomo.cloud/matomo.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<!-- End Matomo Code -->


<style>
    body {
        font-family: 'Space Grotesk', sans-serif;
    }
</style>

