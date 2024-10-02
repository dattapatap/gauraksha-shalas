@extends('frontend.layouts.app')
@section('content')
<style>
    .alert-box {
        position: relative;
        width: 100%;
        padding: 15px;
        text-align: center;
        color: white;
        border-radius: 5px;
        margin-bottom: 20px;
        display: none;
    }

    .alert-danger {
        background-color: #f44336; /* Red background */
    }

    .alert-warning {
        background-color: #ff9800; /* Orange background */
    }

    .alert-close {
        float: right;
        font-size: 20px;
        cursor: pointer;
    }

    .success-box {
        text-align: center;
        padding: 50px;
    }
    .success-box {
        background-color: #fff;
        border: 2px solid #4CAF50;
        border-radius: 10px;
        padding: 30px;
        margin: 0 auto;
        max-width: 500px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        display:none;
    }
    .success-icon {
        font-size: 50px;
        color: white;
        background-color: #4CAF50;
        border-radius: 51%;
        padding: 9px;
        display: inline-block;
        margin-bottom: 28px;
        width: 100px;
        height: 100px;
    }

    .success-box h1 {
        color: #4CAF50;
    }
    .success-box p {
        font-size: 16px;
        color: #333;
    }
    .success-box .btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
        display: inline-block;
    }
</style>


    <style>
        .selectio-item {
            margin-bottom: 10px;
            text-align: center;
            border-radius: 0px;
            padding: 15px 15px;
            border: 1px dashed #82ca9c;
        }

        .btn_option label {
            z-index: 1;
            width: 100%;
            height: 35px;
            align-items: center;
            display: flex;
            justify-content: center;
            margin: 0.5em 0;
            cursor: pointer;
            color: #000;
            background: #efefef;
            border: 1px solid #ababab;
        }

        .form-group .form-control {
            border-radius: 5px;
            background-color: #f9f9f9;
            padding-left: 10px;
            font-size: 15px;
            border: 0;
            border: 1px solid #ced4da;
        }

        .donate_content_btn button {
            background: #5397dc;
            letter-spacing: 1px;
            border: none;
            padding: 11px 50px;
            border-radius: 30px;
            color: #ffffff;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .selectio-item {
            margin-bottom: 10px;
            text-align: center;
            border-radius: 0px;
            padding: 15px 15px;
            border: 1px dashed #82ca9c;
        }

        .btn_option input[type="radio"]:checked+label {
            background: #3c9cdd;
            color: #fff;
        }

        .btn_option input {
            display: none;
        }

        .input-group-text {
            background-color: #f9f9f9 !important;
            font-size: 15px;
            line-height: 1.5 !important;
            border: 0;
            border: 1px solid #ced4da;
            border-radius: 0.25rem 0rem 0rem 0.25rem !important;
        }

        .ruppes_select {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
        }

        .about-content span::before {
            width: 35px;
            height: 2px;
            background: #1b7396;
            content: '';
            position: absolute;
            left: -42px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            display: none;
        }

        .about-content span {
            display: flex;
            position: relative;
            color: #1b7396;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 600;
            height: 45px;
        }

        li {
            list-style-type: none;
        }

        .btn-donate:hover{
            color: #fff!important;
        }

    </style>

    <!-- Start Page Title Area -->
    <div class="page-title-area bg3 jarallax" data-jarallax='{"speed": 0.2}'
        style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>Donate</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Donate</li>
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
                        <img src="{{ asset('storage/'. $donate->image ) }}" alt="image">
                    </div>
                    <br>
                    <p>
                        {{ $donate->short_desc_1}}
                    </p>
                    <p>
                        {{ $donate->short_desc_2}}
                    </p>
                    <p>
                        {!! $donate->more_desc !!}
                    </p>


                </div>

                <div class="col-lg-6">
                    <div class="about-content">
                        <span>Donate Now</span>

                        <div class="alert-box alert-danger">
                            <span class="alert-close" onclick="this.parentElement.style.display='none';">&times;</span>
                            <strong class="paymen-failed"></strong>
                        </div>

                        <h2>Please fill this form and submit </h2>

                        <div class="selectio-item">
                            <form class="form_pay donar_pay_form" novalidate="novalidate" method="POST">
                                @csrf

                                <div class="ruppes_select">
                                    <div class="btn_option">
                                        <input type="radio" value="{{$donate->amount_1}}" id="amount_{{$donate->amount_1}}" name="radio_amount">
                                        <label class="btn btn-default" for="amount_{{$donate->amount_1}}">
                                            <i class="fa fa-inr" aria-hidden="true"></i> &nbsp; {{$donate->amount_1}}
                                        </label>
                                    </div>
                                    <div class="btn_option">
                                        <input type="radio" id="amount_{{$donate->amount_2}}" value="{{$donate->amount_2}}" name="radio_amount">
                                        <label class="btn btn-default" for="amount_{{$donate->amount_2}}">
                                            <i class="fa fa-inr" aria-hidden="true"></i>&nbsp; {{$donate->amount_2}}
                                        </label>
                                    </div>
                                    <div class="btn_option">
                                        <input type="radio" id="amount_{{$donate->amount_3}}" value="{{$donate->amount_3}}" name="radio_amount">
                                        <label class="btn btn-default" for="amount_{{$donate->amount_3}}">
                                            <i class="fa fa-inr" aria-hidden="true"></i>&nbsp; {{$donate->amount_3}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2 mb-3">
                                    <div class="cssTextbox">
                                        <div class="form-group  input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color: white">
                                                    <i class="fa fa-inr" aria-hidden="true" style="line-height: 1.5;"></i>
                                                </span>
                                            </div>
                                            <input type="number" name="amount" id="amount"
                                                class="form-control amount_medicle valid" placeholder="Other Amount *">
                                        </div>
                                    </div>
                                </div>

                                <div class="contact_details">
                                    <div class="col-md-12" style="align-items: flex-start;display: flex;">
                                        <label class="float-left" style="font-size:14px">Fill more information</label>
                                    </div>
                                </div>

                                <div class="donor_form_content">
                                    <div class="row">
                                        <div class="col-md-6 mb-3 cssTextbox">
                                            <div class="form-group">
                                                <input type="text" name="full_name" placeholder="Enter Full name *"
                                                    value="Datta" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 cssTextbox">
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">DOB</span>
                                                </div>
                                                <input class="form-control valid" placeholder="Enter Date Of Birth"
                                                    max="2014-09-11" type="date" name="dob" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3 cssTextbox">
                                            <div class="form-group">
                                                <input type="email" placeholder="Enter Email" value="datta@gmail.com"
                                                    class="form-control" name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 cssTextbox">
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"
                                                        style="background-color: white">+91</span>
                                                </div>
                                                <input type="tel" placeholder="Enter Phone *" value="7620297516"
                                                    class="form-control w-50" name="phone">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3 cssTextbox">
                                            <div class="form-group">
                                                <input type="text" name="city" id="city" value="Bangalore"
                                                    class="form-control valid" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 cssTextbox">
                                            <div class="form-group">
                                                <input type="text" name="pan" id="pan" value="" class="form-control valid" placeholder="Pan No.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3 cssTextbox">
                                            <div class="form-group">
                                                <select name="category" id="category" value=""
                                                    class="form-control" placeholder="Towards">
                                                    <option value="">Choose Category</option>
                                                    <option value="Shelter">Shelter</option>
                                                    <option value="Medical Facility">Medical Facility</option>
                                                    <option value="Protection">Protection</option>
                                                    <option value="Calamity">Calamity</option>
                                                    <option value="Hospital">Hospital</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">

                                            <div class="notes" style="color: #e7212d94;font-weight: 700;">Please provide
                                                PAN
                                                number to claim the benefits of 80G Receipt as per Government norms. </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div>
                                                <label class="agreetxt">
                                                    <input type="checkbox" checked="" name="agree"
                                                        readonly="">&nbsp; You
                                                    agree
                                                    that Gaurakshashalas can reach out to you through
                                                    Email/SMS/Phone to provide information of your
                                                    donation, campaigns, 80G receipt etc.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-donate"> Donate </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="success-box" style="display: none;">

                        <div class="success-icon">✓</div>

                        <h1>Thank You, <strong id="paidName"></strong> </h1>
                        <p>Your generous donation of ₹ <strong id="paidAmount"></strong> has been successfully received.</p>
                        <p>Your support helps us continue our mission and make a difference.</p>

                        <br><br>
                        <a href="{{ url('/donate') }}" class="btn">Make Another Donation</a>
                    </div>


                </div>
            </div>


        </div>
    </section>
@endsection

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="{{ asset('frontend/js/donations.js') }}"></script>

@endsection
