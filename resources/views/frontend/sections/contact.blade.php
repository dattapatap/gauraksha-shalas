<section class="contact-area ptb-100"
    style="background-image: url({{ asset('frontend/images/bg1.jpg') }});background-size: cover;background-attachment: fixed;">
    <div class="container">

        <div class="row">

            <div class="col-lg-6 col-md-12">
                @isset($setting->maps)
                    <div id="map">
                        <iframe src="{{ $setting->maps }}"></iframe>
                    </div>
                @endisset
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="section-title">
                    <h2 style="color:#fff">Get In Touch</h2>
                    <p style="color:#fff">Anything On your Mind. We’ll Be Glad To Assist You!</p>
                </div>
                <form id="contactForm" action="{{ route('contact-form') }}#contactForm" method="POST">
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

        </div>
    </div>
</section>
