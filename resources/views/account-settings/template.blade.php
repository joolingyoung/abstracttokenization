@extends('layouts.main')
@section('sub-header')
    @include('headers.account-settings')
@endsection
@section('content')
<div class="content__body digital">
    @yield('body')
</div>
@endsection
