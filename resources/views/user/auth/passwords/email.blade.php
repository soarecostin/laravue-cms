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
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <p class="lead text-muted">
                                    <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
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
@endsection
