<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'O\'AU') }}</title>
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
    <style>
        body {
            font-family: 'Fira Sans', sans-serif;
        }

        .navbar {
            box-shadow: 0 0 8px 0 #666;
        }

        #app {
            margin-top: 60px;
        }
    </style>
    @yield('style')
</head>
<body>

<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="https://image.flaticon.com/icons/svg/614/614476.svg" width="40" height="40" alt="">
        </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#register">Аъзо бўлиш<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Биз ҳақимизда</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacts">Боғланиш</a>
                </li>
            </ul>
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
    </nav>
</div>

<div id="app">
    <!-- Modal -->
    <div class="modal fade" id="userModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Header</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>{{Session::get('message')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
</div>
<script src="{{asset('dist/js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('dist/js/popper.js')}}"></script>
<script src="{{asset('dist/js/bootstrap.min.js')}}"></script>
@if(Session::has('message'))
    <script>
        $("#userModal").modal();
    </script>
@endif
@yield('script')
</body>
</html>
