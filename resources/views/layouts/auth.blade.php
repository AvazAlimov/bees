<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'O\'AU') }}</title>
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/font-awesome.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
    <style>
        body {
            font-family: 'Fira Sans', sans-serif;
            background: rgba(0, 0, 0, 0) url({{ asset('Resources/halftone-yellow.png') }}) repeat scroll 0 0;
        }

        .navbar {
            box-shadow: 0 0 8px 0 #666;
        }

        #app {
            margin-top: 100px;
        }
    </style>
    <div id="app">
        @yield('style')
    </div>
</head>
<body>

<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/">
            <img src="{{ asset('/Resources/logo1.png') }}" width="40" height="40" alt="">
        </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <div class="navbar-nav mr-auto mt-2 mt-lg-0">
            </div>
            <ul class="navbar-nav my-2 my-lg-0">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Кириш</a>
                </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ \Illuminate\Support\Facades\Auth::user()->username }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a>
                        </div>
                    </li>
                    @endguest
            </ul>
        </div>

        </div>
    </nav>
</div>
<div id="app">
    @yield('content')
</div>
<script src="{{asset('dist/js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('dist/js/popper.js')}}"></script>
<script src="{{asset('dist/js/bootstrap.min.js')}}"></script>
@yield('script')
</body>
</html>
