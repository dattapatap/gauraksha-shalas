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
                    <a href="{{ url('/admin/category-types') }}"> Collections
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">New Collection</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">
            <div class="card">
                <div class="card-body">

                    <div class="col-md-12">
                        <form method="POST" action="{{route('admin.category-types.store')}}" enctype="multipart/form-data">
                            @csrf
                             <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Category Type Image<span class="required-lbl">*</span>( 1050 * 600 )</label>
                                    <input type="file" name="file"
                                        class="form-control @error('file') is-invalid @enderror" accept="image/*">

                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Name<span class="required-lbl">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name')}}" placeholder="Category Type Name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                             </div>
                             <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Select Categoory<span class="required-lbl">*</span></label>
                                    <select class="form-select category @error('category') is-invalid @enderror" name="category" id="category">
                                        <option selected value="">Select Category</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" @if(old('category')==  $cat->id  )   selected @endif > {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Select Sub Categoory<span class="required-lbl">*</span></label>
                                    <select class="form-select sub_category @error('sub_category') is-invalid @enderror" id="sub_category" name="sub_category">
                                        <option selected value="">Select Sub Category</option>

                                    </select>

                                    @error('sub_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Status<span class="required-lbl">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                                        <option selected value="">Select Status</option>
                                        <option value="1" @if(old('status')== '1')   selected @endif >Active</option>
                                        <option value="0" @if(old('status')== '0')   selected @endif >Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Show Home Page<span class="required-lbl">*</span></label>
                                    <select class="form-select @error('show_front') is-invalid @enderror" name="show_front">
                                        <option selected value="0">No</option>
                                        <option value="0" @if(old('status')== '0')   selected @endif >No</option>
                                        <option value="1" @if(old('status')== '1')   selected @endif >Yes</option>
                                    </select>
                                    @error('show_front')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
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
    <script>
        $(document).ready(function(){
            $('body').on('change', '.category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.get-subcategories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        console.log(data);
                        $('.sub_category').html('<option value="">Select</option>')

                        $.each(data, function(i, item){
                            $('.sub_category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })

        })
    </script>
@endpush
