@extends('layouts.app')

@section('content')
<div class="dashboard-content-wrap">
        <div class="row digital">
            <div class="col-xs-12 col-sm-3 col-md-2">
                <div class="left-nav">
                    <div class="card">
                        <div class="card-title black text-center">
                            <h5>Investor Servicing</h5>
                        </div>
                        <br/>
                        <div class="left-nav-item-wrap">
                            <a href="/investor-servicing/choose-investment">
                            <div class="left-nav-item">
                                <p>Choose an Investment</p>
                            </div>
                            </a>
                            <a href="{{'/ownership-snapshot/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}">
                            <div class="left-nav-item">
                                <p>Performance Snapshot</p>
                            </div>
                            </a>
                            <a href="{{'/reports/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}">
                            <div class="left-nav-item active">
                                <p>Reports</p>
                            </div>
                            </a>
                            <a href="{{'/tax-documents/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}">
                            <div class="left-nav-item">
                                <p>Tax Documents</p>
                            </div>
                            </a>
                            <a href="{{'/trade/'. $type. '/'.strtolower(str_random(30)). '/' .$id }}">
                            <div class="left-nav-item">
                                <p>Trade</p>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-10">
                <div class="dashboard-menu-tile-container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3">
                        <a href="{{ $site->id == 1 ? '/account-settings/verification' : '/account-settings/investor-info' }}">
                            <div class="dashboard-menu-tile"><img src="/img/icon-user-etting-blue.svg">
                                @if ($site->id == 1) 
                                    <h5>Account Settings and Sponsor Diligence</h5>
                                @else
                                    <h5>Account Settings</h5>
                                @endif
                            </div>
                        </a>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                        <a href="/investor-servicing/choose-investment">
                            <div class="dashboard-menu-tile active"><img src="/img/icon-paper-settings-active.svg">
                                <h5>My Investments</h5>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
                @yield('body')
            </div>
        </div>
    </div>
@endsection