@extends('layouts.app')

@section('content')

    <div class="content-area my-profile" style="margin-top: -50px">
        <div class="container">
            <div class="row">
                @include('partials._profile-aside')

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <referral-program :user="{{ $user }}" :links="{{ json_encode($links) }}"></referral-program>

                    <edit-profile :user="{{ $user }}"></edit-profile>
                </div>

            </div>
        </div>
    </div>

@endsection
