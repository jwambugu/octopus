@extends('layouts.app')

@section('content')

    <div class="content-area my-profile" style="margin-top: -50px">
        <div class="container">
            <div class="row">
                @include('partials._profile-aside')

                <my-bookings-property-details :booking="{{ $booking }}"></my-bookings-property-details>
            </div>
        </div>
    </div>

@endsection
