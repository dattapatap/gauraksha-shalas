@extends('frontend.layouts.app')

@section('content')
    <div class="page-title-area bg3" style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>Adopt a Cow</h1>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li>{{ $adoptCow->heading }}</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="about-area ptb-80">
        <div class="container">
            <div class="row align-items-center">

                <h2>Adopt a Cow</h2>
                <div class="col-lg-6">
                    <div class="about-content">


                        <p>
                            {{ $adoptCow->xheading }}
                        </p>

                        <p>
                            {{ $adoptCow->short_desc_1 }}
                        </p>

                        <p>
                            {{ $adoptCow->short_desc_2 }}
                        </p>



                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="{{ asset('storage/'. $adoptCow->image )}}" alt="image">
                    </div>
                </div>
            </div>


        </div>
    </section>
    <section class=" ptb-80" style="background-color:#fff;">
        <div class="container">
            <div class="row align-items-center">


                <div class="col-lg-12">
                    <div class="about-content">

                        <p>
                            {!! $adoptCow->more_desc !!}
                        </p>

                        <div class="others-options">
                            <a href="{{ url('/donate')}}" class="btn btn-primary">Donate<i class="icofont-simple-right"></i></a>
                        </div>


                    </div>
                </div>

            </div>


        </div>
    </section>
@endsection
