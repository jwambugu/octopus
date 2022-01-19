@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning override-text-transform" style="font-size: 1.8rem;"
                     role="alert">
                    <span style="margin-left: 145px; font-weight: bold; color: #000000;">
                       <i class="fa fa-info-circle text-warning"></i> Book your vacation and pay with M-Pesa and Debit or Credit Card.
                    </span>
                </div>
            </div>
        </div>
    </div>

    <properties-list-main-component style="margin-top: -40px" :page="{{ $page }}"
                                    :filters="{{ json_encode($filters, JSON_THROW_ON_ERROR) }}"
                                    :query-params="{{ json_encode($queryParams, JSON_THROW_ON_ERROR) }}"
                                    :maps-key="'{{ $key }}'"
                                    :property-type-data="{{ json_encode($propertyTypeData, JSON_THROW_ON_ERROR) }}">
    </properties-list-main-component>
@endsection
