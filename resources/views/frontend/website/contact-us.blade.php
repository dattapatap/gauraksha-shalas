@extends('frontend.layouts.app')

@section('content')
    <div class="page-title-area bg2" style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>Contact Us</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Contact Area -->
    <section class="contact-area ptb-80">
        <div class="container">
            <div class="section-title">
                <h2>Get In Touch</h2>
                <p>Anything On your Mind. We’ll Be Glad To Assist You!</p>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <form id="contactForm" action="{{ route('contact-form') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        style="height: 53px;" placeholder="Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-3">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                        style="height: 53px;" placeholder="Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-3">
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                                        style="height: 53px;" placeholder="Phone">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-3">
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}"
                                        style="height: 53px;" placeholder="Subject">
                                    @error('subject')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="6" placeholder="Your Message">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <div class="clearfix"></div>
                            </div>

                            <!-- Success Message -->
                            @if (session('success'))
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif

                            <!-- Error Message -->
                            @if (session('error'))
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>

                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="contact-sidebar">
                        <div class="contact-item">
                            <div class="icon">
                                <i class="icofont-google-map" style="color:#fff;"></i>
                            </div>
                            <span>Address</span>
                            <p>{{ $settings->address }}</p>
                        </div>

                        <div class="contact-item">
                            <div class="icon">
                                <i class="icofont-ui-call" style="color:#fff;"></i>
                            </div>
                            <span>Phone</span>
                            @isset($settings->phone_1)
                                <p>
                                    <a href="callto:{{ $settings->phone_1 }}"> +91 - {{ $settings->phone_1 }} </a>
                                </p>
                                @endif
                                @isset($settings->phone_2)
                                    <p><a href="callto:{{ $settings->phone_2 }}"> +91 - {{ $settings->phone_2 }} </a></p>
                                    @endif
                                </div>

                                <div class="contact-item">
                                    <div class="icon">
                                        <i class="icofont-envelope" style="color:#fff;"></i>
                                    </div>
                                    <span>Email</span>
                                    @isset($settings->email_1)
                                        <p>
                                            <a href="javascript:void(0)">
                                                {{ $settings->email_1 }}
                                            </a>
                                        </p>
                                        @endif
                                        @isset($settings->email_2)
                                            <p>
                                                <a href="javascript:void(0)">
                                                    {{ $settings->email_2 }}
                                                </a>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Contact Area -->

                    @isset($settings->maps)
                        <div id="map">
                            <iframe src="{{ $settings->maps }}"></iframe>
                        </div>
                    @endisset
                @endsection
