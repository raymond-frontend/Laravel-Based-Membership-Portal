<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <meta name="description" content="The Institute of Chartered Mediators and Conciliators (ICMC) is the professional body of practitioners in Nigeria that regulates and sets standards for the practice of Mediation and Conciliation" />
    <meta name="author" content="Oyinlola Olasunkanmi Raymond. Fullstack Web developer, Kuala Lumpur, Malaysia." />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="The Institute of Chartered Mediators and Conciliators (ICMC) is the professional body of practitioners in Nigeria that regulates and sets standards for the practice of Mediation and Conciliation" />
    <meta property="og:url" content="https://icmccommunity.com/" />
    <meta property="og:site_name" content="ICMC Professional Community" />
    <meta property="og:image" content="https://icmccommunity.com/assets/img/background/new-icmc-01.svg" />
    <meta property="og:image:secure_url" content="https://icmccommunity.com/assets/img/background/new-icmc-01.svg" />
    <meta property="og:image:width" content="981" />
    <meta property="og:image:height" content="552" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="The Institute of Chartered Mediators and Conciliators (ICMC) is the professional body of practitioners in Nigeria that regulates and sets standards for the practice of Mediation and Conciliation" />
    <meta name="twitter:title" content="ICMC Professional Community" />
    <meta name="twitter:site" content="The Institute of Chartered Mediators and Conciliators (ICMC) is the professional body of practitioners in Nigeria that regulates and sets standards for the practice of Mediation and Conciliation" />
    <meta name="twitter:image" content="https://icmccommunity.com/assets/img/background/new-icmc-01.svg" />
    <meta name="twitter:creator" content="" />
    <link rel="shortcut icon" href="/assets/img/logos/favicon.png" type="image/x-icon" />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
     <style>
  .spix{
    margin-top:120px;
  }

  @media only screen and (max-width: 1200px) {
  .spix {
    margin-top:0px;
  }
}
  </style>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                     <span class="align-middle"><img src="/assets/img/logos/logo.jpg" alt="" height="60"></span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('allmembers') }}">{{ __('Find a Mediator') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                    @if (Auth::user()->isAdmin())
                                    href="{{route('adminUsers')}}" 
                                    @else
                                     href="{{route('home')}}"
                                    @endif
                                    >Home</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @extends('layouts.footer')
</body>
</html>
