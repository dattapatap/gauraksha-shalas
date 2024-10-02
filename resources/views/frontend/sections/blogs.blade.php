@php
    $blogs = \App\Models\Blog::where('status', true)
        ->where('category_id', 1)
        ->orderBy('created_at', 'desc')
        ->limit(20)
        ->get();

@endphp

@if (!$blogs->isEmpty())
<section class="stallions-area ptb-100" style=" background-color: #f8f7f5 !important;">
    <div class="container">
        <div class="section-title">
            <h2>Our Blogs</h2>
        </div>

        <div class="row">
            <div class="stallions-slides owl-carousel owl-theme">

                @forelse ($blogs as $item)
                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="image">

                            <div class="stallions-content">
                                <h3>
                                    <a href="{{ url('/blog-detail/' . $item->slug) }}">
                                         {!! Str::limit($item->title, 48, ' ...') !!}
                                    </a>
                                </h3>
                                <p>
                                    {!! Str::limit($item->description, 120, ' ...') !!}
                                </p>
                                <a href="{{ url('/blog-detail/' . $item->slug) }}" class="view-details">
                                    Read more
                                    <i class="icofont-simple-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                @empty

                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('frontend/images/blog/cow-care-hero.jpg') }}" alt="image">

                            <div class="stallions-content">
                                <h3><a href="cow-care.html">Cow Care</a></h3>
                                <p> aring for cows is caring for life—nurturing the sacred bond between humans and
                                    nature.</p>
                                <a href="cow-care.html" class="view-details">Read more<i
                                        class="icofont-simple-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('frontend/images/blog/organic-farming.jpeg') }}" alt="image">

                            <div class="stallions-content">
                                <h3><a href="blog.html">Organic Farming</a></h3>
                                <p>Cultivate the earth with care—grow naturally, live sustainably.</p>
                                <a href="blog.html" class="view-details">Read more<i
                                        class="icofont-simple-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="single-stallions">
                            <img src="{{ asset('frontend/images/blog/govu-pooja.jpg') }}" alt="image">

                            <div class="stallions-content">
                                <h3><a href="events.html">Events</a></h3>
                                <p>Cow Events are gatherings focused on cows, often organized to celebrate their
                                    cultural, religious, or agricultural significance.</p>
                                <a href="events.html" class="view-details">Read more<i
                                        class="icofont-simple-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforelse


            </div>
        </div>
    </div>
</section>
@endif
