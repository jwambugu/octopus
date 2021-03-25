@extends('layouts.auth')

@section('content')
    <div class="login-section">
        <div class="form-content-box">

            <div class="details">
                <div class="logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('img/logos/app-logo.png') }}" style="height: 10rem" alt="logo">
                    </a>
                </div>
                <div class="clearfix"></div>
                <h3>Sign into your account</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="hidden"></label>
                        <input type="email" name="email" id="email" class="input-text error-message-txt" autofocus
                               placeholder="Email Address" value="{{ old('email') }}">

                        @error('email')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="hidden"></label>
                        <input type="password" name="password" id="password" class="input-text error-message-txt"
                               placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="checkbox">
                        <div class="ez-checkbox pull-left">
                            <label>
                                <input type="checkbox" class="ez-hide" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
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
                {{--                <ul class="social-list clearfix">--}}
                {{--                    <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>--}}
                {{--                    <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>--}}
                {{--                    <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>--}}
                {{--                    <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>--}}
                {{--                </ul>--}}
            </div>
            <div class="footer">
            <span>
                Don't have an account? <a href="{{ route('register', ['_next' => $next]) }}">Register here</a>
            </span>
            </div>
        </div>
    </div>

@endsection
