@php
    $projects = \App\Models\Project::with('project_images')->where('status', true)
                        ->orderBy('serial_no', 'asc')->limit(20)->get();

@endphp

<section class="courses-area ">
    <div class="container">
        <div class="section-title">
            <h2>What We Do</h2>
        </div>
        <div class="row">
            <div class="courses-slides owl-carousel owl-theme">
                @forelse ($projects as $item)
                    @if($item->project_images->count() > 0 )
                        <div class="col-lg-12 col-md-12">
                            <div class="single-courses">
                                <div class="courses-image">
                                    @if (Storage::disk('public')->has($item->project_images[0]->image))
                                        <img src="{{ asset('storage/'. $item->project_images[0]->image ) }}" alt="image">
                                    @else
                                        <img src="{{ asset('frontend/images/what-we-do/cow-protection.jpg') }}" alt="image">
                                    @endif
                                </div>

                                <div class="courses-content">
                                    <h3><a href="{{ url('/projects/'.$item->slug ) }}">{{ $item->name }}</a></h3>
                                    <p>
                                        {!! Str::limit($item->short_description_1, 180, ' ...') !!}
                                    </p>
                                    <a href="{{ url('/projects/'.$item->slug ) }}" class="read-more">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-lg-12 col-md-12">
                        <div class="single-courses">
                            <div class="courses-image">
                                <img src="{{ asset('frontend/images/what-we-do/cow-protection.jpg') }}" alt="image">
                            </div>

                            <div class="courses-content">
                                <h3><a href="javascript:void(0)">Protection</a></h3>
                                <p>Our mission is to safeguard the welfare and dignity of cows through dedicated protection
                                    efforts and advocacy.</p>
                                <a href="javascript:void(0)" class="read-more">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="single-courses">
                            <div class="courses-image">
                                <img src="{{ asset('frontend/images/what-we-do/cow-shelter.jpg') }}" alt="image">
                            </div>

                            <div class="courses-content">
                                <h3><a href="javascript:void(0)">Shelter</a></h3>
                                <p>Our mission is to provide a safe, nurturing, and supportive shelter for cows in need,
                                    ensuring their protection, comfort, and well-being. </p>
                                <a href="javascript:void(0)" class="read-more">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-courses">
                            <div class="courses-image">
                                <img src="{{ asset('frontend/images/what-we-do/medical-facility.jpg')}}" alt="image">
                            </div>

                            <div class="courses-content">
                                <h3><a href="javascript:void(0)">Medical Facility</a></h3>
                                <p>Our mission is to provide specialized, compassionate, and high-quality medical care for
                                    cows, ensuring their health, well-being, and productivity.</p>
                                <a href="javascript:void(0)" class="read-more">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-courses">
                            <div class="courses-image">
                                <img src="{{ asset('frontend/images/what-we-do/milk-distrubtions.jpg')}}" alt="image">
                            </div>

                            <div class="courses-content">
                                <h3><a href="javascript:void(0)">Milk Distribution</a></h3>
                                <p>We are committed to establishing an efficient, sustainable, and ethical milk distribution
                                    network that supports local farmers and promotes fair trade practices.</p>
                                <a href="javascript:void(0)" class="read-more">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="single-courses">
                            <div class="courses-image">
                                <img src="{{ asset('frontend/images/what-we-do/cow-protection-drive.jpg')}}" alt="image">
                            </div>

                            <div class="courses-content">
                                <h3><a href="javascript:void(0)">Protection Drive</a></h3>
                                <p>We are committed to rescuing cows from neglect, abuse, and abandonment, providing them
                                    with proper shelter, nutrition, and medical care.</p>
                                <a href="javascript:void(0)" class="read-more">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="single-courses">
                            <div class="courses-image">
                                <img src="{{ asset('frontend/images/what-we-do/organic-farming.jpg')}}" alt="image">
                            </div>

                            <div class="courses-content">
                                <h3><a href="javascript:void(0)">Organic Farming</a></h3>
                                <p> We are committed to cultivating high-quality, chemical-free crops that nurture both
                                    people and the planet. </p>
                                <a href="javascript:void(0)" class="read-more">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
