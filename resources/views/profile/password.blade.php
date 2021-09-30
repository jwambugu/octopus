@extends('layouts.app')

@section('content')
    @auth
        @include('partials._referrals_links')
    @endauth

    <div class="content-area my-profile" style="margin-top: -80px">
        <div class="container">
            <div class="row">
                @include('partials._profile-aside')

                <change-password></change-password>
            </div>
        </div>
    </div>

@endsection
