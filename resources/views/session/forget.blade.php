@extends('layouts.app')
@section('title', 'Forgot Password')

@section('content')
<form action="/forget-password" method="post">
@csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 center">
                <div class="card-content-onboarding card">
                    <div class="onboarding-title">
                        <div class="onboarding-logo"><img src="/img/logo-light-w-type.svg"></div>
                    </div>
                    <div class="content-form">
                        <div class="row">
                            <div class="col-xs-12">
                                <p>Email</p>
                                @if($errors->has('email'))
                                    <p>
                                        <small class="error-small color-white"><em>*</em> <span class="color-white"> {{ $errors->first('email') }} </span></small>
                                    </p>
                                @elseif( isset( $error ) && $error )
                                    <p>
                                        <small class="error-small color-white"><em>*</em> <span class="color-white">The email address you've specified does not exist. </span></small>
                                    </p>
                                @endif
                                <input type="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="signup-footer">
                        <a href="/onboarding/login-reset-password">
                            <button class="large full-width white">Send</button>
                        </a>
                        <p>Remember password?<a href="/onboarding/login"> Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
<style>
    header { display: none !important }
</style>