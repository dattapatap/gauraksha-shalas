@extends('backend.layouts.app')
@section('styles')
<style>
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #ea4444;
}

</style>

@endsection

@section('content')

    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-8">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mb-4">
                        <div class="d-flex flex-column flex-md-row text-center text-md-start mb-3">

                            <figure class="me-4 flex-shrink-0">
                                @if($admin->profile)
                                    <img width="100" class="rounded-pill" src="{{asset('storage/'. $admin->profile  )}}" alt="...">
                                @else
                                    <img width="100" class="rounded-pill" src="{{asset('assets/img1/testimonal.jpg')}}" alt="...">
                                @endif
                            </figure>

                            <div class="flex-fill">
                                <h5 class="mb-3">Gaurakshashalas</h5>
                                <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Change Profile</button>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Basic Information</h6>
                                <form action="{{ route('admin.settings.profile') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$admin->name) }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$admin->email) }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $admin->phone) }}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sticky-top mb-4 mb-md-0">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column gap-2" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" href="javascript:void(0);">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="{{ route('admin.settings.appsettings') }}" >
                                <i class="bi bi-gear me-2"></i> App Settings
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="{{ route('admin.settings.mailsettings') }}" >
                                <i class="bi bi-envelope me-2"></i> Mail Settings
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="{{ route('admin.settings.changepassword') }}" >
                                <i class="bi bi-lock me-2"></i>Change Password
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.settings.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Profile Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" accept="image/*" name="profile" class="form-control" required>
                            </div>
                            @error('profile')
                                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                            @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@if (count($errors)>0)
<script>
    $(document).ready(function(){
        $('#staticBackdrop').modal('show');
    })
</script>
@endif
@endpush
