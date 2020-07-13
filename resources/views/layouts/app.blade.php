<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}

    @yield('externalIncludes')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                  <b>  HOME</b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    @if(session()->has('user'))
                    Vaš token: &nbsp;<br/>
                      <textarea class="form-control" style="width:50%;" rows="2">{{ session('user')->auth_token}}</textarea>

                    @endif
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">

                            <a class="nav-link" href="{{ url('/calendar') }}"><i class="fa fa-calendar" aria-hidden="true"></i>
&nbsp;                                Calendar</a>
                            </li>
                            @if(session()->has('user'))

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user" aria-hidden="true"></i> &nbsp;
                                    {{ session('user')->name }}
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" id="logout"> <i class="fa fa-sign-out" aria-hidden="true"></i>
&nbsp;
                                        Logout
                                    </a>
                                </div>
                            </li>

                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;{{ __('Login') }}</a>
                            </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-book" aria-hidden="true"></i> &nbsp;Register</a>
                                </li>

                            @endif

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">


            @yield('content')
        </main>
    </div>

    @if(session()->has('user'))
    <script>

$(document).ready(function() {
    $('#logout').click(function (e) {

e.preventDefault();
var token ="{{session('user')->auth_token}}";
$.ajax({
               type:'POST',
                url:"{{ route('logout') }}",
               data:{
                   token:token,

                    _token:token
               },
               success:function(data) {
                   window.location.href = data;
               }
            });
    });
});
    </script>

    @endif
</body>
</html>
