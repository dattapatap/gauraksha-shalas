<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="logo" style="width:130px;border-radius:50%">
                        </a>
                    </div>
                    <p>
                        {!! Str::limit($abouts->short_desc_1, 188, '...') !!}
                    </p>
                    <ul class="social">
                        <li><a href="@if($settings->f_link){{$settings->f_link}}  @else # @endif" target="_blank"><i class="icofont-facebook"></i></a></li>
                        <li><a href="@if($settings->t_link){{$settings->t_link}}  @else # @endif" target="_blank"><i class="icofont-twitter"></i></a></li>
                        <li><a href="@if($settings->i_link){{$settings->i_link}}  @else # @endif" target="_blank"><i class="icofont-instagram"></i></a></li>
                        <li><a href="@if($settings->y_link){{$settings->y_link}}  @else # @endif" target="_blank"><i class="icofont-youtube"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <h3>Quick Links</h3>
                    <ul class="services-list">
                        <li><a href="{{ url('/about-us') }}">About Us</a></li>
                        <li><a href="{{ url('/donate') }}">Donate</a></li>
                        <li><a href="{{ url('/gallery') }}">Gallery</a></li>
                        <li><a href="{{ url('/videos') }}">Our Videos</a></li>
                        <li><a href="{{ url('/blogs')}}">Blogs</a></li>
                        <li><a href="{{ url('/news')}}">News</a></li>
                        <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <h3>Contacts</h3>

                    <ul class="contact-info">
                        <h5 class="text-white"> {{ $settings->name }} </h5>
                        <li><span>Address :</span> {{ $settings->address }} </li>
                        <li><span>Email :</span>
                            <a href="#!">
                                {{ $settings->email_1 }}
                            </a>
                            @isset($settings->email_2)
                            ,
                            <a href="#!"> {{ $settings->email_2 }}
                            </a>
                            @endisset

                        </li>
                        <li><span>Phone :</span>
                            <a href="tel:{{$settings->phone_1}}">{{ $settings->phone_1 }}</a>
                            @isset($settings->phone_2)
                            , <a href="tel:{{$settings->phone_2}}">{{ $settings->phone_2 }}</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-footer-widget">
                    <h3>QR Code</h3>
                    <div style="border: 3px solid #ffff; padding: 3px; display: inline-block;">
                        {!! QrCode::size(200)->generate(Request::fullUrl()) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="copyright-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <p>©2024 {{ strtoupper($settings->name) }} <span class="text-white fw-semibold"> . All rights reserved</span></p>
                </div>

                <div class="col-lg-6 col-md-6">
                    <ul>
                        <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ url('/about-us') }}">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
