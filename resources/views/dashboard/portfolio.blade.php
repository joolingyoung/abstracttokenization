@extends('layouts.main')
@section('title', "Dashboard")
<style>
    .filter-form {
        display: flex;
        justify-content: flex-end;
    }

    @media only screen and (max-width:48em) {
        h1 {
            font-size: 40px !important;
        }
        .margin-dv-m {
            margin-top: 40px;
        }
        .filter-form {
            display: block;
            padding-left: 10px;
        }
        .select-order-holdings {
            margin-left: 0 !important;
        }
    }
</style>
@section('content')
<div class="col-md-12 card margin-top-m margin-left-s margin-right-s portfolio-section">
    <div class="card-title blue">
        <h5>Portfolio Overview</h5>
    </div>
    <div class="card-content row padding-top-xl padding-bottom-xl">
        <div class="col-xs-12 col-lg-4 col-sm-6 dashboard-chart">
            <portfolio-overview :data="{{json_encode($chart)}}"></portfolio-overview>
        </div>
        <div class="col-xs-12 col-lg-8 col-sm-6 margin-dv-m margin-top-m">
            <div class="row">
                <div class="col-xs-12 col-lg-4">
                    <h5>Total Amount Invested</h5>
                    <div class="large-number">${{ number_format($total_investment_amount) }}</div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <h5>Amount Currently Invested</h5>
                    <div class="large-number">${{ number_format($current_investment_amount) }}</div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <h5>Cumulative Distributions To Date</h5>
                    <div class="large-number">${{ number_format($aggregate_cash_flow) }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="margin-top-xl light-color">Cumulative Annualized Return:<span class="margin-left-m primary-color font-bold span-portfolio">{{ number_format($cumulative_annualized_return * 100) }}%</span></h3>
                    <h3 class="light-color">Distributions YTD:<span class="margin-left-m primary-color font-bold span-portfolio">${{ number_format($distributions_YTD) }}</span></h3>
                    <h3 class="light-color">Annualized Return YTD:<span class="margin-left-m primary-color font-bold span-portfolio">{{ number_format($annualized_return_YTD * 100,2) }}%</span></h3>
                    <a><h5 class="margin-top-l pointer-cursor document-link"><i class="fa fa-file-text-o" ></i> Documents</h5></a>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="/portfolio" method="POST">
    @csrf
    <div class="margin-right-s filter-form">
        <input class="col-sm-2 col-xs-12 margin-top-l search-holdings search-property" type="search" placeholder="Search" name="search-text"  value="{{ isset($search_text) ? $search_text : '' }}">
        <select class="col-sm-2 col-xs-12 margin-top-l margin-left-m select-order-holdings" name="order-item">
            <option value="" disabled="disabled" @if(!$order_item) selected="selected" @endif>Sort By</option>
            <option value="cumulative_return" @if($order_item === 'cumulative_return') selected="selected" @endif>Cumulative Return</option>
            <option value="cumulative_annualized" @if($order_item === 'cumulative_annualized') selected="selected" @endif>Cumulative Annualized</option>
            <option value="current_annualized" @if($order_item === 'current_annualized') selected="selected" @endif>Current Annualized</option>
            <option value="investment_date" @if($order_item === 'investment_date') selected="selected" @endif>Investment Date</option>
            <option value="capital_contributed" @if($order_item === 'capital_contributed') selected="selected" @endif>Capital Contributed</option>
            <option value="percentage_ownership" @if($order_item === 'percentage_ownership') selected="selected" @endif>Percentage Ownership</option>
            <option value="cumulative_cash_distribution" @if($order_item === 'cumulative_cash_distribution') selected="selected" @endif>Cash Flow To Date</option>
            <option value="current_cash_flow" @if($order_item === 'current_cash_flow') selected="selected" @endif>Current Cash Flow</option>
            <option value="current_occupancy" @if($order_item === 'current_occupancy') selected="selected" @endif>Current Occupancy</option>
        </select>
    </div>
    <button type="submit" class="d-none" id="order-form-submit"></button>
</form>
<div class="col-md-12 card margin-top-m margin-left-s margin-right-s">
    <div class="card-title blue">
        <h5 class="vertical-center content-collapsible"><i class="fa fa-caret-down caret-card-header" ></i>Current Holdings</h5>
    </div>
    <div class="card-content row padding-top-m padding-bottom-m property-content property-list">
        @foreach($current_holdings as $property_detail)
            @include('dashboard.property', ['property_detail' => $property_detail])
        @endforeach
    </div>
</div>

<div class="col-md-12 card margin-top-m margin-left-s margin-right-s">
    <div class="card-title blue">
        <h5 class="vertical-center content-collapsible"><i class="fa fa-caret-down caret-card-header" ></i>Past Holdings</h5>
    </div>
    <div class="card-content row padding-top-m padding-bottom-m property-content property-list">
        @foreach($past_holdings as $property_detail)
            @include('dashboard.property', ['property_detail' => $property_detail])
        @endforeach
    </div>
</div>

<div class="col-md-12 card margin-top-m margin-left-s margin-right-s">
    <div class="card-title blue">
        <h5 class="vertical-center content-collapsible"><i class="fa fa-caret-down caret-card-header" ></i>Offerings in Process</h5>
    </div>
    <div class="card-content row padding-top-m padding-bottom-m vertical-center">
        @foreach($process_offerings as $process_offering)
        <div class="margin-bottom-s margin-top-s margin-left-s margin-right-s row property-content-container" style="width: 100%;">
            <div class="col-sm-2 col-xs-12 justify-content-center">
                <file-preview
                    iname="Single"
                    scope="private"
                    user="{{ Auth::id() }}"
                    field="digital-security"
                    path="/digital-security/photo-gallery/"
                    index="0"
                    section="security-flow-files"
                    sectionid="{{ $process_offering->id }}"
                    isthumbnail="true"
                >
                </file-preview>
            </div>
            <div class="col-sm-10 col-xs-12">
                <p class="property-title col-xs-12 no-padding-left margin-top-l margin-left-s">
                    {{ $process_offering->address }} -
                    <span class="property-status-{{ strtolower($process_offering->status) }}">{{ $process_offering->status }}</span>
                </p>
                <div class="row col-xs-12">
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Target Investor IRR:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $process_offering->investor_irr }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Target Equity Multiple:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $process_offering->equity_multiple }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Target Hold Period:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $process_offering->investment_period }}</h4>
                    </div>
                </div>
                <div class="row col-xs-12">
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Investment Profile:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $process_offering->investment_profile }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Minimum Investment:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $process_offering->investment_minimum }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Date Offers Due:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $process_offering->investment_offer }}</h4>
                    </div>
                </div>
                <div class="row col-xs-12">
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Distribution Period:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $process_offering->distribution_period }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Property Type:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $process_offering->property_type }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Distribution Start:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $process_offering->distribution_start }}</h4>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="col-md-12 card margin-top-m margin-left-s margin-right-s">
    <div class="card-title blue">
        <h5 class="vertical-center content-collapsible"><i class="fa fa-caret-down caret-card-header"></i>
           @if ($site->id == 1) Current
           @else Saved
           @endif
           Offerings
        </h5>
    </div>
    <div class="card-content row padding-top-m padding-bottom-m vertical-center">
        @foreach($current_offerings as $current_offering)
        <div class="margin-bottom-s margin-top-s margin-left-s margin-right-s row property-content-container card-offering" style="width: 100%;">
            <div class="justify-content-center">
                @if ($current_offering->fakeType === 'property')
                    <file-preview
                        iname="Single"
                        scope="private"
                        user="{{Auth::id()}}"
                        field="digital-security"
                        path="/digital-security/photo-gallery/"
                        index="0"
                        section="security-flow-files"
                        sectionid="{{ $current_offering->id }}"
                        isthumbnail="true"
                    >
                    </file-preview>
                @elseif ($current_offering->fakeType === 'fund')
                    <file-preview
                        iname="Single"
                        scope="private"
                        user="{{Auth::id()}}"
                        field="fund-digital-security"
                        path="/digital-security/fund/photo-gallery/"
                        index="0"
                        section="security-fund-flow-files"
                        sectionid="{{ $current_offering->id }}"
                        isthumbnail="true"
                    >
                    </file-preview>
                @endif
            </div>
            <div class="col-md-10">
                <p class="property-title col-xs-12 no-padding-left margin-top-l margin-left-s">{{ $current_offering->address }}</p>
                <div class="row col-xs-12">
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Target Investor IRR:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $current_offering->investor_irr }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Target Equity Multiple:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $current_offering->equity_multiple }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Target Hold Period:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $current_offering->investment_period }}</h4>
                    </div>
                </div>
                <div class="row col-xs-12">
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Investment Profile:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $current_offering->investment_profile }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Minimum Investment:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $current_offering->investment_minimum }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Date Offers Due:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $current_offering->investment_offer }}</h4>
                    </div>
                </div>
                <div class="row col-xs-12">
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Distribution Period:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $current_offering->distribution_period }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Property Type:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $current_offering->property_type }}</h4>
                    </div>
                    <div class="col-lg-4 row col-xs-12">
                        <h4 class="col-sm-7 light-color col-xs-7">Distribution Start:</h4>
                        <h4 class="col-sm-5 col-xs-5">{{ $current_offering->distribution_start }}</h4>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<a>
    <h4 class="margin-top-l margin-bottom-l text-center pointer-cursor">Browse More Offerings</h4>
</a>
@endsection

@section('jquery-js')
    <script>
        $(document).ready(function() {
            $('.select-order-holdings').on('change', function() {
               $('#order-form-submit').click();
            })
        })
    </script>
@stop
