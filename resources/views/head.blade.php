<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="@yield('description', config('app.description'))"/>
<meta name="keywords" content="@yield('keywords', config('app.keywords'))"/>
<meta name="copyright" content="{{ config('app.name') }}">
<meta name="author" content="{{ config('app.name') }}"/>
<meta name="application-name" content="@yield('title', config('app.name'))">
<!--GEO Tags-->
<meta name="DC.title" content="@yield('title', config('app.name'))"/>
<meta name="geo.region" content="GB-HMF"/>
<meta name="geo.placename" content="London"/>
<meta name="geo.position" content="51.493272;-0.239747"/>
<meta name="ICBM" content="51.493272, -0.239747"/>
<!--Facebook Tags-->
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:type" content="article"/>
<meta property="og:url" content="{{ request()->fullUrl() }}"/>
<meta property="og:title" content="@yield('title', config('app.name'))"/>
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

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="{{ asset('js/share.js') }}"></script>
<script src="https://kit.fontawesome.com/6940ba20ce.js" crossorigin="anonymous"></script>

<style>
    body {
        font-family: 'Space Grotesk', sans-serif;
    }
</style>

