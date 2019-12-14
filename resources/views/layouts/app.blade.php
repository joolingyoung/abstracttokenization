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
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    <link rel="stylesheet" href="/css/lib/owl.theme.css">
    <link rel="stylesheet" href="/css/lib/owl.carousel.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/sectionscroll.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.bootstrap-dropdown-hover.min.js"></script>
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
         @yield('content')
    </div>
    @yield('jquery-js')
    <script src="/js/app.js"></script>
    <script>$('[data-toggle="dropdown"]').bootstrapDropdownHover();</script>
    <script>$('#nv-drop').bootstrapDropdownHover();</script>
</body>
</html>
