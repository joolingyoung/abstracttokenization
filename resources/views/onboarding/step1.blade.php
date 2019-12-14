@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
<div class="page-title-row">
        <div class="row center-xs text-center">
            <div class="col-xs-12 col-sm-8">
                <h2>Abstract Users</h2>
                <p>Our Platform was built for Sponsors & Investors alike. One user, one portal. #lessismore</p>
            </div>
        </div>
    </div>
    <div class="dashboard-content-wrap">
        <div class="row center-xs">
            <div class="col-xs-12 col-sm-10">
                <div class="card equal-padding margin-top-xl">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="account-type text-center">
                                <h5>For Sponsors</h5>
                                <p>Abstract automates BOTH the process of creating digital securities, as well as
                                    investor servicing.</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="account-type text-center margin-top-m-sm">
                                <h5>For Investors</h5>
                                <p>Abstract creates LIQUIDITY for Investors & bridges you to institutional quality
                                    investments at lower minimums.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="/welcome" method="post" id="onboard-info">
        @csrf
        <div class="row center-xs">
            <div class="col-xs-12 col-sm-10">
                <div class="account-type-select">
                    <div class="card equal-padding blue margin-top-l">
                        <div class="row text-center">
                            <div class="col-xs-12 col-sm-3">
                                <p>I am a:</p>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <p>Sponsor</p><input type="radio" name="type" value="sponsor">
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <p>Investor</p><input type="radio" name="type" value="investoor">
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <p>Both</p><input type="radio" name="type" value="both">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row center-xs">
            <div class="col-xs-12 col-sm-10 text-center margin-top-l">
            <button class="large full-width white">Next</button>
            </div>
        </div>
        </form>
    </div>
@endsection