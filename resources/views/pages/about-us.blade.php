@extends('layouts.app')

@section('content')
    <div class="about-city-estate" style="margin-top: -80px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="about-text">
                        <h3>Welcome to {{ config('app.name') }}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor arcu non ligula
                            convallis, vel tincidunt ipsum posuere. Fusce sodales lacus ut pellentes sollicitudin. Duis
                            iaculis, arcu ut<span class="n-1200"> hendrerit pharetra, elit augue pulvinar magna, a consectetur eros quam  magna, a consectetur eros</span>
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor arcu non ligula
                            convallis, vel tincidunt ipsum posuere. Fusce sodales lacus ut pellentes sollicitudin.<span
                                class="n-1200"> Duis iaculis, arcu ut hendrerit pharetra, elit augue pulvinar magna, a consectetur eros quam</span>
                        </p>
                        <a href="#" class=" btn button-sm button-theme">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="counters overview-bgi" style="margin-top:15px">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box">
                        <i class="flaticon-tag"></i>
                        <h1 class="counter">967</h1>
                        <p>Listings For Sale</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box">
                        <i class="flaticon-symbol-1"></i>
                        <h1 class="counter">1276</h1>
                        <p>Listings For Rent</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box">
                        <i class="flaticon-people"></i>
                        <h1 class="counter">396</h1>
                        <p>Agents</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box">
                        <i class="flaticon-people-1"></i>
                        <h1 class="counter">177</h1>
                        <p>Brokers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <h3>Looking To For A Place?</h3>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <a href="{{ route('properties.index') }}" class="btn button-md button-theme">Book Now</a>
                </div>
            </div>
        </div>
    </div>

@endsection
