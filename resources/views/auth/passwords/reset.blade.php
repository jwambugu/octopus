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
                <h3>Reset Password</h3>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email" class="hidden"></label>
                        <input type="email" id="email" name="email" class="input-text error-message-txt"
                               placeholder="Email Address"
                               value="{{ $email ?? old('email') }}"
                               autofocus required>
                        @error('email')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="hidden"></label>
                        <input type="password" name="password" id="password" class="input-text error-message-txt"
                               placeholder="Password" autocomplete="new-password" required>

                        @error('password')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="hidden"></label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="input-text error-message-txt"
                               placeholder="Confirm Password" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button-md button-theme btn-block">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
