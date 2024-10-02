<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gaurakshashala') }}</title>
    <meta name="app_url" content="{{ env('APP_URL') }}">
    <meta name="description" content="Gaurakshashala">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/favicon.ico') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Revolution Slider CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/revolution/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/revolution/css/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/revolution/css/navigation.css') }}">

    <!-- Bootstrap Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- Animate Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <!-- IcoFont Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/icofont.min.css') }}">
    <!-- Odometer Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/odometer.min.css') }}">
    <!-- Owl Carousel Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <!-- Magnific Popup Min CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.min.css') }}">
    <!-- MeanMenu CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.min.css') }}">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/jassor.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <title>GOSHALA</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/img/favicon.png') }}">

    @vite(['resources/js/backend.js'])

    @yield('styles')

    <style>
        @media (min-width: 768px) and (max-width:1920px) {
            .destop {
                display: none !important;
            }
        }

        @media (max-width: 767px) {
            .mobile-icons {
                background: #0E1E36;
                width: 100%;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                flex-flow: wrap;
                text-align: center;
                color: #fff;
                position: fixed;
                bottom: 0;
                z-index: 1;
                font-size: 15px;
                border-top: 2px solid gray;
                height: 70px;
            }
        }

        .wp {
            cursor: pointer;
            position: fixed;
            top: 70%;
            right: 0%;
            z-index: 9999;
            bottom: 30%;
            width: 55px;
            height: 50px;
        }

        @media only screen and (max-width :768px) {
            .wp {
                display: none;
            }
        }
    </style>

</head>

