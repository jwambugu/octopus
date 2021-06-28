@extends('layouts.app')

@section('content')
    <div class="container" style="padding-top: 3rem; margin-bottom: 2.4rem; padding-bottom: 100px">
        <div class="row">
            <div class="col-lg-12">
                <div class="error404-content">
                    <h2>Coming Soon</h2>
                    <p>Watch out for best deals on properties.</p>

                    <a href="{{ route('index') }}" class="button-sm out-line-btn override-text-transform"
                       style="margin-top: 10px">
                        Back to home page
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
