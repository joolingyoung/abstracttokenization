@extends('my-properties.properties-template')
@section('title', $title )

@section('body')
<form method="post">
@csrf
<div class="card margin-top-m">
                    <div class="card-title blue">
                    <h5>Approved</h5></div>
                    <div class="card-content">
                        <h5>Choose Ticker Symbol</h5>
                        <p>Check the availability of your Digital Security Sicker Symbol. Once you are finished press Finish Creating Digital Security.</p>
                        <div class="card grey margin-top-m">
                            <div class="card-content">
                                <div class="row center-xs">
                                    <div class="col-xs-12 col-sm-4">
                                    <div class="marketplace-card-image porperty-image">
                                    <div class="marketplace-card-image-description">
                                        <h5>{{!empty($data) ? $data->name : '' }}</h5>
                                        <p class="color-white">
                                        @if (isset($type) &&  $type === 'property')
                                            Digital Security (Property)

                                        @elseif (isset($type) &&  $type === 'sproperty')
                                            Property
                                        @else
                                            Digital Security (Fund)
                                        @endif</p>
                                    </div>
                                    @if ($type === 'fund')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{Auth::id()}}"
                                            field="fund-digital-security"
                                            path="/digital-security/fund/photo-gallery/"
                                            index="0"
                                            section="security-fund-flow-files"
                                            sectionid="{{$id}}">
                                        </file-preview>
                                    @elseif ($type === 'property')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{Auth::id()}}"
                                            field="digital-security"
                                            path="/digital-security/photo-gallery/"
                                            index="0"
                                            section="security-flow-files"
                                            sectionid="{{$id}}">
                                        </file-preview>
                                    @elseif ($type === 'sproperty')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{Auth::id()}}"
                                            field="property-image"
                                            path="/property/images/"
                                            index="0"
                                            section="investor-servicing-files"
                                            sectionid="{{$id}}">
                                        </file-preview>
                                    @endif
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8">
                                        <div class="card-title blue">
                                            <h5>Ticker Availability</h5></div>
                                        <div class="card-content">
                                            <div class="row middle-xs">
                                                <div class="col-xs-12 col-sm-8"></div>
                                                <p class="no-margin">Enter a 3-5 letter security token symbol to check its' availability.</p>
                                                <div class="col-xs-12 col-sm-4">
                                                    <input type="text" class="no-margin">
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="btn margin-top-m">Check Availability</div>
                                                </div>
                                            </div>
                                            <div class="row middle-xs">
                                                <p>Congrats! Your token symbol is available.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="content-footer">
                                            <div class="footer-button-next">
                                                <a href="{{ '/investment/metrics/'.$type.'/'.strtolower(str_random(30)).'/'.$id }}" class="btn gold color-white">FINISH CREATING DIGITAL SECURITY</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</form>
@endsection
@section('jquery-js-top')
    <script src="/js/owl.carousel.min.js"></script>
@stop