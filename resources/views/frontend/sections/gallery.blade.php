@php
    $gallery = \App\Models\Images::where('status', true)->orderBy('serial', 'asc')->limit(6)->get();
@endphp


<section class="video-section ptb-100" style="background-color: #f8f7f5 !important;">
    <div class="container">
        <div class="section-title">
            <h2>Our Gallery</h2>

        </div>
        <div class="row">
            @forelse ($gallery as $item)
                <div class="col-md-4 g-img">
                    <img src="{{ asset('/storage/'. $item->image )}}" alt="">
                </div>
            @empty

                <div class="col-md-4 g-img">
                    <img src="{{ asset('frontend/images/home-gallery/1.jpg')}}" alt="">
                </div>
                <div class="col-md-4 g-img">
                    <img src="{{ asset('frontend/images/home-gallery/2.jpg')}}" alt="">
                </div>
                <div class="col-md-4 g-img">
                    <img src="{{ asset('frontend/images/home-gallery/3.jpg')}}" alt="">
                </div>
                <div class="col-md-4 g-img">
                    <img src="{{ asset('frontend/images/home-gallery/4.jpg')}}" alt="">
                </div>
                <div class="col-md-4 g-img">
                    <img src="{{ asset('frontend/images/home-gallery/5.jpg')}}" alt="">
                </div>
                <div class="col-md-4 g-img">
                    <img src="{{ asset('frontend/images/home-gallery/6.jpg')}}" alt="">
                </div>

            @endforelse
        </div>

    </div>

</section>
