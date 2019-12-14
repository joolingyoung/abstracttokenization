@extends('security-fund-flow.template')
@section('title', $title )

@section('body')
<form action="/security-fund-flow/step-1/create/details" method="post">
@csrf
    <div class="card margin-top-m" id="app">
        <div class="card-title blue">
            <h5>Import Digital Security Details</h5>
        </div>
        <div class="card-content">
            <h5>Details</h5>
            <p>The next 7 steps will collect information on your digital security so that we can create a detailed page of your offering for our Marketplace.</p>
            <div class="card grey card-black margin-top-m">
                <div class="card-content">
                    <form>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="content-form">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <p class="no-margin-top">Fund Name</p><input value="{{ isset($data['fund-name']) ? $data['fund-name'] : '' }}" name="fund-name" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <p class="no-margin-top margin-top-s-md">Opportunity Type</p>
                                            <select name="opportunity-type">
                                                <option value="{{ isset($data['opportunity-type']) ? $data['opportunity-type'] : '' }}" selected="selected">{{ isset($data['opportunity-type']) ? $data['opportunity-type'] : 'Select an option' }}</option>
                                                <option value="Core">Core</option>
                                                <option value="Value-Added">Value-Added</option>
                                                <option value="Opportunistic">Opportunistic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row bottom-xs">
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Type of Fund?</p>
                                            <select name="type-of-fund">
                                                <option value="{{ isset($data['type-of-fund']) ? $data['type-of-fund'] : '' }}" selected="selected">{{ isset($data['type-of-fund']) ? $data['type-of-fund'] : 'Select an option' }}</option>
                                                <option value="Closed End">Closed End</option>
                                                <option value="Opened End">Opened End</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>If Open Eneded, where is the capital from?</p>
                                            <input type="text" name="capital-origin" value="{{ isset($data['capital-origin']) ? $data['capital-origin'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="row bottom-xs">
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Capital Deployed</p>
                                            <input type="text" name="capital-deployed" value="{{ isset($data['capital-deployed']) ? $data['capital-deployed'] : '' }}">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p class="margin-top-s-md">Distribution frequency</p>
                                            <select name="distribution-frequency">
                                                <option value="{{ isset($data['distribution-frequency']) ? $data['distribution-frequency'] : '' }}" selected="selected">{{ isset($data['distribution-frequency']) ? $data['distribution-frequency'] : 'Select an option' }}</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Semi-Annually">Semi-Annually</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row bottom-xs">
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Projected NOI</p>
                                            <input value="{{ isset($data['proforma-current-noi']) ? $data['proforma-current-noi'] : '' }}" name="proforma-current-noi" placeholder="$2,000,000" type="text">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p class="margin-top-s-md">Annual Cash Flow</p>
                                            <input name="annual-cash-flow" placeholder="$1,000,000" value="{{ isset($data['annual-cash-flow']) ? $data['annual-cash-flow'] : '' }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row margin-top-s">
                                        <div class="col-xs-12">
                                            <p>Is this a Discretionary Fund or a new Fund without existing holdings?</p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Yes</p>
                                            <input
                                            <?php
                                                if(isset($data['fund-type']) && $data['fund-type'] === 'Yes'){
                                                    echo 'Checked';
                                                }
                                            ?>
                                            type="radio" value="Yes" name="fund-type">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>No</p>
                                            <input
                                            <?php
                                                if(isset($data['fund-type']) && $data['fund-type'] === 'No'){
                                                    echo 'Checked';
                                                }
                                            ?>
                                            type="radio" value="No" name="fund-type">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row nowrap">
                                            <div class="col-xs-12 col-sm-12">
                                                <p>If No, list Existing and/or Pledged Properties:</p>
                                                <textarea name="existing-properties">{{ isset($data['existing-properties']) ? $data['existing-properties'] : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row yeswrap">
                                            <div class="col-xs-12 col-sm-12" style="margin-top:30px;">
                                                <div class="content-form">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <p class="no-margin-top">If Fund holds Existing or Pledged Properties, list averages below: </p>
                                                        </div>
                                                    </div>
                                                    <div class="row margin-top-s">
                                                        <div class="col-xs-12 col-md-4">
                                                            <p>Vacancy Rate</p><input name="vacancy-rate" value="{{ isset($data['vacancy-rate']) ? $data['vacancy-rate'] : '' }}" type="text">
                                                        </div>
                                                        <div class="col-xs-12 col-md-4">
                                                            <p>Proforma/Current NOI</p><input name="proforma-current-noi" value="{{ isset($data['proforma-current-noi']) ? $data['proforma-current-noi'] : '' }}" type="text">
                                                        </div>
                                                        <div class="col-xs-12 col-md-4">
                                                            <p>Annual Cash Flow</p><input name="annual-cash-flow" value="{{ isset($data['annual-cash-flow']) ? $data['annual-cash-flow'] : '' }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-4">
                                                            <p>1031 Exchange</p><input type="text" name="1031-exchange" value="{{ isset($data['1031-exchange']) ? $data['1031-exchange'] : '' }}" placeholder="Y or N?">
                                                        </div>
                                                        <div class="col-xs-12 col-md-4">
                                                            <p>Market Value</p><input type="text" name="market-value" value="{{ isset($data['market-value']) ? $data['market-value'] : '' }}">
                                                        </div>
                                                        <div class="col-xs-12 col-md-4">
                                                            <p>Square Footage</p><input type="text" name="square-footage" value="{{ isset($data['square-footage']) ? $data['square-footage'] : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-4">
                                                            <p>Property Class</p><input type="text" name="property-class" placeholder="A, B, orC" value="{{ isset($data['property-class']) ? $data['property-class'] : '' }}">
                                                        </div>
                                                        <div class="col-xs-12 col-md-4">
                                                            <p>Property Type</p>
                                                            <select name="property-type-pledged">
                                                                <option value="{{ isset($data['property-type-pledged']) ? $data['property-type-pledged'] : '' }}" selected="selected">{{ isset($data['property-type-pledged']) ? $data['property-type-pledged'] : 'Select an option' }}</option>
                                                                <option value="Healthcare">Healthcare</option>
                                                                <option value="Hospital">Hospital</option>
                                                                <option value="Industrial">Industrial</option>
                                                                <option value="Land">Land</option>
                                                                <option value="Multifamily">Multifamily</option>
                                                                <option value="Office">Office</option>
                                                                <option value="Portfolio">Portfolio</option>
                                                                <option value="Retail">Retail</option>
                                                                <option value="Specialty">Specialty</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-12 col-md-4">
                                                            <p>Market Focus</p>
                                                            <select name="market-focus">
                                                                <option value="{{ isset($data['market-focus']) ? $data['market-focus'] : '' }}" disabled="disabled" selected="selected">
                                                                {{ isset($data['market-focus']) ? $data['market-focus'] : 'Select an option' }}
                                                                </option>
                                                                <option value="Northwest">Northwest</option>
                                                                <option value="Northeast">Northeast</option>
                                                                <option value="Midwest">Midwest</option>
                                                                <option value="Southwest">Southwest</option>
                                                                <option value="Southeast">Southeast</option>
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
                                                            <p>Total Debt</p>
                                                            <input name="total-debt" value="{{ isset($data['total-debt']) ? $data['total-debt'] : '' }}" type="text">
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6">
                                                            <p>Payoff Date</p><input name="payoff-date" value="{{ isset($data['payoff-date']) ? $data['payoff-date'] : '' }}" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="row margin-top-s">
                                                        <div class="col-xs-12 col-sm-6">
                                                            <p>Amortizing</p><input type="radio" value="Amortizing" name="loan-type"
                                                            <?php
                                                                if(isset($data['loan-type']) && $data['loan-type'] === 'Amortizing'){
                                                                    echo 'Checked';
                                                                }
                                                            ?>
                                                            >
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6">
                                                            <p>Interest Only</p><input type="radio" value="Interest Only" name="loan-type"
                                                            <?php
                                                                if(isset($data['loan-type']) && $data['loan-type'] === 'Interest Only'){
                                                                    echo 'Checked';
                                                                }
                                                            ?>
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="row margin-top-m">
                                                        <div class="col-xs-12">
                                                            <h6>Is the Property Developed?</h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-6">
                                                            <p>Yes</p><input type="radio" value="yes" name="developed"
                                                            <?php
                                                                if(isset($data['developed']) && $data['developed'] === 'yes'){
                                                                    echo 'Checked';
                                                                }
                                                            ?>
                                                            >
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6">
                                                            <p>No</p><input type="radio" value="no" name="developed"
                                                            <?php
                                                                if(isset($data['developed']) && $data['developed'] === 'no'){
                                                                    echo 'Checked';
                                                                }
                                                            ?>
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="content-form">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <p class="no-margin-top">Fund Address</p>
                                            <input name="fund-address" value="{{ isset($data['fund-address']) ? $data['fund-address'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <p class="no-margin-top">City</p>
                                            <input name="city" value="{{ isset($data['city']) ? $data['city'] : '' }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <p>State</p>
                                            <input name="state" value="{{ isset($data['state']) ? $data['state'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Zip Code</p>
                                            <input name="zip" value="{{ isset($data['zip']) ? $data['zip'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Country</p>
                                            <input name="country" value="{{ isset($data['country']) ? $data['country'] : '' }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row margin-top-s">
                                    <div class="col-xs-12">
                                            <p>Provide Fund description, strategy and asset type / market focus:</p>
                                            <textarea name="fund-description">{{ isset($data['fund-description']) ? $data['fund-description'] : '' }}</textarea>
                                        </div>
                                        <div class="col-xs-12">
                                            <p>*Please Note: If a fund is Discretionary, expect longer due diligence periods.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="content-footer">
                                <a href="/security-fund-flow/step-1/upload-photos" class="footer-button-back">
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
                </div>
            </div>
        </div>
@endsection
@section('jquery-js')
 <script>
     $(document).ready(function() {
        if (!$("input[name=fund-type]:checked").val()) {
            $(".nowrap").hide();
            $(".yeswrap").hide();
        }
        else {
           if ($("input[name=fund-type]:checked").val() === 'No') {
                $(".nowrap").show();
                $(".yeswrap").hide();
           } else {
                $(".nowrap").hide();
                $(".yeswrap").show();
           }
        }
        $('input[type=radio][name=fund-type]').change(function() {
            if (this.value == 'Yes') {
                $(".nowrap").hide();
                $(".yeswrap").show();
            }
            else if (this.value == 'No') {
                $(".nowrap").show();
                $(".yeswrap").hide();
            }
        });
    });
 </script>
@stop
