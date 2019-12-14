@extends('security-flow.template')
@section('title', $title )

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Key Deal Points</h5>
    </div>
    <div class="card-content">
        <h5>Enter Key Points</h5>
        <p>Cut and paste key deal points from your PPM or offering memerandum. Enter up to 5 key deal points, starting each new deal point with a bullet or asterick.</p>
        <key-points url="security-flow/step-4/create/keyPoints" back="/security-flow/step-3/diligence" data="{{ isset($data['key-points']) ? $data['key-points'] : '' }}" next="yes"></key-points>
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
                            </div>
                            <div class="step-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
