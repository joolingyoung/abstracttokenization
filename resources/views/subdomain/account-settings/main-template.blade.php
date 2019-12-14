@extends('layouts.main')
@section('content')
<ul class="abstract-nav-breadcrumb abstract-line">
    @include('subdomain.account-settings.sidebar')
</ul>
<div class="dashboard-content-wrap">
    <div class="row digital">
        <div class="col-xs-12 col-sm-12 col-md-12">
            @yield('body')
        </div>
    </div>
</div>
@endsection