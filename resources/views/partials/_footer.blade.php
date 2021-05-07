<footer class="main-footer clearfix">
    <div class="container">

        <div class="footer-info">
            <div class="pull-right">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-item fi2">
                            <div class="main-title-2">
                                <h1 style="text-transform: none">Contact Us</h1>
                            </div>
                            <ul class="personal-info">
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    Harlequin Suites, <br> Nairobi Kenya
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:{{ config('mail.from.address') }}"><i
                                            class="fa fa-envelope"></i>
                                        {{ config('mail.from.address') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{--                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">--}}
                    {{--                    <div class="footer-item">--}}
                    {{--                        <div class="main-title-2">--}}
                    {{--                            <h1>Quick Links</h1>--}}
                    {{--                        </div>--}}
                    {{--                        <ul class="links">--}}
                    {{--                            @auth--}}
                    {{--                                <li>--}}
                    {{--                                    <a href="{{ route('home') }}">My Account</a>--}}
                    {{--                                </li>--}}
                    {{--                            @endauth--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ route('index') }}">Home</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ route('about-us') }}">About Us</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ route('contact-us') }}">Contact Us</a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="copy-right">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8 col-sm-12">
                <p>&copy; 2020 - {{ date('Y') }}
                    <a href="{{ route('index') }}" target="_blank">{{ config('app.name') }}</a>.
                    All Rights Reserved.
                </p>
            </div>
            <div class="col-md-4 col-sm-12">
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
                    <li>
                        <a href="#" class="rss-bg">
                            <i class="fa fa-rss"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
