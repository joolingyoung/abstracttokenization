@extends('security-fund-flow.template')
@section('title', $title )

@section('body')
<form action="/security-fund-flow/step-5/create/capitalStack" method="post">
@csrf
<div class="card margin-top-m">
<div class="card-title blue">
                        <h5>Capital Stack</h5>
                    </div>
                    <div class="card-content">
                    <h5>Capital Stack Inputs</h5>
                    <p>If your Fund is new, please use your cap stack expectation for average deals. If existing Fund, enter equity & debt percentages of existing and/or pledged real estate assets and hit next. A Capital Stack graphic will appear on your digital security details page once the process is complete.</p>
                        <div class="card grey card-black margin-top-m">
                            <div class="card-content">
                                <form>
                                    <div class="row">
                                        <!-- <div class="col-xs-12 col-sm-4">
                                            <div class="file-upload-box margin-bottom-m-sm">
                                                <img src="/img/icon-statistics-white.svg">
                                            </div>
                                        </div> -->
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="content-form">
                                                <p>* All  4 inputs should equal 100% </p>
                                                <div class="row margin-top-l">
                                                    <div class="col-xs-12 col-sm-6">
                                                        <p class="no-margin-top">Preferred Equity</p><input name="preferred-equity" placeholder="%" value="{{ isset($data['preferred-equity']) ? $data['preferred-equity'] : '' }}" type="text">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <p class="no-margin-top margin-top-s-sm">Common Equity</p><input name="common-equity" placeholder="%" value="{{ isset($data['common-equity']) ? $data['common-equity'] : '' }}" type="text">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6">
                                                        <p>Mezzanine Debt</p><input name="mezzanine-debt" placeholder="%" value="{{ isset($data['mezzanine-debt']) ? $data['mezzanine-debt'] : '' }}" type="text">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <p>Senior Debt</p><input name="senior-debt" placeholder="%" value="{{ isset($data['senior-debt']) ? $data['senior-debt'] : '' }}" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="content-footer">
                                                <a href="/security-fund-flow/step-4/key-points" class="footer-button-back">
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
