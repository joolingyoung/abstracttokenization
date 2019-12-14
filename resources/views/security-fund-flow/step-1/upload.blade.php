@extends('security-fund-flow.template')
@section('title', $title )

@section('body')
<form action="/account-settings/verification/bio/create" method="post">
@csrf
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Upload Property Photos</h5>
    </div>
    <div class="card-content">
        <h5>Photo Gallery:</h5>
        <p>Upload photos of any existing properties the Fund owns or properites pledged as collateral.</p>
        <div class="card grey card-black margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <uploads-component
                            type="photos"
                            action="/files"
                            elname="image"
                            scope="private"
                            field="fund-digital-security"
                            multi="yes"
                            cook="up1"
                            path="/digital-security/fund/photo-gallery/"
                            class="large margin-bottom-m-md"
                            map="security-fund-flow-files">
                        </uploads-component>

                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="row margin-bottom-m">
                            <div class="col-xs-12 col-sm-6">
                                <uploads-component
                                    type="photos"
                                    action="/files"
                                    elname="image"
                                    scope="private"
                                    field="fund-digital-security"
                                    multi="yes"
                                    cook="up2"
                                    path="/digital-security/fund/photo-gallery/"
                                    class="margin-bottom-m-md"
                                    map="security-fund-flow-files">
                                </uploads-component>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="photo-upload-box">
                                    <uploads-component
                                        type="photos"
                                        action="/files"
                                        elname="image"
                                        scope="private"
                                        field="fund-digital-security"
                                        multi="yes"
                                        cook="up3"
                                        path="/digital-security/fund/photo-gallery/"
                                        class="margin-bottom-m-md"
                                        map="security-fund-flow-files">
                                    </uploads-component>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="photo-upload-box margin-bottom-m-md">
                                    <uploads-component
                                        type="photos"
                                        action="/files"
                                        elname="image"
                                        scope="private"
                                        path="/digital-security/fund/photo-gallery/"
                                        field="fund-digital-security"
                                        multi="yes"
                                        cook="up4"
                                        class="margin-bottom-m-md"
                                        map="security-fund-flow-files">
                                    </uploads-component>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="photo-upload-box">
                                    <uploads-component
                                        type="photos"
                                        action="/files"
                                        elname="image"
                                        scope="private"
                                        path="/digital-security/fund/photo-gallery/"
                                        field="fund-digital-security"
                                        multi="yes"
                                        cook="up5"
                                        class="margin-bottom-m-md"
                                        map="security-fund-flow-files">
                                    </uploads-component>
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
                                <a href="/security-fund-flow/step-1/details" class="btn color-white">Next</a>
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
