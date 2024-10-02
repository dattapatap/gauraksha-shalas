
@extends('frontend.layouts.app')

@section('content')

<!-- Start Page Title Area -->
<div class="page-title-area bg2" style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
    <div class="container">
        <div class="page-title-content">
            <h1>Projects</h1>
            <ul>
                <li><a href="javascript:void(0)">Home</a></li>
                <li> {{ $project->name }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Blog Details Area -->
<section class="blog-details-area ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="blog-details">
                    <div class="article-img">
                        <section>
                            <div id="jssor_1"
                                style="position:relative;margin:0 auto;top:0px;left:0px;width:800px;height:400px;overflow:hidden;visibility:hidden;">
                                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:800px;height:400px;overflow:hidden;">

                                    @foreach ($project->project_images as $item)
                                    <div data-p="170.00">
                                        <img data-u="image" src="{{ asset('storage/'. $item->image)}}" />
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Bullet Navigator -->
                                <div data-u="navigator" class="jssorb052"
                                    style="position:absolute;bottom:12px;right:12px;" data-autocenter="1"
                                    data-scale="0.5" data-scale-bottom="0.75">
                                    <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                        <svg viewbox="0 0 16000 16000"
                                            style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                            <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                                        </svg>
                                    </div>
                                </div>
                                <!-- Arrow Navigator -->
                                <div data-u="arrowleft" class="jssora053"
                                    style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2"
                                    data-scale="0.75" data-scale-left="0.75">
                                    <svg viewbox="0 0 16000 16000"
                                        style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                        <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                                    </svg>
                                </div>
                                <div data-u="arrowright" class="jssora053"
                                    style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2"
                                    data-scale="0.75" data-scale-right="0.75">
                                    <svg viewbox="0 0 16000 16000"
                                        style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                        <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                                    </svg>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="article-content">
                        <h3> {{ $project->heading }}</h3>
                        <p>
                            {!! $project->short_description_1 !!}
                        </p>
                        <p>
                            {!! $project->short_description_2 !!}
                        </p>
                        <p>
                            {!! $project->long_description !!}
                        </p>

                        <div class="others-options">
                            <a href="{{ url('/donate') }}" class="btn btn-primary">Donate<i
                                    class="icofont-simple-right"></i></a>
                        </div>

                    </div>
                </div>




            </div>

            <div class="col-lg-4 col-md-12">
                <aside class="widget-area" id="secondary">
                    <section class="widget widget_categories">
                        <h3 class="widget-title">Projects</h3>
                        <ul>
                            @foreach($lstProjects as $item)
                                <li><a href="{{ $item->slug }}"> {{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</section>


@endsection

