@extends('layouts.app')

@section('content')
    @auth
        @include('partials._referrals_links')
    @endauth

    @include('partials._property_details')
@endsection
