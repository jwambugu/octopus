<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ mix('js/app.js') }}" defer></script>


    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-submenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" type="text/css">--}}
    {{--    <link rel="stylesheet" href="{{ asset('css/map.css') }}" type="text/css">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/linearicons/style.css') }}">
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}">--}}


    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    {{--    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('css/skins/default.css') }}">--}}
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('css/skins/yellow.css') }}">


    <link rel="shortcut icon"
          href="https://storage.googleapis.com/theme-vessel/template-images/nest-html/assets/img/favicon.ico"
          type="image/x-icon">


    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPlayfair+Display:400,700%7CRoboto:100,300,400,400i,500,700">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;900&amp;family=Roboto:wght@400;500;700&amp;display=swap"
        rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{ asset('css/ie10-viewport-bug-workaround.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script type="text/javascript" src="{{ asset('js/html5shiv.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body>


{{--<div class="page_loader"></div>--}}

<div id="app">
    @include('partials._header')

    @yield('content')

    @include('partials._footer')
</div>


<script src="{{ asset('js/jquery-2.2.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-submenu.js') }}"></script>
{{--<script src="{{ asset('js/rangeslider.js') }}"></script>--}}
{{--<script src="{{ asset('js/wow.min.js') }}"></script>--}}
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
{{--<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>--}}
{{--<script src="{{ asset('js/jquery.scrollUp.js') }}"></script>--}}
{{--<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/leaflet.js') }}"></script>--}}
{{--<script src="{{ asset('js/leaflet-providers.js') }}"></script>--}}
{{--<script src="{{ asset('js/leaflet.markercluster.js') }}"></script>--}}
{{--<script src="{{ asset('js/jquery.filterizr.js') }}"></script>--}}
{{--<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/maps.js') }}"></script>--}}
<script src="{{ asset('js/main.js') }}"></script>


<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>

</body>
</html>
