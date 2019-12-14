@extends('investor-servicing.template')
@section('title', "Reports > Investor Servicing")

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Reports</h5>
    </div>
    <div class="card-content">
        <p>First, upload a Quarterly Report, define year and quarter, then choose a send date. Quarterly reports will be sent to ALL positions tied to this deal.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <form>
                    <div class="row middle-xs">
                        <reports-component></reports-component>
                        <div class="row"></div>
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
                                            </div>
                                            <div class="step-divider"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer-button-next"><input type="submit" value="Save"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
