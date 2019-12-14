@extends('security-fund-flow.template')
@section('title', $title )

@section('body')
<form action="/security-fund-flow/step-1/create/highlights" method="post">
@csrf
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5> Import Digital Security Details</h5>
    </div>
    <div class="card-content">
        <h5>Quick View Highlights</h5>
        <p>Enter the following data to give investors a quick view of pertinent deal highlights.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <form>
                    <div class="card">
                        <div class="card-title dust">
                            <h5>Deal Highlights</h5>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 margin-bottom-l-md">
                                    <div class="content-form">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Target Investor IRR</p>
                                                <input type="text" placeholder="17%" name="target-investor-irr" value="{{ isset($data['target-investor-irr']) ? $data['target-investor-irr'] : '' }}">
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Target Equity Multiple</p><input placeholder="2.3x" type="text" name="target-equity-multiple" value="{{ isset($data['target-equity-multiple']) ? $data['target-equity-multiple'] : '' }}">
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Target Investment Period</p><input placeholder="5 years" name="target-investment-period" type="text" value="{{ isset($data['target-investment-period']) ? $data['target-investment-period'] : '' }}">
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Target Avg Investor Cash Yield</p><input name="target-avg-investor-cash-yield" placeholder="14.2%" type="text" value="{{ isset($data['target-avg-investor-cash-yield']) ? $data['target-avg-investor-cash-yield'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 margin-bottom-l-md">
                                    <div class="content-form">
                                        <div class="row">
                                        <div class="col-xs-12 col-sm-3">
                                                <p>Investment Profile</p>
                                                <input type="text" placeholder="Core" name="investment-profile" value="{{ isset($data['investment-profile']) ? $data['investment-profile'] : '' }}">
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Minimum Investment</p><input placeholder="$25,000" name="minimum-investment" type="text" value="{{ isset($data['minimum-investment']) ? $data['minimum-investment'] : '' }}">
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Property Type</p><input placeholder="Multi Family" name="property-type" value="{{ isset($data['property-type']) ? $data['property-type'] : '' }}" type="text">
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Offers Due</p><input name="offers-due" placeholder="06/30/2019" type="text" value="{{ isset($data['offers-due']) ? $data['offers-due'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12">
                                    <div class="content-form">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Funds Due</p><input placeholder="06/30/2019" type="text" name="funds-due" value="{{ isset($data['funds-due']) ? $data['funds-due'] : '' }}">
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Distribution Period</p><input name="distribution-period" type="text" placeholder="Monthly" value="{{ isset($data['distribution-period']) ? $data['distribution-period'] : '' }}">
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Sponsor Co-Investment</p><input placeholder="$5,000,000" name="sponsor-co-investment" value="{{ isset($data['sponsor-co-investment']) ? $data['sponsor-co-investment'] : '' }}" type="text">
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <p>Distribution Commencement</p><input name="distribution-commencement" type="text" placeholder="08/01/2019" value="{{ isset($data['distribution-commencement']) ? $data['distribution-commencement'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="content-footer">
                                <a href="/security-fund-flow/step-1/details" class="footer-button-back">
                                    <h5><img src="/img/icon-arrow-back.svg" style="margin-right:10px;"> Back</h5>
                                </a>
                                <div class="row center-xs">
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <div class="content-footer-step">
                                        <div class="row">
                                            <div class="col-xs">
                                                <div class="step-item"></div>
                                            </div>
                                            <div class="col-xs">
                                                <div class="step-item"></div>
                                            </div>
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
                                <div class="footer-button-next"><input type="submit" value="Next"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</form>
@endsection
