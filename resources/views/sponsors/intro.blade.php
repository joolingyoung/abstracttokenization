@extends('layouts.main')
@section('title', "Welcome")

@section('content')
<div class="page-title-row">
    <div class="row center-xs text-center">
        <div class="col-xs-12 col-sm-8">
            <h2>Our Services</h2>
            <p>Explore our automated Investor Servicing Portal or lead the way for CRE 2.0 and create your first Digital Security with our Primary Issuance Platform.</p>
        </div>
    </div>
</div>
<div class="page-container">
    <div class="row text-center center-xs margin-bottom-l">
        <div class="col-xs-12 col-md-6 margin-bottom-m">

            <div class="intro-card">
                <img src="/img/intro-laptop.png"/>
            </div>
            <div class="intro-action">
            <a href="/investor-servicing/choose-investment" class="btn intro-btn">Start now</a>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 margin-bottom-m">
            <div class="intro-card">
                <img src="/img/intro-blockchain.png"/>
            </div>
            <div class="intro-action">
                <a href="/account-settings/verification" class="btn intro-btn">Start now</a>
            </div>
        </div>
    </div>
    <div class="row center-xs">
        <div class="col-xs-12 col-md-4 col-lg-2">
        <a href="/sponsor/schedule-demo" class="btn intro-btn full-width">Schedule Demo</a>
        </div>
    </div>
</div>
@endsection
