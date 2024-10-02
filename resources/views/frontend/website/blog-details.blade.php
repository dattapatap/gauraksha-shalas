@extends('frontend.layouts.app')

@section('content')
    <div class="page-title-area bg2" style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>Blog Details</h1>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>{{ $blog->title }}</li>
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
                            <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}">
                        </div>
                        <div class="article-content">
                            <h3> {{ $blog->title }}</h3>

                            <p>
                                {!! $blog->description !!}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area" id="secondary">
                        <section class="widget widget_semental_posts_thumb">
                            <h3 class="widget-title">Recent Blogs</h3>
                            @forelse ($recents as $item)
                            <article class="item">
                                <a href="{{  url('/blog-detail/'. $item->slug ) }}" class="thumb">
                                    {{-- <span class="cover bg3" role="img"> --}}
                                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title}}" />
                                    {{-- </span> --}}
                                </a>
                                <div class="info">
                                    <time datetime="{{ $item->ceated_at}}"> {{ Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</time>
                                    <h4 class="title usmall">
                                        <a href="{{  url('/blog-detail/'. $item->slug ) }}">{{ $item->title }}</a>
                                    </h4>
                                </div>
                                <div class="clear"></div>
                            </article>

                            @empty
                                <span>Empty Blogs</span>
                            @endforelse
                        </section>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
