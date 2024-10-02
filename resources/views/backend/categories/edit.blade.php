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
                    <a href="{{ url('/admin/categories') }}"> Categories  </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 justify-content-center">
            <div class="card">
                <div class="card-body">

                    <div class="col-md-12">
                        <form method="POST" action="{{route('admin.categories.update', $category->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Icon ( Allowed only SVG )</label><br>
                                <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/svg+xml" >
                                @error('icon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="row">

                                <div class="col-12 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $category->name)}}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-12  mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                                        <option selected value="">Select Status</option>
                                        <option value="1" @if(old('status', $category->status)== '1')   selected @endif >Active</option>
                                        <option value="0" @if(old('status', $category->status )== '0')   selected @endif >Inactive</option>
                                    </select>
                                    @error('status')
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

