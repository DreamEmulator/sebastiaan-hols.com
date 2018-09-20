<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Analytics-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119163363-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-119163363-1');
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.12/js/all.js"
            integrity="sha384-Voup2lBiiyZYkRto2XWqbzxHXwzcm4A5RfdfG6466bu5LqjwwrjXCMBQBLMWh7qR"
            crossorigin="anonymous"></script>
    <!-- Styles -->
    @php
        if (session('dream_theme') !== null){$dream_theme = session('dream_theme');} else {$dream_theme = 'light';}
        if ($dream_theme == 'dark'){$change_theme = 'light';} else {$change_theme = 'dark';}
    @endphp
    <link id="dream_theme" href="{{ asset('css/' . $dream_theme .'_dream.css') }}" rel="stylesheet">

    @yield('extra_style')
    @yield('extra_js')

</head>
<body class="text-{{session('contrast') ? session('contrast') : 'dark'}}">
<nav class="navbar navbar-{{$dream_theme}} bg-{{$dream_theme}} text-{{session('contrast')}} navbar-expand-lg mb-4 border-0">
    <div class="container">
        <a class="navbar-brand border-0" href="{{ url('/') }}">
            <i class="fas fa-anchor"></i>
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <a class="border-0 nav-link text-{{session('contrast')}}" href="javascript:;"
                   onclick="event.preventDefault();document.getElementById('change_dream_theme').submit();"
                   title="Change the theme">{{$change_theme}} mode</a>
                <form id="change_dream_theme" action="{{route('change_theme')}}" method="post">
                    @csrf
                    <input name="dream_theme" type="hidden" value="{{$change_theme}}">
                </form>
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{action('PhotoController@index')}}">{{ __('Photo\'s') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{action('MusicController@index')}}">{{ __('Music') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{route('coding')}}">{{ __('Coding') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{route('about')}}">{{ __('About') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{route('login')}}">{{ __('Login') }}</a></li>
                @endguest
                @auth
                    @if (auth()->user()->isAdmin())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-{{session('contrast')}}" href="#"
                               id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Photos</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-{{session('contrast')}}"
                                   href="{{action('PhotoController@index')}}">{{ __('Photo\'s') }}</a>
                                <a class="dropdown-item text-{{session('contrast')}}"
                                   href="{{route('manage_photos')}}">{{ __('Edit Photo') }}</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-{{session('contrast')}}" href="#"
                               id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Music</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-{{session('contrast')}}"
                                   href="{{action('MusicController@index')}}">{{ __('Music') }}</a>
                                <a class="dropdown-item text-{{session('contrast')}}"
                                   href="{{route('add_music')}}">{{ __('Add Music') }}</a>
                                <a class="dropdown-item text-{{session('contrast')}}"
                                   href="{{route('manage_music')}}">{{ __('Edit Music') }}</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-{{session('contrast')}}" href="#"
                               id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Register Users</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-{{session('contrast')}}"
                                   href="{{route('register')}}">{{ __('Register User') }}</a>
                                <a class="dropdown-item text-{{session('contrast')}}"
                                   href="{{route('manage')}}">{{ __('Manage Users') }}</a>
                            </div>
                        </li>
                        <li><a class="border-0 nav-link text-{{session('contrast')}}"
                               href="{{route('coding')}}">{{ __('Coding') }}</a></li>
                        <li><a class="border-0 nav-link text-{{session('contrast')}}"
                               href="{{route('about')}}">{{ __('About') }}</a></li>
                    @endif
                    <a class="border-0 nav-link text-{{session('contrast')}}" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endauth
                <li><a class="border-0 nav-link text-{{session('contrast')}}"
                       href="{{'mailto:info@' . $_SERVER['SERVER_NAME'] . '?Subject=Hello%20there'}}" target="_top"><i
                                class="fas fa-envelope"></i></a></li>
            </ul>
        </div>
    </div>
</nav>

<div id="app">
    @yield('content')
    <hr class="featurette-divider">
</div>

@yield('non_vue')

<footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>Custom built with <i class="fas fa-heart"></i> in <i class="fab fa-laravel"></i> + <i class="fab fa-vuejs"></i> -
        &copy; Sebastiaan Hols {{date("Y")}}</p>
</footer>
</body>
</html>
