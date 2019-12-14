@extends('layouts.app')
@section('title', "You're All Set")

@section('content')
<div id="welcome-banner">
    <h1>You're All Set!</h1>
    <h2>Access ALL relevant functions of Abstract’s platform from your user dashboard.</h2>
</div>
<div id="allset">
    <img src="/img/onboarding/user-dashboard.png">
    <img src="/img/onboarding/create-digital-security.png">
    <img src="/img/onboarding/search-marketplace.png">
</div>
<a class="button" id="onboard-continue" href="/sponsor/welcome">Next</a>
@endsection