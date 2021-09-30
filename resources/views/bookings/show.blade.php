@extends('layouts.app')

@section('content')

    @auth
        <div class="container-fluid" style="margin-top: 10px">
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

                <my-bookings-property-details :booking="{{ $booking }}"
                                              :can-cancel="{{ json_encode($canCancel) }}"
                                              :charges-breakdown="{{ json_encode($cancellationChargesBreakdown) }}"
                ></my-bookings-property-details>
            </div>
        </div>
    </div>

@endsection
