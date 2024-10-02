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
                    <a href="{{ url('admin/testimonial') }}"> Testimonial
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">New Testimonial</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">
            <div class="card">
                <div class="card-body">

                    <div class="col-md-12">

                        <form method="POST" action="{{ route('admin.testimonial.store') }}" enctype="multipart/form-data"
                            onsubmit="validateForm()">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Image <span class="text-danger">*</span></label><br>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                <p class="small text-muted mt-3">
                                    use an image at least 100px by 100px in either .jpg or .png format
                                </p>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Testimonial Quote<span class="text-danger">*</span></label>
                                <input type="text" name="quote"
                                    class="form-control @error('quote') is-invalid @enderror" value="{{ old('quote') }}">

                                @error('quote')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}">

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Rating</label>
                                        <select class="form-select @error('rating') is-invalid @enderror" name="rating">
                                            <option selected value="">Select Rating</option>
                                            <option value="1"  @if (old('rating') == '1') selected @endif>1</option>
                                            <option value="2"  @if (old('rating') == '2') selected @endif>2</option>
                                            <option value="3"  @if (old('rating') == '3') selected @endif>3</option>
                                            <option value="4"  @if (old('rating') == '4') selected @endif>4</option>
                                            <option value="5"  @if (old('rating') == '5') selected @endif>5</option>
                                        </select>
                                        @error('rating')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status">
                                    <option selected value="">Select Status</option>
                                    <option value="1" @if (old('status') == '1') selected @endif>Publish</option>
                                    <option value="0" @if (old('status') == '0') selected @endif>Draft</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="modal-footer">
                                <a href="{{route('admin.testimonial.index')}}" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
@endpush
