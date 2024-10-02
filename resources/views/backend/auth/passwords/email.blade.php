@extends('backend.auth.layouts.auth')

@section('auth-content')
<div class="container" style="height: 100%">

    <div class="form-wrapper">
        <div class="container d-flex justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="row g-0">
                        <div class="col" style="min-height: 100px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-block text-center">
                                        <img width="250" src="{{ asset('backend/assets/images/logo.png') }}" alt="logo">
                                    </div>
                                    <div class="my-3 text-center">
                                        <h3 class=""> Reset Password</h3>
                                    </div>

                                    @include('backend.layouts.alert')

                                    <form class="mb-2" method="POST" action="{{ route('admin.password.email') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="email address">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>


</div>



@endsection
