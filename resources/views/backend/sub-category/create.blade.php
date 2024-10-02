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
                    <a href="{{ url('/admin/sub-category') }}"> Sub Categories
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">New Sub Category</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">
            <div class="card">
                <div class="card-body">

                    <div class="col-md-12">
                        <form method="POST" action="{{route('admin.sub-category.store')}}" enctype="multipart/form-data">
                            @csrf
                             <div class="row">

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name')}}" placeholder="Sub Category Name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Select Categoory</label>
                                    <select class="form-select @error('category') is-invalid @enderror" name="category">
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
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
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

