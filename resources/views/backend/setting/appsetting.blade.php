@extends('backend.layouts.app')
@section('content')
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-8">
            <div class="mb-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-4">Basic Information</h6>
                        <form method="POST" action="{{ route('admin.settings.appsettings.updateSettings') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $appsettings->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Site Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $appsettings->name) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Contact Email 1</label>
                                        <input type="text" name="email_1"
                                            class="form-control @error('email_1') is-invalid @enderror"
                                            value="{{ old('email_1', $appsettings->email_1) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Contact Phone 1</label>
                                        <input type="text" name="phone_1"
                                            class="form-control @error('phone_1') is-invalid @enderror"
                                            value="{{ old('phone_1', $appsettings->phone_1) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Contact Email 2</label>
                                        <input type="text" name="email_2"
                                            class="form-control @error('email_2') is-invalid @enderror"
                                            value="{{ old('email_2', $appsettings->email_2) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Contact Phone 2</label>
                                        <input type="text" name="phone_2"
                                            class="form-control @error('phone_2') is-invalid @enderror"
                                            value="{{ old('phone_2', $appsettings->phone_2) }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Contact Address</label>
                                        <input type="text" name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            value="{{ old('address', $appsettings->address) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Google Map URL</label>
                                        <input type="text" name="maps"
                                            class="form-control @error('maps') is-invalid @enderror"
                                            value="{{ old('maps', $appsettings->maps) }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Twitter</label>
                                        <input type="text" name="t_link"
                                            class="form-control @error('t_link') is-invalid @enderror"
                                            value="{{ old('t_link', $appsettings->t_link) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Facebook</label>
                                        <input type="text" name="f_link"
                                            class="form-control @error('f_link') is-invalid @enderror"
                                            value="{{ old('f_link', $appsettings->f_link) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Instagram</label>
                                        <input type="text" class="form-control @error('i_link') is-invalid @enderror"
                                            value="{{ old('i_link', $appsettings->i_link) }}" name="i_link">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Youtube</label>
                                        <input type="text" class="form-control @error('y_link') is-invalid @enderror"
                                            value="{{ old('y_link', $appsettings->y_link) }}" name="y_link">
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
                            <a class="nav-link active" href="javascript:void(0);" >
                                <i class="bi bi-gear me-2"></i> Basic Details
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
@endsection
