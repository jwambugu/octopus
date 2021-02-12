@extends('layouts.app')

@section('content')
    <properties-details-page-main-component :property="{{ $property }}"
                                            style="margin-top: -40px"></properties-details-page-main-component>
@endsection
