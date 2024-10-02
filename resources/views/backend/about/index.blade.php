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
                <li class="breadcrumb-item active" aria-current="page">About Us Page</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 justify-content-center">
            @include('backend.layouts.alert')

            <form action="{{ route('admin.abouts.update', $about->id) }}" method="POST" onsubmit="validateForm()" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Heading <span class="text-danger">*</span></label>
                                    <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" value="{{ old('heading', $about->heading ) }}">
                                    @error('heading')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short Description 1 <span class="text-danger">*</span></label>
                                    <textarea name="short_desc_1" cols="30" rows="4" class="form-control @error('short_desc_1') is-invalid @enderror">{{ old('short_desc_1', $about->short_desc_1 ) }}</textarea>
                                    @error('short_desc_1')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short Description 2 <span class="text-danger">*</span></label>
                                    <textarea name="short_desc_2" cols="30" rows="4" class="form-control @error('short_desc_2') is-invalid @enderror">{{ old('short_desc_2', $about->short_desc_2 ) }}</textarea>
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
                                    <label class="form-label">About Image <span class="text-danger">*</span></label><br>
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
                                    <a target="_new" href="{{ asset('storage/' . $about->image) }}">
                                        <img class="image" id="uploding_image" style="width:250px;height:250px" src="{{ asset('storage/' . $about->image) }}" alt="image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Vision <span class="text-danger">*</span></label>
                                    <textarea name="vision" cols="30" rows="2" class="form-control @error('vision') is-invalid @enderror">{{ old('vision', $about->vision) }}</textarea>

                                    @error('vision')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mission <span class="text-danger">*</span></label>
                                    <textarea name="mission" cols="30" rows="3" class="form-control @error('mission') is-invalid @enderror">{{ old('mission', $about->mission) }}</textarea>
                                    @error('mission')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Core Values <span class="text-danger">*</span></label>
                                    <textarea name="core_values" cols="30" rows="3" class="form-control @error('core_values') is-invalid @enderror">{{ old('core_values', $about->core_values) }}</textarea>
                                    @error('core_values')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">

                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label"># Cows In Gowshala <span class="text-danger">*</span></label>
                                    <input type="text" name="cows_in_goshala" class="form-control @error('cows_in_goshala') is-invalid @enderror"  value="{{ old('cows_in_goshala', $about->cows_in_goshala) }}">
                                    @error('cows_in_goshala')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"> Gauvansh Sheltered  <span class="text-danger">*</span></label>
                                    <input type="text" name="gauvansh_sheltered" class="form-control @error('gauvansh_sheltered') is-invalid @enderror" value="{{ old('gauvansh_sheltered', $about->gauvansh_sheltered) }}">
                                    @error('gauvansh_sheltered')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gauvansh Rescued <span class="text-danger">*</span></label>
                                    <input type="text" name="gauvansh_rescued" class="form-control @error('gauvansh_rescued') is-invalid @enderror" value="{{ old('gauvansh_rescued', $about->gauvansh_rescued) }}">
                                    @error('gauvansh_rescued')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gauvansh Medicated <span class="text-danger">*</span></label>
                                    <input type="text" name="gauvansh_medicated" class="form-control @error('gauvansh_medicated') is-invalid @enderror" value="{{ old('gauvansh_medicated', $about->gauvansh_medicated ) }}">
                                    @error('gauvansh_medicated')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">More Descriptions (optional)</label><br>
                                <textarea class="form-control @error('more_desc') is-invalid @enderror" name="more_desc" id="editor">{{ old('more_desc', $about->more_desc) }}</textarea>
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
