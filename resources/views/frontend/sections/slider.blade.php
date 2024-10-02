@php

    $sliders = \App\Models\Slider::where('status', true)->orderBy('serial', 'asc')->get();
@endphp

<section>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1920px;height:800px;overflow:hidden;visibility:hidden;">

        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1920px;height:800px;overflow:hidden;">
            @forelse ($sliders as $item)
                @if(Storage::disk('public')->has($item->image))
                    <div data-p="170.00">
                        <img data-u="image" src="{{ asset('storage/'.$item->image) }}" />
                        <div data-u="caption" data-t="3"
                            style="position:absolute;top:275px;left:500px;width:900px;height:40px;font-size:52px;font-weight:700;line-height:1.2;text-align:center; color: #fff;text-shadow: 2px 2px 3px black;">
                            {{ $item->title }}
                        </div>
                        <div data-u="caption" data-t="3"
                            style="position:absolute;top:370px;left:500px;width:900px;height:40px;font-size:34px;font-weight:700;line-height:1.2;text-align:center; color: #fff;text-shadow: 2px 2px 3px black;">
                            {{ $item->desc }}
                        </div>
                    </div>
                @endif
            @empty
                <div data-p="170.00">
                    <img data-u="image" src="{{ asset('frontend/images/banner1.jpg') }}" />
                    <div data-u="caption" data-t="3"
                        style="position:absolute;top:320px;left:500px;width:900px;height:40px;font-size:52px;font-weight:700;line-height:1.2;text-align:center; color: #fff;text-shadow: 2px 2px 3px black;">
                        Their care is our duty. Help us provide food, shelter, and compassion
                    </div>
                </div>
                <div data-p="170.00">
                    <img data-u="image" src="{{ asset('frontend/images/banner2.jpg') }}" />
                    <div data-u="caption" data-t="3"
                        style="position:absolute;top:320px;left:500px;width:900px;height:40px;font-size:52px;font-weight:700;line-height:1.2;text-align:center; color: #fff;text-shadow: 2px 2px 3px black;">
                        Protecting our sacred cows is protecting our heritage. Donate today.
                    </div>
                </div>
                <div data-p="170.00">
                    <img data-u="image" src="{{ asset('frontend/images/banner3.jpg') }}" />
                    <div data-u="caption" data-t="3"
                        style="position:absolute;top:320px;left:500px;width:900px;height:40px;font-size:52px;font-weight:700;line-height:1.2;text-align:center; color: #fff;text-shadow: 2px 2px 3px black;">
                        Cows are the heartbeat of our land. Help us nourish them, as they nourish the earth.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb052" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1"
            data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora053" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2"
            data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora053" style="width:55px;height:55px;top:0px;right:25px;"
            data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
    </div>
</section>
