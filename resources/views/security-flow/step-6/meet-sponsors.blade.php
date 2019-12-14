@extends('security-flow.template')
@section('title', $title )

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Meet the Sponsors</h5>
    </div>
    <div class="card-content">
        <form action="/security-flow/step-6/create/meetSponsors" method="post">
        @csrf
            <h5>Team is Everything</h5>
            <p>Share the bios and backgrounds of your key team members. Let your investors know they’re in good hands!</p>
            <principal-form
                next="yes"
                back="/security-flow/step-5/capital-stack"
                url="/security-flow/step-7/preview"
                data="{{ isset($data['principles']) ? $data['principles'] : '' }}"
                user="{{Auth::id()}}"
                map="security-flow-files">
            </principal-form>
        </form>
    </div>
    <div class="row">
        <div class="col-xs-12">
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
                                <div class="step-item active"></div>
                            </div>
                            <div class="col-xs">
                                <div class="step-item"></div>
                            </div>
                        </div>
                        <div class="step-divider"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /account-settings/verification/principles/create -->
@endsection
