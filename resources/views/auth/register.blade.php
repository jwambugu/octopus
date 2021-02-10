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
                <h3>Create an account</h3>
                <form>
                    <div class="form-group">
                        <label for="name" class="hidden"></label>
                        <input type="text" id="name" class="input-text" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="hidden"></label>
                        <input type="email" id="email" class="input-text" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="password" class="hidden"></label>
                        <input type="password" id="password" class="input-text" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="hidden"></label>
                        <input type="password" id="password_confirmation" class="input-text"
                               placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button-md button-theme btn-block">
                            Create Account
                        </button>
                    </div>
                </form>
                <ul class="social-list clearfix">
                    <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="google-bg"><i class="fa fa-google"></i></a></li>
                    <li><a href="#" class="linkedin-bg"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
            <div class="footer">
                <span>
                    Already a member? <a href="{{ route('login') }}">Login here</a>
                </span>
            </div>
        </div>
    </div>

@endsection
