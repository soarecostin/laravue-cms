@extends('user.layouts.app')

@section('content')
<div class="section section--bg">
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6">
                <h1 class="mt-5 mb-4 text-center text-white font-weight-light">{{ __('Verify Your Email Address') }}</h1>
                
                <div class="card">
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p class="lead text-muted mb-0">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection