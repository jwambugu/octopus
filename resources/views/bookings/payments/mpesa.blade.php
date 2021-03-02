@extends('layouts.app')

@section('content')

    <div class="content-area my-profile" style="margin-top: -50px">
        <div class="container">
            <div class="row">
                @include('partials._profile-aside')

                <mpesa-payment-view :booking="{{ $booking }}" :user="{{ $user}}"></mpesa-payment-view>
            </div>
        </div>
    </div>

@endsection
