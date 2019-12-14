<div class="margin-bottom-s margin-top-s margin-left-s margin-right-s row property-content-container flex property-id-{{$property_detail['id']}}" style="width: 100%;">
    <div class="property-image">
        <file-preview
            iname="Single"
            scope="private"
            user="{{ Auth::id() }}"
            field="property-image"
            path="/property/images/"
            index="0"
            section="investor-servicing-files"
            sectionid="{{$property_detail['id']}}"
            isthumbnail="true"
        >
        </file-preview>
    </div>
    <div class="property-info">
        <div class="property-title">{{ $property_detail['address'] }}</div>
        <div class="row">
            <div class="col-lg-4 row col-xs-12">
                <h4 class="col-sm-7 light-color col-xs-7 margin-top-xs margin-bottom-xs">Cumulative Return:</h4>
                <h4 class="col-sm-5 col-xs-5 margin-top-xs margin-bottom-xs">{{ number_format($property_detail['cumulative_return'] * 100, 2) }}%</h4>
            </div>
            <div class="col-lg-4 row col-xs-12">
                <h4 class="col-sm-7 light-color col-xs-7 margin-top-xs margin-bottom-xs">Cumulative Annualized:</h4>
                <h4 class="col-sm-5 col-xs-5 margin-top-xs margin-bottom-xs">{{ number_format($property_detail['cumulative_annualized'] * 100, 2) }}%</h4>
            </div>
            <div class="col-lg-4 row col-xs-12">
                <h4 class="col-sm-7 light-color col-xs-7 margin-top-xs margin-bottom-xs">Current Annualized:</h4>
                <h4 class="col-sm-5 col-xs-5 margin-top-xs margin-bottom-xs">{{ number_format($property_detail['current_annualized'] * 100, 2) }}%</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 row col-xs-12">
                <h4 class="col-sm-7 light-color col-xs-7 margin-top-xs margin-bottom-xs">Investment Date:</h4>
                <h4 class="col-sm-5 col-xs-5 margin-top-xs margin-bottom-xs">{{ $property_detail['investment_date']->format('d/m/Y') }}</h4>
            </div>
            <div class="col-lg-4 row col-xs-12">
                <h4 class="col-sm-7 light-color col-xs-7 margin-top-xs margin-bottom-xs">Capital Contributed:</h4>
                <h4 class="col-sm-5 col-xs-5 margin-top-xs margin-bottom-xs">${{ number_format($property_detail['capital_contributed']) }}</h4>
            </div>
            <div class="col-lg-4 row col-xs-12">
                <h4 class="col-sm-7 light-color col-xs-7 margin-top-xs margin-bottom-xs">Percentage Ownership:</h4>
                <h4 class="col-sm-5 col-xs-5 margin-top-xs margin-bottom-xs">{{ number_format($property_detail['percentage_ownership'] * 100, 2) }}%</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 row col-xs-12">
                <h4 class="col-sm-7 light-color col-xs-7 margin-top-xs margin-bottom-xs">Distribution To Date:</h4>
                <h4 class="col-sm-5 col-xs-2 margin-top-xs margin-bottom-xs">${{ number_format($property_detail['cumulative_cash_distribution']) }}</h4>
            </div>
            <div class="col-lg-4 row col-xs-12">
                <h4 class="col-sm-7 light-color col-xs-7 margin-top-xs margin-bottom-xs">Current Distribution:</h4>
                <h4 class="col-sm-5 col-xs-5 margin-top-xs margin-bottom-xs">
                    ${{ number_format($property_detail['current_cash_flow']) }}
                    @if ($property_detail['distribution_trend'] === 1) <img src="/img/trend-arrow-up.svg" class="trend-arrow" />
                    @else <img src="/img/trend-arrow-down.svg" class="trend-arrow" />
                    @endif
                </h4>
            </div>
            <div class="col-lg-4 row col-xs-12">
                <h4 class="col-sm-7 light-color col-xs-7 margin-top-xs margin-bottom-xs">Current Occupancy:</h4>
                <h4 class="col-sm-5 col-xs-5 margin-top-xs margin-bottom-xs">{{ number_format($property_detail['current_occupancy'] * 100, 2) }}%</h4>
            </div>
        </div>
    </div>
</div>