<body>

    <div class="destop">
        <div class="mobile-icons " style="z-index:9999;padding-top:5px;">
            <div>
                @if ($settings->phone_1)
                    <a href="tel:  +91 {{ $settings->phone_1 }}">
                        <i class="fa fa-phone" style="font-size:25px;color:#fff;"></i>
                        <p style="color:#fff;">CALL NOW</p>
                    </a>
                @endif
            </div>
            <div>
                @if ($settings->phone_1)
                    <a href="https://api.whatsapp.com/send?phone=  :   +91 {{ $settings->phone_1 }} &text=Interested in share More Details"
                        target="_blank">
                        <img src="img/wp.png" alt="" style="width: 30%;">
                        <p style="color:#fff;">WHAT'S APP</p>
                    </a>
                @endif
            </div>
        </div>
    </div>
    @if ($settings->phone_1)
        <div style="cursor:pointer" class="wp wp2">
            <a href="https://api.whatsapp.com/send?phone= +91 {{ $settings->phone_1 }} &text=Hi Sir, Please share Me More Details "
                target="_blank"><img src="{{ asset('frontend/images/whatsapp-png-logo-7.png') }}"
                    title="Connect With Us on Whatsapp" style="width: 55px; height:55px;">
            </a>
        </div>
    @endif


    <!-- Start Navbar Area -->
    <div class="navbar-area">
        <div class="semental-mobile-nav">
            <div class="logo">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="logo" style="width:150px;">
            </div>
        </div>

        <div class="semental-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">

                    <a class="navbar-brand" href="{{ url('/') }}" style="padding: 0px 15px;">
                        <img src="{{ asset('frontend/images/logo.png') }}" alt="logo"
                             style="border-radius: 50%;height: 100px;width: 100px;">
                    </a>

                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link active">Home </a>

                            </li>

                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link">About Us <i
                                        class="icofont-simple-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="{{ url('/about-us') }}" class="nav-link">About</a>
                                    </li>
                                    <li class="nav-item"><a href="{{ url('/our-trustees') }}" class="nav-link">Our
                                            Trustees</a></li>
                                </ul>
                            </li>

                            <li class="nav-item"><a href="javascript:void(0);" class="nav-link">Projects <i
                                        class="icofont-simple-down"></i></a>
                                <ul class="dropdown-menu">

                                    @foreach ($projects as $item)
                                        <li class="nav-item">
                                            <a href="{{ url('/projects/'. $item->slug) }}" class="nav-link ">{{ $item->name }}</a>
                                        </li>
                                    @endforeach

                                    {{-- <li class="nav-item">
                                        <a href="shelter.html" class="nav-link ">Shelter</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="hospital.html" class="nav-link ">Hospital</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="protection.html" class="nav-link ">Protection</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="milk-distribution.html" class="nav-link ">Milk
                                            Distribution</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="protection-drive.html" class="nav-link ">Protection
                                            Drive</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="organic-farming.html" class="nav-link ">Organic
                                            Farming</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="calamity.html" class="nav-link ">Calamity</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="yagya-cultural-events.html" class="nav-link ">Yagya
                                            & cultural events</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="bio-cng-plant-powered-by-ongc.html"
                                            class="nav-link ">BIO CNG plant powered by ONGC</a>
                                    </li> --}}
                                </ul>
                            </li>



                            <li class="nav-item"><a href="javascript:void(0)" class="nav-link">Get Involved <i
                                        class="icofont-simple-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="{{ url('/service/adopt-cow') }}"
                                            class="nav-link active">Adopt a cow</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/service/volunteer') }}" class="nav-link">Become A
                                            Volunteer Form
                                        </a>
                                    </li>
                                    <li class="nav-item"><a href="{{ url('/donate') }}"
                                            class="nav-link">Donation</a></li>
                                </ul>
                            </li>

                            <li class="nav-item"><a href="#" class="nav-link">Live Streaming</a></li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link">Gallery<i class="icofont-simple-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ url('/gallery') }}" class="nav-link ">Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/videos') }}" class="nav-link ">Our Videos</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link">Blogs<i class="icofont-simple-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ url('/blogs') }}" class="nav-link ">Blogs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/news') }}" class="nav-link ">News</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/events') }}" class="nav-link ">Events</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item"><a href="{{ url('/contact-us') }}" class="nav-link">Contact Us</a>
                            </li>

                        </ul>

                        <div class="others-options">
                            <a href="{{ url('/donate') }}" class="btn btn-primary">Donate Now<i
                                    class="icofont-simple-right"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->




    @yield('content')



    {{-- Footer Area --}}

    <!-- Start Footer Area -->
    @include('frontend/layouts/footer')
    <!-- End Footer Area -->

    <div class="go-top"><i class="icofont-swoosh-up"></i><i class="icofont-swoosh-up"></i></div>

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <!-- Bootstrap Min JS -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!-- MeanMenu JS -->
    <script src="{{ asset('frontend/js/jquery.meanmenu.js') }}"></script>
    <!-- Appear Min JS -->
    <script src="{{ asset('frontend/js/jquery.appear.min.js') }}"></script>
    <!-- Parallax min JS -->
    <script src="{{ asset('frontend/js/parallax.min.js') }}"></script>
    <!-- Odometer Min JS -->
    <script src="{{ asset('frontend/js/odometer.min.js') }}"></script>
    <!-- Owl Carousel Min JS -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup Min JS -->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Fancybox JS -->
    <script src="{{ asset('frontend/js/fancybox.min.js') }}"></script>
    <!-- WOW Min JS -->
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <!-- ajaxChimp Min JS -->
    <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script src="{{ asset('frontend/js/validation.min.js') }}"></script>
    <script src="{{ asset('frontend/js/additional.validation.min.js') }}"></script>

    <!-- Slider Revolution core JavaScript files -->
    <script src="{{ asset('frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('frontend/js/rev-slider-custom.js') }}"></script>
    <script src="{{ asset('frontend/js/jassor.js') }}"></script>
    <script src="{{ asset('frontend/js/jssor.slider-27.1.0.min.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
        let base_url = $('meta[name="app_url"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    @yield('scripts')

    <script type="text/javascript">
        jssor_1_slider_init();
    </script>

</body>

</html>
