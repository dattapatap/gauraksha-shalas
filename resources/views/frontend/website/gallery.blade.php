@extends('frontend.layouts.app')

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area bg3" style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>Gallery</h1>
                <ul>
                    <li><a href="{{ url('/')}}">Home</a></li>
                    <li>Gallery</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    @php
        $gallery = \App\Models\Images::where('status', true)->orderBy('serial', 'asc')->limit(6)->get();
    @endphp


    <!-- Start Courses Area -->
    <section class="courses-area ptb-80 bg-image bg-color-none">
        <div class="container">
            <div class="row">
                @forelse ($gallery as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="single-courses">
                        <div class="courses-image">
                            <img src="{{ url('storage/'. $item->image ) }}" alt="image">
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-12 col-md-12 text-center p-10">
                    <h3> Gallery we will update soon..</h3>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- End Courses Area -->
@endsection
