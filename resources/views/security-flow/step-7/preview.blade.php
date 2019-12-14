@extends('security-flow.template')
@section('title', $title )

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Preview & Submit</h5>
    </div>
    <div class="card-content">
        <h5>You’re nearly there!</h5>
        <p>Hit preview to review all information to ensure it is correct. You may EDIT if need be by pressing the EDIT button at the start of each section; your information will automatically re-save when you hit submit at the bottom of the page..</p>
        <div class="card">
            <div class="card-title dust has-button">
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
        <div class="row">
            <div class="col-xs-12">
                <div class="content-footer">
                    <a href="/security-fund-flow/step-6/meet-sponsors" class="footer-button-back">
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
                            </div>
                            <div class="step-divider"></div>
                        </div>
                    </div>
                    </div>
                    <div class="footer-button-next">
                        <a href="/security-flow/preview" class="btn color-white">Preview</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
