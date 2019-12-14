@extends('subdomain.investor-servicing.template')
@section('title', "Reports > Investor Servicing")

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Reports</h5></div>
    <div class="card-content">
        <p class="no-margin-top">Choose an available quarterly Report to view in PDF or CSV format. The quarterly reports include: DST Financials, Operational Highlights, Property Financial Highlights, and Cash Distributions Summary. </p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row center-xs">
                    <div class="col-xs-12 col-sm-4">
                        <div class="marketplace-card-image porperty-image">
                            <div class="marketplace-card-image-description">
                                    <h5>{{!empty($data) ? $data->name : '' }}</h5>
                                    <p class="color-white">
                                        @if (isset($type) &&  $type === 'property')
                                            Property digital security

                                        @elseif (isset($type) &&  $type === 'sproperty')
                                            Property
                                        @else
                                            Fund digital security
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
                                        user="{{$data->userid}}"
                                        field="property-image"
                                        path="/property/images/"
                                        section="investor-servicing-files"
                                        sectionid="{{$data->id}}"
                                        index="0">
                                    </file-preview>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                    <form action="/investor-servicing/investor/reports/{{$type}}/'{{strtolower(str_random(30))}}'/{{$id}}" method="get">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 text-left"></div>
                                        </div>
                                        <p>Choose an Available Report:</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                                        <select name="report_id" class="no-margin-top">
                                            <option value=""  disabled="disabled" selected="selected">Select an option</option>
                                            @foreach ($report_data as $key)
                                                <option value="{{$key->id}}">{{ $key->year." ".($key->quater != " " ? $key->quater : " ")." ".($key->month != " " ? $key->month : " ") }}</option>
                                            @endforeach
                                        </select>
                                        <div class="row"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-m">
                            <div class="col-xs-12 col-sm-6">
                                <!-- <a href="{{'/investor-servicing/reports/dt/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}" class="btn full-width margin-bottom-m-md color-white">View</a>
                                 -->
                                 <input type="submit" value="View">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <a href="/28912SAIAS232/dst-report.pdf" class="btn full-width margin-bottom-m-md color-white" download>Download</a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-footer">
                            <a href="{{'/tax-documents/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}" class="footer-button-back">
                            <h5><img src="/img/icon-arrow-back.svg">Back</h5></a>
                            <div class="footer-button-next">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
