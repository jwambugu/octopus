@extends('layouts.auth')

@section('content')
    <div class="login-section">
        <div class="form-content-box">

            <div class="details">
                <div class="logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('img/logos/logo.png') }}" alt="logo">
                    </a>
                </div>
                <div class="clearfix"></div>
                <h3>Sign into your account</h3>
                <form action="https://templates.themevessel.com/the-nest/index.html" method="GET">
                    <div class="form-group">
                        <label for="email" class="hidden"></label>
                        <input type="email" id="email" class="input-text" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="password" class="hidden"></label>
                        <input type="password" id="Password" class="input-text" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <div class="ez-checkbox pull-left">
                            <label>
                                <input type="checkbox" class="ez-hide">
                                Remember me
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="link-not-important pull-right">
                            Forgot Password
                        </a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button-md button-theme btn-block">login</button>
                    </div>
                </form>
                <ul class="social-list clearfix">
                    <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="footer">
            <span>
                Don't have an account? <a href="{{ route('register') }}">Register here</a>
            </span>
            </div>
        </div>
    </div>

@endsection
