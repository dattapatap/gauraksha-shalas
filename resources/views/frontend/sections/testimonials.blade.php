
@php
    $testimonials = \App\Models\Testimonial::where('status', true)
                        ->orderBy('serial', 'asc')->limit(20)->get();

@endphp
<section class="feedback-area extra-pb ptb-100">
    <div class="container">
        <div class="section-title">
            <span>Testimonials</span>
            <h2>What people say <br>about {{ $settings->name }}</h2>
        </div>

        <div class="row">
            <div class="feedback-slides owl-carousel owl-theme">
                @forelse ($testimonials as $item)

                    <div class="col-lg-12 col-md-12">
                        <div class="single-feedback">
                            <img src="{{ asset('storage/'. $item->image ) }}" alt="image">

                            <p>
                                {{ $item->quote }}
                            </p>

                            <div class="client-info">
                                <h3>{{ $item->name }}</h3>
                            </div>
                        </div>
                    </div>


                @empty

                    <div class="col-lg-12 col-md-12">
                        <div class="single-feedback">
                            <img src="{{ asset('frontend/images/sd (1).png') }}" alt="image">

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>

                            <div class="client-info">
                                <h3>Jason Statham</h3>
                                <span>Phonix, CTO</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-feedback">
                            <img src="{{ asset('frontend/images/sd (1).png') }}" alt="image">

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>

                            <div class="client-info">
                                <h3>Jason Smith</h3>
                                <span>Phonix, CTO</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-feedback">
                            <img src="{{ asset('frontend/images/sd (1).png') }}" alt="image">

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>

                            <div class="client-info">
                                <h3>Salar Taylor</h3>
                                <span>Phonix, CTO</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-feedback">
                            <img src="{{ asset('frontend/images/sd (1).png') }}" alt="image">

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>

                            <div class="client-info">
                                <h3>Jason Smith</h3>
                                <span>Phonix, CTO</span>
                            </div>
                        </div>
                    </div>

                @endforelse
            </div>
        </div>
    </div>
</section>
