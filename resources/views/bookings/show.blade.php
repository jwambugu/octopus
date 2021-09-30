@extends('layouts.app')

@section('content')

    @auth
        @include('partials._referrals_links')
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
