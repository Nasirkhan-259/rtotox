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
    <link href="{{asset('css/header-1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/color_scheme/red.css')}}" rel="stylesheet" type="text/css" id="color_scheme" />



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

<!-- wrapper -->
<div id="wrapper">
    <!-- Top Bar -->
<!-- /Top Bar -->

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

                <!-- Mobile Menu Button -->
                <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>



                <!-- corproate Logo -->
                <a class="logo float-left" href="index.php">
                    <img src="../assets/images/corporate-logos/corp-demo.jpg" alt="">
                </a>
                <!-- /corporate Logo -->
                <div class="navbar-collapse collapse float-right nav-main-collapse submenu-dark">
                    <nav class="nav-main">

                        <ul id="topMain" class="nav nav-pills nav-main has-topBar">
                            <li class="dropdown">
                                <!-- plan your travel -->
                                <a class="dropdown-toggle" href="#">
                                    Company Setup
                                </a>
                                <ul class="dropdown-menu has-topBar">

                                    <li><a href="{{url('')}}">Departments</a></li>
                                    <li><a href="#">Hotels</a></li>
                                    <li><a href="#">Transfer</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <!-- plan your travel -->
                                <a class="dropdown-toggle" href="#">
                                    PLAN YOUR TRAVEL
                                </a>
                                <ul class="dropdown-menu has-topBar">

                                    <li><a href="#">Flights</a></li>
                                    <li><a href="#">Hotels</a></li>
                                    <li><a href="#">Transfer</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <!-- plan your travel -->
                                <a class="dropdown-toggle" href="#">
                                    TRIPS
                                </a>
                                <ul class="dropdown-menu has-topBar">

                                    <li><a href="#">My Confirmed Trips</a></li>
                                    <li><a href="#">Trip Status</a></li>

                                </ul>
                            </li>

                            <li class="dropdown">
                                <!-- plan your travel -->
                                <a class="dropdown-toggle" href="#">
                                    SETTINGS
                                </a>
                                <ul class="dropdown-menu has-topBar">

                                    <li><a href="#">My Profile</a></li>
                                    <li><a href="#">Logout</a></li>

                                </ul>
                            </li>


                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!-- /Top Nav -->
    </div>
    <section class="page-header parallax parallax-3" style="background-image:url('img/airport.jpg')">
        <div class="overlay dark-5">
            <!-- dark overlay [1 to 9 opacity] -->
        </div>
        <div class="container">
            <h1 class="float-left fs-lato">Corporate Travel Desk
            </h1>
            <h1 class="float-right">Corporate Name
            </h1>
            </span>
        </div>
    </section>
    @yield('content');
</div>
</body>

<!-- FOOTER -->
<footer id="footer">
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <!-- Footer Logo -->
                <img class="footer-logo" src="assets/images/_smarty/logo-footer.png" alt="" />

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
                    <li><a href="#">Company Setup</a></li>
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

    <!-- JAVASCRIPT FILES -->
    <script>
        var plugin_path = '../assets/plugins/';
    </script>
    <script src="{{asset('plugins/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
    @stack('scripts')

</footer>


</html>