
@php
    $about = \App\Models\About::where('id', 1)->first();
@endphp

<div class="riding-lessons-area ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="riding-lessons-content">

                    <div class="lessons-inner-content">
                        <div class="icon-image">
                            <img src="{{ asset('frontend/images/icons/vision (1).png')}}" alt="icon" style="width:50px;" alt="icon">
                        </div>
                        <div class="content">
                            <h3>Vision</h3>
                            <p>{{ $about->vision }}</p>
                        </div>
                    </div>

                    <div class="lessons-inner-content">
                        <div class="icon-image">
                            <img src="{{ asset('frontend/images/icons/mission (2).png')}}" alt="icon" style="width:50px;"
                                alt="icon">
                        </div>
                        <div class="content">
                            <h3>Our mission</h3>
                            <p>{{ $about->mission }}</p>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="riding-lessons-image">
                    <img src="{{ asset('frontend/images/banner-abt.jpg')}}" alt="image">
                </div>
            </div>
        </div>
    </div>
</div>


<section class="ptb-100 ">
    <div class="container">
        <h2 class="text-center"></h2>
        <div class="section-title">
            <h2>Our Goal is to Save Gauvansh</h2>
        </div>
        <div class="funfacts-wrap-inner-box  with-color-black">
            <div class="row">
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="single-funfacts">
                        <h2>
                            <span class="odometer" data-count="{{ $about->cows_in_goshala }}">0</span>
                        </h2>
                        <p> Cow In Gaushala </p>
                    </div>
                </div>

                <div class="col-lg-3 col-6 col-md-3">
                    <div class="single-funfacts">
                        <h2>
                            <span class="odometer" data-count="{{ $about->gauvansh_sheltered}}">0</span>
                        </h2>
                        <p>Gauvansha Sheltered</p>
                    </div>
                </div>

                <div class="col-lg-3 col-6 col-md-3">
                    <div class="single-funfacts">
                        <h2>
                            <span class="odometer" data-count="{{ $about->gauvansh_medicated}}"> 0</span>
                        </h2>
                        <p>Gauvansh Medicated</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-md-3">
                    <div class="single-funfacts">
                        <h2>
                            <span class="odometer" data-count="{{ $about->gauvansh_rescued}}">0</span>
                        </h2>
                        <p>Gauvansh Rescued</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
