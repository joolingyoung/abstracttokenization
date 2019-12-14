@extends('layouts.main')
@section('sub-header')
@include('headers.marketplace')
@endsection
@section('content')
<div class="main__content digital">
    @yield('body')
</div>
@endsection
