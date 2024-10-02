@extends('frontend.layouts.app')

@section('content')

    <style>
        .horse-society-card {
            margin-bottom: 30px;
            height: 400px !important;

        }
    </style>

    @php
        $about = \App\Models\About::where('id', 1)->first();
    @endphp

    <!-- Start Page Title Area -->
    <div class="page-title-area bg3 jarallax" data-jarallax='{"speed": 0.2}'
        style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>About Us</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start About Area -->
    <section class="about-area ptb-80">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-image">
                        @if (Storage::disk('public')->has($about->image))
                            <img src="{{ asset('storage/' . $about->image) }}" alt="image">
                        @else
                            <img src="{{ asset('frontend/images/abt.png') }}" alt="image">
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-content">
                        <span>About Us</span>
                        <h2>{{ $about->heading }} </h2>
                        <p>
                            {{ $about->short_desc_1 }}
                        </p>
                        <p>
                            {{ $about->short_desc_2 }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-12">
                    {{ $about->more_desc }}
                </div>
            </div>


        </div>
    </section>
    <!-- End About Area -->
    <!-- Start Courses Area -->
    <!-- Start Horse Society Area -->
    <div class="horse-society-wrap-area pt-70 pb-70" style="background-color:#09351c">
        <div class="container">
            <div class="section-title with-wrap-style">
                <span>Care for Cows</span>
                <h2 style="color: #ffffff !important;">Our vision and mission </h2>
            </div>

            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 col-md-6">
                    <div class="horse-society-card">
                        <div class="horse-society-content">
                            <div class="icon-image">
                                <img src="{{ asset('frontend/images/icons/vision (1).png') }}" alt="icon" style="width:50px;">
                            </div>
                            <div class="content">
                                <h3>
                                    <a href="javascript:void(0);">Vision</a>
                                </h3>
                                <p>
                                    {{ $about->vision }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="horse-society-card">
                        <div class="horse-society-content">
                            <div class="icon-image">
                                <img src="{{ asset("frontend/images/icons/mission (2).png") }}" alt="icon" style="width:50px;">
                            </div>
                            <div class="content">
                                <h3>
                                    <a href="javascript:void(0)">Mission</a>
                                </h3>
                                <p>
                                    {{ $about->mission }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="horse-society-card">
                        <div class="horse-society-content">
                            <div class="icon-image">
                                <img src="{{ asset("frontend/images/icons/value (1).png") }}" alt="icon" style="width:50px;">
                            </div>
                            <div class="content">
                                <h3>
                                    <a href="javascriot:void(0)">Our Core Values</a>
                                </h3>
                                <p>
                                    {{ $about->core_values }}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Horse Society Area -->
@endsection
