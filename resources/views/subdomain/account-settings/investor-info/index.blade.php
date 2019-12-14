@extends('subdomain.account-settings.main-template')
@section('title', "Investor Information > Investor Servicing")
<style>
.prop-new .content-footer{
    margin:50px 0;
}
</style>
@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Investor Information</h5></div>
    <div class="card-content">
        <form>
            <h5>Your Investor Account Info</h5>
            <p>Please update any information below as needed. Please double check your Email address to ensure everything is being sent to the correct address..</p>
            <div class="content-form">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <p>First Name</p>
                        <input type="text">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p>Last Name</p>
                        <input type="text">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p>Email</p>
                        <input type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <p>Work Phone</p>
                        <input type="text">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p>Mobile Phone</p>
                        <input type="text">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p>Job Title</p>
                        <input type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <p>Address</p>
                        <input type="text">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8">
                                <p>City</p>
                                <input type="text">
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <p>State</p>
                                <input type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p>Country</p>
                        <input type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <p>Address Line 2</p>
                        <input type="text">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p>Post Code</p>
                        <input type="text">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p>Are you an Accredited Investor?</p>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <p>Yes</p>
                                <input type="radio" name="accredited">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <p>No</p>
                                <input type="radio" name="accredited">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="content-footer">
                        <div class="footer-button-next">
                            <a href="/account-settings/bank-account" class="btn color-white">Next</a>
                            <!-- <input type="submit" value="Next"> -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

<!-- @todo Ben
upload  -->