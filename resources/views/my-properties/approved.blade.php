@extends('my-properties.properties-template')
@section('title', $title )

@section('body')
<form method="post">
@csrf
<div class="card margin-top-m">
        <div class="card-title blue">
            <h5>Approved</h5></div>
        <div class="card-content">
            <h5>Ready to Complete</h5>
            <p>Select a property or fund and press COMPLETE to finialize the process of creating your digital security.</p>
            <div class="card grey margin-top-m">
                <div class="card-content">
                @if (!$data->isEmpty())
                    <div class="owl-carousel owl-theme default-slider">
                        @foreach ($data as $key=>$property)
                            <div class="item">
                                <div class="marketplace-card-image porperty-image">
                                    <div class="marketplace-card-image-description">
                                        <h5>{{ $property->name }}</h5>
                                        <p>
                                        @if (isset($property->fakeType) &&  $property->fakeType === 'property')
                                            Digital Security (Property)

                                        @elseif (isset($property->fakeType) &&  $property->fakeType === 'sproperty')
                                            Property
                                        @else
                                            Digital Security (Fund)
                                        @endif
                                        </p>
                                    </div>
                                    @if ($property->fakeType === 'fund')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{Auth::id()}}"
                                            field="fund-digital-security"
                                            path="/digital-security/fund/photo-gallery/"
                                            index="0"
                                            section="security-fund-flow-files"
                                            sectionid="{{$property->id}}">
                                        </file-preview>
                                    </div>
                                    <a href="{{ '/properties/choose/sticker/'.$property->fakeType.'/'.strtolower(str_random(30)).'/'.$property->id }}" class="btn full-width margin-top-s color-white">Complete</a>
                                    @elseif ($property->fakeType === 'property')
                                    <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{Auth::id()}}"
                                            field="digital-security"
                                            path="/digital-security/photo-gallery/"
                                            index="0"
                                            section="security-flow-files"
                                            sectionid="{{$property->id}}">
                                        </file-preview>
                                    </div>
                                    <a href="{{ '/properties/choose/sticker/'.$property->fakeType.'/'.strtolower(str_random(30)).'/'.$property->id }}" class="btn full-width margin-top-s color-white">Complete</a>
                                @endif
                            </div>
                            @endforeach
                    </div>
                    @else
                        <p class="margin-left-s">You have no approved Digital Securities.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('jquery-js-top')
    <script src="/js/owl.carousel.min.js"></script>
@stop