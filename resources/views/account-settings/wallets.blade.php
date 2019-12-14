@extends('account-settings.template')
@section('title', $title )

@section('body')
<div class="card margin-top-m">
    <div class="card-title blue">
        <h5>Digital Custody</h5>
    </div>
    <div class="card-content">
        <h5>Your Sponsor Wallets</h5>
        <p>We have partnered with PrimeTrust for institutional grade, qualified custody and digital securities storage. PrimeTrust is the leading cold storage solution provided by the trusted expert in digital custody.</p>
        <div class="card grey margin-top-m">
            <div class="card-content">
                <div class="row">
                    <div class="col-xs-12">
                        <h5>Individual Property Digital Wallets </h5>
                        <p>You will have a digital wallet created for each individual property you convert to a digital security. You can trade your digital securites from the My Properties section in your dashboard.</p>
                    </div>
                </div>
                <div class="row margin-top-l">
                    <div class="col-xs-12 col-sm-4">
                        <h5>Digital Wallet / Property</h5>
                        <ul class="basic">
                            <li>Mulbery Place</li>
                            <li>Pennington High Rise</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <h5>Digital Wallet / Property</h5>
                        <ul class="basic">
                            <li>0x3ef680b2086130a2f23fdbafde0a7d3040b6ed652edd041ab8abfb3c2b1916ac</li>
                            <li>0xc340482a62332c502420c450614af1aa3cdd6fa371c59c2e7c6923c123e9ae78</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
