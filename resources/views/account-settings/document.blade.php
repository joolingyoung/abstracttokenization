@extends('account-settings.template')
@section('title', $title )
<style>
.mrg-right{
    margin-right: 10px;
}
</style>
@section('body')
@if( isset( $saved ) && $saved )
<popup-component
    title="Save and Come Back"
    type="recurring"
    user="{{ $userid }}"
    info="<h5>If you need more time, all your information will be saved until you preview and submit your account registration. Please note, you cannot begin to create a digital security until your Account Settings/Sponsor Due Diligence has been completed and reviewed by our team. This process takes no more than 48 hours upon full submission.</h5>"
    action="Got It!">
</popup-component>
@endif

<form action="/account-settings/verification/diligence/create" method="post">
@csrf

<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Document Management</h5>
    </div>
    <div class="card-content">
        <h5>Manage Your Diligence Documents</h5>
        <p>View or share a specific property's Due Diligence Box Folder, or select a specific subfolder.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="card-title">
                                <div class="breadcome">
                                    <p>All Files <img src="/img/icon-arrow-right.svg"> {{ !empty($company) ? $company->company_name : '' }} Diligence Documents </p>
                                </div>
                            </div>
                            <div class="card-content">
                                <!-- todo fix company name in session -->
                            <box-component-extra
                                user="{{ Auth::id() }}"
                                owner="{{ !empty($company) ? $company->company_name : '' }}"
                                struc="diligence">
                            </box-component-extra>
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
