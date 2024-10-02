@extends('frontend.layouts.app')

@section('content')
    <style>
        .g-img img {
            margin-bottom: 30px !important;
        }
    </style>
    <!-- Start Main Banner -->

    @include('frontend/sections/slider')

    <!-- End Main Banner -->


    <!-- Start About Area -->
    @include('frontend/sections/about')
    <!-- End About Area -->


    <!-- Start Courses Area -->
    @include('frontend/sections/projects')
    <!-- End What We Do Section -->

    <!-- Start Riding Lessons Area -->
    @include('frontend/sections/about_additional')
    <!-- End Riding Lessons Area -->

    <!-- Start Video Section Area -->
    @include('frontend/sections/videos')
    <!-- End Video Section Area -->

    <!-- Start Video Section Area -->
    @include('frontend/sections/gallery')
    <!-- End Video Section Area -->


    <!-- Start Stallions Area -->
    @include('frontend/sections/sevas')
    <!-- End Stallions Area -->


    @include('frontend/sections/blogs')





    <!-- Start Feedback Area -->
    @include('frontend/sections/testimonials')
    <!-- End Feedback Area -->


    <!-- Start Contact Area -->
    @include('frontend/sections/contact')
    <!-- End Contact Area -->
@endsection
