@extends('marketplace.mcg-template')
@section('title', $title )

@section('body')
<form>
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
@endif
<input type="hidden" name="updateflow" value="{{isset($data['id']) ? $data['id'] : ''}}"/>
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Preview & Submit</h5></div>
    <div class="card-content">
            <h5>Final Review {{json_encode($data['investment-profile'])}}</h5>
            <p>Please review all the information below and ensure it is correct. To make changes, click the Edit link in the section you wish to change. Hit Submit at the bottom of the page when you are ready to send in your digital security for review.</p>
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
                                        field="companylogo_{{$data['id']}}"
                                        path="/account-settings/company-logo/"
                                        index="0"
                                        section="company_logo"
                                        >
                                    </file-preview>
                                    <uploads-component
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
                                        refresh="true"
                                        section="company_logo"
                                        sectionId="{{$data['id']}}">
                                    </uploads-component>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-8">
                                <div class="presented-description">
                                    <p class="color-white">{{ isset($bio) ? $bio : '' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row center-xs">
                            <div class="col-xs-12 col-sm-4">
                                <a target="_blank" href="https://api-development.norcapsecurities.com/admin_v3/widgetv3_demo?widget=TOPPIPJWCXJGCWLJBIBGZRCVD" class="color-white btn full-width margin-top-m gold">Invest</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card margin-bottom-m">
                <div class="card-title blue has-button">
                    <h5>Digital Security Details</h5>
                    <a href="/security-fund-flow/step-1/upload-photos" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                @if (isset($type) &&  $type === 'property')
                <file-preview
                    iname="Digital Security Photo Gallery"
                    scope="private"
                    user="{{Auth::id()}}"
                    field="digital-security"
                    path="/digital-security/photo-gallery/"
                    section="security-flow-files">
                </file-preview>

                @elseif (isset($type) &&  $type === 'sproperty')
                <file-preview
                    iname="Digital Security Photo Gallery"
                    scope="private"
                    user="{{Auth::id()}}"
                    field="fund-digital-security"
                    path="/digital-security/fund/photo-gallery/"
                    section="security-fund-flow-files">
                </file-preview>
                @else
                <file-preview
                    iname="Digital Security Photo Gallery"
                    scope="private"
                    user="{{Auth::id()}}"
                    field="fund-digital-security"
                    path="/digital-security/fund/photo-gallery/"
                    section="security-fund-flow-files">
                </file-preview>
                @endif
                
                </div>
            </div>
            <div class="card grey margin-bottom-m margin-top-m">
                <div class="card-title blue has-button">
                    <h5>Deal Highlights</h5>
                    <a href="/security-fund-flow/step-1/highlights" class="btn color-white">Edit</a>
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
                                        <input name="property-type" value="{{ isset($data['property-type']) ? $data['property-type'] : '' }}" type="text">
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
            <div class="card grey margin-bttom-m margin-top-m">
                <div class="card-title blue has-button">
                    <h5>Fund Details</h5>
                    <a href="/security-fund-flow/step-1/details" class="btn color-white">Edit</a>
                </div>
                
<div class="card-content">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="content-form">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <p class="no-margin-top">Fund Name</p>
                        @if($errors->has('fund-name'))
                            <br/>
                            <small class="error-small"><em>*</em> <span> {{ $errors->first('fund-name') }} </span></small>
                        @endif
                        <input value="{{ isset($data['fund-name']) ? $data['fund-name'] : '' }}" name="fund-name" type="text">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <p class="no-margin-top margin-top-s-md">Opportunity Type</p>
                        @if($errors->has('opportunity-type'))
                            <br/>
                            <small class="error-small"><em>*</em> <span> {{ $errors->first('opportunity-type') }} </span></small>
                        @endif
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
                        @if($errors->has('type-of-fund'))
                            <br/>
                            <small class="error-small"><em>*</em> <span> {{ $errors->first('type-of-fund') }} </span></small>
                        @endif
                        <select name="type-of-fund">
                            <option value="{{ isset($data['type-of-fund']) ? $data['type-of-fund'] : '' }}" selected="selected">{{ isset($data['type-of-fund']) ? $data['type-of-fund'] : 'Select an option' }}</option>
                            <option value="Closed End">Closed End</option>
                            <option value="Opened End">Opened End</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <p>If Open Eneded, where is the capital from?</p>
                        @if($errors->has('capital-origin'))
                            <br/>
                            <small class="error-small"><em>*</em> <span> {{ $errors->first('capital-origin') }} </span></small>
                        @endif
                        <input type="text" name="capital-origin" value="{{ isset($data['capital-origin']) ? $data['capital-origin'] : '' }}">
                    </div>
                </div>
                <div class="row margin-top-s">
                    <div class="col-xs-12">
                        <p>Is this a Discretionary Fund or a new Fund without existing holdings?</p>
                        @if($errors->has('fund-type'))
                            <br/>
                            <small class="error-small"><em>*</em> <span> {{ $errors->first('fund-type') }} </span></small>
                        @endif
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
                            @if($errors->has('existing-properties'))
                                <br/>
                                <small class="error-small"><em>*</em> <span> {{ $errors->first('existing-properties') }} </span></small>
                            @endif
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
                                        <p>Vacancy Rate</p>
                                        @if($errors->has('vacancy-rate'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('vacancy-rate') }} </span></small>
                                        @endif
                                        <input name="vacancy-rate" value="{{ isset($data['vacancy-rate']) ? $data['vacancy-rate'] : '' }}" type="text">
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <p>Proforma/Current NOI</p>
                                        @if($errors->has('proforma-current-noi'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('proforma-current-noi') }} </span></small>
                                        @endif
                                        <input name="proforma-current-noi" value="{{ isset($data['proforma-current-noi']) ? $data['proforma-current-noi'] : '' }}" type="text">
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <p>Annual Cash Flow</p>
                                        @if($errors->has('annual-cash-flow'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('annual-cash-flow') }} </span></small>
                                        @endif
                                        <input name="annual-cash-flow" value="{{ isset($data['annual-cash-flow']) ? $data['annual-cash-flow'] : '' }}" type="text">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                        <p>1031 Exchange</p>
                                        @if($errors->has('1031-exchange'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('1031-exchange') }} </span></small>
                                        @endif
                                        <input type="text" name="1031-exchange" value="{{ isset($data['1031-exchange']) ? $data['1031-exchange'] : '' }}" placeholder="Y or N?">
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <p>Market Value</p>
                                        @if($errors->has('market-value'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('market-value') }} </span></small>
                                        @endif
                                        <input type="text" name="market-value" value="{{ isset($data['market-value']) ? $data['market-value'] : '' }}">
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <p>Square Footage</p>
                                        @if($errors->has('square-footage'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('square-footage') }} </span></small>
                                        @endif
                                        <input type="text" name="square-footage" value="{{ isset($data['square-footage']) ? $data['square-footage'] : '' }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                        <p>Property Class</p>
                                        @if($errors->has('property-class'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('property-class') }} </span></small>
                                        @endif
                                        <input type="text" name="property-class" placeholder="A, B, orC" value="{{ isset($data['property-class']) ? $data['property-class'] : '' }}">
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <p>Property Type</p>
                                        @if($errors->has('property-type-pledged'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('property-type-pledged') }} </span></small>
                                        @endif
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
                                        @if($errors->has('market-focus'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('market-focus') }} </span></small>
                                        @endif
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
                                        @if($errors->has('total-debt'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('total-debt') }} </span></small>
                                        @endif
                                        <input name="total-debt" value="{{ isset($data['total-debt']) ? $data['total-debt'] : '' }}" type="text">
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <p>Payoff Date</p>
                                        @if($errors->has('payoff-date'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('payoff-date') }} </span></small>
                                        @endif
                                        <input name="payoff-date" value="{{ isset($data['payoff-date']) ? $data['payoff-date'] : '' }}" type="text">
                                    </div>
                                </div>
                                <div class="row margin-top-s">
                                    <div class="col-xs-12 col-sm-6">
                                        <p>Amortizing</p>
                                        <input type="radio" value="Amortizing" name="loan-type"
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
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('developed') }} </span></small>
                                        @endif
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
                        @if($errors->has('fund-address'))
                            <br/>
                            <small class="error-small"><em>*</em> <span> {{ $errors->first('fund-address') }} </span></small>
                        @endif
                        <input name="fund-address" value="{{ isset($data['fund-address']) ? $data['fund-address'] : '' }}" type="text">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <p class="no-margin-top">City</p>
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
                        <p>ZipCode</p>
                        @if($errors->has('zip'))
                            <br/>
                            <small class="error-small"><em>*</em> <span> {{ $errors->first('zip') }} </span></small>
                        @endif
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
                        @if($errors->has('fund-description'))
                            <br/>
                            <small class="error-small"><em>*</em> <span> {{ $errors->first('fund-description') }} </span></small>
                        @endif
                        <textarea name="fund-description">{{ isset($data['fund-description']) ? $data['fund-description'] : '' }}</textarea>
                    </div>
                    <div class="col-xs-12">
                        <p>*Please Note: If a fund is Discretionary, expect longer due diligence periods.</p>
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
                    <a href="/security-fund-flow/step-2/ownership" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <h5>Existing Investor Ownership</h5>
                            <p>Please upload your cap table; our preferred method of data transfer. However, if you have 3 or less investors on your cap table, you may enter their information manually below. </p>
                                @if (isset($type) &&  $type === 'property')
                                <file-preview
                                    iname="file"
                                    scope="private"
                                    user="{{Auth::id()}}"
                                    field="cap-property"
                                    path="/ownership/"
                                    section="security-flow-files">
                                </file-preview>   

                                @elseif (isset($type) &&  $type === 'sproperty')
                                <file-preview
                                    iname="file"
                                    scope="private"
                                    user="{{Auth::id()}}"
                                    field="property-cap"
                                    path="/ownership/"
                                    section="investor-servicing-files">
                                </file-preview>
                                @else
                                <file-preview
                                    iname="file"
                                    scope="private"
                                    user="{{Auth::id()}}"
                                    field="fund-cap-property"
                                    path="/ownership/"
                                    section="security-fund-flow-files">
                                </file-preview>
                                @endif

                            <div class="content-form">
                               
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="content-form">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <p class="no-margin-top">Minimum Raise Amount</p>
                                        @if($errors->has('minimum-raise-amount'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('minimum-raise-amount') }} </span></small>
                                        @endif
                                        <input name="minimum-raise-amount" value="{{ isset($data['minimum-raise-amount']) ? $data['minimum-raise-amount'] : '' }}" type="text">
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <p class="no-margin-top margin-top-s-md">Distribution frequency</p>
                                        @if($errors->has('distribution-frequency'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('distribution-frequency') }} </span></small>
                                        @endif
                                        <select name="distribution-frequency">
                                            <option value="{{ isset($data['distribution-frequency']) ? $data['distribution-frequency'] : '' }}" selected="selected">{{ isset($data['distribution-frequency']) ? $data['distribution-frequency'] : 'Select an option' }}</option>
                                            <option value="Monthly">Monthly</option>
                                            <option value="Quarterly">Quarterly</option>
                                            <option value="Semi-Annually">Semi-Annually</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <p>Maximum Raise Amount</p>
                                        @if($errors->has('maximum-raise-amount'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('maximum-raise-amount') }} </span></small>
                                        @endif
                                        <input name="maximum-raise-amount" value="{{ isset($data['maximum-raise-amount']) ? $data['maximum-raise-amount'] : '' }}" type="text">
                                        <p class="light">*Maximum of 100%</p>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <p>Total Capital Required</p>
                                        @if($errors->has('total-capital-required'))
                                            <br/>
                                            <small class="error-small"><em>*</em> <span> {{ $errors->first('total-capital-required') }} </span></small>
                                        @endif
                                        <input name="total-capital-required" value="{{ isset($data['total-capital-required']) ? $data['total-capital-required'] : '' }}" type="text">
                                        <p class="light">*Total amount of capital that needs to be raised between equity & debt.</p>
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
                    <a href="/security-fund-flow/step-5/capital-stack" class="btn color-white">Edit</a>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="col-sm-6">
                                <pie-chart type="capital stack" data="{{ isset($data) ? json_encode($data) : '' }}"></pie-chart>
                            </div>
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
                        <key-points url="security-fund-flow/step-4/create/keyPoints" data="{{ isset($data['key-points']) ? $data['key-points'] : '' }}" next="no"></key-points>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card grey margin-bottom-m">
                <div class="card-title blue has-button">
                    <h5>Meet the Principles</h5>
                    <a href="/security-fund-flow/step-6/meet-sponsors" class="btn color-white">Edit</a>
                </div>
                <principal-form
                    preview="true"
                    url="/principles/create"
                    data="{{ isset($data['principles']) ? $data['principles'] : '' }}"
                    user="{{Auth::id()}}">
                </principal-form>
            </div>
            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card margin-bottom-m">
                                        <div class="card-title">
                                            <h5>Questions?</h5></div>
                                        <div class="card-content">
                                            <p class="no-margin-top">If you’re ready to pull the trigger on this invetment, you can begin the Investment process below&mdash;or feel free to contact us to set up a call. We’re here to help! </p>
                                            <div class="btn">Contact Us</div>
                                            <a target="_blank" href="https://api-development.norcapsecurities.com/admin_v3/widgetv3_demo?widget=TOPPIPJWCXJGCWLJBIBGZRCVD" class="btn gold margin-left-m color-white">Invest</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
    </div>
</div>

</form>
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