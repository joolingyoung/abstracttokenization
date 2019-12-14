@extends('investor-servicing.template')
@section('title', "Reports > Investor Servicing")
@section('body')
@if( $site->id == 1 )

<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Reports</h5>
    </div>
    <div class="card-content">
        <p>First, define report period’s month or quarter, define its year, then hit Submit. Quarterly reports will available to view in your Investor Servicing portal witin 48 hours.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12 col-md-6 margin-bottom-m-md padding-right-l-lg border-right-lg">
                        <div class="card equal-padding margin-bottom-m">
                            <form action="/reports/create/new" id="create-report-form" method="post">
                                @csrf
                                <input type="hidden" name="did" value="{{$id}}" />
                                <input type="hidden" name="tid" value="{{$type}}" />
                                <div class="row middle-xs">
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="row middle-xs">
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 text-left">
                                                <p class="no-margin">Month:</p>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                <input type="text" name="month" value="{{ isset($data['month']) ? $data['month'] : '' }}" placeholder="3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2 text-center">
                                        <p class="no-margin">or</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                        <div class="row middle-xs">
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 text-left">
                                                <p class="no-margin">Quarter:</p>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                                <input type="text" name="quarter" value="{{ isset($data['quater']) ? $data['quater'] : '' }}" placeholder="2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card equal-padding margin-bottom-m">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 text-left">
                                    <p>Report Year:</p>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                                    <select name="year" class="no-margin-top">
                                        <option value="{{ isset($data['year']) ? $data['year'] : '' }}" name="year" disabled="disabled" selected="selected">{{ isset($data['year']) ? $data['year'] : 'Select an option' }}</option>
                                        @for($i = 2019; $i >= 1900; $i--)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row center-xs">
                            <div class="col-xs-12 col-md-8">
                                <uploads-component
                                    title="Upload Investor Report"
                                    type="single"
                                    action="/files"
                                    elname="file"
                                    scope="private"
                                    field="report-documents"
                                    multi="yes"
                                    section="reports"
                                    path="/reports/documents/">
                                </uploads-component>
                            </div>
                            <div class="content-form">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 padding-left-l-lg">
                        <form action="/investor-servicing/sponsor/reports/{{$id}}">
                        <div class="content-form">
                            <p class="no-margin">Choose an Available Document:</p>
                            <div class="row margin-top-m">
                                <div class="col-xs-12 col-sm-6">
                                    <select name="report_id" class="no-margin-top" id="report_id" required>
                                        <option value=""  disabled="disabled" selected="selected">Select an option</option>
                                        @foreach ($report_data as $key)
                                            <option value="{{$key->id}}">{{ $key->year." ".($key->quater != " " ? $key->quater : " ")." ".($key->month != " " ? $key->month : " ") }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <select name="report_type" class="no-margin-top" id="report_type">
                                        <option value="dst" selected="selected">DST Financial Report</option>
                                        <option value="highlights">Loan and Reserve Highlights</option>
                                        <option value="operating">Property Operating Statement</option>
                                        <option value="cash">Cash Distribution Summary</option>
                                        {{-- <option value="cashFlow">Net Cash Flow</option> --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-m">
                            <div class="col-xs-12 col-sm-6">
                                <input type="submit" class="btn full-width margin-bottom-m-sm" name="download" value="PDF">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <input type="submit" class="btn full-width margin-bottom-m-sm" name="download" value="CSV">
                            </div>
                        </div>
                        </form>
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
                                        </div>
                                        <div class="step-divider"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-button-next">
                                <input type="submit" value="Save" form="create-report-form">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
@include('investor-servicing.reports.dummy-index')
@endif
@endsection
