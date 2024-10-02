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
                    <a href="{{ url('admin/testimonial') }}"> Testimonial List
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Testimonial</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">
            <form method="POST" action="{{ route('admin.testimonial.update', $testimonial->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label"> Image (100px * 100px)(Optional)</label><br>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*"  onchange="readURL(this);">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Testimonial Quote<span class="text-danger">*</span></label>
                                    <input type="text" name="quote" class="form-control @error('quote') is-invalid @enderror" value="{{ old('quote', $testimonial->quote) }}">

                                    @error('quote')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $testimonial->name) }}">

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rating <span class="text-danger">*</span></label>
                                    <select class="form-select @error('rating') is-invalid @enderror" name="rating">
                                        <option selected value="">Select Rating</option>
                                        <option value="1" @if (old('rating', $testimonial->rating) == '1') selected @endif>1</option>
                                        <option value="2" @if (old('rating', $testimonial->rating) == '2') selected @endif>2</option>
                                        <option value="3" @if (old('rating', $testimonial->rating) == '3') selected @endif>3</option>
                                        <option value="4" @if (old('rating', $testimonial->rating) == '4') selected @endif>4</option>
                                        <option value="5" @if (old('rating', $testimonial->rating) == '5') selected @endif>5</option>
                                    </select>
                                    @error('rating')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                                        <option value="1" @if (old('status', $testimonial->status) == '1') selected @endif>Published</option>
                                        <option value="0" @if (old('status', $testimonial->status) == '0') selected @endif>Draft</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Serial No. <span class="text-danger">*</span></label>
                                    <input type="text" name="serial"
                                        class="form-control @error('serial') is-invalid @enderror"
                                        value="{{ old('serial', $testimonial->serial) }}">

                                    @error('serial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <img class="image rounded-circle" id="uploding_image" style="width:100px;height:100px"
                                src="{{ asset('storage/'.$testimonial->image) }}" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#uploding_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@endsection
