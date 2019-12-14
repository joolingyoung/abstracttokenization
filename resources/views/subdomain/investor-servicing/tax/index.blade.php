@extends('subdomain.investor-servicing.template')
@section('title', "Tax Documents > Investor Servicing")
<style>
.prop-new .content-footer {
    margin:50px 0;
}
</style>
@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Tax Documents</h5></div>
    <div class="card-content">
        <p class="no-margin-top">Choose an available Tax Document then select PDF or CSV to view or downloaod. </p>
        <form action="/subdomain/tax/create" method="POST">
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
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 text-left">
                                        <p>Choose an Available Tax Document:</p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                                    <select class="no-margin-top">
                                    <option disabled="disabled" selected="selected">Select an option</option>
                                            <option value="option">Schedule E</option>
                                            <option value="option">K-1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-m">
                            <div class="col-xs-12 col-sm-6">
                                <a href="/28912SAIAS232/happy-investor-k1.pdf" download class="btn full-width margin-bottom-m-md color-white">Preview</a>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <a href="/28912SAIAS232/happy-investor-k1.pdf" download class="btn dust full-width color-white">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-footer">
                            <a href="{{'/ownership-snapshot/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}" class="footer-button-back"><img src="/img/icon-arrow-back.svg">
                                <h5>Back</h5></a>
                            <div class="footer-button-next">
                                <a href="{{'/reports/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}" class="btn color-white">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection

<!-- @todo Ben
upload  -->
