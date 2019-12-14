@extends('subdomain.account-settings.main-template')
@section('title', "Reports > Investor Servicing")

@section('body')

<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Password & Two Factor Authentication</h5></div>
    <div class="card-content">
        <form>
            <p class="no-margin-top">Update your password below. We will notify you by email when 2FA is ready to set up.</p>
            <div class="content-form margin-top-m">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h5>Password Update:</h5>
                        <div class="row">
                            <div class="col-xs-12">
                                <p>Current Password</p>
                                <input type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <p>New Password</p>
                                <input type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <p>Confirm New Password</p>
                                <input type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6"></div>
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
                            <input type="submit" value="Next">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection