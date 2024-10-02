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
                    <a href="{{ url('admin/blogs') }}"> blogs
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit blog</li>
            </ol>
        </nav>
    </div>
    <div class="row">

        @include('backend.layouts.alert')

        <div class="col-md-12 justify-content-center">
            <div class="card">
                <div class="card-body">

                    <div class="col-md-12">

                        <form method="POST" action="{{ route('admin.blogs.update', $blog->id) }}" enctype="multipart/form-data" onsubmit="return validateForm()">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Category Id <span class="text-danger">*</span></label>
                                    <select class="form-select category @error('category') is-invalid @enderror" name="category" id="category">
                                            <option selected value="">Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    @if (old('category', $blog->category_id) == $cat->id) selected @endif> {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="col-6 -bottom-3mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('blog_status') is-invalid @enderror" name="blog_status">
                                        <option value="1" @if( old('blog_status', $blog->status) == '1')   selected @endif >Publish</option>
                                        <option value="0" @if( old('blog_status', $blog->status) == '0')   selected @endif >Draft</option>
                                    </select>
                                    @error('blog_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image (optional) </label><br>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" >
                                    <p class="small text-muted mt-3">
                                        use an image at least 1020px by 570px in either .jpg or .png format
                                    </p>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Blog/News/Event Name <samp class="text-danger">*</samp></label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"  value="{{ old('title', $blog->title)}}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description <samp class="text-danger">*</samp></label>
                                <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="editor">{{ old('desc',$blog->description) }}</textarea>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <a href="{{ url('admin/blogs') }}" type="button" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
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
