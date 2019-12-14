@extends('subdomain.investor-servicing.template')
@section('title', "Choose Investment > Investor Servicing")

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Choose an Investment</h5></div>
    <div class="card-content">
        @if ($site->id == 1)
            <p>Select an investment below to view your performance details.</p>
        @else
            <p>Select an investment below to view all investment details.</p>
        @endif
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <div class="owl-carousel owl-theme slider-two-item">
                            @foreach ($data as $key=>$investment)
                            <div class="item">
                                <div class="marketplace-card-image porperty-image">
                                    <div class="marketplace-card-image-description">
                                        <h5>{{ $investment->name }}</h5>
                                        <p>{{ ($investment->fakeType === "sproperty" ) ? 'Property digital security' : 'Fund digital security' }}</p>
                                    </div>
                                    @if ($investment->fakeType === "sproperty")
                                        <file-preview
                                            iname="Single"
                                            scope="private"
                                            user="{{$investment->userid}}"
                                            field="property-image"
                                            path="/property/images/"
                                            index="0"
                                            section="investor-servicing-files"
                                            sectionid="{{$investment->id}}">
                                        </file-preview>
                                    </div>
                                    <a href="{{'/ownership-snapshot/sproperty/' . strtolower(str_random(30)) . '/' .$investment->id}}" class="btn full-width margin-top-s color-white">Select</a>
                                    @else
                                    <file-preview
                                        iname="Single"
                                        scope="private"
                                        user="{{Auth::id()}}"
                                        path="/digital-security/photo-gallery/"
                                        index="$key"
                                        section="security-flow-files">
                                    </file-preview>
                                    <a href="{{'/investor-servicing/cap-table-mgmt/' . strtolower(str_random(30)) . '/fund/'.$investment->id}}" class="btn full-width margin-top-s color-white">Select</a>
                                </div>
                                <a href="{{'/ownership-snapshot/sproperty/' . strtolower(str_random(30)) . '/' .$investment->id}}" class="btn full-width margin-top-s color-white">Select</a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Choose an Investment</h5>
    </div>
    <div class="card-content">
        <h5>Choose a Live Property or Fund</h5>
        <p>Select any investments below to view Investor Servicing and send reports to all positions tied to the investment.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="owl-carousel owl-theme default-slider">
                </div>
            </div>
        </div>
    </div>
</div>
-->
<popup-component
    title="Abstract Investor Servicing"
    type="basic"
    user="{{ $userid }}"
    info="<h5>We listened  to our Sponsor Network’s feedback and created a simplified Investor Servicing portal. </h5><p>Once you upload the relavent documentation, we will pass your property or fund through our diligenprocess in 48 hours or less. Next, you will receive an email with instructions on how to invite your investoto login to your personal portal and view investor servicing reporting.</p>"
    action="Got It!">
</popup-component>
@endsection
@section('jquery-js')
    <script src="/js/owl.carousel.min.js"></script>
@stop
