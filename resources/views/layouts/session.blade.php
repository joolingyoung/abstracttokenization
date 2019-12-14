<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') | {{ $site->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.rawgit.com/Chalarangelo/mini.css/v3.0.1/dist/mini-default.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/css/session.css">
    <link rel="stylesheet" href="/css/for-approval.css">
</head>
<body>
    @yield('content')
</body>
</html>