@extends('user.layouts.app')

@section('content')
<div class="container spacing--container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h3 class="display-5 pt-5 pb-4">
                    Welcome, {{ Auth::user()->name }}
                </h3>
                <h4 class="text-muted font-weight-light pb-5">
                    This is your dashboard
                </h4>
            </div>
        </div>
    </div>
</div>
@endsection