<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Red Travel Group - travel made easy!</title>
    <meta name="description" content="" />


    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- WEB FONTS : use %7C instead of | (pipe) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <!-- THEME CSS -->
    <link href="{{asset('css/essentials.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/layout.css')}}" rel="stylesheet" type="text/css" />

    <!-- THEME RED SCRIPTS -->
    <link href="{{asset('css/header-1.css')}}"  rel="stylesheet" type="text/css" />
    <link href="{{asset('css/color_scheme/red.css')}}" rel="stylesheet" type="text/css" id="color_scheme" />

    <style>
        .login-box {
            background-color: #fff;
            border-radius: 6px;
            padding: 30px 15px;
            display: block;
            position: relative;
            text-align: left;
            -webkit-box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="smoothscroll enable-animation">
<!-- wrapper -->
<div id="wrapper">

    <div id="header" class="navbar-toggleable-md sticky clearfix">

        <!-- SEARCH HEADER -->
        <div class="search-box over-header">
            <a id="closeSearch" href="#" class="fa fa-remove"></a>

            <form action="page-search-result-1.html" method="get">
                <input type="text" class="form-control" placeholder="SEARCH">
            </form>
        </div>
        <!-- /SEARCH HEADER -->


        <!-- TOP NAV -->
        <header id="topNav">
            <div class="container">

                <!-- Logo -->
                <a class="logo float-left" href="index.php">
                    <img src="{{ADMINURLIMG.$corporate->logo}}" alt="">
                </a>

            </div>
        </header>
        <!-- /Top Nav -->
    </div>

{{--     Slider --}}


    <section class="m-0" data-background-delay="3500" data-background-fade="1000" data-background="../images/airport.jpg,../images/plane.jpg"
             style="position: relative; z-index: 0;">


        <div class="container z-index-1">
            <div class="row">
                <!-- RIGHT COLUMN -->
                <div class="col-lg-6 col-md-6 col-xs-12 order-lg-2 order-md-2 text-md-right text-sm-center text-xs-center">
                    <h1 class="m-0 fs-40 fw-400 text-white wow fadeInUp animated animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">{{$corporate->name}}</h1>
                    <p class="lead fs-16 fw-300 text-white wow fadeInUp animated animated" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInUp;">WELCOME TO TRAVELDESK</p>
                </div>

                <!-- LEFT COLUMN -->
                <div class="col-lg-6 col-md-6 col-md-6 col-xs-12 order-lg-1 order-md-1 mb-0">
                    <div class="login-box p-20">
                        <h2 class="restate-box-title mb-30 block">
                            <i class="fa fa-user text-silver"></i> &nbsp;
                            CORPORATE LOGIN
                        </h2>
                        @if (session('errors'))
                            <div class="alert alert-danger">
                                {{ session('errors') }}
                            </div>
                        @endif
                        <form class="m-0" method="post" action="{{url('corporate/login')}}" autocomplete="off">
                            {{csrf_field()}}
                            <div class="clearfix">
                                <input type="hidden" name="corporate_name" value="{{$corporate->name}}">
                                <!-- Email -->
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email" required="">
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <!-- Inform Tip -->
                                    <div class="form-tip pt-20">
                                        <a class="no-text-decoration fs-13 mt-10 block" href="{{url('corporate/'.strtolower($corporate->alais).'/forget/password')}}">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                    <button type="submit" class="btn btn-primary">OK, LOG IN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /container -->

        <span class="overlay dark-6 z-index-0">
<!-- dark|light overlay [0 to 9 opacity] -->
</span>

    </section>



    <section>
        <div class="container">

            <div class="row grid-color">
                <div class="col-md-6"><span>6</span></div>
                <div class="col-md-6"><span>6</span></div>
            </div>


        </div>
    </section>
    <!-- / -->


    <footer id="footer">
        <div class="container">

            <div class="row">

                <div class="col-md-3">
                    <!-- Footer Logo -->
                    <img class="footer-logo" src="{{asset('images/_smarty/logo-footer.png')}}" alt="" />

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
                Powered By Red Travel Group
            </div>
        </div>
    </footer>



</div>
<!-- /wrapper -->

<!-- SCROLL TO TOP -->
<a href="#" id="toTop"></a>

<!-- JAVASCRIPT FILES -->
<script>
    var plugin_path = '../plugins/';
</script>
<script src="{{ asset('plugins/jquery/jquery-3.3.1.min.js') }}" type="text/javascript"></script>

<script src="{{asset('js/scripts.js')}}"></script>
</body>

</html>