@extends('layouts.app')

@section('content')

    <div class="content-area my-profile" style="margin-top: -50px">
        <div class="container">
            <div class="row">
                @include('partials._profile-aside')

                @if($bookings->count())
                    <my-bookings :bookings="{{ json_encode($bookings) }}"
                                 :links="{{ json_encode($links) }}"></my-bookings>

                @else
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="my-address">

                            <div
                                class="alert alert-info text-center override-alert-text-transform"
                                role="alert"
                            >
                                Sorry. You have not booked any properties yet.
                            </div>

                            <div class="text-center" style="padding-top: 3rem; padding-bottom: 2rem">
                                <a href="{{ route('properties.index') }}" class="button-md button-theme">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endempty

            </div>
        </div>
    </div>

@endsection
