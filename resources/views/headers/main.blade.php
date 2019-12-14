@php
    $top_menu = Request::segment(1);
    $menu = Request::segment(2);
    $submenu = Request::segment(3);
    $is_sponsor= $site->id === 1;
@endphp
<header>
    <div class="container-fluid">
        <div class="navbar">
            <div class="nav-logo">
                <a href="/">
                    @if(!$is_sponsor && $site -> logo_dark)
                        <img src="{{ $site -> logo_dark }}" style="height:30px; width:auto;" class="logo push-up-nav">
                    @else
                        <img src="/img/abstract-logo.svg" class="logo">
                    @endif
                </a>
            </div>
            <ul class="abstract-drop-nav">
                @if ($is_sponsor)
                    <li class="{{$top_menu == 'sponsor' && $menu == 'introduction' ? 'active' : ''}}">
                        <a href="/sponsor/introduction" >Intro</a>
                    </li>
                    <li class="{{$top_menu == 'investor-servicing' ? 'active' : ''}}">
                        <a href="/investor-servicing/choose-investment">Servicing</a>
                    </li>
                    <li class="{{$top_menu == 'diligence' ? 'active' : ''}}">
                        <a href="/diligence/verification">Sponsor Diligence</a>
                    </li>
                    <li class="{{$sponsor_approved === true ? $top_menu == 'security-flow' ? 'active' : '' : 'nav-disabled'}}">
                        <a href="{{ $sponsor_approved === true ? '/security-flow/step-1/choose' : '#' }}">Digital Security</a>
                    </li>
                    <li class="{{($top_menu == 'properties' || $top_menu == 'portfolio') ? 'active' : ''}}">
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
                    <li>
                        <a href="/marketplace">Marketplace</a>
                    </li>
                    @else
                    <li class="{{$top_menu == 'dashboard' ? 'active' : ''}}">
                        <a href="/dashboard">Dashboard</a>
                    </li>
                    <li class="{{$top_menu == 'investor-servicing' ? 'active' : ''}}">
                        <a href="/investor-servicing/choose-investment">Servicing</a>
                    </li>
                    <li class="{{$top_menu == 'marketplace' ? 'active' : ''}}">
                        <a href="/marketplace">Marketplace</a>
                    </li>
                    @endif
            </ul>
                @if (auth()->user())
                <div class="nav-item">
                    <div class="nav-notification">
                        <notification></notification>
                    </div>
                </div>
                <div class="nav-user-info">
                    <div class="user-setting">
                        <div class="dropdown">
                            <div data-toggle="dropdown" class="dropdown-toggle">
                                <div class="user-image"><img src="/img/icon-user.svg"></div>
                                <div class="user-setting-arrow"></div>
                            </div>
                            <ul class="dropdown-menu">
                                    @if ($is_sponsor)
                                        <li><a href="/account-settings/verification/entire">Account Settings</a></li>
                                    @else
                                        <li><a href="/account-settings/investor-info">Account Settings</a></li>
                                    @endif
                                <li><a href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            @endif
        </div>
        <div class="navbar-mobile">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo"><a href="/"><img src="/img/logo-dark-w-type.svg" class="logo"></a></div>
                    <div class="menu-button"><img src="/img/icon-menu-btn.svg"></div>
                    <ul class="nav-item">
                        @if ($is_sponsor)
                            <li class="{{$top_menu == 'sponsor' && $menu == 'introduction' ? 'active' : ''}}">
                                <a href="/sponsor/introduction" >Intro</a>
                            </li>
                            <li class="{{$top_menu == 'investor-servicing' ? 'active' : ''}}">
                                <a href="/investor-servicing/choose-investment">Servicing</a>
                            </li>
                            <li class="{{$top_menu == 'diligence' ? 'active' : ''}}">
                                <a href="/diligence/verification">Sponsor Diligence</a>
                            </li>
                            <li class="{{$sponsor_approved === true ? $top_menu == 'security-flow' ? 'active' : '' : 'nav-disabled'}}">
                                <a href="/security-flow/step-1/choose">Digital Security</a>
                            </li>
                            <li class="{{($top_menu == 'properties' || $top_menu == 'portfolio') ? 'active' : ''}}">
                                <a href="/portfolio">Portfolio</a>
                            </li>
                            <li>
                                <a href="/marketplace">Marketplace</a>
                            </li>
                            <li><a href="/account-settings/verification/entire">Account Settings</a></li>
                        @else
                            <li><a href="#">Investor </a></li>
                            <li><a href="#">Sponsors</a></li>
                            <li><a href="/marketplace">Marketplace</a></li>
                            <li><a href="/account-settings/investor-info">Account Settings</a></li>
                        @endif
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
@if((new \Jenssegers\Agent\Agent())->isMobile())
<popup-notification
    title="Get the App now!"
    type="notification"
    browsertype="{{$browser}}"
    user="{{ Auth::id() }}"
    info='<h5>Add the web app icon to your home screen for convenient access: tap the bottom <img src="/img/icon-safari-tap.png"></img> then click "Add to Home Screen" </h5>'
    info1='<h5>Add the web app icon to your home screen for convenient access: tap <img src="/img/icon-chrome-tap.png"></img> then click "Add to Home Screen" </h5>'
>
</popup-notification>
<temp-clear
    field="companylogo"
    cook="cp1">
</temp-clear>
@endif