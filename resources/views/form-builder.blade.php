@extends('layouts.panes')
@section('title', $title)

@section('body')
    <script>
        window.FormBody = @json($form);
    </script>
    <div id="vue-app">
        <form-container></form-container>
    </div>
@endsection