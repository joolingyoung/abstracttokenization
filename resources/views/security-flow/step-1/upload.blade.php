@extends('security-flow.template')
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
        <p>Upload 5 images that help showcase your digital security. Please note you can save your information and return to EDIT at a later time from ‘Pending Properties’ on your Sponsor Dashboard.</p>
        <div class="card grey card-black margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <uploads-component
                            type="photos"
                            action="/files"
                            elname="image"
                            scope="private"
                            field="digital-security"
                            cook="up1"
                            multi="yes"
                            path="/digital-security/photo-gallery/"
                            class="large margin-bottom-m-md"
                            map="security-flow-files">
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
                                    field="digital-security"
                                    cook="up2"
                                    multi="yes"
                                    path="/digital-security/photo-gallery/"
                                    class="margin-bottom-m-md"
                                    map="security-flow-files">
                                </uploads-component>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="photo-upload-box">
                                    <uploads-component
                                        type="photos"
                                        action="/files"
                                        elname="image"
                                        scope="private"
                                        field="digital-security"
                                        cook="up3"
                                        multi="yes"
                                        path="/digital-security/photo-gallery/"
                                        class="margin-bottom-m-md"
                                        map="security-flow-files">
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
                                        path="/digital-security/photo-gallery/"
                                        field="digital-security"
                                        cook="up4"
                                        multi="yes"
                                        class="margin-bottom-m-md"
                                        map="security-flow-files">
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
                                        path="/digital-security/photo-gallery/"
                                        field="digital-security"
                                        cook="up5"
                                        multi="yes"
                                        class="margin-bottom-m-md"
                                        map="security-flow-files">
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
                                <a href="/security-flow/step-1/details" class="btn color-white">Next</a>
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
