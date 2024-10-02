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
                    <a href="{{ url('admin/slider') }}"> Slider List
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Slider</li>
            </ol>
        </nav>
    </div>
    <div class="row">

        @include('backend.layouts.alert')

        <div class="col-md-12 justify-content-center">
            <form method="POST" action="{{ route('admin.slider.update', $slider->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Slider Type <span class="text-danger">*</span></label>
                                    <select name="slider_type" id="mySelect" onchange="myFunction()"
                                        class="form-control form-select @error('slider_type') is-invalid @enderror"
                                        value="{{ old('slider_type') }}">
                                        <option value="1" @if (old('slider_type', $slider->slider_type) == '1') selected @endif>Web
                                        </option>
                                        {{-- <option value="0" @if (old('slider_type', $slider->slider_type) == '0') selected @endif>Moblie
                                        </option> --}}
                                    </select>

                                    @error('slider_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Banner Image (1920*800) </label><span   class="mb-2 mt-2" id="demo"></span>
                                    <br>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" accept="image/*">

                                    @error('image')
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
                                        <option value="1" @if (old('status', $slider->status) == '1') selected @endif>Publish
                                        </option>
                                        <option value="0" @if (old('status', $slider->status) == '0') selected @endif>Draft
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Serial</label>
                                    <input type="text" name="serial" class="form-control @error('serial') is-invalid @enderror"
                                        value="{{ old('serial', $slider->serial) }}">

                                    @error('serial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Heading <span class="text-danger">*</span></label>
                            <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror"
                                value="{{ old('heading', $slider->title) }}">

                            @error('heading')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Short Description <span class="text-danger">*</span></label>
                            <textarea name="short_desc" cols="30" rows="5" class="form-control @error('short_desc') is-invalid @enderror">{{ old('short_desc', $slider->desc) }}</textarea>

                            @error('short_desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{route('admin.slider.index')}}" type="button" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function myFunction() {
            var x = document.getElementById("mySelect").value;
            if (x == '1') {
                document.getElementById("demo").innerHTML = "Size: (1960X800)";
            } else if (x == '0') {
                document.getElementById("demo").innerHTML = "Size: (750X800)";
            }
        }
    </script>
@endpush
