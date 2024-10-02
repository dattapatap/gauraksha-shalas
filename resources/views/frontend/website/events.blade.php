@extends('frontend.layouts.app')

@section('content')
    <div class="page-title-area bg2 jarallax" data-jarallax='{"speed": 0.2}'
        style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>Event</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Events List</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <section class="blog-area ptb-80">
        <div class="container">
            <div class="section-title">
                <h2>Our Recent Events</h2>
            </div>

            <div class="row">

                @forelse ($blogs as $item)

                        <div class="col-lg-4 col-md-6">
                            <div class="single-blog-post">
                                <div class="post-image">
                                    <a href="{{ url('/event-detail/'. $item->slug)}}">
                                        <img src="{{ asset('storage/'. $item->image) }}" alt="image"></a>
                                </div>
                                <div class="post-content">
                                    <span>{{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</span>
                                    <h3>
                                        <a href="{{ url('/event-detail/'. $item->slug) }}">
                                            {!! Str::limit($item->title, 100, ' ...') !!}
                                        </a>
                                    </h3>
                                    <div class="blog-content">
                                        <p>{!! Str::limit($item->description, 100) !!}</p>
                                    </div>
                                    <a href="{{ url('/event-detail/'. $item->slug) }}" class="read-more">Read More
                                        <i class="icofont-simple-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                @empty

                        <h4 class="text-center"> No Events found </h4>

                @endforelse


                <div class="col-lg-12 col-md-12">
                    <div class="pagination-area">
                        {{ $blogs->links() }}
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
