@extends('layouts.main')
@section('sub-header')
    @include('headers.security-fund-flow')
@endsection
@section('content')
<div class="content__body digital">
    @yield('body')
</div>
@endsection
