<!DOCTYPE html>
<html>

<head>
    <title>@yield('title') | {{ $site->name }}</title>
    <meta http-eqiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="en-us">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <!-- <link rel="stylesheet" href="/css/lib/bootstrap.css"> -->
    <link rel="stylesheet" href="/css/lib/flexboxgrid.css">
    <link rel="stylesheet" href="/css/lib/jquery-ui.css">
    <!-- <link rel="stylesheet" href="/css/lib/cs-select.css"> -->
    <link rel="stylesheet" href="/css/lib/owl.theme.css">
    <link rel="stylesheet" href="/css/lib/owl.carousel.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/sectionscroll.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/BoxSdk.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    @yield('jquery-js-top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = {!! json_encode([
            'user' => ['id' => Auth::user()?Auth::user()->id:''],
            'csrfToken' => csrf_token(),
            'vapidPublicKey' => config('webpush.vapid.public_key'),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
        ]) !!};

        //set performance tab if active
        $(document).ready(function() {
            if(localStorage.getItem('tab') == 'Performance'){
                $('.header-toggle-item').removeClass('action-brown');
                $('p:contains(Performance)').parent().addClass('action-brown');
            }
        });
    </script>
</head>

<body>
    <div id="app">
        <header>
            <div class="container-fluid">
                <div class="navbar">
                    <div class="row middle-xs no-margin">
                        <div class="col-xs-12 col-sm-4">
                            <div class="nav-logo">
                                <a href="/">
                                    @if($site->id != 1 && $site -> logo_dark)
                                        <img src="{{ $site -> logo_dark }}" style="height:30px; width:auto;" class="logo push-up-nav">
                                    @else
                                        <img src="/img/abstract-logo.svg" class="logo">
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class=" text-center">
                                <div class="row">
                                @if ($site->id == 1)
                                    <div class="col-xs-12 col-sm-4">
                                        <a href="/sponsor/introduction" onclick="localStorage.setItem('tab', 'Sponsors');">
                                            <div class="header-toggle-item header-toggle">
                                                <p>Sponsors</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <a href="/marketplace" onclick="localStorage.setItem('tab', 'Marketplace');">
                                        <div class="header-toggle-item header-toggle active action-brown">
                                            <p>Marketplace</p>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <a href="/view-investment" onclick="localStorage.setItem('tab', 'Performance');">
                                            <div class="header-toggle-item header-toggle" >
                                                <p>Performance</p>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                <div class="col-xs-12 col-sm-6">
                                        <div class="header-toggle-item header-toggle">
                                            <p>Investor Reporting</p>
                                        </div>
                                    </div>
                                <div class="col-xs-12 col-sm-6">
                                        <a href="/marketplace">
                                        <div class="header-toggle-item header-toggle active action-brown">
                                            <p>Marketplace</p>
                                        </div>
                                    </a>
                                </div>
                                @endif

                                </div>
                            </div>
                        </div>
                        @if (auth()->user())
                        <div class="col-xs-12 col-sm-4">
                            <div class="nav-user-info">
                                <div class="user-setting">
                                    <div class="dropdown">
                                        <div data-toggle="dropdown" class="dropdown-toggle">
                                            <div class="user-image"><img src="/img/icon-user.svg"></div>
                                            <div class="user-setting-arrow"></div>
                                        </div>
                                        <ul class="dropdown-menu">
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
         @yield('content')
    </div>
    @yield('jquery-js')
    <script src="/js/app.js"></script>
</body>
</html>
