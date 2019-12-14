@extends('security-fund-flow.template')
@section('title', $title )

@section('body')
<form>
@csrf
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Diligence & Deal Documents</h5>
    </div>
    <div class="card-content">
        <h5>If your have any EXISTING or PLEDGED properties, please upload their diligence documents below, please only click on the folder for FURTHER SPONSOR DD.</h5>
        <p>View each of the 6 diligence category folders below and click on the respective DD List for all items needed to satisfty each category’s diligence. The list will pop up in another window or you may choose to Print the list. Simply drag and drop each diligence item in its’ respective folder. If you do not have any existing or pledged properties click on the folder for Further Sponsor DD.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="breadcrumb">
                            <p>All Files<img src="/img/icon-arrow-right.svg">{{ !empty($company) ? $company->company_name : '' }} Diligence & Deal Documents</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6"><input type="search"></div>
                </div>
                <div class="row">
                    <box-component
                        user="{{ $userid }}"
                        owner="{{ !empty($company) ? $company->company_name : '' }}"
                        struc="diligence">
                    </box-component>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-footer">
                            <a href="/security-fund-flow/step-2/ownership" class="footer-button-back">
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
                                        </div>
                                        <div class="step-divider"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-button-next">
                                <a href="/security-fund-flow/step-4/key-points" class="btn color-white">Next</a>
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
