@php
    $sevas = \App\Models\Seva::with('seva_images')->whereHas('seva_images')->where('status', true)
                        ->orderBy('serial_no', 'asc')->limit(20)->get();
@endphp

<section class="stallions-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2>Book Your Seva</h2>
            <p>Support the well-being of cows by booking a seva (service) at our Goshala. Your contribution helps us
                care for and protect these gentle creatures. Choose from the following seva options:</p>
        </div>

        <div class="row">
            <div class="stallions-slides owl-carousel owl-theme">

                @forelse ($sevas as $item)
                    @if($item->seva_images->count() > 0 )
                        <div class="col-lg-12 col-md-12">
                            <div class="single-stallions">
                                @if (Storage::disk('public')->has($item->seva_images[0]->image))
                                <img src="{{ asset('storage/'. $item->seva_images[0]->image ) }}">
                                @else
                                <img src="{{ asset('frontend/images/book-your-seva/service-to-mother-cow.jpg') }}">
                                @endif

                                <div class="stallions-content">
                                    <h3><a href="{{ url('/sevas/'.$item->slug ) }}">{{ $item->name }}</a></h3>
                                    <p>
                                        {!! Str::limit($item->short_description_1, 180, ' ...') !!}
                                    </p>
                                    <a href="{{ url('/donate') }}" class="view-details">Donate<i class="icofont-simple-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif

                @empty

                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('frontend/images/book-your-seva/medical-help.jpg') }}" alt="image">

                            <div class="stallions-content">
                                <h3><a href="#!">Medical Help</a></h3>
                                <p>Ensuring the health and well-being of our cows is a priority at our Goshala.</p>
                                <a href="#!" class="view-details">Donate<i class="icofont-simple-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('frontend/images/book-your-seva/feed-mother.jpg') }}" alt="image">

                            <div class="stallions-content">
                                <h3><a href="#!">Feed Mother Cow</a></h3>
                                <p>Contribute to the well-being of Gau Mata by offering nutritious food through Feed
                                    Mother Cow.</p>
                                <a href="#!" class="view-details">Donate<i class="icofont-simple-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('frontend/images/book-your-seva/shelter.jpg') }}" alt="image">

                            <div class="stallions-content">
                                <h3><a href="#!">Shelter Maintenance</a></h3>
                                <p>Help in maintaining and improving the shelter for a safe and comfortable living
                                    environment.</p>
                                <a href="#!" class="view-details">Donate<i class="icofont-simple-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('frontend/images/book-your-seva/daily-feeding.jpg') }}" alt="image">

                            <div class="stallions-content">
                                <h3><a href="#!">Daily Feeding</a></h3>
                                <p>Sponsor the daily feeding of cows to ensure they receive nutritious meals.</p>
                                <a href="#!" class="view-details">Donate<i class="icofont-simple-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('frontend/images/book-your-seva/goshala.jpg') }}" alt="image">

                            <div class="stallions-content">
                                <h3><a href="#!">Special Festive Seva</a></h3>
                                <p>Contribute to special feeding or care services during festivals and auspicious days.
                                </p>
                                <a href="#!" class="view-details">Donate<i class="icofont-simple-right"></i></a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('frontend/images/book-your-seva/adopta-cow.jpg') }}" alt="image">

                            <div class="stallions-content">
                                <h3><a href="#!">Adopt a Cow</a></h3>
                                <p>Take responsibility for the care and upkeep of a cow for a period of time.</p>
                                <a href="#!" class="view-details">Donate<i class="icofont-simple-right"></i></a>
                            </div>

                        </div>
                    </div>

                @endforelse

            </div>
        </div>
    </div>
</section>
