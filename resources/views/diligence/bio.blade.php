@extends('diligence.template')
@section('title', $title )

@section('body')
<form action="/diligence/bio/create" method="post">
@csrf
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Account Verification</h5>
    </div>
    <div class="card-content">
        <h5>About the Sponsor</h5>
        <p>Your Sponsor Bio will be shown alongside your offerings on the Abstract Marketplace. Investors use your Sponsor Bio to learn more about your company’s history.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row center-xs">
                    <div class="col-xs-12 col-md-8">
                        <h5>Sponsor Bio</h5>
                        <p>Reassure potential investors with an in-depth bio describing your past successes, milestones, and relavent statistics.</p>
                        <textarea name="bio">{{ isset($data['bio']) ? $data['bio'] : '' }}</textarea>
                        <div class="content-form-row">
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-sm-8">
                                    <p>Total Portfolio Activity Amount:</p>
                                </div>
                                <div class="col-xs-12 col-sm-4"><input type="text" value="{{ isset($data['portfolio_activity_amount']) ? $data['portfolio_activity_amount'] : '' }}" name="portfolio_activity_amount" placeholder="$1,000,000"></div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-sm-8">
                                    <p>Total Assets Under Management:</p>
                                </div>
                                <div class="col-xs-12 col-sm-4"><input type="text" value="{{ isset($data['assets_under_management']) ? $data['assets_under_management'] : '' }}" name="assets_under_management" placeholder="$5,000,000"></div>
                            </div>
                            <div class="row middle-xs">
                                <div class="col-xs-12 col-sm-8">
                                    <p>Total Square Feet Managed:</p>
                                </div>
                                <div class="col-xs-12 col-sm-4"><input type="text" value="{{ isset($data['square_feet_managed']) ? $data['square_feet_managed'] : '' }}" name="square_feet_managed" placeholder="50,000 sq. ft."></div>
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
                                <input type="submit" value="Next">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
