@extends('layouts.app')

@section('content')
    @auth
        @include('partials._referrals_links')
    @endauth

    <properties-details-page-main-component :property="{{ $property }}"
                                            style="margin-top: -80px"></properties-details-page-main-component>
@endsection
