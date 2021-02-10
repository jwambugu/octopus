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
                    <li>
                        <a href="{{ route('login') }}" class="sign-in"><i class="fa fa-sign-in"></i> Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="sign-in"><i class="fa fa-user"></i> Register</a>
                    </li>
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
                    <img src="{{ asset('img/logos/logo.png') }}" alt="logo">
                </a>
            </div>

            <div class="navbar-collapse collapse" role="navigation" aria-expanded="true" id="app-navigation">
                <ul class="nav navbar-nav">
                    <li class="dropdown ">
                        <a href="{{ route('index') }}">
                            Home
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('index') }}">
                            About Us
                        </a>
                    </li>
                    <li class="dropdown ">
                        <a href="{{ route('index') }}">
                            Contact Us
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right rightside-navbar">
                    <li>
                        <a href="{{ route('login') }}" class="button">
                            Login Now
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
