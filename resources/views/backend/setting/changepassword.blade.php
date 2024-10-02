@extends('backend.layouts.app')
@section('content')

    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-8">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mb-4">

                        <div class="card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Change Password </h6>
                                <form action="{{ route('admin.settings.changepassword') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Old Password</label>
                                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" value="{{ old('current_password') }}">
                                                @error('current_password')
                                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">New Password</label>
                                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" value="{{ old('new_password') }}">
                                                @error('new_password')
                                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" value="{{ old('new_password_confirmation') }}">
                                                @error('new_password_confirmation')
                                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update Password</button>
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
                            <a class="nav-link" href="{{ route('admin.settings.avatar') }}">
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
                            <a class="nav-link active" href="javascript:void(0)" >
                                <i class="bi bi-lock me-2"></i>Change Password
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
