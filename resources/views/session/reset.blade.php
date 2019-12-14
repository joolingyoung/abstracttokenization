@extends('layouts.app')
@section('title', 'Reset Password')

@section('content')
<form method="post" action="">
@csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-5 center">
                <div class="card-content-onboarding card padding-bottom-m">
                    <div class="onboarding-title">
                        <div class="onboarding-logo"><img src="/img/logo-light-w-type.svg"></div>
                    </div>
                    <div class="content-form">
                        <div class="row">
                            <div class="col-xs-12">
                                <p>New password</p>
                                <input type="password" name="password">
                            </div>
                        </div>
                        <a href="/onboarding/login">
                            <input type="submit" value="Reset" class="large full-width margin-top-m white">
                            <br/><br/><br/>
                        </a>
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