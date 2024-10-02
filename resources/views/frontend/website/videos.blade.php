@extends('frontend.layouts.app')

@section('content')

    <div class="page-title-area bg2" style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>Our Videos </h1>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Our Videos </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    @php
        $videos = \App\Models\Videos::where('status', true)->orderBy('serial', 'asc')->limit(6)->get();
    @endphp



    <section class="video-section" style="background-color: #8c878921 !important;">
        <div class="container">
            <div class="section-title">
            </div>
            <div class="row">

                @forelse ($videos as $item)
                    @php
                        $videoUrl = str_replace('watch?v=', 'embed/', $item->video);
                    @endphp

                    <div class="col-md-4">
                        <div class="video-content">
                            <iframe width="100%" height="315"
                            src="{{$videoUrl }}" title="{{ $item->title}}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
                        </div>
                    </div>
                @empty
                <div class="col-lg-12 col-md-12 text-center p-10">
                    <h3> Gallery we will update soon..</h3>
                </div>
                @endforelse
            </div>

        </div>

    </section>
    <!-- Start Contact Area -->

    <!-- End Contact Area -->

    <!-- Start Map -->


    @endsection
