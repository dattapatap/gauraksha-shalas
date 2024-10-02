@extends('frontend.layouts.app')

@section('content')
    <div class="page-title-area bg2" style="background-image:url({{ asset('frontend/images/inner-banner.jpg') }})">
        <div class="container">
            <div class="page-title-content">
                <h1>Our Trustees</h1>
                <ul>
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li>Our Trustees</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->



    @php
        $trustees = \App\Models\Trustee::orderBy('id', 'desc')->get();
    @endphp

    <!-- Start Instructor Area -->
    <section class="instructor-area ptb-80">
        <div class="container">
            <div class="row">
                @forelse ($trustees as $item)

                <div class="col-lg-3 col-sm-6">
                    <div class="team-wrap-card">
                        <div class="team-image">
                            <img src="{{ asset('storage/'. $item->image) }}" alt="image">
                        </div>
                        <div class="team-content">
                            <h3> {{ $item->name }} </h3>
                            <span>{{ $item->designation }}</span>
                        </div>
                    </div>
                </div>

                @empty

                <div class="col-lg-12 col-md-12 text-center p-10">
                    <h3> COMMING SOON..</h3>
                </div>
                @endforelse

            </div>
        </div>
    </section>
@endsection
