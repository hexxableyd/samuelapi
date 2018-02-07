<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Samuel API') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    
</head>
<body>
    <div id="app">
        @guest
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <strong>SAMUEL API</strong>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>
            </div>
        </nav>
            @yield('content')
        @else
        <div class="row">
                <div class="side-menu">
                <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <div class="brand-wrapper">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="brand-name-wrapper">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <strong>SAMUEL API</strong>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="side-menu-container">
                    <ul class="nav navbar-nav">
                        <li id='dashboard'><a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp; Dashboard</a></li>
                        <li id='apikey'><a href="{{ route('api_key') }}"><i class="fas fa-key"></i>&nbsp;&nbsp; API Key</a></li>
                        <li class="panel panel-default account" id="dropdown">
                            <a data-toggle="collapse" href="#dropdown-lvl1">
                                <span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}<span class="caret"></span>
                            </a>
                            <div id="dropdown-lvl1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="{{ route('account') }}" ><i class="fas fa-cog"></i>&nbsp;&nbsp; Account Settings</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}" 
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <span class="glyphicon glyphicon-log-out"></span> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
                </div>
                <div style='margin-left:0px' class="container-fluid">
                    <div class="side-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{ $page_title }}</h3>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        @endguest
    </div>

    <!-- Scripts -->
    
    
    @auth
    <script type='text/javascript'>
        $("{{ $active_nav }}").addClass("active")
    </script>
    @endauth
</body>
</html>
