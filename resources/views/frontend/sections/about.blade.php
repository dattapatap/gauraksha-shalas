@php
    $about = \App\Models\About::where('id', 1)->first();
@endphp

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

                    <div class="others-options">
                        <a href="{{ url('about-us') }}" class="btn btn-primary">
                            Read More
                            <i class="icofont-simple-right"></i></a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
