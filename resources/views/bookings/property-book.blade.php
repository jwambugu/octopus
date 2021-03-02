@extends('layouts.app')

@section('content')

    <div class="content-area my-profile" style="margin-top: -50px">
        <div class="container">
            <div class="row">
                @include('partials._profile-aside')

                <book-property :property="{{ $property }}"></book-property>
            </div>
        </div>
    </div>

@endsection