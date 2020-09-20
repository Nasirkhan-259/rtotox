<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Javascirpt constant -->
        <script>
            const plugin_path = '{{ asset('plugins') }}/';
            const base_url = '{{ url("") }}/';
        </script>

        <!-- WEB FONTS : use %7C instead of | (pipe) -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

        <!-- CORE CSS -->

        <!-- THEME CSS -->
        <link href="{{ asset('css/essentials.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/layout.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- THEME RED SCRIPTS -->
        <link href="{{ asset('css/header-1.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/color_scheme/red.css') }}" rel="stylesheet" type="text/css" id="color_scheme" />
        <link href="{{ asset('css/booking-widget.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- CUSTOM RTOTO CSS -->
        <link href="{{ asset('css/custom-rtoto.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/frontend.css') }}" rel="stylesheet" type="text/css" />
        @stack("styles")
    </head>
    <body class="smoothscroll enable-animation">

        <!-- SLIDE TOP -->
        <div id="slidetop">

            <div class="container">

                <div class="row">

                    <div class="col-md-4">
                        <h6><i class="icon-heart"></i> WHY SMARTY?</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Ut enim massa, sodales tempor convallis et, iaculis ac massa. </p>
                    </div>

                    <div class="col-md-4">
                        <h6><i class="fa-facheck"></i> RECENTLY VISITED</h6>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fa fa-angle-right"></i> Consectetur adipiscing elit amet</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> This is a very long text, very very very very very very very very very very very very </a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Lorem ipsum dolor sit amet</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Dolor sit amet,consectetur adipiscing elit amet</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Consectetur adipiscing elit amet,consectetur adipiscing elit</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h6><i class="icon-envelope"></i> CONTACT INFO</h6>
                        <ul class="list-unstyled">
                            <li><b>Address:</b> PO Box 21132, Here Weare St, <br /> Melbourne, Vivas 2355 Australia</li>
                            <li><b>Phone:</b> 1-800-565-2390</li>
                            <li><b>Email:</b> <a href="mailto:support@yourname.com">support@yourname.com</a></li>
                        </ul>
                    </div>

                </div>

            </div>

            <a class="slidetop-toggle" href="#"><!-- toggle button --></a>

        </div>
        <!-- /SLIDE TOP -->

        <div class="wrapper" id="app">

            <!-- Top Bar -->
            <div id="topBar">
                <div class="container">
                    <!-- right
                    <ul class="top-links list-inline float-right">
                        <li class="text-welcome">Welcome to Smarty, <strong>John Doe</strong></li>
                        <li>
                            <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#">
                            <i class="fa fa-user hidden-xs-down"></i> MY ACCOUNT</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="#"><i class="fa fa-history"></i> ORDER HISTORY</a></li>
                                <li class="divider"></li>
                                <li><a tabindex="-1" href="#"><i class="fa fa-cog"></i> MY SETTINGS</a></li>
                                <li class="divider"></li>
                                <li><a tabindex="-1" href="#"><i class="glyphicon glyphicon-off"></i> LOGOUT</a></li>
                            </ul>
                        </li>
                        <li><a href="userlogin.php">LOGIN</a></li>
                        <li><a href="agentlogin.php">AGENT LOGIN</a></li>
                    </ul>-->
                    <div class="top-links list-inline float-right margin-left-150">
                        <ul class="top-links list-inline pull-right">
                            <li class="text-welcome">Welcome to Smarty, <strong>John Doe</strong></li>
                            <li>
                                <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#">
                                    <i class="fa fa-user hidden-xs-down"></i> MY ACCOUNT</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="#"><i class="fa fa-history"></i> ORDER HISTORY</a></li>
                                    <li class="divider"></li>
                                    <li><a tabindex="-1" href="#"><i class="fa fa-cog"></i> MY SETTINGS</a></li>
                                    <li class="divider"></li>
                                    <li><a tabindex="-1" href="{{url('agent/logout')}}"><i class="glyphicon glyphicon-off"></i> LOGOUT</a></li>
                                </ul>
                            </li>
                            <li class="hidden-xs"><a href="{{ url('agent/login') }}"><i class="fa fa-user hidden-xs"></i>User LOGIN</a></li>
                            @auth('agent')
                            <li class="hidden-xs"><a href="{{ url('agent/login') }}"><i class="fa fa-user hidden-xs" style="color: #D50C45;"></i>Agent Login</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- left -->
                    <ul class="top-links list-inline">
                        <li><a href="page-faq-1.html">FAQ</a></li>
                        <li>
                            <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#">{{session("currency")}}</a>
                            <ul class="dropdown-langs dropdown-menu">
                                <li><a tabindex="-1" href="{{ url("settings/set-currency/USD") }}">USD</a></li>
                                <li><a tabindex="-1" href="{{ url("settings/set-currency/TZS") }}">TZS</a></li>
                                <li><a tabindex="-1" href="{{ url("settings/set-currency/KES") }}">KES</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- /Top Bar -->

            <!-- Top Nav -->
            <div id="header" class="navbar-toggleable-md sticky clearfix">

    <!-- SEARCH HEADER -->
    <div class="search-box over-header">
        <a id="closeSearch" href="#" class="fa fa-remove"></a>

        <form action="#" method="get">
            <input type="text" class="form-control" placeholder="SEARCH">
        </form>
    </div>
    <!-- /SEARCH HEADER -->

    <!-- TOP NAV -->
    <header id="topNav">
        <div class="container">

            <!-- Mobile Menu Button -->
            <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                <i class="fa fa-bars"></i>
            </button>

            <!-- BUTTONS -->
            <ul class="float-right nav nav-pills nav-second-main has-topBar">

                <!-- SEARCH -->
                <li class="search">
                    <a href="javascript:;">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <!-- /SEARCH -->

            </ul>
            <!-- /BUTTONS -->

            <!-- Logo -->
            <a class="logo float-left" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="">
            </a>
            <div class="navbar-collapse collapse float-right nav-main-collapse submenu-dark">
                <nav class="nav-main">

                    <ul id="topMain" class="nav nav-pills nav-main has-topBar">
                        <li class="">
                            <!-- HOME -->
                            <a class="" href="{{ url('/') }}">
                                HOME
                            </a>

                        </li>
                        <li class="dropdown">
                            <!-- PAGES -->
                            <a class="dropdown-toggle" href="#">
                                ABOUT
                            </a>
                            <ul class="dropdown-menu has-topBar">

                                <li><a href="#">The Group</a></li>
                                <li><a href="#">News & Updates</a></li>
                                <li><a href="#">CSR</a></li>
                            </ul>
                        </li>

                        <li class="">
                            <!-- PACKAGES -->
                            <a class="" href="index.php">
                                PACKAGES
                            </a>

                        </li>
                        <li class="">
                            <!-- HOME -->
                            <a class="" href="index.php">
                                SERVICES
                            </a>

                        </li>
                        <li class="">
                            <!-- HOME -->
                            <a class="" href="index.php">
                                FEATURES
                            </a>

                        </li>
                        <li class="">
                            <!-- HOME -->
                            <a class="" href="index.php">
                                CONTACT
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!-- /Top Nav -->
</div>
            <!-- /Top Nav -->

            @yield('breadcrumb')



                @yield('content')

            </div>

            <!-- FOOTER -->
            <footer id="footer">
                <div class="container">

                    <div class="row">

                        <div class="col-md-3">
                           <!-- Small Description -->
                            <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>

                            <!-- Contact Address -->
                            <address>
                                <ul class="list-unstyled">
                                    <li class="footer-sprite address">
                                        PO Box 21132<br>
                                        Here Weare St, Melbourne<br>
                                        Vivas 2355 Australia<br>
                                    </li>
                                    <li class="footer-sprite phone">
                                        Phone: 1-800-565-2390
                                    </li>
                                    <li class="footer-sprite email">
                                        <a href="mailto:support@yourname.com">support@yourname.com</a>
                                    </li>
                                </ul>
                            </address>
                            <!-- /Contact Address -->

                        </div>

                        <div class="col-md-3">

                            <!-- Latest Blog Post -->
                            <h4 class="letter-spacing-1">LATEST NEWS</h4>
                            <ul class="footer-posts list-unstyled">
                                <li>
                                    <a href="#">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue</a>
                                    <small>29 June 2017</small>
                                </li>
                                <li>
                                    <a href="#">Nullam id dolor id nibh ultricies</a>
                                    <small>29 June 2017</small>
                                </li>
                                <li>
                                    <a href="#">Duis mollis, est non commodo luctus</a>
                                    <small>29 June 2017</small>
                                </li>
                            </ul>
                            <!-- /Latest Blog Post -->

                        </div>

                        <div class="col-md-2">

                            <!-- Links -->
                            <h4 class="letter-spacing-1">EXPLORE SMARTY</h4>
                            <ul class="footer-links list-unstyled">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Our Services</a></li>
                                <li><a href="#">Our Clients</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                            <!-- /Links -->

                        </div>

                        <div class="col-md-4">

                            <!-- Newsletter Form -->
                            <h4 class="letter-spacing-1">KEEP IN TOUCH</h4>
                            <p>Subscribe to Our Newsletter to get Important News &amp; Offers</p>

                            <form class="validate" action="php/newsletter.php" method="post" data-success="Subscribed! Thank you!" data-toastr-position="bottom-right">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" id="email" name="email" class="form-control required" placeholder="Enter your Email">
                                    <span class="input-group-btn">
										<button class="btn btn-success" type="submit">Subscribe</button>
									</span>
                                </div>
                            </form>
                            <!-- /Newsletter Form -->

                            <!-- Social Icons -->
                            <div class="mt-20">
                                <a href="#" class="social-icon social-icon-border social-facebook float-left" data-toggle="tooltip" data-placement="top" title="Facebook">

                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>

                                <a href="#" class="social-icon social-icon-border social-twitter float-left" data-toggle="tooltip" data-placement="top" title="Twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>

                                <a href="#" class="social-icon social-icon-border social-gplus float-left" data-toggle="tooltip" data-placement="top" title="Google plus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>

                                <a href="#" class="social-icon social-icon-border social-linkedin float-left" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                    <i class="icon-linkedin"></i>
                                    <i class="icon-linkedin"></i>
                                </a>

                                <a href="#" class="social-icon social-icon-border social-rss float-left" data-toggle="tooltip" data-placement="top" title="Rss">
                                    <i class="icon-rss"></i>
                                    <i class="icon-rss"></i>
                                </a>

                            </div>
                            <!-- /Social Icons -->

                        </div>

                    </div>

                </div>

                <div class="copyright">
                    <div class="container">
                        <ul class="float-right m-0 list-inline mobile-block">
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li>&bull;</li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                        &copy; All Rights Reserved, Red Travel Group
                    </div>
                </div>
            </footer>
            <!-- /FOOTER -->
        </div>
        <!-- /wrapper -->

        <!-- SCROLL TO TOP -->
        <a href="#" id="toTop"></a>


        <!-- JAVASCRIPT Libraries -->
        <script src="{{ asset('plugins/jquery/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/jquery/jquery-ui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/typeahead.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{asset('js/nouislider.min.js')}}"></script>
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/scripts.js') }}" type="text/javascript"></script>
        @stack('scripts')
    </body>
</html>
