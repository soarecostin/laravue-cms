@extends('admin.layouts.app', ['bodyClass' => "bg-dark"])

@section('main-content')
<div class="container mt-5">

    <div class="card card-login mx-auto mt-5">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="form-group">
                    <p class="lead text-muted">
                        <label for="email" class="col-form-label">Username</label>
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </p>
                </div>
                <div class="form-group">
                    <p class="lead text-muted">
                        <label for="password" class="col-form-label">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </p>
                </div>
                <div class="form-group pt-2 mb-2">
                    <button class="btn btn-primary btn-block btn-lg">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection