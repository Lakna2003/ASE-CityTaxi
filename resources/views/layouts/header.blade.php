<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themesjungle.net/html/primecab/home-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jan 2024 16:38:36 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="description" content="Prime Cab HTML56 Responsive Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>City Taxi</title>

    <!-- Css Files Start -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link id="switcher" href="{{ asset('css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('css/color-switcher.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icomoon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <!-- Css Files End -->

    <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 <![endif]-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>



</head>

<body>
    <!--Wrapper Content Start-->
    <div class="tj-wrapper">
        <div class="loader-outer">
            <div class="tj-loader">
                <img src="{{ asset('images/pre-loader.gif') }}" alt="">
                <h2>Loading...</h2>
            </div>
        </div>
        <!--Style Switcher Section Start-->

        <!--Style Switcher Section End-->
        <header class="tj-header">
            <!--Header Content Start-->
            <div class="container">
                <div class="row">
                    <!--Toprow Content Start-->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <!--Logo Start-->
                        <div class="tj-logo">
                            <h1><a href="{{ route('home') }}">City Taxi</a></h1>
                        </div>
                        <!--Logo End-->
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="info_box">
                            <i class="fa fa-home"></i>
                            <div class="info_text">
                                <span class="info_title">Address</span>
                                <span>Matara, Sri Lanka</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="info_box">
                            <i class="fa fa-envelope"></i>
                            <div class="info_text">
                                <span class="info_title">Email Us</span>
                                <span><a href="mailto:citytaxihead@gmail.com">citytaxihead@gmail.com</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="phone_info">
                            <div class="phone_icon">
                                <i class="fas fa-phone-volume"></i>
                            </div>
                            <div class="phone_text">
                                <span><a href="tel:+94-76-541-7849">+94-76-541-7849</a></span>
                            </div>
                        </div>
                    </div>
                    <!--Toprow Content End-->
                </div>
            </div>

            <div class="tj-nav-row">
                <div class="container">
                    <div class="row">
                        <!--Nav Holder Start-->
                        <div class="tj-nav-holder">
                            <!--Menu Holder Start-->
                            <nav class="navbar navbar-default">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                        data-target="#tj-navbar-collapse" aria-expanded="false">
                                        <span class="sr-only">Menu</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <!-- Navigation Content Start -->
                                <div class="collapse navbar-collapse" id="tj-navbar-collapse">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown"> <a href="/">Home</a>

                                        </li>
                                        <li>
                                            <a href="#">About us</a>
                                        </li>
                                        <li class="dropdown"> <a href="#" class="dropdown-toggle"
                                                data-toggle="dropdown" role="button" aria-haspopup="true"
                                                aria-expanded="false">Services</a>

                                        </li>

                                        @if (Auth::check())
                                            @php
                                                $userId = Auth::id();
                                                $hasDesiredRole = \DB::table('user_roles')
                                                    ->where('user_id', $userId)
                                                    ->whereIn('role_id', [1, 4])
                                                    ->exists();
                                            @endphp

                                            @if ($hasDesiredRole)
                                                <li><a href="{{ route('operator.dashboard') }}">Admin</a></li>
                                            @endif
                                        @endif

                                        <ul class="nav navbar-nav">
                                            <!-- Authentication Links -->
                                            @guest
                                                @if (Route::has('login'))
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ route('login') }}"><span
                                                                style="font-weight: bold;">{{ __('Login') }}</span></a>
                                                    </li>
                                                @endif
                                            @else
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                        role="button" aria-haspopup="true" aria-expanded="false"> <i
                                                            class="fa fa-circle" style="margin-right: 10px;"></i><span
                                                            style="font-weight: bold;">{{ Auth::user()->name }}</span><i
                                                            class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                    <ul class="dropdown-menu">

                                                        <li><a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                                        </li>

                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </ul>
                                                </li>

                                            @endguest
                                        </ul>




                                    </ul>


                                </div>
                                <!-- Navigation Content Start -->
                            </nav>
                            <!--Menu Holder End-->


                            @guest
                                <div class="book_btn">
                                    <a href="contact.html">Book Now <i class="fa fa-arrow-circle-right"
                                            aria-hidden="true"></i></a>
                                </div>
                            @else
                                <div id="bookNowBtn" class="book_btn">
                                    <a href="contact.html">Book Now <i class="fa fa-arrow-circle-right"
                                            aria-hidden="true"></i></a>
                                </div>

                                <div id="becomeDriverBtn" class="book_btn">
                                    <a href="{{ route('driver.register') }}" style="background-color: #198754;">Become a
                                        Driver <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                </div>

                                <div id="driverProfile" class="book_btn">
                                    <a href="#" onclick="checkDriverProfileStatus()"
                                        style="background-color: #ffc107;">Driver
                                        Profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                </div>

                            @endguest
                        </div><!--Nav Holder End-->
                    </div>
                </div>
            </div>
        </header>
        <!--Header Content End-->


        @yield('content')

        <!--Footer Copyright Start-->
        <section class="tj-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <p>&copy; Copyrights 2024 <a href="{{ route('home') }}">City Taxi</a>. All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <ul class="payment-icons">
                            <li><i class="fab fa-cc-visa"></i></li>
                            <li><i class="fab fa-cc-mastercard"></i></li>
                            <li><i class="fab fa-cc-paypal"></i></li>
                            <li><i class="fab fa-cc-discover"></i></li>
                            <li><i class="fab fa-cc-jcb"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--Footer Copyright End-->
    </div>
    <!--Wrapper Content End-->

    <script>
        $(document).ready(function() {
            // Make an asynchronous request to your backend endpoint
            $.ajax({
                url: "{{ route('check.driver.registered') }}", // Replace with your actual backend endpoint
                method: "GET",
                success: function(response) {
                    // Check the response and perform actions accordingly
                    if (response.success) {
                        $('#becomeDriverBtn').hide();
                        $('#driverProfile').show();

                    } else {
                        console.log('User is not a registered driver.');
                        $('#becomeDriverBtn').show();
                        $('#driverProfile').hide();
                    }
                },
                error: function(error) {
                    console.error('Error in AJAX request:', error);
                }
            });
        });


        function checkDriverProfileStatus() {
            $.ajax({
                url: "{{ route('check.driver.profile.status') }}", // Replace with your actual backend endpoint
                method: "GET",
                success: function(response) {
                    if (response.code === 'active') {
                        window.location.href = "{{ route('driver.profile') }}";
                    } else if (response.code === 'inactive') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    } else if (response.code === 'pending') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Wait!',
                            text: response.message,
                        });
                    } else if (response.code === 'declined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    } else if (response.code === 'unknown') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    } else if (response.code === 'not_found') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    }
                },
                error: function(error) {
                    console.error('Error in AJAX request:', error);
                }
            });

        }
    </script>

    <!-- Js Files Start -->
    <script src="{{ asset('js/jquery-1.12.5.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/migrate.js') }}""></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}""></script>
    <script src="{{ asset('js/color-switcher.js') }}""></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}""></script>
    <script src="{{ asset('js/waypoints.min.js') }}""></script>
    <script src="{{ asset('js/tweetie.js') }}""></script>
    <script src="{{ asset('js/custom.js') }}""></script>
    <!-- Js Files End -->
</body>

<!-- Mirrored from themesjungle.net/html/primecab/home-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jan 2024 16:38:55 GMT -->

</html>
