@extends('backend.auth.layouts.auth')

@section('auth-content')
<div class="container" style="height: 100%;">

    <div class="form-wrapper p-75">
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
                                        <h3 class="display-8">Sign In</h3>
                                        <p class="text-muted">Sign in to  continue</p>
                                    </div>

                                    @include('backend.layouts.alert')


                                    <form class="mb-2" method="POST" action="{{ route('admin.login.post') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email"
                                                 name="email"  value="gaurakshashalas@gmail.com"
                                                autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input placeholder="Enter password" id="password" type="password" class="form-control
                                                @error('password') is-invalid @enderror" name="password" value="password"
                                                autocomplete="current-password" value="">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            @if (Route::has('admin.password.request'))
                                            <p class="small">Can't access your account?
                                                <a href="{{ route('admin.password.request') }}" style="color: #65B38B;">{{ __('Forgot Your Password') }}</a>.
                                            </p>
                                            @endif
                                            <button  type="submit"  class="btn btn-primary">Sign In</button>

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
