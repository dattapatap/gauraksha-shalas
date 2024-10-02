@extends('backend.auth.layouts.auth')

@section('auth-content')


<div class="container" style="height: 100%">

    <div class="form-wrapper">
        <div class="container d-flex justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="row g-0">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-block text-center">
                                        <img width="250" src="{{ asset('backend/assets/images/logo.png') }}" alt="logo">
                                    </div>
                                    <div class="my-2 text-center">
                                        <h3 class="display-8"> Update Password</h3>
                                        <p class="text-muted"></p>
                                    </div>

                                    @include('backend.layouts.alert')

                                    <form class="mb-2" method="POST" action="{{ route('admin.reset.password.update') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="mb-3">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus
                                                placeholder="Email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                                name="password" autocomplete="new-password" placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                                 autocomplete="new-password" placeholder="Confirm Password">
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Reset Password') }}
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
