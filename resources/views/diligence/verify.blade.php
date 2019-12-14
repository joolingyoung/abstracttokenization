@extends('diligence.template')
@section('title', $title )
<style>
.fix-verify{
    margin-top:21px;
}
</style>
@section('body')
<form action="/diligence/verification/create" method="post">
@csrf
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Account Verification</h5>
    </div>
    <div class="card-content">
        <h5>About the Sponsor</h5>
        <p>Providing the following information now will save time when using other facets of our platform AND help us quickly approve your Sponsor Account.</p>
        <div class="card grey margin-top-m">
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
                                class="small"
                                >
                            </uploads-component>

                        <div class="content-form">
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Company Name</p>
                                    <input type="text" value="{{ isset($user['company_name']) ? $user['company_name'] : '' }}" name="company_name">
                                </div>
                                <div class="col-xs-12">
                                    <p>Company Website</p>
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
                                            <input type="text" value="{{ !empty($data['first_name']) ? $data['first_name'] : !empty($user) ? $user->first_name : '' }}" name="first_name">
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <p class="no-margin-top">Last Name</p>
                                            <input type="text" value="{{ !empty($data['last_name']) ? $data['last_name'] : !empty($user) ? $user->last_name : '' }}" name="last_name">
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <p class="no-margin-top">Email</p>
                                            <input type="email" value="{{ !empty($data['email']) ? $data['email'] : !empty($user) ? $user->email : '' }}" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4">
                                            <p>Work Phone</p>
                                            <input type="text" value="{{ isset($data['work_phone']) ? $data['work_phone'] : '' }}" name="work_phone">
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <p>Mobile Phone</p>
                                            <input type="text" value="{{ isset($data['mobile']) ? $data['mobile'] : '' }}" name="mobile">
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <p>Job Title</p>
                                            <input type="text" value="{{ isset($data['job_title']) ? $data['job_title'] : '' }}" name="job_title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4">
                                            <p>Company Address</p>
                                            <input type="text" value="{{ isset($data['company_address']) ? $data['company_address'] : '' }}" name="company_address">
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <p>City</p>
                                            <input type="text" value="{{ isset($data['city']) ? $data['city'] : '' }}" name="city">
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <p>State</p>
                                            <input type="text" value="{{ isset($data['state']) ? $data['state'] : '' }}" name="state">
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <p>Sponsor EIN/TIN</p>
                                            <input type="text" value="{{ isset($data['tin']) ? $data['tin'] : '' }}" name="tin">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4">
                                            <p>ZIP Code</p>
                                            <input type="text" value="{{ isset($data['zip']) ? $data['zip'] : '' }}" name="zip">
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <p>Country</p>
                                            <input type="text" value="{{ isset($data['country']) ? $data['country'] : '' }}" name="country">
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
