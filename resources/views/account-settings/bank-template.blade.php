@extends('layouts.accounts')
@php
    $top_menu = Request::segment(1);
    $menu = Request::segment(2);
    $submenu = Request::segment(3);
@endphp
<style>
.left-nav-item {
    display: block;
}
</style>
@section('content')
<header>
            <div class="container-fluid">
                <div class="navbar">
                    <div class="row middle-xs no-margin">
                        <div class="col-xs-12 col-sm-10">
                            <div class="nav-logo">
                                <a href="/">
                                    @if($site->id != 1 && $site -> logo_dark)
                                        <img src="{{ $site -> logo_dark }}" style="height:30px; width:auto;" class="logo push-up-nav">
                                    @else
                                        <img src="/img/abstract-logo.svg" class="logo">
                                    @endif
                                </a>
                            </div>
                            <ul class="abstract-drop-nav">
                            @if ($site->id == 1)
                                <li>
                                    <a href="/sponsor/introduction">Intro</a>
                                </li>
                            @endif
                                <li>
                                    <a href="/investor-servicing/choose-investment">Servicing</a>
                                </li>
                                @if ($site->id == 1)
                                <li class="active">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="true">Sponsor Diligence <span class="caret"></span></a>
                                     <div class="arrow"></div>
                                     @include('account-settings.sidebar.verification', ['select'=>$menu])
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="true">Portfolio <span class="caret"></span></a>
                                     <div class="arrow"></div>
                                     <div class="dropdown-menu abstract-d-menu">
                                       <a class="dropdown-item" href="/properties/pending">In Process</a>
                                       <a class="dropdown-item" href="/properties/pending">Pending</a>
                                       <a class="dropdown-item" href="/properties/approved">Approved</a>
                                       <a class="dropdown-item" href="/properties/approved">Digitized</a>
                                       <a class="dropdown-item" href="/properties/approved">Available to Trade</a>
                                    </div>
                                </li>
                                @endif
                                <li>
                                    <a href="/marketplace">Marketplace</a>
                                </li>
                                @if ($site->id != 1)
                                <li class="active">
                                    <a href="/account-settings/investor-info">Account Settings</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @if (auth()->user())
                        <div class="col-xs-12 col-sm-2">
                            <div class="nav-user-info">
                                <div class="user-setting">
                                    <div class="dropdown">
                                        <div data-toggle="dropdown" class="dropdown-toggle">
                                            <div class="user-image"><img src="/img/icon-user.svg"></div>
                                            <div class="user-setting-arrow"></div>
                                        </div>
                                        <ul class="dropdown-menu">
                                            @if ($site->id == 1)
                                                <li><a href="/account-settings/verification/entire">Account Settings</a></li>
                                            @else
                                                <li><a href="/account-settings/investor-info">Account Settings</a></li>
                                            @endif
                                            <li><a href="/logout">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="nav-item">
                                <div class="nav-notification">
                                    <notification></notification>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="navbar-mobile">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="logo"><a href="/"><img src="/img/logo-dark-w-type.svg" class="logo"></a></div>
                            <div class="menu-button"><img src="/img/icon-menu-btn.svg"></div>
                            <ul class="nav-item">
                                <li><a href="#">Investor </a></li>
                                <li><a href="#">Sponsors</a></li>
                                <li><a href="#">Marketplace</a></li>
                                <li><a href="#">Settings</a></li>
                                <li><a href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <ul class="abstract-nav-breadcrumb abstract-line">
        @if ($site->id == 1)
            @include('account-settings.sidebar', ['select'=>$menu])
        @else
            @include('subdomain.account-settings.sidebar')
        @endif
        </ul>
    <div class="dashboard-content-wrap">
        <div class="row digital">
            <div class="col-xs-12 col-sm-12 col-md-12">
                @yield('body')
            </div>
        </div>
    </div>
@endsection
