@extends('diligence.template')
@section('title', $title )

@section('body')
<form method="post">
@csrf
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Account Verification</h5>
    </div>
    <div class="card-content">
        <h5>Meet The Principals, Property Owners, and Fund Managers</h5>
        <p>Connect any principals or partners to your organization.  This information will be shown alongside your deals on Abstract’s Marketplace. </p>
        <principal-form
            back="/diligence/bio"
            next="yes"
            url="/diligence/references"
            data="{{ isset($data['principles']) ? $data['principles'] : '' }}"
            user="{{ Auth::id() }}"
            type="account settings"
            map="account-verification-files">
        </principal-form>
    </div>
</div>
</form>
@endsection
