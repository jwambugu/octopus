@extends('layouts.app')

@section('content')

    @auth
        <div class="container" style="margin-top: 10px">
            <div class="row">
                <div class="col-md-12">
                    @include('partials._referrals_links')
                </div>
            </div>
        </div>
    @endauth

    <div class="content-area my-profile" style="margin-top: -80px">
        <div class="container">
            <div class="row">
                @include('partials._profile-aside')

                <div class="col-lg-8 col-md-8 col-sm-12">

                    <edit-profile :user="{{ $user }}"></edit-profile>
                </div>

            </div>
        </div>
    </div>
@endsection
