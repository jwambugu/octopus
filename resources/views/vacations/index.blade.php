@extends('layouts.app')

@section('content')
    <properties-list-main-component style="margin-top: -40px" :page="{{ $page }}"
                                    :filters="{{ json_encode($filters) }}"
                                    :query-params="{{ json_encode($queryParams) }}"></properties-list-main-component>
@endsection
