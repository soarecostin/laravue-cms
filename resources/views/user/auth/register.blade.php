@extends('user.layouts.app')

@section('content')
<div class="section section--bg">
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6">
                <h1 class="mt-5 mb-4 text-center text-white font-weight-light">Register an account</h1>
                
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            @if($errors->any())
                                <p class="text-danger">
                                    There are some issues, please check below
                                </p>
                            @endif
                            
                            <div class="form-group">
                                <p class="lead text-muted">
                                    <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </p>
                            </div>
                            
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
                                <div class="checkbox lead text-muted">
                                    <label class="form-control border-0 pl-0 {{ $errors->has('terms') ? ' is-invalid' : '' }}">
                                        <input type="checkbox" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}> I agree to the <a href="">Terms of Service</a>
                                    </label>

                                    @if ($errors->has('terms'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('terms') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Create account') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <p class="lead text-center mt-4 mb-4 text-white font-weight-light">
                    Already have an account? <a href="{{ route('login') }}" class="link-contrast">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
