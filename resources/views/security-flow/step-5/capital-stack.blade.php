@extends('security-flow.template')
@section('title', $title )

@section('body')
<form action="/security-flow/step-5/create/capitalStack" method="post">
@csrf
<div class="card margin-top-m">
<div class="card-title blue">
                        <h5>Capital Stack</h5>
                    </div>
                    <div class="card-content">
                    <h5>Capital Stack Inputs</h5>
                    <p>Enter your data points and hit next. A Capital Stack graphic will appear on your digital security details page once the process is complete.</p>
                        <div class="card grey card-black margin-top-m">
                            <div class="card-content">
                                <form>
                                    <div class="row">
                                         <!-- <div class="col-xs-12 col-sm-4">
                                            <div class="file-upload-box margin-bottom-m-sm">
                                                <img src="/img/icon-statistics-white.svg"></div>
                                        </div> -->
                                        <div class="col-xs-12 col-sm-12">
                                            <p>* All 4 inputs should equal 100% </p>
                                            <br/><br/>
                                            <div class="content-form">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6">
                                                        <p class="no-margin-top">Preferred Equity</p><input name="preferred-equity" placeholder="%" value="{{ isset($data['preferred-equity']) ? $data['preferred-equity'] : '' }}" type="text">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <p class="no-margin-top margin-top-s-sm">Common Equity</p><input placeholder="%" name="common-equity" value="{{ isset($data['common-equity']) ? $data['common-equity'] : '' }}" type="text">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6">
                                                        <p>Mezzanine Debt</p><input placeholder="%" name="mezzanine-debt" value="{{ isset($data['mezzanine-debt']) ? $data['mezzanine-debt'] : '' }}" type="text">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <p>Senior Debt</p><input placeholder="%" name="senior-debt" value="{{ isset($data['senior-debt']) ? $data['senior-debt'] : '' }}" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="content-footer">
                                                <a href="/security-flow/step-4/key-points" class="footer-button-back">
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
                                                                <div class="step-item active"></div>
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
                                                <div class="footer-button-next"><input type="submit" value="Next"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
</div>
</form>
@endsection
