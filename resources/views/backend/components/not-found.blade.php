@extends('backend.layouts.app')

@section('content')

<div class="mb-4">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/admin') }}">
                    <i class="bi bi-globe2 small me-2"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ Request::segment(2)  }}</li>
        </ol>
    </nav>
</div>

 <!-- Start error section -->
 <section class="error__section pb-5">
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <div class="error__content wishlist-content">
                    <img class="error__content--img display-block mb-50" style="width:400px"  src="{{ asset('assets/img/other/404-thumb.webp') }}">
                </div>
                <div class="text-center">
                    <a class="error__content--btn primary__btn" href="{{ url('/') }}">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End error section -->

@endsection
