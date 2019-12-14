@extends('account-settings.template')
@section('title', "Cap Table > Investor Servicing")

@section('body')

<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Bank Account Information</h5></div>
    <div class="card-content">
        <h5>Bank Details</h5>
        <p>Please verify your bank details. Click "Edit" to update this information.</p>
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
                                            <p>Checking</p>
                                            <input type="radio" name="loan-type">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Savings</p>
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
                            <div class="col-xs-12 col-sm-6 margin-top-m-sm">
                                <div class="btn full-width">Edit</div>
                            </div>
                            <div class="col-xs-12 col-sm-6 margin-top-m-sm">
                                <div class="btn dust full-width">Save</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
