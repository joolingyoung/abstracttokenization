@extends('investor-servicing.template')
@section('title', "Cap Table > Investor Servicing")
@section('body')
@if( $success === true )
<popup-component
    title="Abstract Investor Servicing"
    type="recurring"
    user="{{ Auth::id() }}"
    info="<h5>Please email support@abstracttokenization.com to request an export of all property or fund data </h5>"
    action="Got It!"
    url="/investor-servicing/cap-table-mgmt/{{$type}}/{{strtolower(str_random(30))}}/{{$id}}">
</popup-component>
@endif
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Cap Table Management</h5></div>
    <div class="card-content">
        <h5>Real Time Investor Cap Table</h5>
        <p>If your cap table has changed, please upload an updated version. We will contact you after the update has been reviewed.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <cap-preview id="{{$id}}" type="{{$type}}" data="{{ isset($data) ? json_encode($data) : '' }}"></cap-preview>
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
                                        </div>
                                        <div class="step-divider"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-button-next">
                                <a href="{{'/investor-servicing/distributions/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}" class="btn color-white">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
