@extends('frontend.layouts.app')

@section('content')
    <div class="page-title-area bg3" style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>Become A Volunteer</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li> </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="about-area ptb-80">
        <div class="container">
            <div class="row align-items-center">

                <h2> {{ $volunteer->heading }} </h2>
                <div class="col-lg-6">
                    <div class="about-content">
                        <p>
                            {{ $volunteer->short_desc_1 }}
                        </p>
                        <p>
                            {{ $volunteer->short_desc_2 }}
                        </p>

                        {!! $volunteer->more_desc !!}

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="{{ asset('storage/' . $volunteer->image) }}" alt="image">
                    </div>
                </div>
            </div>


        </div>
    </section>

    <section class="checkout-area ptb-80">
        <div class="container">
            <form>
                <div class="row">

                    <div class="col-lg-6 col-md-12">
                        <div class="billing-details">
                            <h3 class="title">Volunteer Registration Form :</h3>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label> Name <span class="required">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <label>Address <span class="required">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>State / County <span class="required">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input type="email" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>



                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Comments <span class="required">*</span></label>
                                        <textarea name="notes" id="notes" cols="30" rows="2" placeholder="" class="form-control"
                                            style="min-height:110px; "></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="about-content form-contents">

                            {!! $volunteer->form_desc !!}

                            <div class="others-options">
                                <a href="donate.html" class="btn btn-primary">Donate<i class="icofont-simple-right"></i></a>
                            </div>


                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
@endsection
