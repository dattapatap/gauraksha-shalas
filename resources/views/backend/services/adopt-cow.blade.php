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
                <li class="breadcrumb-item active" aria-current="page">Adopt-Cow</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 justify-content-center">
            @include('backend.layouts.alert')

            <form action="{{ route('admin.adopt-cow.update') }}" method="POST" onsubmit="validateForm()" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="adopt_id" value="{{ $adoptCow->id }}">
                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Heading <span class="text-danger">*</span></label>
                                    <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" value="{{ old('heading', $adoptCow->heading ) }}">
                                    @error('heading')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short Description 1 <span class="text-danger">*</span></label>
                                    <textarea name="short_desc_1" cols="30" rows="4" class="form-control @error('short_desc_1') is-invalid @enderror">{{ old('short_desc_1', $adoptCow->short_desc_1 ) }}</textarea>
                                    @error('short_desc_1')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short Description 2 <span class="text-danger">*</span></label>
                                    <textarea name="short_desc_2" cols="30" rows="4" class="form-control @error('short_desc_2') is-invalid @enderror">{{ old('short_desc_2', $adoptCow->short_desc_2 ) }}</textarea>
                                    @error('short_desc_2')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label"> Image <span class="text-danger">*</span></label><br>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                        accept="image/*" onchange="readURL(this);">
                                    <p class="mt-3">use an image 1060px by 795px in either .jpg or .png format</p>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <a target="_new" href="{{ asset('storage/' . $adoptCow->image) }}">
                                        <img class="image" id="uploding_image" style="width:300px;height:250px" src="{{ asset('storage/' . $adoptCow->image) }}" alt="image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">More Descriptions (optional)</label><br>
                                <textarea class="form-control @error('more_desc') is-invalid @enderror" name="more_desc" id="editor">{{ old('more_desc', $adoptCow->more_desc) }}</textarea>
                                @error('more_desc')
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

@push('scripts')
<script src="{{ asset('backend/assets/libs/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.addCss('.cke_editable { background-color: #303030; color: white }');
    CKEDITOR.replace('editor');

    CKEDITOR.editorConfig = function( config ) {
        config.versionCheck = false;
    };
    CKEDITOR.instances['editor'].updateElement();
</script>
@endpush
