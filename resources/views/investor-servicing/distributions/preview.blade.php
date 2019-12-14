@extends('investor-servicing.template')
@section('title', "Distributions > Investor Servicing")
<style>
    .pad-bottom-open {
        padding-bottom: 40px;
    }
</style>

@section('body')
@if( isset( $errors ) && $errors )
<small class="error-small"><em>*</em> <span>
        {{ $msg }}
    </span></small>
@endif
@if( isset( $success ) && $success )
<popup-component title="Download Ready" type="recurring" user="{{ Auth::id() }}" info="<h5>Your distribution download link is ready!</h5>" action="Download" url="{{ $data }}" download="true">
</popup-component>
<!-- <a href="{{ $data }}" download>Download</a> -->
@endif
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Distributions</h5>
    </div>
    <div class="card-content">
        <p>Abstract will alert you within 48 hours when distributions report will be uploaded to the investor servicing portal, ready to view and/or send to all positions tied to the deal.</p>
        <div class="card grey pad-bottom-open margin-top-m">
            <div class="card-content">
                <form action="/distributions/preview/new" method="post">
                    @csrf
                    <input type="hidden" name="did" value="{{$id}}" />
                    <input type="hidden" name="tid" value="{{$type}}" />
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 text-center">
                            <div class="distribution-icon-container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="square-icon"><img src="/img/icon-globe.svg"></div>
                                        <p>Allocate Pro Rata</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <div class="content-form">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <p class="no-margin-top">Description / Name</p>
                                        @if($errors->has('name'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('name') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['name']) ? $data['name'] : '' }}" name="name">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p class="no-margin-top">Date</p>
                                        @if($errors->has('date'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('date') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['date']) ? $data['date'] : '' }}" name="date">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p class="no-margin-top">Total Amount</p>
                                        @if($errors->has('totalAmount'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('totalAmount') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['totalAmount']) ? $data['totalAmount'] : '' }}" name="totalAmount">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Cash Flow Type</p>
                                        @if($errors->has('cashFlowtype'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('cashFlowtype') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['cashFlowtype']) ? $data['cashFlowtype'] : '' }}" name="cashFlowtype">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Yield Period Start Date</p>
                                        @if($errors->has('period_start_date'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('period_start_date') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['period_start_date']) ? $data['period_start_date'] : '' }}" name="period_start_date">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Yield Period End Date</p>
                                        @if($errors->has('period_end_date'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('period_end_date') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['period_end_date']) ? $data['period_end_date'] : '' }}" name="period_end_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="content-footer">
                                <div class="row center-xs margin-top-m">
                                    <!-- <input type="submit" value="Download CSV of Distributions"> -->
                                    <!-- @remove and update dynamically -->
                                    <a href="/investor-servicing/distributions/csv/{{$type}}/{{rand()}}/{{$distribution_id}}" class="btn color-white mrg-left" download>Download CSV of Distributions</a>
                                    <a href="/investor-servicing/distributions/nacha/{{$type}}/{{rand()}}/{{$distribution_id}}" class="btn color-white mrg-left" download>Download NACHA File</a>
                                </div>
                                <br />
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
                                    <a href="{{'/investor-servicing/reports/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}" class="btn color-white">Next</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <br /><br /><br />
        </div>
    </div>
</div>
@endsection
<!-- @todo Ben
/dashboard/investor-servicing/distributions-v2-view-CSV/
-->
