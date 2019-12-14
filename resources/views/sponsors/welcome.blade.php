@extends('layouts.main')
@section('title', "Welcome")

@section('content')
    <div class="page-banner">
        <div class="row end-xs">
            <div class="col-xs-12 col-sm-8">
                <div class="btn dust">Invite Friends</div>
            </div>
        </div>
    </div>
    <div class="page-title-row">
        <div class="row center-xs text-center">
            <div class="col-xs-12 col-sm-8">
                <h2>Hello, {{ $user->first_name }}! Be sure to complete your Dashboard account setup so that we can approve your Sponsor & Investor accounts. </h2>
                <p>We will let you know when your account has been approved within 1-2 days.</p>
            </div>
        </div>
    </div>
    <div class="dashboard-content-wrap">
        <div class="row center-xs">
            <div class="col-xs-12 col-sm-10">
                <div class="wc-box-container">
                    <div class="row text-center center-xs">
                        <div class="col-xs-12 col-sm-3">
                            <div class="card wc-box-item">
                                <div class="wc-item-wrap">
                                    <div class="wc-item-icon"></div>
                                    <div class="wc-item-content">
                                        <h5>Complete Sponsor Due Dilligence </h5><a>Let’s get started!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="card wc-box-item">
                                <div class="wc-item-wrap">
                                    <div class="wc-item-icon"></div>
                                    <div class="wc-item-content">
                                        <h5>Investing in Digital Securities </h5><a>A ‘How To’ guide awaits…</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="card wc-box-item">
                                <div class="wc-item-wrap">
                                    <div class="wc-item-icon"></div>
                                    <div class="wc-item-content">
                                        <h5>Explore Abstract’s Marketplace </h5><a>Primary issuance…personified.</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="card wc-box-item">
                                <div class="wc-item-wrap">
                                    <div class="wc-item-icon"></div>
                                    <div class="wc-item-content">
                                        <h5>Abstract’s Investor Servicing </h5><a>Come see automation at it’s best.</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wc-cta-container">
                    <div class="row text-center center-xs margin-top-m">
                        <div class="col-xs-12 col-sm-6 wc-cta-box wc-cta-box-1">
                            <div class="card">
                                <div class="box-item-wrap">
                                    <div class="box-item-content">
                                        <h2>Don’t Forget!</h2>
                                        <p>Please verify this important information and we’ll approve your account ASAP!</p>
                                        <a href="/account-settings/verification"><div class="btn line white-text">Verify Now</div></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 wc-cta-box wc-cta-box-2">
                            <div class="card">
                                <div class="box-item-wrap">
                                    <div class="box-item-content">
                                        <p>Digital Securities open up a world of opportunity…</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
