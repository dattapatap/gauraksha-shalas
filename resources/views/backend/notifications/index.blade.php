@extends('backend.layouts.app')

@section('styles')
<style>
    .h1, h1 {
        font-size: 2.0rem;
    }
    h1 i{
        color: #00000075;
        font-size: 1.5rem;
        /* color: aqua; */
    }
    .bts i, h4, span{
        color:     #646f7a;
    }
    .user-dropdown span{
        color: #e9ecef;
    }

    .TabsHeader .nav-link{
        padding: 0.5rem 1.5rem;
    }
    .tab-content .me-3{
        margin-right: 2rem !important;
    }
    .tab-content .d-flex{
        border-bottom: 1px solid #74788d30;
    }
    .unread{
        background-color: rgba(0,154,224,.08);
    }
    .read{
        background-color: white;
    }

</style>
@endsection

@section('content')
<div class="mb-4 d-flex">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/admin/home') }}">
                    <i class="bi bi-globe2 small me-2"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Notifications</li>
        </ol>
    </nav>
</div>

<div class="col-md-12 col-lg-12 mt-4" style="min-height: 500px;">
    <div class="row">
        <div class="offset-1 col-md-10">

            <div class="card" style="margin-bottom: 10px;">
                <div class="card-body" style="padding: 0.5rem 1.25rem;">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <h5 class="float-left"> Notifications </h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">

                        <div class="row">
                            @if($notification->where('read_at', null)->count() > 0)
                                <div class="col-md-12 marksall" style="">
                                    <a href="#" class="btn btn-default mark-all float-right">
                                        <span>Mark all as read </span>
                                    </a>
                                </div>
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                            @forelse($notification as $items)
                                    <div class=" content notifications  @if($items->unread()) unread @else  read @endif" style="border-bottom: 1px solid #c2bbbb;">
                                        <a href="{{ $items->data['link'] }}" class="d-flex notification-item  @if($items->unread()) mark-as-read @endif" data-id="{{ $items->id }}"
                                        style="padding-bottom: 10px;">

                                            <div class="flex-shrink-0">
                                                <figure class="avatar avatar-info me-3">
                                                        <span class="avatar-text rounded-circle">
                                                            @if ($items->data['category'] == 'Order')
                                                                <i class="bi bi-cart-check"></i>
                                                            @elseif($items->data['category'] == 'Review')
                                                                <i class="bi bi-star"></i>
                                                            @else
                                                                <i class="bi bi-user"></i>
                                                            @endif
                                                        </span>
                                                </figure>
                                            </div>

                                            <div class="flex-grow-1">
                                                <p class="mb-0 fw-bold d-flex justify-content-between">
                                                    {!! htmlspecialchars_decode($items->data['header']) !!}
                                                </p>
                                                <div class="font-size-12 text-muted" style="margin-top: 5px;">
                                                    <p class="mb-1">{!! htmlspecialchars_decode($items->data['data']) !!}</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ Carbon\Carbon::parse($items->created_at)->diffForHumans() }} </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                            @empty
                            <div class="col-sm-12">
                                    <br>
                                    <div class="text-center">
                                        <div class="mb-3" style="position: relative;">
                                            <img src="{{ asset('assets/images/notification.jpg') }}"
                                                style="height: 100%;width: 25%;"
                                                class="img-fluid" alt="">
                                        </div>
                                        <p class="text-muted text-truncate mb-2">You don't have any notifications to display here
                                        </p>
                                    </div>
                                </div>
                            @endforelse

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $(function() {
            $('.mark-as-read').click(function(e) {
                let id = $(this).data('id');
                var div = $(this);
                $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.mark-as-read-notification') }}',
                        data: {id},
                        success: function(response) {
                            console.log('Succes!',response);
                        },
                        error : function(err) {
                            console.log('Error!', err.responseText);
                        },
                    });
            });

            $('.mark-all').click(function(e) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.mark-all-as-read-notification') }}',
                    data:{id:null},
                    success: function(response) {
                        console.log(response);
                        $("div.unread").removeClass("unread");
                        $("div.notifications").addClass("read");
                        $('.marksall').css('display', 'none');
                    },
                    error : function(err) {
                        console.log('Error!', err.responseText);
                    },
                });
            });


        });
    })
</script>
@endsection
