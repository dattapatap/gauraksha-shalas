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
                    <a href="{{ url('/admin/sevas') }}"> Seva List </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/sevas') }}"> {{ $seva->name }} </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.sevas.gallery', $seva->slug) }}"> Gallery
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Add New Image</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">

            <form method="POST" action="{{ route('admin.sevas.gallery.store', $seva->slug) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3">

                                        <input type="hidden" name="seva" value="{{ $seva->id }}">

                                        <label class="form-label">Name</label>

                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label id="lblcategory" class="form-label">Image ( 800 * 450 )</label><br>
                                    <input type="file" name="image" id="image" onchange="readURL(this);"
                                        class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="card-footer d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.sevas.gallery', $seva->slug) }}" type="button" class="btn btn-danger btn-update">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div id="image_preview" style="padding-left: 15px;">
                            <img class="rounded" id="uploding_image" style="width:500px;height:300px"
                                src="https://placehold.co/800x450" alt="image">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
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

        $('#file_type').change(function(){
            if($(this).val() == 'video'){
                $('#lblcategory').text("Video");
                $('#image').attr('accept', 'video/mp4,video/x-m4v,video/*')
            }else{
                $('#image').attr('accept', 'image/*')
                $('#lblcategory').text("Image ( 650 * 650 )");
            }
        })

    </script>
@endpush
