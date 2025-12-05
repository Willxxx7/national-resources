<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if ($title === config('app.name'))
            {{ $title }}
        @else
            {{ config('app.name') }} &ndash; {{ $title }}
        @endif
    </title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">

    {{-- FontAwesome --}}
    <link href="{{ asset('fontawesome/css/fontawesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('fontawesome/css/regular.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('fontawesome/css/solid.min.css') }}" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
</head>

<body>
<header id="header">
    <div class="header-container">
        <div class="header-logo-section">
            <a href="{{route('dashboard')}}" class="logo-link">
                <img
                    src="{{ asset('images/logo.svg') }}"
                    alt="{{ config('app.name') }}"
                    class="header-logo"
                    onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='inline';"
                >
                <span class="logo-text">{{ config('app.name') }}</span>
            </a>
        </div>
        @auth
            <div class="header-user">
                <span class="welcome-text">Welcome, {{ auth()->user()->name }}</span>

                <form method="post" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa fa-sign-out-alt"></i>
                        <span class="btn-text">Logout</span>
                    </button>
                </form>
            </div>
        @endauth
    </div>
</header>

<main>
    @auth
        <div class="dashboard-layout">
            <nav class="navigation" id="side-navigation">
                <ul class="links">
                    <li @class(['active' => Route::is('dashboard')])>
                        <a href="{{ route('dashboard') }}">
                            <i class="fa fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li @class(['active' => Route::is('events.*')])>
                        <a href="{{ route('events.index') }}">
                            <i class="fa fa-calendar"></i>
                            Events
                        </a>
                    </li>
                    <li @class(['active' => Route::is('pictures.*')])>
                        <a href="{{ route('pictures.index') }}">
                            <i class="fa fa-image"></i>
                            Pictures
                        </a>
                    </li>
                    <li @class(['active' => Route::is('orders.*')])>
                        <a href="{{ route('orders.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            Orders
                        </a>
                    </li>
                    <li @class([
                            'active' => Route::is('settings.*', 'categories.*', 'picture-sizes.*'),
                        ])>
                        <a href="{{ route('settings.index') }}">
                            <i class="fa fa-cog"></i>
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>

            <div id="content">
                @yield('content')
            </div>
        </div>
    @else
        <div class="container">
            @yield('content')
        </div>
    @endauth
</main>

<footer id="footer">
    <div class="footer-copyright">
        &copy; {{ date('Y') }} {{ config('app.name') }}
    </div>
</footer>

</body>
</html>
