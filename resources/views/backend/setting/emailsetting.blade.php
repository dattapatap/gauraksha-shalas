@extends('backend.layouts.app')
@section('content')
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-4">Email Configuration</h6>
                    <form method="POST" action="{{ route('admin.settings.updatemail') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $mailconfiguration->id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Email From <span class="text-danger">*</span></label>
                                    <input type="text" name="email_from" class="form-control @error('email_from') is-invalid @enderror"
                                        value="{{ old('email_from', $mailconfiguration->email_from) }}">
                                    @error('email_from')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CC Mail(Optional)</label>
                                    <input type="text" name="email_cc" class="form-control @error('email_cc') is-invalid @enderror"
                                        value="{{ old('email_cc', $mailconfiguration->email_cc) }}">
                                    @error('email_cc')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">BCC Mail (optional)</label>
                                    <input type="text" name="email_bcc"
                                        class="form-control @error('email_bcc') is-invalid @enderror"
                                        value="{{ old('email_bcc', $mailconfiguration->email_bcc) }}">

                                    @error('email_bcc')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card sticky-top mb-4 mb-md-0">
                <div class="card-body">

                    <ul class="nav nav-pills flex-column gap-2" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " href="{{ route('admin.settings.avatar') }}">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" href="{{ route('admin.settings.appsettings') }}" >
                                <i class="bi bi-gear me-2"></i> Basic Details
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" href="javascript:void(0);" >
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

@endsection
