<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>dotCFP: A Call for Papers Application</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-bullhorn"></i> {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}"><i
                                    class="fa fa-home"></i> Home</a></li>

                    @if(auth()->check())
                        <li class="{{ Request::is('users/' . auth()->user()->username . '/edit') ? 'active' : '' }}"><a
                                    href="{{ route('users.edit', auth()->user()->username) }}"><i
                                        class="fa fa-pencil"></i> Edit Profile</a></li>
                    @endif

                    @if(auth()->check() && auth()->user()->inCommittee())
                        <li class="{{ Request::is('users') ? 'active' : '' }}"><a href="{{ route('users.index') }}"><i
                                        class="fa fa-users"></i> Users</a></li>
                        <li class="dropdown{{ Request::is('talks') ? ' active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">
                                <i class="fa fa-list"></i> Talks <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('talks.index') }}"><i class="fa fa-list"></i> All Times</a>
                                </li>
                                <li><a href="{{ route('talks.index', ['order' => 'most-voted']) }}"><i
                                                class="fa fa-star"></i> Most Voted</a></li>
                                <li><a href="{{ route('talks.index', ['status' => 'approved']) }}"><i
                                                class="fa fa-check"></i> Approved</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(auth()->check() && !auth()->user()->inCommittee())
                        <li class="{{ Request::is('talks') ? 'active' : '' }}"><a href="{{ route('talks.index') }}"><i
                                        class="fa fa-list"></i> My Talks</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}"><i class="fa fa-github"></i> Login with GitHub</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Made with <i class="fa fa-heart" aria-hidden="true"></i> in Istanbul, Fork me on <a target="_blank"
                                                                                                                  href="https://github.com/emir/dotCFP"><i class="fa fa-github" aria-hidden="true"></i></a>.️
        </p>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/bootbox.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
@stack('scripts')

</body>
</html>
