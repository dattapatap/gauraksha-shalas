@extends('backend.layouts.app')
@section('content')
    <div class="mb-4 d-flex">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('admin/videos') }}"> Videos List
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">New Video</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">

            @include('backend.layouts.alert')

            <form method="POST" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Video Link <span class="text-danger">*</span></label><br>
                                    <input type="url" name="video_url"  class="form-control @error('video_url') is-invalid @enderror" >

                                    @error('video_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Video Name <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}">

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <a href="{{ url('admin/videos') }}" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add Video</button>
                </div>
            </form>

        </div>
    </div>
@endsection

