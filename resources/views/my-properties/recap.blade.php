@extends('my-properties.properties-template')
@section('title', $title )

@section('body')
<form method="post">
@csrf
    <div class="card margin-top-m">
        <div class="card-title blue">
            <h5>Approved</h5>
        </div>
        <div class="card-content">
            <h5>Recap Review</h5>
            <p>Review your Investment Metrics. IF everything is correct, hit NEXT. IF you need to edit any of the information press EDIT below. Please note, if any edits are made, your digital security will need to be reviewed, which may take up to 2 days.</p>
            <div class="row">
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
                <a href="{{ '/edit/security-flow/' . $type . '/' . $id }}" class="btn full-width dust margin-top-m color-white">Edit</a>
            </div>
            <div class="col-xs-12 col-sm-8">
                <div class="card">
                    <div class="card-title blue">
                        <h5>Investment Metrics Recap</h5></div>
                    <div class="card-content">
                        <ul class="no-margin">
                            <li>Minimum Equity Raise Amount: $15 million</li>
                            <li>Maximum Equity Raise Amount: $50 million</li>
                            <li>Total Capital Required: $50 million</li>
                            <li>Total Token Supply: 100 million</li>
                            <li>Price Per Token: $1 dollar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="content-footer">
                    <div class="footer-button-next">
                        <a href="{{ '/create/recap/metrics/'.$type.'/'.strtolower(str_random(30)).'/'.$id }}" class="btn">Next</a>
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