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
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="copy-right">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12 text-center">
                <p>&copy; 2020 - {{ date('Y') }}
                    <a href="#" style="color: #ffb400">{{ config('app.name') }}</a>.
                    All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</div>
