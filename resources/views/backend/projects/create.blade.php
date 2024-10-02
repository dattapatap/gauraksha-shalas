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
                    <a href="{{ url('admin/projects') }}"> Projects
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">New Project</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">

            @include('backend.layouts.alert')

            <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Project Name <span class="text-danger">*</span></label>
                                        <input type="text" name="project_name" class="form-control @error('project_name') is-invalid @enderror"  value="{{ old('project_name') }}">
                                        @error('project_name')
                                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Project Heading <span class="text-danger">*</span> </label>
                                    <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" value="{{ old('heading') }}">

                                    @error('heading')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Short Desciptions 1 <span class="text-danger">*</span> </label>
                                    <textarea name="short_desc_1" cols="30" rows="3" class="form-control @error('short_desc_1') is-invalid @enderror">{{ old('short_desc_1') }}</textarea>
                                    @error('short_desc_1')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short Desciptions 2 </label>
                                    <textarea name="short_desc_2" cols="30" rows="3" class="form-control @error('short_desc_2') is-invalid @enderror">{{ old('short_desc_2') }}</textarea>
                                    @error('short_desc_2')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Long Desciptions </label>
                                    <textarea class="form-control @error('long_description') is-invalid @enderror" name="long_description" id="editor">{{ old('long_description') }}</textarea>
                                    @error('long_description')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <a href="{{ url('admin/projects') }}" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>

        </div>
    </div>
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
