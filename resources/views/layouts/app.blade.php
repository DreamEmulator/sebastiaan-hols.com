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

    <title>{{ config('app.name', 'Sebastiaan-Hols.com') }}</title>

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
    <script src="{{ asset('js/navbar.js') }}" defer></script>
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

</head>
<body class="text-{{session('contrast') ? session('contrast') : 'dark'}}">
<nav class="navbar navbar-custom navbar-{{$dream_theme}} bg-{{$dream_theme}} text-{{session('contrast')}} navbar-expand-lg mb-4 border-0">
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
            <ul class="navbar-nav ml-auto align-content-center align-items-center">
                <!-- Authentication Links -->
                @guest
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{action('BlogController@index')}}">{{ __('Dev Blog') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{action('PhotoController@index')}}">{{ __('Photo\'s') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{action('PaintingsController@index')}}">{{ __('Art Collection') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{action('MusicController@index')}}">{{ __('Music') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{route('coding')}}">{{ __('Coding') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{route('about')}}">{{ __('About') }}</a></li>
                    <li><a class="border-0 nav-link text-{{session('contrast')}}"
                           href="{{route('login')}}">{{ __('Login') }}</a></li>
                    <li>
                        <a class="border-0 nav-link text-{{session('contrast')}}" href="javascript:;"
                           onclick="event.preventDefault();document.getElementById('change_dream_theme').submit();"
                           title="Change the theme">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 299.994 299.994" style="height: 25px; width: 25px; background: #fff;    border-radius: 100%;
    border: 1px solid #fff; enable-background:new 0 0 299.994 299.994;"
                                 xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path d="M148.75,87.806c-17.424,0.568-37.578,10.605-37.576,37.143c0,13.445,7.965,21.42,16.402,29.865
                                                c3.278,3.278,6.608,6.611,9.306,10.32h23.739c2.695-3.706,6.025-7.042,9.306-10.32c8.434-8.445,16.399-16.42,16.399-29.865
                                                C186.326,98.411,166.171,88.374,148.75,87.806z"/>
                                            <path d="M149.997,0C67.156,0,0,67.156,0,149.997c0,82.839,67.156,149.997,149.997,149.997s149.997-67.158,149.997-149.997
                                                C299.995,67.156,232.839,0,149.997,0z M148.75,218.471c-12.893,0-23.342-11.085-23.342-24.766h46.685
                                                C172.095,207.388,161.643,218.471,148.75,218.471z M170.412,180.695h-43.326c-1.167-12.753-31.476-23.871-31.476-55.747
                                                c0-34.002,25.425-52.027,53.137-52.709c0,0,0,0,0.005,0c27.71,0.682,53.135,18.708,53.135,52.709
                                                C201.887,156.824,171.576,167.942,170.412,180.695z"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <form id="change_dream_theme" action="{{route('change_theme')}}" method="post">
                            @csrf
                            <input name="dream_theme" type="hidden" value="{{$change_theme}}">
                        </form>
                    </li>
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
                                   href="{{route('manage_photos')}}">{{ __('Edit Photo\'s') }}</a>
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
                       href="{{'mailto:s.hols@icloud.com?Subject=Hello%20there'}}" target="_top"><i
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
    <p>Built from scratch with <i class="fas fa-heart"></i> in <i class="fab fa-laravel"></i> + <i
                class="fab fa-vuejs"></i> by Sebastiaan Hols {{date("Y")}}</p>
</footer>
@yield('extra_js')
</body>
</html>
