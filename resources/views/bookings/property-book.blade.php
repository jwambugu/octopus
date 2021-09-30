@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endpush

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

    <div class="content-area my-profile" style="margin-top: -50px">
        <div class="container">
            <div class="row">
                @include('partials._profile-aside')

                <book-property :property="{{ $property }}" :booked-dates="{{ $bookedDates }}"></book-property>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endpush
