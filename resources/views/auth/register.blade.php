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
                <h3>Create an account</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <input type="hidden" name="_next" value="{{ $next }}">
                    <input type="hidden" name="_referral_code" value="{{ $referralCode }}">

                    <div class="form-group">
                        <label for="name" class="hidden"></label>
                        <input type="text" name="name" id="name" class="input-text error-message-txt" autofocus
                               value="{{ old('name') }}" placeholder="Full Name">

                        @error('name')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="hidden"></label>
                        <input type="email" name="email" id="email" class="input-text error-message-txt"
                               value="{{ old('email') }}" placeholder="Email Address">

                        @error('email')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_number" class="hidden"></label>
                        <input type="number" name="phone_number" id="phone_number" class="input-text error-message-txt"
                               value="{{ old('phone_number') }}" placeholder="Phone Number">

                        @error('phone_number')
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
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="hidden"></label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="input-text"
                               placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button-md button-theme btn-block">
                            Create Account
                        </button>
                    </div>
                </form>
                {{--                <ul class="social-list clearfix">--}}
                {{--                    <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>--}}
                {{--                    <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>--}}
                {{--                    <li><a href="#" class="google-bg"><i class="fa fa-google"></i></a></li>--}}
                {{--                    <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>--}}
                {{--                </ul>--}}
            </div>
            <div class="footer">
                <span>
                    Already a member? <a href="{{ route('login') }}">Login here</a>
                </span>
            </div>
        </div>
    </div>

@endsection
