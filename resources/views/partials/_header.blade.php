<header class="top-header hidden-xs" id="top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="list-inline">
                    <a href="tel:{{ config('mail.phone_number.main') }}">
                        <i class="fa fa-phone"></i>
                        {{ config('mail.phone_number.main') }}
                    </a>
                    <a href="mailto:{{ config('mail.from.address') }}"><i
                            class="fa fa-envelope"></i>{{ config('mail.from.address') }}
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <ul class="top-social-media pull-right">
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="sign-in"><i class="fa fa-sign-in"></i> Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="sign-in"><i class="fa fa-user"></i> Register</a>
                        </li>
                    @else
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</header>


<header class="main-header">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navigation" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ route('index') }}" class="logo">
                    <img src="{{ asset('img/logos/app-logo.png') }}" style="margin-top: -10px; height: 6rem;"
                         alt="logo">
                </a>
            </div>

            <div class="navbar-collapse collapse" role="navigation" aria-expanded="true" id="app-navigation">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="{{ route('index') }}" class="override-text-transform">
                            Home
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('properties.index') }}" class="override-text-transform">
                            Vacations
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('about-us') }}" class="override-text-transform">
                            About Us
                        </a>
                    </li>
                    <li class="dropdown ">
                        <a href="{{ route('contact-us') }}" class="override-text-transform">
                            Contact Us
                        </a>
                    </li>
                    @auth
                        <li class="dropdown">
                            <a href="{{ route('home') }}" class="override-text-transform">
                                My Account
                            </a>
                        </li>
                    @endauth
                </ul>
                <ul class="nav navbar-nav navbar-right rightside-navbar">
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="button override-text-transform">
                                Login Now
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                               class="button override-text-transform">
                                Logout
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>
