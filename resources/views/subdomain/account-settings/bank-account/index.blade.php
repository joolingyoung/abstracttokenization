@extends('subdomain.account-settings.main-template')
@section('title', "Cap Table > Investor Servicing")

@section('body')

<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Bank Account Information</h5></div>
    <div class="card-content">
        <h5>Bank Details</h5>
        <p>Please ensure your banking details are correct. Click Edit to change.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row center-xs">
                    <div class="col-xs-12 col-md-9">
                        <div class="content-form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p class="no-margin-top">Bank Name</p>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p class="no-margin-top">Account Name</p>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p class="no-margin-top">Account Number</p>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p>ABA / TRC Number</p>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-5">
                                    <div class="row margin-top-s">
                                        <div class="col-xs-12">
                                            <p class="no-margin-top">Account Type</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Amortizing</p>
                                            <input type="radio" name="loan-type">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Interest Only</p>
                                            <input type="radio" name="loan-type">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row center-xs margin-top-m">
                    <div class="col-xs-12 col-md-6">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="btn full-width">Edit</div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="btn dust full-width">Save</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-footer">
                            <div class="row center-xs">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="content-footer-step">
                                        <div class="row">
                                            <div class="col-xs">
                                                <div class="step-item active"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item"></div>
                                            </div>
                                        </div>
                                        <div class="step-divider"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-button-next">
                                <a href="/account-settings/electronic-consent" class="btn color-white">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            
@endsection