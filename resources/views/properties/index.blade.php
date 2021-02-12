@extends('layouts.app')

@section('content')


    <div class="sub-banner overview-bgi">
        <div class="overlay">
            <div class="container">
                <div class="breadcrumb-area">
                    <h1>Properties Listing</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="active">Properties Listing</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <properties-list-main-component :page="{{ $page }}"></properties-list-main-component>

@endsection
