<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('opencfp.event_name', 'dotCFP') }}: Call for Papers</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
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
                    <i class="fa fa-bullhorn"></i> {{ config('opencfp.event_name', 'dotCFP') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}"><i
                                    class="fa fa-home"></i> Home</a></li>

                    <li><a target="_blank" href="{{ config('opencfp.event_site') }}"><i
                                    class="fa fa-ticket"></i> Event Website</a></li>

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
                        <li class="{{ Request::is('users/' . auth()->id() . '/edit') ? 'active' : '' }}"><a
                                    href="{{ route('users.edit', auth()->id()) }}"><i
                                        class="fa fa-pencil"></i> Edit Profile</a></li>
                        <li class="{{ Request::is('talks') ? 'active' : '' }}"><a href="{{ route('talks.index') }}"><i
                                        class="fa fa-list"></i> My Talks</a></li>
                    @endif

                    @if(config('opencfp.cfp_start_date') > date('Y-m-d'))
                    <li style="margin-left: 10px;">
                        <p class="navbar-btn">
                            <a target="_blank" href="{{ config('opencfp.event_site') }}" class="btn btn-info">Opened from {{ config('opencfp.cfp_start_date') }} to {{ config('opencfp.cfp_end_date') }}</a>
                        </p>
                    </li>
                    @elseif(config('opencfp.cfp_end_date') < date('Y-m-d'))
                        <li style="margin-left: 10px;">
                            <p class="navbar-btn">
                                <a target="_blank" href="{{ config('opencfp.event_site') }}" class="btn btn-danger">CFP is closed—now what?</a>
                            </p>
                        </li>
                    @else
                    <li style="margin-left: 10px;">
                        <p class="navbar-btn">
                            <a href="{{ route('talks.create') }}" class="btn btn-success">Submit your Talk!</a>
                        </p>
                    </li>
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

</body>
</html>
