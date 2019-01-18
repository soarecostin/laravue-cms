@extends('user.layouts.app')

@section('content')
<div class="section section--bg">
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6">
                <h1 class="mt-5 mb-4 text-center text-white">
                    Welcome back
                </h1>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <p class="lead text-muted">
                                    <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <div class="form-group">
                                <p class="lead text-muted">
                                    <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <div class="form-group">
                                <div class="checkbox lead text-muted">
                                    <label class="form-control border-0 pl-0">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Stay logged in. This is a trusted computer.
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Sign in') }}
                                </button>
                            </div>

                            <!-- Registration Links -->
                            <div class="text-center mt-4">
                                <p>
                                    <a href="{{ route('password.request') }}" class="active" title="Forgot Password">Forgot Your Password?</a>
                                </p>
                            </div>
                        </form>
                    </div>

                </div>

                <p class="lead text-center mt-4 mb-4 text-white font-weight-light">
                    New user? <a href="{{ route('register') }}" class="link-contrast">Create an account</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
