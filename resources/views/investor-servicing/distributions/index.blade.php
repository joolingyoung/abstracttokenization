@extends('investor-servicing.template')
@section('title', "Distributions > Investor Servicing")
<style>
    .pad-bottom-open {
        padding-bottom: 40px;
    }
    .rwd-table thead tr th:nth-child(4),
    .rwd-table tbody tr td:nth-child(4) {
        text-align: right;
    }
</style>

@section('body')
@if( isset( $success ) && $success )
<popup-component title="Please Wait While We Update Your Distributions " type="recurring" user="{{ Auth::id() }}" info="<h5>You will be able to view this document in excel or CSV form shortly.  Within 48 hours we will post the distributions via PDF to  your Investors Servicing Portal for their viewing. </h5>" action="Got It!" url="{{'/investor-servicing/distributions/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}">
</popup-component>
@endif
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Distribution History</h5>
    </div>
    <div class="card-content">
        @if(sizeof($distributions) < 1) <p>This property has no historical distributions.</p>
            @else
            <table class="rwd-table">
                <thead>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Yield Period</th>
                    <th>Total Amount</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($distributions as $h)
                    <tr>
                        <td>{{$h->name}}</td>
                        <td>{{$h->date}}</td>
                        <td>{{$h->period_start_date}} - {{$h->period_end_date}}</td>
                        <td>${{$h->total_amount}}</td>
                        <td><a href="/investor-servicing/distributions/csv/{{$type}}/{{strtolower(str_random(30))}}/{{$h->id}}">Download CSV</a> | <a href="/investor-servicing/distributions/nacha/{{$type}}/{{strtolower(str_random(30))}}/{{$h->id}}">Download NACHA</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
    </div>
</div>
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>New Distribution</h5>
    </div>
    <div class="card-content">
        <p>Fill in the pro rata data inputs, then hit submit to preview. Abstract will alert you within 48 hours when distributions reports are uploaded to the Investor Servicing Portal and ready for your investors to view.</p>
        <div class="card grey pad-bottom-open margin-top-m">
            <div class="card-content">
                <form action="/distributions/create/new" method="post">
                    @csrf
                    <input type="hidden" name="did" value="{{$id}}" />
                    <input type="hidden" name="tid" value="{{$type}}" />
                    <div class="row margin-bottom-m padding-bottom-m border-bottom">
                        <div class="col-xs-12 col-sm-3">
                            <p class="no-margin">Distribution Method</p>
                            <div class="distribution-icon-container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <select name="distribution_method" class="no-margin-top" id="distribution_method">
                                            <option value="allocate-pro-rate">Allocate Pro-Rata</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <p>Final Distribution?</p>
                            <div class="row">
                                <div class="col-xs-12">
                                    <select name="final_distribution" class="no-margin-top" id="final_distribution">
                                        <option value="">No</option>
                                        <option value="1">Yes</option>
                                    </select>
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
                                        <input type="text" value="{{ isset($data['name']) ? $data['name'] : '' }}" name="name" placeholder="Dec-19">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p class="no-margin-top">Distribution Date</p>
                                        @if($errors->has('date'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('date') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['date']) ? $data['date'] : '' }}" name="date" placeholder="04/30/2019">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p class="no-margin-top">Total Amount</p>
                                        @if($errors->has('totalAmount'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('totalAmount') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['totalAmount']) ? $data['totalAmount'] : '' }}" name="totalAmount" placeholder="$150,000">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Cash Flow Type</p>
                                        @if($errors->has('cashFlowtype'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('cashFlowtype') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['cashFlowtype']) ? $data['cashFlowtype'] : '' }}" name="cashFlowtype" placeholder="Pro Rota">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Yield Period Start Date</p>
                                        @if($errors->has('period_start_date'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('period_start_date') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['period_start_date']) ? $data['period_start_date'] : '' }}" name="period_start_date" placeholder="05/01/2019">
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <p>Yield Period End Date</p>
                                        @if($errors->has('period_end_date'))
                                        <br />
                                        <small class="error-small"><em>*</em> <span> {{ $errors->first('period_end_date') }} </span></small>
                                        @endif
                                        <input type="text" value="{{ isset($data['period_end_date']) ? $data['period_end_date'] : '' }}" name="period_end_date" placeholder="05/31/2019">
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $('input[name="date"]').datepicker();
                                            $('input[name="period_start_date"]').datepicker();
                                            $('input[name="period_end_date"]').datepicker();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="content-footer">
                                <!-- <div class="row center-xs margin-top-m">
                                    <input type="submit" value="Submit">
                                </div> -->
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
                                    <input type="submit" value="Next">
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
