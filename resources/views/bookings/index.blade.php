@extends('layouts.app')

@section('content')

    <div class="content-area my-profile" style="margin-top: -50px">
        <div class="container">
            <div class="row">
                @include('partials._profile-aside')

                <my-bookings :bookings="{{ json_encode($bookings) }}" :links="{{ json_encode($links) }}"></my-bookings>
            </div>
        </div>
    </div>

@endsection
