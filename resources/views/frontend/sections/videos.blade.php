@php
    $videos = \App\Models\Videos::where('status', true)->orderBy('serial', 'asc')->limit(6)->get();
@endphp

<section class="video-section ptb-100"
    style="background-image: url({{ asset('frontend/images/bg2.jpg') }});background-size: cover;background-attachment: fixed;">
    <div class="container">
        <div class="section-title">
            <h2 style="color:#fff;">Our Videos</h2>
        </div>

        <div class="row">

            @forelse ($videos as $item)
            @php
                $videoUrl = str_replace('watch?v=', 'embed/', $item->video);
            @endphp

            <div class="col-md-4">
                <div class="video-content">
                    <iframe width="100%" height="300"
                        src="{{$videoUrl }}" title="{{ $item->title}}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
            @empty


            @endforelse
        </div>

    </div>
</section>
