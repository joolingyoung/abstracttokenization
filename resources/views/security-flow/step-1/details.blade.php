@extends('security-flow.template')
@section('title', $title )

@section('body')
<form action="/security-flow/step-1/create/details" method="post">
@csrf
<div class="card margin-top-m" id="app">
        <div class="card-title blue">
            <h5> Import Digital Security Details</h5>
        </div>
        <div class="card-content">
            <h5>Details</h5>
            <p>The next 7 steps will collect information on your digital security so that we can create a detailed page of your offering for our Marketplace.</p>
            <div class="card grey margin-top-m card-black">
                <div class="card-content">
                    <form>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="content-form">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-7">
                                            <p class="no-margin-top">Property / Opportunity Name</p><input value="{{ isset($data['property']) ? $data['property'] : '' }}" name="property" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-5">
                                            <p class="no-margin-top margin-top-s-md">Opportunity Type</p>
                                            <select name="opportunity_type">
                                                <option value="{{ isset($data['opportunity_type']) ? $data['opportunity_type'] : '' }}" selected="selected">{{ isset($data['opportunity_type']) ? $data['opportunity_type'] : 'Select an option' }}</option>
                                                <option value="Core">Core</option>
                                                <option value="Value-Added">Value-Added</option>
                                                <option value="Opportunistic">Opportunistic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p>Short Description of Opportunity</p>
                                            <textarea name="opportunity_description">{{ isset($data['opportunity_description']) ? $data['opportunity_description'] : '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Property Address</p><input value="{{ isset($data['property_address']) ? $data['property_address'] : '' }}" name="property_address" type="text">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>City</p><input name="city" value="{{ isset($data['city']) ? $data['city'] : '' }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <p>State</p><input name="state" value="{{ isset($data['state']) ? $data['state'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Zip Code</p><input name="zip" value="{{ isset($data['zip']) ? $data['zip'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Country</p><input name="country" value="{{ isset($data['country']) ? $data['country'] : '' }}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="content-form">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <p class="no-margin-top">Vacancy Rate</p><input name="vacancy_rate" placeholder="45%" value="{{ isset($data['vacancy_rate']) ? $data['vacancy_rate'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p class="no-margin-top">Current NOI</p><input name="current_noi" placeholder="$1,000,000" value="{{ isset($data['current_noi']) ? $data['current_noi'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p class="no-margin-top">Projected NOI</p><input value="{{ isset($data['pro-frorma-noi']) ? $data['pro-frorma-noi'] : '' }}" name="pro-frorma-noi" placeholder="$2,000,000" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <p>1031 Exchange</p><input type="text" name="1031_exchange" placeholder="Y or N?" value="{{ isset($data['1031_exchange']) ? $data['1031_exchange'] : '' }}">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Market Value</p><input name="market_value" placeholder="$50,000,000" type="text" value="{{ isset($data['market_value']) ? $data['market_value'] : '' }}">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Square Footage</p><input name="square_footage" placeholder="50,000 sq. ft." type="text" value="{{ isset($data['square_footage']) ? $data['square_footage'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <p>Property Class</p><input type="text" name="property_class" placeholder="A, B or C" value="{{ isset($data['property_class']) ? $data['property_class'] : '' }}">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Annual Cash Flow</p><input name="annual_cash_flow" placeholder="$1,000,000" value="{{ isset($data['annual_cash_flow']) ? $data['annual_cash_flow'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p class="margin-top-s-md">Distribution frequency</p>
                                            <select name="distribution-frequency">
                                                <option value="{{ isset($data['distribution-frequency']) ? $data['distribution-frequency'] : '' }}" selected="selected">{{ isset($data['distribution-frequency']) ? $data['distribution-frequency'] : 'Select an option' }}</option>
                                                <option value="Monthly">Monthly </option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Semi-Annually">Semi-Annually</option>
                                                <option value="Annually">Annually</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row margin-top-m">
                                        <div class="col-xs-12">
                                            <h6>Loan Information:</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Total Debt</p><input name="total_debt" placeholder="$900,000" value="{{ isset($data['total_debt']) ? $data['total_debt'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Payoff Date</p><input name="payoff_date" placeholder="12/05/2020" value="{{ isset($data['payoff_date']) ? $data['payoff_date'] : '' }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row margin-top-s">
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Amortizing</p><input type="radio"
                                            <?php
                                                if(isset($data['loan-type']) && $data['loan-type'] === 'Amortizing'){
                                                    echo 'Checked';
                                                }
                                            ?>
                                             value="Amortizing" name="loan-type">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Interest Only</p><input type="radio"
                                            <?php
                                            if(isset($data['loan-type']) && $data['loan-type'] === 'Interest Only'){
                                                echo 'Checked';
                                            }
                                            ?>
                                            value="Interest Only" name="loan-type">
                                        </div>
                                    </div>
                                    <div class="row margin-top-m">
                                        <div class="col-xs-12">
                                            <h6>Is the Property Developed?</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Yes</p><input type="radio"
                                            <?php
                                            if(isset($data['developed']) && $data['developed'] === 'yes'){
                                                echo 'Checked';
                                            }
                                            ?> value="yes" name="developed">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>No</p><input type="radio"
                                            <?php
                                            if(isset($data['developed']) && $data['developed'] === 'no'){
                                                echo 'Checked';
                                            }
                                            ?>
                                            value="no" name="developed">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="content-footer">
                                    <a href="/security-flow/step-1/upload-photos" class="footer-button-back">
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
<script>
    $(document).ready(function() {
        $('input[name="payoff_date"]').datepicker();
    });
</script>
@endsection
