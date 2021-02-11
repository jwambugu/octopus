@extends('layouts.app')

@section('content')
    <div class="banner b6">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item item-100vh active">
                    <img src="img/banner/img-2.jpg" alt="banner-slider-1">
                    <div class="carousel-caption banner-slider-inner">
                        <div class="banner-content container banner-content-left">
                            <h1>Find your Dream House</h1>
                            <p>Find new & featured property located in your local city.</p>
                            <div class="hidden-lg hidden-md">
                                <a href="#" class="btn button-md button-theme">Get Started Now</a>
                                <a href="#" class="btn button-md border-button-theme">Learn More</a>
                            </div>
                            <div class="tab-btn hidden-sm hidden-xs">
                                <div class="tab-btn-inner">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_default_1" data-toggle="tab">Buy</a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_2" data-toggle="tab">Rent</a>
                                        </li>
                                        <li>
                                            <a href="#tab_default_3" data-toggle="tab">Sale</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_default_1">
                                            <div class="search-area">
                                                <div class="search-area-inner">
                                                    <form method="GET">
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <input type="text" name="full-name"
                                                                           class="input-text search-fields"
                                                                           placeholder="Enter Keyword">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <select class="selectpicker search-fields"
                                                                        name="property-status" data-live-search="true"
                                                                        data-live-search-placeholder="Search value">
                                                                    <option>Property Type</option>
                                                                    <option>Apartment</option>
                                                                    <option>Family House</option>
                                                                    <option>Modern Villa</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <select class="selectpicker search-fields"
                                                                        name="location"
                                                                        data-live-search="true"
                                                                        data-live-search-placeholder="Search value">
                                                                    <option>Location</option>
                                                                    <option>United States</option>
                                                                    <option>United Kingdom</option>
                                                                    <option>American Samoa</option>
                                                                    <option>Belgium</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <select class="selectpicker search-fields"
                                                                        name="area-from"
                                                                        data-live-search="true"
                                                                        data-live-search-placeholder="Search value">
                                                                    <option>Room</option>
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2 cp3">
                                                            <div class="form-group">
                                                                <button class="search-button">Search</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_default_2">
                                            <div class="search-area">
                                                <div class="search-area-inner">
                                                    <form method="GET">
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <input type="text" name="full-name"
                                                                           class="input-text search-fields"
                                                                           placeholder="Enter Keyword">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <select class="selectpicker search-fields"
                                                                        name="property-status" data-live-search="true"
                                                                        data-live-search-placeholder="Search value">
                                                                    <option>Property Type</option>
                                                                    <option>Apartment</option>
                                                                    <option>Family House</option>
                                                                    <option>Modern Villa</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <select class="selectpicker search-fields"
                                                                        name="location"
                                                                        data-live-search="true"
                                                                        data-live-search-placeholder="Search value">
                                                                    <option>Location</option>
                                                                    <option>United States</option>
                                                                    <option>United Kingdom</option>
                                                                    <option>American Samoa</option>
                                                                    <option>Belgium</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <select class="selectpicker search-fields"
                                                                        name="area-from"
                                                                        data-live-search="true"
                                                                        data-live-search-placeholder="Search value">
                                                                    <option>Room</option>
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2 cp3">
                                                            <div class="form-group">
                                                                <button class="search-button">Search</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_default_3">
                                            <div class="search-area">
                                                <div class="search-area-inner">
                                                    <form method="GET">
                                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <input type="text" name="full-name"
                                                                           class="input-text search-fields"
                                                                           placeholder="Enter Keyword">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <select class="selectpicker search-fields"
                                                                        name="property-status" data-live-search="true"
                                                                        data-live-search-placeholder="Search value">
                                                                    <option>Property Type</option>
                                                                    <option>Apartment</option>
                                                                    <option>Family House</option>
                                                                    <option>Modern Villa</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <select class="selectpicker search-fields"
                                                                        name="location"
                                                                        data-live-search="true"
                                                                        data-live-search-placeholder="Search value">
                                                                    <option>Location</option>
                                                                    <option>United States</option>
                                                                    <option>United Kingdom</option>
                                                                    <option>American Samoa</option>
                                                                    <option>Belgium</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2">
                                                            <div class="form-group">
                                                                <select class="selectpicker search-fields"
                                                                        name="area-from"
                                                                        data-live-search="true"
                                                                        data-live-search-placeholder="Search value">
                                                                    <option>Room</option>
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 col-pad2 cp3">
                                                            <div class="form-group">
                                                                <button class="search-button">Search</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="search-area hidden-lg hidden-md">
        <div class="container">
            <div class="search-area-inner">
                <div class="search-contents ">
                    <form method="GET">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="area-from" data-live-search="true"
                                            data-live-search-placeholder="Search value">
                                        <option>Area From</option>
                                        <option>1000</option>
                                        <option>800</option>
                                        <option>600</option>
                                        <option>400</option>
                                        <option>200</option>
                                        <option>100</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="property-status"
                                            data-live-search="true" data-live-search-placeholder="Search value">
                                        <option>Property Status</option>
                                        <option>For Sale</option>
                                        <option>For Rent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="location" data-live-search="true"
                                            data-live-search-placeholder="Search value">
                                        <option>Location</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                        <option>American Samoa</option>
                                        <option>Belgium</option>
                                        <option>Cameroon</option>
                                        <option>Canada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="property-types"
                                            data-live-search="true"
                                            data-live-search-placeholder="Search value">
                                        <option>Property Types</option>
                                        <option>Residential</option>
                                        <option>Commercial</option>
                                        <option>Land</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="bedrooms" data-live-search="true"
                                            data-live-search-placeholder="Search value">
                                        <option>Bedrooms</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker search-fields" name="bathrooms" data-live-search="true"
                                            data-live-search-placeholder="Search value">
                                        <option>Bathrooms</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="range-slider">
                                        <div data-min="0" data-max="150000" data-unit="USD" data-min-name="min_price"
                                             data-max-name="max_price" class="range-slider-ui ui-slider"
                                             aria-disabled="false"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 ">
                                <div class="form-group">
                                    <button class="search-button">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="content-area featured-properties">
        <div class="container">

            <div class="main-title">
                <h1>Featured Properties</h1>
            </div>
            <ul class="list-inline-listing filters filters-listing-navigation">
                <li class="active btn filtr-button filtr" data-filter="all">All</li>
                <li data-filter="1" class="btn btn-inline filtr-button filtr">House</li>
                <li data-filter="2" class="btn btn-inline filtr-button filtr">Office</li>
                <li data-filter="3" class="btn btn-inline filtr-button filtr">Apartment</li>
                <li data-filter="4" class="btn btn-inline filtr-button filtr">Residential</li>
            </ul>
            <div class="row wow fadeInUp delay-04s">
                <div class="filtr-container">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="1, 2, 3">
                        <div class="property">

                            <div class="property-img">
                                <div class="property-tag button alt featured">Featured</div>
                                <div class="property-tag button sale">For Sale</div>
                                <div class="property-price">$72.000</div>
                                <img src="img/properties/properties-1.jpg" alt="fp" class="img-responsive">
                                <div class="property-overlay">
                                    <a href="properties-details.html" class="overlay-link">
                                        <i class="fa fa-link"></i>
                                    </a>
                                    <a class="overlay-link property-video" title="Lexus GS F">
                                        <i class="fa fa-video-camera"></i>
                                    </a>
                                    <div class="property-magnify-gallery">
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-1.jpg"
                                           class="overlay-link">
                                            <i class="fa fa-expand"></i>
                                        </a>

                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-2.jpg"
                                           class="hidden"></a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-3.jpg"
                                           class="hidden"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="property-content">

                                <div class="info">

                                    <h1 class="title">
                                        <a href="properties-details.html">Beautiful Single Home</a>
                                    </h1>

                                    <h3 class="property-address">
                                        <a href="properties-details.html">
                                            <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                        </a>
                                    </h3>

                                    <ul class="facilities-list clearfix">
                                        <li>
                                            <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                            <span>4800 sq ft</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-bed"></i>
                                            <span>3 Beds</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-monitor"></i>
                                            <span>TV </span>
                                        </li>
                                        <li>
                                            <i class="flaticon-holidays"></i>
                                            <span> 2 Baths</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-vehicle"></i>
                                            <span>1 Garage</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-building"></i>
                                            <span> 3 Balcony</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="property-footer">
                                <span class="left">
                                    <a href="#"><i class="fa fa-user"></i>Jhon Doe</a>
                                </span>
                                    <span class="right">
                                    <i class="fa fa-calendar"></i>5 Days ago
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="1">
                        <div class="property">

                            <div class="property-img">
                                <div class="property-tag button alt featured">Featured</div>
                                <div class="property-tag button sale">For Sale</div>
                                <div class="property-price">$72.000</div>
                                <img src="img/properties/properties-2.jpg" alt="fp" class="img-responsive">
                                <div class="property-overlay">
                                    <a href="properties-details.html" class="overlay-link">
                                        <i class="fa fa-link"></i>
                                    </a>
                                    <a class="overlay-link property-video" title="Lexus GS F">
                                        <i class="fa fa-video-camera"></i>
                                    </a>
                                    <div class="property-magnify-gallery">
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-2.jpg"
                                           class="overlay-link">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-4.jpg"
                                           class="hidden"></a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-3.jpg"
                                           class="hidden"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="property-content">

                                <div class="info">

                                    <h1 class="title">
                                        <a href="properties-details.html">Modern Family Home</a>
                                    </h1>

                                    <h3 class="property-address">
                                        <a href="properties-details.html">
                                            <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                        </a>
                                    </h3>

                                    <ul class="facilities-list clearfix">
                                        <li>
                                            <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                            <span>4800 sq ft</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-bed"></i>
                                            <span>3 Beds</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-monitor"></i>
                                            <span>TV </span>
                                        </li>
                                        <li>
                                            <i class="flaticon-holidays"></i>
                                            <span> 2 Baths</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-vehicle"></i>
                                            <span>1 Garage</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-building"></i>
                                            <span> 3 Balcony</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="property-footer">
                                <span class="left">
                                    <a href="#"><i class="fa fa-user"></i>Jhon Doe</a>
                                </span>
                                    <span class="right">
                                    <i class="fa fa-calendar"></i>5 Days ago
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="2, 3">
                        <div class="property">

                            <div class="property-img">
                                <div class="property-tag button alt featured">Featured</div>
                                <div class="property-tag button sale">For Sale</div>
                                <div class="property-price">$72.000</div>
                                <img src="img/properties/properties-3.jpg" alt="fp" class="img-responsive">
                                <div class="property-overlay">
                                    <a href="properties-details.html" class="overlay-link">
                                        <i class="fa fa-link"></i>
                                    </a>
                                    <a class="overlay-link property-video" title="Lexus GS F">
                                        <i class="fa fa-video-camera"></i>
                                    </a>
                                    <div class="property-magnify-gallery">
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-3.jpg"
                                           class="overlay-link">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-2.jpg"
                                           class="hidden"></a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-1.jpg"
                                           class="hidden"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="property-content">

                                <div class="info">

                                    <h1 class="title">
                                        <a href="properties-details.html">Sweet Family Home</a>
                                    </h1>

                                    <h3 class="property-address">
                                        <a href="properties-details.html">
                                            <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                        </a>
                                    </h3>

                                    <ul class="facilities-list clearfix">
                                        <li>
                                            <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                            <span>4800 sq ft</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-bed"></i>
                                            <span>3 Beds</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-monitor"></i>
                                            <span>TV </span>
                                        </li>
                                        <li>
                                            <i class="flaticon-holidays"></i>
                                            <span> 2 Baths</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-vehicle"></i>
                                            <span>1 Garage</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-building"></i>
                                            <span> 3 Balcony</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="property-footer">
                                <span class="left">
                                    <a href="#"><i class="fa fa-user"></i>Jhon Doe</a>
                                </span>
                                    <span class="right">
                                    <i class="fa fa-calendar"></i>5 Days ago
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="3, 4">
                        <div class="property">

                            <div class="property-img">
                                <div class="property-tag button alt featured">Featured</div>
                                <div class="property-tag button sale">For Sale</div>
                                <div class="property-price">$72.000</div>
                                <img src="img/properties/properties-4.jpg" alt="fp" class="img-responsive">
                                <div class="property-overlay">
                                    <a href="properties-details.html" class="overlay-link">
                                        <i class="fa fa-link"></i>
                                    </a>
                                    <a class="overlay-link property-video" title="Lexus GS F">
                                        <i class="fa fa-video-camera"></i>
                                    </a>
                                    <div class="property-magnify-gallery">
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-4.jpg"
                                           class="overlay-link">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-2.jpg"
                                           class="hidden"></a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-3.jpg"
                                           class="hidden"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="property-content">

                                <div class="info">

                                    <h1 class="title">
                                        <a href="properties-details.html">Big Head House</a>
                                    </h1>

                                    <h3 class="property-address">
                                        <a href="properties-details.html">
                                            <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                        </a>
                                    </h3>

                                    <ul class="facilities-list clearfix">
                                        <li>
                                            <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                            <span>4800 sq ft</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-bed"></i>
                                            <span>3 Beds</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-monitor"></i>
                                            <span>TV </span>
                                        </li>
                                        <li>
                                            <i class="flaticon-holidays"></i>
                                            <span> 2 Baths</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-vehicle"></i>
                                            <span>1 Garage</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-building"></i>
                                            <span> 3 Balcony</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="property-footer">
                                <span class="left">
                                    <a href="#"><i class="fa fa-user"></i>Jhon Doe</a>
                                </span>
                                    <span class="right">
                                    <i class="fa fa-calendar"></i>5 Days ago
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="4">
                        <div class="property">

                            <div class="property-img">
                                <div class="property-tag button alt featured">Featured</div>
                                <div class="property-tag button sale">For Sale</div>
                                <div class="property-price">$72.000</div>
                                <img src="img/properties/properties-5.jpg" alt="fp" class="img-responsive">
                                <div class="property-overlay">
                                    <a href="properties-details.html" class="overlay-link">
                                        <i class="fa fa-link"></i>
                                    </a>
                                    <a class="overlay-link property-video" title="Lexus GS F">
                                        <i class="fa fa-video-camera"></i>
                                    </a>
                                    <div class="property-magnify-gallery">
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-5.jpg"
                                           class="overlay-link">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-2.jpg"
                                           class="hidden"></a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-3.jpg"
                                           class="hidden"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="property-content">

                                <div class="info">

                                    <h1 class="title">
                                        <a href="properties-details.html">Park Avenue</a>
                                    </h1>

                                    <h3 class="property-address">
                                        <a href="properties-details.html">
                                            <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                        </a>
                                    </h3>

                                    <ul class="facilities-list clearfix">
                                        <li>
                                            <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                            <span>4800 sq ft</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-bed"></i>
                                            <span>3 Beds</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-monitor"></i>
                                            <span>TV </span>
                                        </li>
                                        <li>
                                            <i class="flaticon-holidays"></i>
                                            <span> 2 Baths</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-vehicle"></i>
                                            <span>1 Garage</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-building"></i>
                                            <span> 3 Balcony</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="property-footer">
                                <span class="left">
                                    <a href="#"><i class="fa fa-user"></i>Jhon Doe</a>
                                </span>
                                    <span class="right">
                                    <i class="fa fa-calendar"></i>5 Days ago
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12  filtr-item" data-category="1">
                        <div class="property">

                            <div class="property-img">
                                <div class="property-tag button alt featured">Featured</div>
                                <div class="property-tag button sale">For Sale</div>
                                <div class="property-price">$72.000</div>
                                <img src="img/properties/properties-6.jpg" alt="fp" class="img-responsive">
                                <div class="property-overlay">
                                    <a href="properties-details.html" class="overlay-link">
                                        <i class="fa fa-link"></i>
                                    </a>
                                    <a class="overlay-link property-video" title="Lexus GS F">
                                        <i class="fa fa-video-camera"></i>
                                    </a>
                                    <div class="property-magnify-gallery">
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-6.jpg"
                                           class="overlay-link">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-2.jpg"
                                           class="hidden"></a>
                                        <a href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/properties/properties-3.jpg"
                                           class="hidden"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="property-content">

                                <div class="info">

                                    <h1 class="title">
                                        <a href="properties-details.html">Masons Villas</a>
                                    </h1>

                                    <h3 class="property-address">
                                        <a href="properties-details.html">
                                            <i class="fa fa-map-marker"></i>123 Kathal St. Tampa City,
                                        </a>
                                    </h3>

                                    <ul class="facilities-list clearfix">
                                        <li>
                                            <i class="flaticon-square-layouting-with-black-square-in-east-area"></i>
                                            <span>4800 sq ft</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-bed"></i>
                                            <span>3 Beds</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-monitor"></i>
                                            <span>TV </span>
                                        </li>
                                        <li>
                                            <i class="flaticon-holidays"></i>
                                            <span> 2 Baths</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-vehicle"></i>
                                            <span>1 Garage</span>
                                        </li>
                                        <li>
                                            <i class="flaticon-building"></i>
                                            <span> 3 Balcony</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="property-footer">
                                <span class="left">
                                    <a href="#"><i class="fa fa-user"></i>Jhon Doe</a>
                                </span>
                                    <span class="right">
                                    <i class="fa fa-calendar"></i>5 Days ago
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="services content-area-11 clearfix">
        <div class="container">

            <div class="main-title">
                <h1>What Are you Looking For?</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 wow fadeInLeft delay-04s">
                    <div class="service-info">
                        <div class="number">01</div>
                        <div class="icon">
                            <i class="flaticon-people-1"></i>
                        </div>
                        <div class="detail">
                            <h3>Trusted By Thousands</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 wow fadeInUp delay-04s">
                    <div class="service-info">
                        <div class="number">02</div>
                        <div class="icon">
                            <i class="flaticon-symbol-1"></i>
                        </div>
                        <div class="detail">
                            <h3>Financing Made Easy</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 wow fadeInRight delay-04s">
                    <div class="service-info">
                        <div class="number">03</div>
                        <div class="icon">
                            <i class="flaticon-apartment"></i>
                        </div>
                        <div class="detail">
                            <h3>Wide Renge Of Properties</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 text-center wow fadeInUp delay-04s">
                    <a href="services-1.html" class="btn read-more-2 button-theme text-center">Read More</a>
                </div>
            </div>
        </div>
    </div>

    <div class="counters2 overview-bgi">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12 wow fadeInLeft delay-04s">
                    <div class="sec-title-three">
                        <h2>Counters</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 wow fadeInRight delay-04s">
                    <div class="media counter-box">
                        <div class="media-left">
                            <i class="flaticon-tag"></i>
                        </div>
                        <div class="media-body">
                            <h1 class="counter">967</h1>
                            <p>Listings For Sale</p>
                        </div>
                    </div>
                    <div class="media counter-box">
                        <div class="media-left">
                            <i class="flaticon-symbol-1"></i>
                        </div>
                        <div class="media-body">
                            <h1 class="counter">967</h1>
                            <p>Listings For Rent</p>
                        </div>
                    </div>
                    <div class="media counter-box">
                        <div class="media-left">
                            <i class="flaticon-people"></i>
                        </div>
                        <div class="media-body">
                            <h1 class="counter">396</h1>
                            <p>Agents</p>
                        </div>
                    </div>
                    <div class="media counter-box">
                        <div class="media-left">
                            <i class="flaticon-people-1"></i>
                        </div>
                        <div class="media-body">
                            <h1 class="counter">177</h1>
                            <p>Brokers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="categories content-area-12">
        <div class="container">

            <div class="main-title">
                <h1>Popular Places</h1>
            </div>
            <div class="clearfix"></div>
            <div class="row wow">
                <div class="col-lg-8 col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 col-pad wow fadeInLeft delay-04s">
                            <div class="category cey2">
                                <div class="category_bg_box cat-1-bg">
                                    <div class="category-overlay">
                                        <div class="cc3">
                                            <div class="category-subtitle">14 Properties</div>
                                            <div class="info">
                                                <h4>
                                                    <a href="#">Florida</a>
                                                </h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-pad wow fadeInLeft delay-04s">
                            <div class="category cey2">
                                <div class="category_bg_box cat-2-bg">
                                    <div class="category-overlay">
                                        <div class="cc3">
                                            <div class="category-subtitle">27 Properties</div>
                                            <div class="info">
                                                <h4>
                                                    <a href="#">California</a>
                                                </h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-pad wow fadeInUp delay-04s">
                            <div class="category cey2">
                                <div class="category_bg_box cat-7-bg">
                                    <div class="category-overlay">
                                        <div class="cc3">
                                            <div class="category-subtitle">21 Properties</div>
                                            <div class="info">
                                                <h4>
                                                    <a href="#">New York City</a>
                                                </h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-pad wow fadeInUp delay-04s">
                            <div class="category cey2">
                                <div class="category_bg_box cat-6-bg">
                                    <div class="category-overlay">
                                        <div class="cc3">
                                            <div class="category-subtitle">12 Properties</div>
                                            <div class="info">
                                                <h4>
                                                    <a href="#">San Francisco</a>
                                                </h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                    eiusmod</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12 col-pad wow fadeInRight delay-04s">
                    <div class="category cey2">
                        <div class="category_bg_box category_long_bg cat-3-bg">
                            <div class="category-overlay">
                                <div class="cc3">
                                    <div class="category-subtitle">02 Properties</div>
                                    <div class="info">
                                        <h4>
                                            <a href="#">Tokyo</a>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="agent-section mb-70">
        <div class="container">

            <div class="main-title">
                <h1>Our Agent</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInLeft delay-04s">

                    <div class="agent-1">

                        <div class="photo">
                            <a href="properties-details.html" class="agent-img">
                                <img src="img/team/team-6.jpg" alt="team-1" class="img-responsive">
                            </a>
                            <div class="icon">
                                <div class="icon-inner"></div>
                            </div>
                            <div class="clearfix"></div>
                            <ul class="social-list clearfix">
                                <li>
                                    <a href="#" class="facebook-bg">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="twitter-bg">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="linkedin-bg">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="google-bg">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="agent-content">
                            <h5><a href="agent-single.html">John Antony</a></h5>
                            <h6>Web Developer</h6>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInLeft delay-04s">

                    <div class="agent-1">

                        <div class="photo">
                            <a href="properties-details.html" class="agent-img">
                                <img src="img/team/team-5.jpg" alt="team-1" class="img-responsive">
                            </a>
                            <div class="icon">
                                <div class="icon-inner"></div>
                            </div>
                            <div class="clearfix"></div>
                            <ul class="social-list clearfix">
                                <li>
                                    <a href="#" class="facebook-bg">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="twitter-bg">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="linkedin-bg">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="google-bg">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="agent-content">
                            <h5><a href="agent-single.html">Karen Paran</a></h5>
                            <h6>Creative Director</h6>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInRight delay-04s">

                    <div class="agent-1">

                        <div class="photo">
                            <a href="properties-details.html" class="agent-img">
                                <img src="img/team/team-7.jpg" alt="team-1" class="img-responsive">
                            </a>
                            <div class="icon">
                                <div class="icon-inner"></div>
                            </div>
                            <div class="clearfix"></div>
                            <ul class="social-list clearfix">
                                <li>
                                    <a href="#" class="facebook-bg">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="twitter-bg">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="linkedin-bg">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="google-bg">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="agent-content">
                            <h5><a href="agent-single.html">John Maikel</a></h5>
                            <h6>Office Manager</h6>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wow fadeInRight delay-04s">

                    <div class="agent-1">

                        <div class="photo">
                            <a href="properties-details.html" class="agent-img">
                                <img src="img/team/team-8.jpg" alt="team-1" class="img-responsive">
                            </a>
                            <div class="icon">
                                <div class="icon-inner"></div>
                            </div>
                            <div class="clearfix"></div>
                            <ul class="social-list clearfix">
                                <li>
                                    <a href="#" class="facebook-bg">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="twitter-bg">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="linkedin-bg">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="google-bg">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="agent-content">
                            <h5><a href="agent-single.html">Eliane Pereira</a></h5>
                            <h6>Support Manager</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="testimonials-3 overview-bgi">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div id="carouse3-example-generic" class="carousel slide" data-ride="carousel">
                        <h1>Our Testimonial</h1>

                        <div class="carousel-inner wow fadeInUp delay-04s" role="listbox">
                            <div class="item content clearfix active">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="avatar">
                                            <img src="img/avatar/avatar-1.jpg" alt="avatar-1" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="testimonials-info">
                                            <div class="text">
                                                <sup>
                                                    <i class="fa fa-quote-left"></i>
                                                </sup>
                                                Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim.
                                                Donec vel lectus vel felis lacinia luctus vitae iaculis arcu. Mauris
                                                mattis, massa eu porta ultricies.
                                                <sub>
                                                    <i class="fa fa-quote-right"></i>
                                                </sub>
                                            </div>
                                            <div class="author-name">
                                                John Antony
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star-half-full"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item content clearfix">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="avatar">
                                            <img src="img/avatar/avatar-2.jpg" alt="avatar-2" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="testimonials-info">
                                            <div class="text">
                                                <sup>
                                                    <i class="fa fa-quote-left"></i>
                                                </sup>
                                                Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim.
                                                Donec vel lectus vel felis lacinia luctus vitae iaculis arcu. Mauris
                                                mattis, massa eu porta ultricies.
                                                <sub>
                                                    <i class="fa fa-quote-right"></i>
                                                </sub>
                                            </div>
                                            <div class="author-name">
                                                John Mery
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star-half-full"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item content clearfix">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="avatar">
                                            <img src="img/avatar/avatar-4.jpg" alt="avatar-4" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="testimonials-info">
                                            <div class="text">
                                                <sup>
                                                    <i class="fa fa-quote-left"></i>
                                                </sup>
                                                Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim.
                                                Donec vel lectus vel felis lacinia luctus vitae iaculis arcu. Mauris
                                                mattis, massa eu porta ultricies.
                                                <sub>
                                                    <i class="fa fa-quote-right"></i>
                                                </sub>
                                            </div>
                                            <div class="author-name">
                                                John Top
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star-half-full"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item content clearfix">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <div class="avatar">
                                            <img src="img/avatar/avatar-3.jpg" alt="avatar-3" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 ">
                                        <div class="testimonials-info">
                                            <div class="text">
                                                <sup>
                                                    <i class="fa fa-quote-left"></i>
                                                </sup>
                                                Aliquam dictum elit vitae mauris facilisis, at dictum urna dignissim.
                                                Donec vel lectus vel felis lacinia luctus vitae iaculis arcu. Mauris
                                                mattis, massa eu porta ultricies.
                                                <sup>
                                                    <i class="fa fa-quote-right"></i>
                                                </sup>
                                            </div>
                                            <div class="author-name">
                                                John Pitarshon
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star-half-full"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="left carousel-control" href="#carouse3-example-generic" role="button"
                           data-slide="prev">
                        <span class="slider-mover-left t-slider-l" aria-hidden="true">
                            <i class="fa fa-angle-left"></i>
                        </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carouse3-example-generic" role="button"
                           data-slide="next">
                        <span class="slider-mover-right t-slider-r" aria-hidden="true">
                            <i class="fa fa-angle-right"></i>
                        </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
