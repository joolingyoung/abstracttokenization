@extends('security-flow.template')
@section('title', $title )

@section('body')
<form action="/account-settings/verification/bio/create" method="post">
@csrf
@if( isset( $block ) && $block == "notregister" )
    <popup-component
        title="Access Blocked!"
        type="recurring"
        user="{{ Auth::id() }}"
        info="<h5>You must register a sponsor entity under account settings and submit it to Abstract for approval before you can create a digital security.</h5>"
        action="Got It!"
        url="/account-settings/verification">
    </popup-component>
        <temp-clear
            field="companylogo"
            cook="cp1">
        </temp-clear>
@else
    <div class="card margin-top-m">
    <div class="card-title blue">
            <h5> Import Security Details</h5>
        </div>
        <div class="card-content">
            <p>I am creating and servicing digital securities for a:</p>
            <div class="card grey margin-top-m card-black">
                <div class="card-content">
                    <div class="row center-xs text-center long">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="card equal-padding dust">
                                <img src="/img/icon-building-white.svg" />
                            </div>
                            <a href="/security-flow/step-1/upload-photos" class="btn margin-top-m color-white">Property</a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="card equal-padding dust margin-top-m-sm">
                            <img src="/img/icon_-stock-market-portfolio-white.svg" />
                            </div>
                            <a href="/security-fund-flow/step-1/upload-photos" class="btn margin-top-m color-white">Fund</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="content-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endif
@endsection
