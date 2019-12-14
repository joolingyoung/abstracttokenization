@extends('investor-servicing.template')
@section('title', "Choose Investment > Investor Servicing")
@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>
        @if ($site->id == 1)
            Choose or Upload New Property
        @else
            Choose an Investment
        @endif
    </h5></div>
    <div class="card-content">
        <p>
            @if ($site->id == 1)
                Create a new property or choose an approved Property below to utilize our automated Investor Servicing portal.
            @else
                Select an investment below to view all investment details.
            @endif
        </p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row">
                @if ($site->id == 1)
                    <div class="col-xs-12 col-sm-4 slider-upload">
                        <a href="/investor-servicing/upload-new-property">
                            <div class="marketplace-card-image porperty-image"><img src="/img/icon-circle-plus.svg" class="icon-plus"></div>
                        </a>
                        <a  href="/investor-servicing/upload-new-property" class="btn full-width margin-top-s color-white">Upload New</a>
                    </div>
                @endif
                    <div class="col-xs-12 col-sm-8">
                        @if (!$data->isEmpty())
                        <div class="owl-carousel owl-theme slider-two-item">
                            @foreach ($data as $key=>$investment)
                            <div class="item">
                                <div class="marketplace-card-image porperty-image">
                                    <div class="marketplace-card-image-description">
                                        <h5>{{ $investment->name }}</h5>
                                        <p>
                                        @if (isset($investment->fakeType) &&  $investment->fakeType === 'property')
                                            Digital Security (Property)

                                        @elseif (isset($investment->fakeType) &&  $investment->fakeType === 'sproperty')
                                            Property
                                        @else
                                            Digital Security (Fund)
                                        @endif
                                        </p>
                                    </div>
                                    @if ($investment->fakeType === 'fund')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{Auth::id()}}"
                                            field="fund-digital-security"
                                            path="/digital-security/fund/photo-gallery/"
                                            index="0"
                                            section="security-fund-flow-files"
                                            sectionid="{{$investment->id}}">
                                        </file-preview>
                                    </div>
                                    <a href="{{ $site->id == 1 ? '/investor-servicing/cap-table-mgmt/' : '/ownership-snapshot/' }}{{$investment->fakeType. '/'.strtolower(str_random(30)). '/' .$investment->id}}" class="btn full-width margin-top-s color-white">Select</a>
                                    @elseif ($investment->fakeType === 'property')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{Auth::id()}}"
                                            field="digital-security"
                                            path="/digital-security/photo-gallery/"
                                            index="1"
                                            section="security-flow-files"
                                            sectionid="{{$investment->id}}">
                                        </file-preview>
                                    </div>
                                    <a href="{{ $site->id == 1 ? '/investor-servicing/cap-table-mgmt/' : '/ownership-snapshot/' }}{{$investment->fakeType. '/'.strtolower(str_random(30)). '/' .$investment->id}}" class="btn full-width margin-top-s color-white">Select</a>
                                    @elseif ($investment->fakeType === 'sproperty')
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{$site->id == 1 ? Auth::id() : $investment->userid}}"
                                            field="property-image"
                                            path="/property/images/"
                                            index="0"
                                            section="investor-servicing-files"
                                            sectionid="{{$investment->id}}">
                                        </file-preview>
                                    </div>
                                    <a href="{{ $site->id == 1 ? '/investor-servicing/cap-table-mgmt/' : '/ownership-snapshot/' }}{{$investment->fakeType. '/'.strtolower(str_random(30)). '/' .$investment->id}}" class="btn full-width margin-top-s color-white">Select</a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="no-margin-top margin-left-s">Choose Approved Property or Digital Security:</p>
                        <p class="margin-left-s">You have no approved properties or digital securities.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($site->id == 1)
<popup-component
    title="Abstract Investor Servicing"
    type="basic"
    user="{{ $userid }}"
    info="<h5>We listened to our Sponsor Network’s feedback and created a simplified Investor Servicing portal. </h5><p>Once you upload the relavent documentation, we will pass your property or fund through our diligence process in 48 hours or less. Next, you will receive an email with instructions on how to invite your investor to login to your personal portal and view investor servicing &amp; reporting.</p>"
    action="Got It!">
</popup-component>
@else
<popup-component
    title="{{ strtoupper($site -> host). ' Investor Servicing' }}"
    type="basic"
    user="sub{{ $userid }}"
    info="<h5>Welcome</h5><p>Upon closing this pop up, you will be taken to the properties you have invested in with ACG.  Please don’t forget to go to your Account Settings page and  finish filling out  all pertinent information as well as your Bank Details for distributions/payments.</p>"
    action="Got It!">
</popup-component>
@endif
@endsection
@section('jquery-js-top')
    <script src="/js/owl.carousel.min.js"></script>
@stop
