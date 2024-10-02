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
                <li class="breadcrumb-item active" aria-current="page">Donation Form</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 justify-content-center">
            @include('backend.layouts.alert')

            <form action="{{ route('admin.donation-form.update') }}" method="POST" onsubmit="validateForm()" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="donation_id" value="{{ $donation->id }}">
                    <div class="col-lg-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Heading <span class="text-danger">*</span></label>
                                    <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" value="{{ old('heading', $donation->heading ) }}">
                                    @error('heading')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short Description 1 <span class="text-danger">*</span></label>
                                    <textarea name="short_desc_1" cols="30" rows="4" class="form-control @error('short_desc_1') is-invalid @enderror">{{ old('short_desc_1', $donation->short_desc_1 ) }}</textarea>
                                    @error('short_desc_1')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Short Description 2 <span class="text-danger">*</span></label>
                                    <textarea name="short_desc_2" cols="30" rows="4" class="form-control @error('short_desc_2') is-invalid @enderror">{{ old('short_desc_2', $donation->short_desc_2 ) }}</textarea>
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
                                    <label class="form-label">Donation Image <span class="text-danger">*</span></label><br>
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
                                    <a target="_new" href="{{ asset('storage/' . $donation->image) }}">
                                        <img class="image" id="uploding_image" style="width:300px;height:250px" src="{{ asset('storage/' . $donation->image) }}" alt="image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <span class="mb-3">Donation Custom Amounts</span>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <input type="number" name="amount_1" placeholder="1st Amount" value="{{ old('amount_1', $donation->amount_1)}}"
                                        class="form-control @error('amount_1') is-invalid @enderror" >
                                        @error('amount_1')
                                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="amount_2"  placeholder="2ns Amount" value="{{ old('amount_2', $donation->amount_2)}}"
                                        class="form-control @error('amount_2') is-invalid @enderror">
                                        @error('amount_2')
                                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="amount_3" placeholder="3rd Amount" value="{{ old('amount_3', $donation->amount_3)}}"
                                        class="form-control @error('amount_3') is-invalid @enderror">
                                        @error('amount_3')
                                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">More Descriptions (optional)</label><br>
                                <textarea class="form-control @error('more_desc') is-invalid @enderror" name="more_desc" id="editor">{{ old('more_desc', $donation->more_desc) }}</textarea>
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
