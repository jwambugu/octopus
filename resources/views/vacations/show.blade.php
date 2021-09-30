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

    <properties-details-page-main-component :property="{{ $property }}"
                                            style="margin-top: -40px"></properties-details-page-main-component>
@endsection
