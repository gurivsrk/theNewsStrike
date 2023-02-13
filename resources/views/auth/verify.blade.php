@extends('layouts.app',['emailVerificationFailed'=>true])

@section('content')
<div class="container blur-bg">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                    <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="btn logout-btn btn-link p-0 mx-3 align-baseline" onclick="document.getElementById('formLogOut').submit();">{{ __('Log out') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
