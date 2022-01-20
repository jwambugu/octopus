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

    @include('partials._properties_list')
@endsection
