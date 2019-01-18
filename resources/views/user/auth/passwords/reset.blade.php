@extends('user.layouts.app')

@section('content')
<div class="section section--bg">
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6">
                <h1 class="mt-5 mb-4 text-center text-white font-weight-light">
                    {{ __('Reset Password') }}
                </h1>

                <div class="card mb-5">

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.request') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <p class="lead text-muted">
                                    <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

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
                                <p class="lead text-muted">
                                    <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </p>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
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
@endsection
