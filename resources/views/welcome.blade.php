<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>


    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-submenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/linearicons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('css/skins/default.css') }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon"
          href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/favicon.ico"
          type="image/x-icon">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;900&amp;family=Roboto:wght@400;500;700&amp;display=swap"
        rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ie10-viewport-bug-workaround.css') }}">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script type="text/javascript" src="{{ asset('js/html5shiv.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>

<!-- End Google Tag Manager (noscript) -->
{{--<div class="page_loader"></div>--}}

<div id="app">
    <!-- Option Panel -->
    <div class="option-panel option-panel-collased">
        <h2>Change Color</h2>
        <div class="color-plate default-plate" data-color="default"></div>
        <div class="color-plate blue-plate" data-color="blue"></div>
        <div class="color-plate yellow-plate" data-color="yellow"></div>
        <div class="color-plate red-plate" data-color="red"></div>
        <div class="color-plate green-light-plate" data-color="green-light"></div>
        <div class="color-plate orange-plate" data-color="orange"></div>
        <div class="color-plate yellow-light-plate" data-color="yellow-light"></div>
        <div class="color-plate green-light-2-plate" data-color="green-light-2"></div>
        <div class="color-plate olive-plate" data-color="olive"></div>
        <div class="color-plate purple-plate" data-color="purple"></div>
        <div class="color-plate blue-light-plate" data-color="blue-light"></div>
        <div class="color-plate brown-plate" data-color="brown"></div>
        <div class="setting-button">
            <i class="fa fa-gear"></i>
        </div>
    </div>
    <!-- /Option Panel -->

    <!-- Top header start -->
    <header class="top-header hidden-xs" id="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="list-inline">
                        <a href="tel:1-8X0-666-8X88"><i class="fa fa-phone"></i>1-8X0-666-8X88</a>
                        <a href="tel:info@themevessel.com"><i class="fa fa-envelope"></i>info@themevessel.com</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <ul class="top-social-media pull-right">
                        <li>
                            <a href="login.html" class="sign-in"><i class="fa fa-sign-in"></i> Login</a>
                        </li>
                        <li>
                            <a href="signup.html" class="sign-in"><i class="fa fa-user"></i> Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- Top header end -->

    <!-- Main header start -->
    <header class="main-header">
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#app-navigation" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index-2.html" class="logo">
                        <img src="img/logos/logo.png" alt="logo">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="navbar-collapse collapse" role="navigation" aria-expanded="true" id="app-navigation">
                    <ul class="nav navbar-nav">
                        <li class="dropdown active">
                            <a tabindex="0" href="#" data-toggle="dropdown" data-submenu="" aria-expanded="false">
                                Home<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="index-2.html">Home 1</a></li>
                                <li><a href="index-3.html">Home 2</a></li>
                                <li><a href="index-4.html">Home 3</a></li>
                                <li><a href="index-5.html">Home 4</a></li>
                                <li><a href="index-6.html">Home 5</a></li>
                                <li><a href="index-7.html">Home 6</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a tabindex="0" href="#" data-toggle="dropdown" data-submenu="" aria-expanded="false">
                                Properties<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a tabindex="0">List Layout</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="properties-list-rightside.html">Right Sidebar</a></li>
                                        <li><a href="properties-list-leftside.html">Left Sidebar</a></li>
                                        <li><a href="properties-list-fullwidth.html">Fullwidth</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a tabindex="0">Grid Layout</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="properties-grid-rightside.html">Right Sidebar</a></li>
                                        <li><a href="properties-grid-leftside.html">Left Sidebar</a></li>
                                        <li><a href="properties-grid-fullwidth.html">Fullwidth</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a tabindex="0">Map View</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="properties-map-leftside-list.html">Map List 1</a></li>
                                        <li><a href="properties-map-rightside-list.html">Map List 2</a></li>
                                        <li><a href="properties-map-leftside-grid.html">Map Grid 1</a></li>
                                        <li><a href="properties-map-rightside-grid.html">Map Grid 2</a></li>
                                        <li><a href="properties-map-full.html">Map FullWidth</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a tabindex="0">Property Detail</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="properties-details.html">Property Detail 1</a></li>
                                        <li><a href="properties-details-2.html">Property Detail 2</a></li>
                                        <li><a href="properties-details-3.html">Property Detail 3</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a tabindex="0" href="#" data-toggle="dropdown" data-submenu="" aria-expanded="false">
                                Agents<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="agent-listing-grid.html">Agent grid</a></li>
                                <li><a href="agent-listing-grid-sidebar.html">Agent Grid sidebarbar</a></li>
                                <li><a href="agent-listing-row.html">Agent list</a></li>
                                <li><a href="agent-listing-row-sidebar.html">Agent List Sidebarbar</a></li>
                                <li><a href="agent-single.html">Agent Detail</a></li>
                            </ul>
                        </li>
                        <li class="dropdown mega-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Pages <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu mega-dropdown-menu row">
                                <li class="col-lg-3 col-md-3 col-sm-6">
                                    <ul>
                                        <li class="dropdown-header dh2">Pages</li>
                                        <li><a href="about.html">About 1</a></li>
                                        <li><a href="about-2.html">About 2</a></li>
                                        <li><a href="services-1.html">Services 1</a></li>
                                        <li><a href="services-2.html">Services 2</a></li>
                                        <li><a href="pricing-tables.html">Pricing Tables 1</a></li>
                                        <li><a href="pricing-tables-2.html">Pricing Tables 2</a></li>
                                        <li><a href="pricing-tables-3.html">Pricing Tables 3</a></li>
                                    </ul>
                                </li>
                                <li class="col-lg-3 col-md-3 col-sm-6">
                                    <ul>
                                        <li class="dropdown-header dh2">Pages</li>
                                        <li><a href="faq.html">Faq 1</a></li>
                                        <li><a href="faq-2.html">Faq 2</a></li>
                                        <li><a href="gallery-1.html">Gallery 1</a></li>
                                        <li><a href="gallery-2.html">Gallery 2</a></li>
                                        <li><a href="gallery-3.html">Gallery 3</a></li>
                                        <li><a href="properties-comparison.html">Properties Comparison</a></li>
                                        <li><a href="search-brand.html">Search Brand</a></li>
                                    </ul>
                                </li>
                                <li class="col-lg-3 col-md-3 col-sm-6">
                                    <ul>
                                        <li class="dropdown-header dh2">Pages</li>
                                        <li><a href="contact.html">Contact 1</a></li>
                                        <li><a href="contact-2.html">Contact 2</a></li>
                                        <li><a href="contact-3.html">Contact 3</a></li>
                                        <li><a href="typography.html">Typography</a></li>
                                        <li><a href="elements.html">Elements</a></li>
                                        <li><a href="icon.html">Icon</a></li>
                                        <li><a href="404.html">Pages 404</a></li>

                                    </ul>
                                </li>
                                <li class="col-lg-3 col-md-3 col-sm-6">
                                    <ul>
                                        <li class="dropdown-header dh2">Pages</li>
                                        <li><a href="user-profile.html">User profile</a></li>
                                        <li><a href="my-properties.html">My Properties</a></li>
                                        <li><a href="favorited-properties.html">Favorited properties</a></li>
                                        <li><a href="submit-property.html">Submit Property</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="signup.html">Signup</a></li>
                                        <li><a href="forgot-password.html">Forgot Password</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a tabindex="0" href="#" data-toggle="dropdown" data-submenu="" aria-expanded="false">
                                Blog<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a tabindex="0">Classic</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="blog-classic-sidebar-right.html">Right
                                                Sidebar</a></li>
                                        <li><a class="dropdown-item" href="blog-classic-sidebar-left.html">Left
                                                Sidebar</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a tabindex="0">Columns</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="blog-columns-2col.html">2 Columns</a></li>
                                        <li><a class="dropdown-item" href="blog-columns-3col.html">3 Columns</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a tabindex="0">Blog Details</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="blog-single-sidebar-right.html">Right
                                                Sidebar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="blog-single-sidebar-left.html">Left
                                                Sidebar</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right rightside-navbar">
                        <li>
                            <a href="submit-property.html" class="button">
                                Submit Property
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- Main header end -->

    <!-- Banner start -->
    <div class="banner b6">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
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
    <!-- Banner end -->

    <!-- Search area start -->
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
</div>
<!-- Search area start -->


<script src="{{ asset('js/jquery-2.2.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-submenu.js') }}"></script>
<script src="{{ asset('js/rangeslider.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('js/jquery.scrollUp.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('js/leaflet-providers.js') }}"></script>
<script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
<script src="{{ asset('js/jquery.filterizr.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/maps.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
<!-- Custom javascript -->

</body>

</html>
