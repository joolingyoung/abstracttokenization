@extends('subdomain.investor-servicing.template')
@section('title', "Cap Table > Investor Servicing")

@section('body')

<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Ownership Distribution & Performance</h5></div>
    <div class="card-content">
        <p>Below is a quick overview of Ownership Details, distribution and performance. Choose next to view other reports.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row center-xs">
                    <div class="col-xs-12 col-sm-4">
                        <div class="marketplace-card-image porperty-image">
                            <div class="marketplace-card-image-description">
                                <h5>{{!empty($property_details) ? $property_details->name : '' }}</h5>
                                <p class="color-white">
                                    @if (isset($type) &&  $type === 'property')
                                        Property (Digital Security)

                                    @elseif (isset($type) &&  $type === 'sproperty')
                                        Property
                                    @else
                                        Fund (Digital Security)
                                    @endif
                                </p>
                            </div>
                            @if ($type === 'fund')
                                <file-preview
                                    iname="Single"
                                    scope="private"
                                    user="{{Auth::id()}}"
                                    field="fund-digital-security"
                                    path="/digital-security/fund/photo-gallery/"
                                    section="security-fund-flow-files"
                                    index="0">
                                </file-preview>
                            @elseif ($type === 'property')
                                <file-preview
                                    iname="Single"
                                    scope="private"
                                    user="{{Auth::id()}}"
                                    field="digital-security"
                                    path="/digital-security/photo-gallery/"
                                    section="security-flow-files"
                                    index="0">
                                </file-preview>
                            @elseif ($type === 'sproperty')
                                <file-preview
                                    iname="Single"
                                    scope="private"
                                    user="{{$property_details->userid}}"
                                    field="property-image"
                                    path="/property/images/"
                                    index="0"
                                    section="investor-servicing-files"
                                    sectionid="{{$property_details->id}}">
                                </file-preview>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <div class="stats-container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card grey margin-top-m">
                                        <div class="card-title blue">
                                            <h5>Performance Overview</h5>
                                        </div>
                                        <div class="card-content overview-card">
                                            <div class="row margin-bottom-m">
                                                <div class="col-xs-12 col-md-6 col-lg-4">
                                                    <div class="card equal-padding">
                                                        <p>Cumulative Return</p>
                                                        <h4>{{ number_format( $cumulative_return, 2 ) }}%</h4>

                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6 col-lg-4">
                                                    <div class="card equal-padding margin-top-m-md">
                                                        <p>Cumulative Anualized</p>

                                                        <h4>{{ number_format( $pre_tax_annualized_return, 2 ) }}%</h4>

                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6 col-lg-4">
                                                    <div class="card equal-padding margin-top-m-lg">
                                                        <p>
                                                            Current Annualized
                                                        </p>

                                                        <h4>{{ number_format( $current_annualized, 2) }}%</h4>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row margin-bottom-m">
                                                <div class="col-xs-12 col-md-6 col-lg-4">
                                                    <div class="card equal-padding">
                                                        <p>Investment Date</p>

                                                        <h4>{{ $investment_details->contributed_at->format('m/d/Y') }}</h4>

                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6 col-lg-4">
                                                    <div class="card equal-padding">
                                                        <p>Capital Contributed</p>
                                                        <h4>${{ number_format( $investment_details->amount ) }}</h4>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6 col-lg-4">
                                                    <div class="card equal-padding">
                                                        <p>Percentage Ownership</p>
                                                        <h4>{{ round( $investment_details->share * 100, 2 ) }}%</h4>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row margin-bottom-m">

                                                <div class="col-xs-12 col-md-6 col-lg-4">
                                                    <div class="card equal-padding margin-top-m-md">
                                                        <p>Cash Flow To Date</p>

                                                        <h4>${{ number_format( $cumulative_cash_distribution, 0 ) }}</h4>

                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6 col-lg-4">
                                                    <div class="card equal-padding margin-top-m-lg">
                                                        <p>Current Cash Flow</p>

                                                        <h4>${{ number_format( $current_cash_flow, 0 ) }}</h4>

                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6 col-lg-4">
                                                    <div class="card equal-padding margin-top-m-lg">
                                                        <p>Current Occupancy</p>
                                                        @if( $occupancy == 'Unknown' )
                                                            <h4>Unknown</h4>
                                                        @else
                                                            <h4>{{number_format($occupancy, 2)}}%</h4>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="card margin-top-m">
                            <div class="card-title blue">
                                <h5>Distributions</h5>
                            </div>
                            <div class="card-content">
                                <div>
                                    <bar-chart data="{{
                                        json_encode(array('distributions'=>json_encode($distributions),
                                            'investment'=>json_encode($investment_details),
                                            'max_distribution' => $max_distribution))
                                    }}" type="distribution"></bar-chart>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="card margin-top-m">
                            <div class="card-title blue">
                                <h5>NOI</h5>
                            </div>
                            <div class="card-content">
                                <div>
                                    <bar-chart data="{{
                                        json_encode($noi_data)
                                    }}"></bar-chart>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="card margin-top-m">
                            <div class="card-title blue">
                                <h5>Debt</h5>
                            </div>
                            <div class="card-content">
                                <div>
                                    <line-chart data="{{
                                        json_encode($debt_data)
                                    }}"></line-chart>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-footer">
                            <a href="/investor-servicing/choose-investment" class="footer-button-back"><img src="/img/icon-arrow-back.svg">
                                <h5>Back</h5></a>
                            <div class="footer-button-next">
                                <a href="{{'/tax-documents/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}" class="btn color-white">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
