@extends('account-settings.template')
@section('title', $title )

@section('body')
<form action="/account-settings/verification/create" method="post">
@csrf
@if( isset( $success ) && $success )
<popup-component
    title="Thanks for your Submission!"
    type="recurring"
    user="{{ Auth::id() }}"
    info="<h5>Our team will be in touch within 48 hours should we need any thing else from your end.  You’re one step closer to creating your first digital security!</h5>"
    action="Got It!"
    url="/account-settings/bank-account">
</popup-component>
    <temp-clear
        field="companylogo"
        cook="cp1">
    </temp-clear>
@endif
    <div class="card margin-top-m">
        <div class="card-title blue">
            <h5>Account Settings</h5>
        </div>
        <div class="card-content">
            <div class="card grey margin-top-m">
                <div class="card-title dust has-button">
                    <h5>Sponsor Info</h5>
                </div>
                <div class="card-content">
                    <h5>About the Sponsor</h5>
                    <p>Providing the following information now will save time when using other facets of our platform AND help us quickly approve your Sponsor Account.</p>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3">
                                    <uploads-component
                                        title="Upload Sponsor Logo"
                                        action="/files"
                                        elname="image"
                                        scope="private"
                                        field="companylogo"
                                        path="/account-settings/company-logo/"
                                        multi="no"
                                        map="account-verification-files"
                                        type="single"
                                        cook="cp1"
                                        class="small">
                                    </uploads-component>

                                <div class="content-form">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p>Company Name</p>

                                            @if($errors->has('company_name'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('company_name') }} </span></small>
                                            @endif

                                            <input type="text" value="{{ isset($data['company_name']) ? $data['company_name'] : '' }}" name="company_name">
                                        </div>
                                        <div class="col-xs-12">
                                            <p>Company Website</p>

                                            @if($errors->has('company_website'))
                                                <br/>
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('company_website') }} </span></small>
                                            @endif

                                            <input type="text" value="{{ isset($data['company_website']) ? $data['company_website'] : '' }}" name="company_website">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                <div class="content-form fix-verify">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4">
                                                    <p class="no-margin-top">First Name</p>

                                                    @if($errors->has('first_name'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('first_name') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ !empty($data['first_name']) ? $data['first_name'] : !empty($user) ? $user->first_name : '' }}" name="first_name">
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <p class="no-margin-top">Last Name</p>

                                                    @if($errors->has('last_name'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('last_name') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ !empty($data['last_name']) ? $data['last_name'] : !empty($user) ? $user->last_name : '' }}" name="last_name">
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <p class="no-margin-top">Email</p>

                                                    @if($errors->has('email'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('email') }} </span></small>
                                                    @endif

                                                    <input type="email" value="{{ !empty($data['email']) ? $data['email'] : !empty($user) ? $user->email : '' }}" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4">
                                                    <p>Work Phone</p>

                                                    @if($errors->has('work_phone'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('work_phone') }} </span></small>
                                                    @endif
                                                    
                                                    <input type="text" value="{{ isset($data['work_phone']) ? $data['work_phone'] : '' }}" name="work_phone">
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <p>Mobile Phone</p>

                                                    @if($errors->has('mobile'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('mobile') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['mobile']) ? $data['mobile'] : '' }}" name="mobile">
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <p>Job Title</p>

                                                    @if($errors->has('job_title'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('job_title') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['job_title']) ? $data['job_title'] : '' }}" name="job_title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4">
                                                    <p>Company Address</p>
                                                     
                                                    @if($errors->has('company_address'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('company_address') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['company_address']) ? $data['company_address'] : '' }}" name="company_address">
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                    <p>City</p>

                                                    @if($errors->has('city'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('city') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['city']) ? $data['city'] : '' }}" name="city">
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                    <p>State</p>

                                                    @if($errors->has('state'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('state') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['state']) ? $data['state'] : '' }}" name="state">
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <p>Sponsor EIN/TIN</p>

                                                    @if($errors->has('tin'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('tin') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['tin']) ? $data['tin'] : '' }}" name="tin">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4">
                                                    <p>Company Address</p>

                                                    @if($errors->has('company_address_2'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('company_address_2') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['company_address_2']) ? $data['company_address_2'] : '' }}" name="company_address_2">
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <p>ZIP Code</p>

                                                    @if($errors->has('zip'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('zip') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['zip']) ? $data['zip'] : '' }}" name="zip">
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <p>Country</p>

                                                    @if($errors->has('country'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('country') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['country']) ? $data['country'] : '' }}" name="country">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card grey margin-top-m">
                <div class="card-title dust has-button">
                    <h5>Sponsor Bio</h5>
                </div>
                <div class="card-content">
                    <h5>About the Sponsor</h5>
                    <p>Connect your Sponsor Bio now and this information can automatically be connected to the digital securities you create for Abstract’s Marketplace. Investors will look at your Sponsor Bio to learn more about your company’s history.</p>
                    <div class="card-content">
                        <div class="row center-xs">
                            <div class="col-xs-12 col-md-8">
                                <h5>Sponsor Bio</h5>
                                <p>Reassure potential investors with an in-depth bio describing your past successes, milestones and relavent statistics.</p>
                                <textarea name="bio">{{ isset($data['bio']) ? $data['bio'] : '' }}</textarea>
                                <div class="content-form-row">
                                    <div class="row middle-xs">
                                        <div class="col-xs-12 col-sm-8">
                                            <p>Total Portfolio Activity Amount:</p>

                                            @if($errors->has('portfolio_activity_amount'))
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('portfolio_activity_amount') }} </span></small>
                                            @endif

                                        </div>
                                        <div class="col-xs-12 col-sm-4"><input type="text" value="{{ isset($data['portfolio_activity_amount']) ? $data['portfolio_activity_amount'] : '' }}" name="portfolio_activity_amount" placeholder="$1,000,000"></div>
                                    </div>
                                    <div class="row middle-xs">
                                        <div class="col-xs-12 col-sm-8">
                                            <p>Total Assets Under Management:</p>

                                            @if($errors->has('assets_under_management'))
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('assets_under_management') }} </span></small>
                                            @endif
                                            
                                        </div>
                                        <div class="col-xs-12 col-sm-4"><input type="text" value="{{ isset($data['assets_under_management']) ? $data['assets_under_management'] : '' }}" name="assets_under_management" placeholder="$5,000,000"></div>
                                    </div>
                                    <div class="row middle-xs">
                                        <div class="col-xs-12 col-sm-8">
                                            <p>Total Square Feet Managed:</p>

                                            @if($errors->has('square_feet_managed'))
                                                <small class="error-small"><em>*</em> <span> {{ $errors->first('square_feet_managed') }} </span></small>
                                            @endif

                                        </div>
                                        <div class="col-xs-12 col-sm-4"><input type="text" value="{{ isset($data['square_feet_managed']) ? $data['square_feet_managed'] : '' }}" name="square_feet_managed" placeholder="50,000 sq. ft."></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card grey margin-top-m">
                <div class="card-title dust has-button">
                    <h5>Meet the Principals, Property Owners or Fund Managers</h5>
                </div>
                <div class="card-content">
                    <h5>Meet The Principals, Property Owners, and Fund Managers</h5>
                    <p>Connect any Principals or Partners to your organization.  These will be shared to investors interested in your deals on Abstract’s Marketplace. </p>
                    <principal-form
                        back="/account-settings/verification/bio"   
                        url="/account-settings/verification/references"
                        data="{{ isset($data['principles']) ? $data['principles'] : '' }}"
                        user="{{ Auth::id() }}"
                        type="account settings"
                        map="account-verification-files">
                    </principal-form>
                </div>
            </div>
            <div class="card grey margin-top-m">
                <div class="card-title dust has-button">
                    <h5>Professional References</h5>
                </div>
                <div class="card-content">
                    <h5>Professional References </h5>
                    <p>We will need 4 references from your team. (1) Commercial Mortgage Broker, (2) Bank References, and (1) CRE Broker. </p>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="content-form">
                                    <div class="row">
                                        <!-------
                                            -------------- Reference 1 -------------
                                        -------->
                                        <div class="col-xs-12 col-sm-12 margin-bottom-m-sm">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Reference Type</p>

                                                    @if($errors->has('reference_type_1'))
                                                        <small class="error-small"><em>*</em> <span> Please select an option </span></small>
                                                    @endif

                                                    <select name="reference_type_1">

                                                        <!-- default select value -->
                                                        <option value="{{ isset($data['reference_type_1']) ? $data['reference_type_1'] : '' }}" selected="selected">
                                                            @if(isset($data['reference_type_1']))

                                                            @switch($data['reference_type_1'])
                                                                @case('cre')
                                                                        CRE Broker
                                                                    @break

                                                                @case('cmb')
                                                                    Commercial Mortgage Broker
                                                                    @break

                                                                @case('bank')
                                                                        Bank Reference
                                                                    @break

                                                                @default

                                                            @endswitch

                                                            @else
                                                                Select an option
                                                            @endif
                                                        </option>


                                                        <option value="cmb">Commercial Mortgage Broker</option>
                                                        <option value="cre">CRE Broker</option>
                                                        <option value="bank">Bank Reference</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Full Name</p>

                                                    @if($errors->has('reference_name_1'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> This field is required </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_name_1']) ? $data['reference_name_1'] : '' }}" placeholder="Jane Doe" name="reference_name_1">
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Phone Number</p>

                                                    @if($errors->has('reference_phone_1'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('reference_phone_1') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_phone_1']) ? $data['reference_phone_1'] : '' }}" placeholder="202-555-0176" name="reference_phone_1">
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Email</p>

                                                    @if($errors->has('reference_email_1'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('reference_email_1') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_email_1']) ? $data['reference_email_1'] : '' }}" placeholder="jane@abstract.com" name="reference_email_1">
                                                </div>
                                            </div>
                                        </div>

                                        <!-------
                                            -------------- Reference 2 -------------
                                        -------->

                                        <div class="col-xs-12 col-sm-12 margin-bottom-m-sm">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Reference Type</p>

                                                    @if($errors->has('reference_type_2'))
                                                        <small class="error-small"><em>*</em> <span> Please select an option </span></small>
                                                    @endif

                                                    <select name="reference_type_2">

                                                        <!-- default select value -->
                                                        <option value="{{ isset($data['reference_type_2']) ? $data['reference_type_2'] : '' }}" selected="selected">
                                                            @if(isset($data['reference_type_2']))

                                                            @switch($data['reference_type_2'])
                                                                @case('cre')
                                                                        CRE Broker
                                                                    @break

                                                                @case('cmb')
                                                                    Commercial Mortgage Broker
                                                                    @break

                                                                @case('bank')
                                                                        Bank Reference
                                                                    @break

                                                                @default

                                                            @endswitch

                                                            @else
                                                                Select an option
                                                            @endif
                                                        </option>

                                                        <option value="cmb">Commercial Mortgage Broker</option>
                                                        <option value="cre">CRE Broker</option>
                                                        <option value="bank">Bank Reference</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Full Name</p>

                                                    @if($errors->has('reference_name_2'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> This field is required </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_name_2']) ? $data['reference_name_2'] : '' }}" placeholder="John Doe" name="reference_name_2">
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Phone Number</p>

                                                    @if($errors->has('reference_phone_2'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('reference_phone_2') }} </span></small>
                                                    @endif


                                                    <input type="text" value="{{ isset($data['reference_phone_2']) ? $data['reference_phone_2'] : '' }}" placeholder="202-555-0176" name="reference_phone_2">
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Email</p>

                                                    @if($errors->has('reference_email_2'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('reference_email_2') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_email_2']) ? $data['reference_email_2'] : '' }}" placeholder="john@abstract.com" name="reference_email_2">
                                                </div>
                                            </div>
                                        </div>

                                        <!-------
                                            -------------- Reference 3 -------------
                                        -------->

                                        <div class="col-xs-12 col-sm-12 margin-bottom-m-sm">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Reference Type</p>

                                                    @if($errors->has('reference_type_3'))
                                                        <small class="error-small"><em>*</em> <span> Please select an option </span></small>
                                                    @endif


                                                    <select name="reference_type_3">

                                                        <!-- default select value -->
                                                        <option value="{{ isset($data['reference_type_3']) ? $data['reference_type_3'] : '' }}" selected="selected">
                                                            @if(isset($data['reference_type_3']))

                                                            @switch($data['reference_type_3'])
                                                                @case('cre')
                                                                        CRE Broker
                                                                    @break

                                                                @case('cmb')
                                                                    Commercial Mortgage Broker
                                                                    @break

                                                                @case('bank')
                                                                        Bank Reference
                                                                    @break

                                                                @default

                                                            @endswitch

                                                            @else
                                                                Select an option
                                                            @endif
                                                        </option>

                                                        <option value="cmb">Commercial Mortgage Broker</option>
                                                        <option value="cre">CRE Broker</option>
                                                        <option value="bank">Bank Reference</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Full Name</p>

                                                    @if($errors->has('reference_name_3'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> This field is required </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_name_3']) ? $data['reference_name_3'] : '' }}" placeholder="Jane Doe" name="reference_name_3">
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Phone Number</p>

                                                    @if($errors->has('reference_phone_3'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('reference_phone_3') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_phone_3']) ? $data['reference_phone_3'] : '' }}" placeholder="202-555-0176" name="reference_phone_3">
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Email</p>

                                                    @if($errors->has('reference_email_3'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('reference_email_3') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_email_3']) ? $data['reference_email_3'] : '' }}" placeholder="jane@abstract.com" name="reference_email_3">
                                                </div>
                                            </div>
                                        </div>

                                        <!-------
                                            -------------- Reference 4 -------------
                                        -------->

                                        <div class="col-xs-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Reference Type</p>

                                                    @if($errors->has('reference_type_4'))
                                                        <small class="error-small"><em>*</em> <span> Please select an option </span></small>
                                                    @endif

                                                    <select name="reference_type_4">

                                                        <!-- default select value -->
                                                        <!-- default select value -->
                                                        <option value="{{ isset($data['reference_type_4']) ? $data['reference_type_4'] : '' }}" selected="selected">
                                                            @if(isset($data['reference_type_4']))

                                                            @switch($data['reference_type_4'])
                                                                @case('cre')
                                                                        CRE Broker
                                                                    @break

                                                                @case('cmb')
                                                                    Commercial Mortgage Broker
                                                                    @break

                                                                @case('bank')
                                                                        Bank Reference
                                                                    @break

                                                                @default

                                                            @endswitch

                                                            @else
                                                                Select an option
                                                            @endif
                                                        </option>

                                                        <option value="cmb">Commercial Mortgage Broker</option>
                                                        <option value="cre">CRE Broker</option>
                                                        <option value="bank">Bank Reference</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Full Name</p>

                                                    @if($errors->has('reference_name_4'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> This field is required </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_name_4']) ? $data['reference_name_4'] : '' }}" placeholder="John Doe" name="reference_name_4">
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Phone Number</p>

                                                    @if($errors->has('reference_phone_4'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('reference_phone_4') }} </span></small>
                                                    @endif

                                                    <input type="text" value="{{ isset($data['reference_phone_4']) ? $data['reference_phone_4'] : '' }}" placeholder="202-555-0176" name="reference_phone_4">
                                                </div>
                                                <div class="col-xs-12 col-sm-3">
                                                    <p>Email</p>

                                                    @if($errors->has('reference_email_4'))
                                                        <br/>
                                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('reference_email_4') }} </span></small>
                                                    @endif
                                            
                                                    <input type="text" value="{{ isset($data['reference_email_4']) ? $data['reference_email_4'] : '' }}" placeholder="john@abstract.com" name="reference_email_4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card grey margin-top-m">
                <div class="card-title dust">
                    <h5>Sponsor Diligence</h5>
                </div>
                <div class="card-content">
                    <h5>Sponsor Diligence with Ease</h5>
                    <p>Abstract ensures that our marketplace consists only of institutional grade, high quality properties, funds and Sponsors. Providing the following diligence will help us quickly qualify you. We’re powered by Box.com to ensure top level security and a succinct diligence hand off between our team and yours. Simply drag and drop the specific DD files into their individual folders below.</p>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card">
                                    <!--
                                    <div class="card-title">
                                        <div class="breadcome">
                                            <p>All Files <img src="/img/icon-arrow-right.svg"> {{ !empty($company) ? $company->company_name : '' }} Diligence Documents </p>
                                        </div>
                                    </div>
                                    -->
                                    <div class="card-content">
                                        <!-- todo fix company name in session -->
                                    <box-component
                                        user="{{ Auth::id() }}"
                                        owner="{{ !empty($company) ? $company->company_name : '' }}"
                                        struc="diligence">
                                    </box-component>
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
                        <div class="text-center">
                            <input class="btn" type="submit" value="Finish">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
