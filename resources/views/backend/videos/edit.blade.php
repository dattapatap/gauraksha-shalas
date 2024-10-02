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
                <li class="breadcrumb-item active" aria-current="page">Edit Video</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">
            <form method="POST" action="{{ route('admin.videos.update', $video->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Video Link</label><br>
                                    <input type="url" name="video_url"  class="form-control @error('video_url') is-invalid @enderror"
                                        value="{{ old('video_url', $video->video)}}">

                                    @error('video_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Video Name</label>
                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title', $video->title) }}">

                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Serial No </label>
                                            <input type="number" name="serial_no" class="form-control @error('serial_no') is-invalid @enderror"
                                                value="{{ old('serial_no', $video->serial) }}">

                                            @error('serial_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


                <div class="modal-footer">
                    <a href="{{ url('admin/videos') }}" type="button" class="btn btn-danger" >Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection

