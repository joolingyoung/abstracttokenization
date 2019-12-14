@extends('security-flow.template')
@section('title', $title )

@section('body')
<form action="/security-flow/step-7/create/preview" method="post">
@csrf
@if( isset( $success ) && $success )
    <popup-component
        title="Thanks for your Submission!"
        type="recurring"
        user="{{ Auth::id() }}"
        info="<h5>Our team will be in touch within 48 hours should we need anything. You’re one step closer to creating your first digital security!</h5>"
        action="Got It!"
        url="/properties/approved">
    </popup-component>
    <temp-clear
        field="digital-security"
        cook="up1,up2,up3,up4,up5">
    </temp-clear>
@endif
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Preview & Submit</h5></div>
    <div class="card-content">
            <h5>Final Review</h5>
            <p>Please review and ensure all information provided it is correct. To make changes, click the Edit link in the section you wish to change. Hit Submit at the bottom of the page when you are ready to send in your digital security for review.</p>
            <div class="card grey margin-bottom-m">
                <div class="card-title blue has-button">
                    <h5>Presented By:</h5>
                    <a href="/account-settings/verification/bio" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                    <div class="card equal-padding">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <div class="presented-company">
                                    <file-preview
                                        iname="Single"
                                        scope="private"
                                        user="{{Auth::id()}}"
                                        field="companylogo"
                                        path="/account-settings/company-logo/"
                                        index="0"
                                        section="account-verification-files">
                                    </file-preview>
                                    <!-- <uploads-component
                                        class="button-edit"
                                        title="Change Logo"
                                        action="/files"
                                        elname="image"
                                        scope="private"
                                        field="companylogo"
                                        path="/account-settings/company-logo/"
                                        multi="no"
                                        flat="true"
                                        type="text"
                                        refresh="true">
                                    </uploads-component> -->
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-8">
                                <div class="presented-description">
                                    <p>{{ isset($bio) ? $bio : '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card margin-bottom-m">
                <div class="card-title blue has-button">
                    <h5>Digital Security Details</h5>
                    <a href="/security-flow/step-1/choose" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                    <file-preview
                        iname="Digital Security Photo Gallery"
                        scope="private"
                        user="{{Auth::id()}}"
                        field="digital-security"
                        path="/digital-security/photo-gallery/"
                        section="security-flow-files">
                    </file-preview>
                </div>
            </div>
            <div class="card grey margin-bottom-m margin-top-m">
                <div class="card-title blue has-button">
                    <h5>Deal Highlights</h5>
                    <a href="/security-flow/step-1/highlights" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                            <div class="row">
                                <div class="col-xs-12 col-md-3 margin-bottom-l-md">
                                    <div class="content-form">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <p>Target Investor IRR</p>
                                                @if($errors->has('target-investor-irr'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('target-investor-irr') }} </span></small>
                                                @endif
                                                <input type="text" name="target-investor-irr" value="{{ isset($data['target-investor-irr']) ? $data['target-investor-irr'] : '' }}">
                                            </div>
                                            <div class="col-xs-12">
                                                <p>Investment Profile</p>
                                                @if($errors->has('investment-profile'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('investment-profile') }} </span></small>
                                                @endif
                                                <input type="text" name="investment-profile" value="{{ isset($data['investment-profile']) ? $data['investment-profile'] : '' }}">
                                            </div>
                                            <div class="col-xs-12">
                                                <p>Funds Due</p>
                                                @if($errors->has('funds-due'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('funds-due') }} </span></small>
                                                @endif
                                                <input type="text" name="funds-due" value="{{ isset($data['funds-due']) ? $data['funds-due'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3 margin-bottom-l-md">
                                    <div class="content-form">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <p>Target Equity Multiple</p>
                                                @if($errors->has('target-equity-multiple'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('target-equity-multiple') }} </span></small>
                                                @endif
                                                <input type="text" name="target-equity-multiple" value="{{ isset($data['target-equity-multiple']) ? $data['target-equity-multiple'] : '' }}">
                                            </div>
                                            <div class="col-xs-12">
                                                <p>Minimum Investment</p>
                                                @if($errors->has('minimum-investment'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('minimum-investment') }} </span></small>
                                                @endif
                                                <input name="minimum-investment" type="text" value="{{ isset($data['minimum-investment']) ? $data['minimum-investment'] : '' }}">
                                            </div>
                                            <div class="col-xs-12">
                                                <p>Distribution Period</p>
                                                @if($errors->has('distribution-period'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('distribution-period') }} </span></small>
                                                @endif
                                                <input name="distribution-period" type="text" value="{{ isset($data['distribution-period']) ? $data['distribution-period'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3 margin-bottom-l-md">
                                    <div class="content-form">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <p>Target Investment Period</p>
                                                @if($errors->has('target-investment-period'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('target-investment-period') }} </span></small>
                                                @endif
                                                <input name="target-investment-period" type="text" value="{{ isset($data['target-investment-period']) ? $data['target-investment-period'] : '' }}">
                                            </div>
                                            <div class="col-xs-12">
                                                <p>Property Type</p>
                                                @if($errors->has('property-type'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('property-type') }} </span></small>
                                                @endif
                                                <input value="{{ isset($data['property-type']) ? $data['property-type'] : '' }}" name="property-type" type="text">
                                            </div>
                                            <div class="col-xs-12">
                                                <p>Sponsor Co-Investment</p>
                                                @if($errors->has('sponsor-co-investment'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('sponsor-co-investment') }} </span></small>
                                                @endif
                                                <input name="sponsor-co-investment" value="{{ isset($data['sponsor-co-investment']) ? $data['sponsor-co-investment'] : '' }}" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <div class="content-form">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <p>Target Avg Investor Cash Yield</p>
                                                @if($errors->has('target-avg-investor-cash-yield'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('target-avg-investor-cash-yield') }} </span></small>
                                                @endif
                                                <input name="target-avg-investor-cash-yield" type="text" value="{{ isset($data['target-avg-investor-cash-yield']) ? $data['target-avg-investor-cash-yield'] : '' }}">
                                            </div>
                                            <div class="col-xs-12">
                                                <p>Offers Due</p>
                                                @if($errors->has('offers-due'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('offers-due') }} </span></small>
                                                @endif
                                                <input name="offers-due" type="text" value="{{ isset($data['offers-due']) ? $data['offers-due'] : '' }}">
                                            </div>
                                            <div class="col-xs-12">
                                                <p>Distribution Commencement</p>
                                                @if($errors->has('distribution-commencement'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('distribution-commencement') }} </span></small>
                                                @endif
                                                <input name="distribution-commencement" type="text" value="{{ isset($data['distribution-commencement']) ? $data['distribution-commencement'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card grey margin-bttom-m margin-top-m">
                <div class="card-title blue has-button">
                    <h5>Property Details</h5>
                    <a href="/security-flow/step-1/details" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="content-form">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-7">
                                            <p class="no-margin-top">Property / Opportunity Name</p>
                                            @if($errors->has('property'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('property') }} </span></small>
                                            @endif
                                            <input value="{{ isset($data['property']) ? $data['property'] : '' }}" name="property" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-5">
                                            <p class="no-margin-top margin-top-s-md">Opportunity Type</p>
                                            @if($errors->has('opportunity_type'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('opportunity_type') }} </span></small>
                                            @endif
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
                                            @if($errors->has('opportunity_description'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('opportunity_description') }} </span></small>
                                            @endif
                                            <textarea name="opportunity_description">{{ isset($data['opportunity_description']) ? $data['opportunity_description'] : '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Property Address</p>
                                            @if($errors->has('property_address'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('property_address') }} </span></small>
                                            @endif
                                            <input value="{{ isset($data['property_address']) ? $data['property_address'] : '' }}" name="property_address" type="text">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>City</p>
                                            @if($errors->has('city'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('city') }} </span></small>
                                            @endif
                                            <input name="city" value="{{ isset($data['city']) ? $data['city'] : '' }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <p>State</p>
                                            @if($errors->has('state'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('state') }} </span></small>
                                            @endif
                                            <input name="state" value="{{ isset($data['state']) ? $data['state'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Zip Code</p>
                                            @if($errors->has('zip'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('zip') }} </span></small>
                                            @endif
                                            <input name="zip" value="{{ isset($data['zip']) ? $data['zip'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Country</p>
                                            @if($errors->has('country'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('country') }} </span></small>
                                            @endif
                                            <input name="country" value="{{ isset($data['country']) ? $data['country'] : '' }}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="content-form">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <p class="no-margin-top">Vacancy Rate</p>
                                            @if($errors->has('vacancy_rate'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('vacancy_rate') }} </span></small>
                                            @endif
                                            <input name="vacancy_rate" value="{{ isset($data['vacancy_rate']) ? $data['vacancy_rate'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p class="no-margin-top">Current NOI</p>
                                            @if($errors->has('current_noi'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('current_noi') }} </span></small>
                                            @endif
                                            <input name="current_noi" value="{{ isset($data['current_noi']) ? $data['current_noi'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p class="no-margin-top">Annual Cash Flow</p>
                                            @if($errors->has('annual_cash_flow'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('annual_cash_flow') }} </span></small>
                                            @endif
                                            <input name="annual_cash_flow" value="{{ isset($data['annual_cash_flow']) ? $data['annual_cash_flow'] : '' }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <p>1031 Exchange</p>
                                            @if($errors->has('1031_exchange'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('1031_exchange') }} </span></small>
                                            @endif
                                            <input type="text" name="1031_exchange" placeholder="Y or N?" value="{{ isset($data['1031_exchange']) ? $data['1031_exchange'] : '' }}">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Market Value</p>
                                            @if($errors->has('market_value'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('market_value') }} </span></small>
                                            @endif
                                            <input name="market_value" type="text" value="{{ isset($data['market_value']) ? $data['market_value'] : '' }}">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Square Footage</p>
                                            @if($errors->has('square_footage'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('square_footage') }} </span></small>
                                            @endif
                                            <input name="square_footage" type="text" value="{{ isset($data['square_footage']) ? $data['square_footage'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-4">
                                            <p>Property Class</p>
                                            @if($errors->has('property_class'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('property_class') }} </span></small>
                                            @endif
                                            <input type="text" name="property_class" placeholder="A, B or C" value="{{ isset($data['property_class']) ? $data['property_class'] : '' }}">
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
                                            @if($errors->has('total_debt'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('total_debt') }} </span></small>
                                            @endif
                                            <input name="total_debt" value="{{ isset($data['total_debt']) ? $data['total_debt'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Payoff Date</p>
                                            @if($errors->has('payoff_date'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('payoff_date') }} </span></small>
                                            @endif
                                            <input name="payoff_date" value="{{ isset($data['payoff_date']) ? $data['payoff_date'] : '' }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row margin-top-s">
                                        <div class="col-xs-12 col-sm-6">
                                            <p>Amortizing</p>
                                            <input type="radio"
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
                                        <div class="col-xs-12 col-sm-12">

                                            @if($errors->has('loan-type'))
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('loan-type') }} </span></small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row margin-top-m">
                                        <div class="col-xs-12">
                                            <h6>Is the Property Developed?</h6>
                                            @if($errors->has('developed'))
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('developed') }} </span></small>
                                            @endif
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
                </div>
            </div>
            <div class="card grey margin-bttom-m margin-top-m">
                <div class="card-title blue has-button">
                    <h5>Investment Details</h5>
                    <a href="/security-flow/step-2/ownership" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <h5>Existing Investor Ownership</h5>
                                <p>Please upload your cap table; our preferred method of data transfer. However, if you have 3 or less investors on your cap table, you may enter their information mannually below. </p>
                                <file-preview
                                    iname="file"
                                    scope="private"
                                    user="{{Auth::id()}}"
                                    field="cap-property"
                                    path="/ownership/"
                                    section="security-flow-files">
                                </file-preview>
                                <div class="content-form">
                                    <!--<div class="row margin-bottom-l-md">
                                        <div class="col-xs-12 col-md-4">
                                            <p>Investor First Name</p>
                                            @if($errors->has('investor-first-name'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('investor-first-name') }} </span></small>
                                            @endif
                                            <input value="{{ isset($data['investor-first-name']) ? $data['investor-first-name'] : '' }}" name="investor-first-name" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Investor Last Name</p>
                                            @if($errors->has('investor-last-name'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('investor-last-name') }} </span></small>
                                            @endif
                                            <input name="investor-last-name" value="{{ isset($data['investor-last-name']) ? $data['investor-last-name'] : '' }}" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>% Ownership</p>
                                            @if($errors->has('ownership'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('ownership') }} </span></small>
                                            @endif
                                            <input type="text" value="{{ isset($data['ownership']) ? $data['ownership'] : '' }}" name="ownership">
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-l-md">
                                        <div class="col-xs-12 col-md-4">
                                            <p>Investor First Name</p>
                                            @if($errors->has('investor-first-name-1'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('investor-first-name-1') }} </span></small>
                                            @endif
                                            <input value="{{ isset($data['investor-first-name-1']) ? $data['investor-first-name-1'] : '' }}" type="text" name="investor-first-name-1">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Investor Last Name</p>
                                            @if($errors->has('investor-last-name-1'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('investor-last-name-1') }} </span></small>
                                            @endif
                                            <input type="text" value="{{ isset($data['investor-last-name-1']) ? $data['investor-last-name-1'] : '' }}" name="investor-last-name-1">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>% Ownership</p>
                                            @if($errors->has('ownership-1'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('ownership-1') }} </span></small>
                                            @endif
                                            <input type="text" value="{{ isset($data['ownership-1']) ? $data['ownership-1'] : '' }}" name="ownership-1">
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-l-sm">
                                        <div class="col-xs-12 col-md-4">
                                            <p>Investor First Name</p>
                                            @if($errors->has('investor-first-name-2'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('investor-first-name-2') }} </span></small>
                                            @endif
                                            <input type="text" value="{{ isset($data['investor-first-name-2']) ? $data['investor-first-name-2'] : '' }}" name="investor-first-name-2">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>Investor Last Name</p>
                                            @if($errors->has('investor-last-name-2'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('investor-last-name-2') }} </span></small>
                                            @endif
                                            <input type="text" value="{{ isset($data['investor-last-name-2']) ? $data['investor-last-name-2'] : '' }}" name="investor-last-name-2">
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <p>% Ownership</p>
                                            @if($errors->has('ownership-2'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('ownership-2') }} </span></small>
                                            @endif
                                            <input type="text" value="{{ isset($data['ownership-2']) ? $data['ownership-2'] : '' }}" name="ownership-2">
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="content-form">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <p class="no-margin-top">Pro forma NOI</p>
                                            @if($errors->has('pro-frorma-noi'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('pro-frorma-noi') }} </span></small>
                                            @endif
                                            <input value="{{ isset($data['pro-frorma-noi']) ? $data['pro-frorma-noi'] : '' }}" name="pro-frorma-noi" type="text">
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <p class="no-margin-top margin-top-s-md">Distribution frequency</p>
                                            @if($errors->has('distribution-frequency'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('distribution-frequency') }} </span></small>
                                            @endif
                                            <select name="distribution-frequency">
                                                <option value="{{ isset($data['distribution-frequency']) ? $data['distribution-frequency'] : '' }}" selected="selected">
                                                {{ isset($data['distribution-frequency']) ? $data['distribution-frequency'] : 'Select an option' }}</option>
                                                <option value="Monthly">Monthly </option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Semi-Annually">Semi-Annually</option>
                                                <option value="Annually">Annually</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <p>Equity Raise Floor Amount</p>
                                            @if($errors->has('equity-raise-floor-amount'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('equity-raise-floor-amount') }} </span></small>
                                            @endif
                                            <input type="text" name="equity-raise-floor-amount" value="{{ isset($data['equity-raise-floor-amount']) ? $data['equity-raise-floor-amount'] : '' }}">
                                            <p class="light">*Required Minimum of 25% of Total Capital Structure.</p>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <p>Total Capital Required</p>
                                            @if($errors->has('total-capital-required'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('total-capital-required') }} </span></small>
                                            @endif
                                            <input type="text" name="total-capital-required" value="{{ isset($data['total-capital-required']) ? $data['total-capital-required'] : '' }}">
                                            <p class="light">*Total amount of capital that needs to be raised incl. equity & debt.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <p>Equity Raise Hard Cap</p>
                                            @if($errors->has('equity-raise-hard-cap'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('equity-raise-hard-cap') }} </span></small>
                                            @endif
                                            <input type="text" value="{{ isset($data['equity-raise-hard-cap']) ? $data['equity-raise-hard-cap'] : '' }}" name="equity-raise-hard-cap">
                                            <p class="light">*Maximum of 100%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            </div>
            <div class="card grey margin-bottom-m">
                <div class="card-title blue has-button">
                    <h5>Diligence & Deal Documents</h5>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="breadcrumb">
                                <p>All Files <img src="/img/icon-arrow-right.svg"> {{ !empty($company) ? $company->company_name : '' }} Diligence & Deal Documents</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <input type="search">
                        </div>
                    </div>
                    <div class="row">
                        <box-component
                            user="{{ Auth::id() }}"
                            owner="{{ !empty($company) ? $company->company_name : '' }}"
                            struc="diligence">
                        </box-component>
                    </div>
                </div>
            </div>
            <div class="card grey margin-bottom-m">
                <div class="card-title blue has-button">
                    <h5>Capital Stack</h5>
                    <a href="/security-flow/step-5/capital-stack" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <pie-chart type="capital stack" data="{{ isset($data) ? json_encode($data) : '' }}"></pie-chart>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="content-form">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <p class="no-margin-top">Preferred Equity</p>
                                                @if($errors->has('preferred-equity'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('preferred-equity') }} </span></small>
                                                @endif
                                                <input name="preferred-equity" value="{{ isset($data['preferred-equity']) ? $data['preferred-equity'] : '' }}" type="text">
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <p class="no-margin-top margin-top-s-sm">Common Equity</p>
                                                @if($errors->has('common-equity'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('common-equity') }} </span></small>
                                                @endif
                                                <input name="common-equity" value="{{ isset($data['common-equity']) ? $data['common-equity'] : '' }}" type="text">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <p>Mezzanine Debt</p>
                                                @if($errors->has('mezzanine-debt'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('mezzanine-debt') }} </span></small>
                                                @endif
                                                <input name="mezzanine-debt" value="{{ isset($data['mezzanine-debt']) ? $data['mezzanine-debt'] : '' }}" type="text">
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <p>Senior Debt</p>
                                                @if($errors->has('senior-debt'))
                                                    <br/>
                                                    <small class="error-small"><em>*</em> <span> {{ $errors->first('senior-debt') }} </span></small>
                                                @endif
                                                <input name="senior-debt" value="{{ isset($data['senior-debt']) ? $data['senior-debt'] : '' }}" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card grey margin-bottom-m">
                <div class="card-title blue has-button">
                    <h5>Key Deal Points</h5>
                </div>
                <div class="card-content">
                    @if($errors->has('key-point'))
                        <br/>
                        <small class="error-small"><em>*</em> <span> {{ $errors->first('key-point') }} </span></small>
                    @endif
                    <div class="row">
                        <div class="col-xs-12">
                            <key-points url="security-flow/step-4/create/keyPoints" data="{{ isset($data['key-points']) ? $data['key-points'] : '' }}" next="no"></key-points>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card grey margin-bottom-m">
                <div class="card-title blue has-button">
                    <h5>Meet the Principals</h5>
                    <a href="/security-flow/step-6/meet-sponsors" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                    <div class="card">
                        <div class="card-content">
                            <principal-form
                                preview="true"
                                url="/principles/create"
                                data="{{ isset($data['principles']) ? $data['principles'] : '' }}"
                                user="{{Auth::id()}}"
                                map="security-flow-files">
                            </principal-form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="card margin-bottom-m">
                        <div class="card-title">
                            <h5>Edit or Submit</h5></div>
                        <div class="card-content">
                            <p class="no-margin-top">Once you submit your digital security diligence, you will receive an email from our team confirming receipt. Our diligence team will be in touch via email within 2-3 days to let you know if you’re digital security is ready to complete. Congrats!</p>
                            <input type="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

</form>
@endsection
