@extends('layouts.session')
@section('title', $title )

@section('content')
    <div class="for_approval_background">  
        <div class="for_approval_content">
            <div class="for_approval_header">
                <h2><?= $title?></h2>
            </div>
            <div class="for_approval_body">
              
                @if (isset($type) &&  $type != 'no')
                    @if ($type == 'reject')
                    <form action="/sponsor/rejected" method="post">
                    @elseif ($type == 'propertyReject')
                    <form action="/property/rejected" method="post">
                    @elseif ($type == 'fundReject')
                    <form action="/fund/rejected" method="post">
                    @endif
                        @csrf
                        <span class="for_approval_info"><?= $info?></span><br/>
                        <input type="hidden" name="id" value="{{$id}}" />
                        <input type="hidden" name="reject_token" value="{{$reject_token}}" />
                        <textarea name="comments" autofocus></textarea> <br/>
                        <button class="for_approval_button" type="submit">Submit</button>
                        <button class="for_approval_button" type="button" onclick="window.open('', '_parent', ''); window.close();">Cancel</button>
                    </form>
                @else
                    <span class="for_approval_info"><?= $info?></span><br/>
                @endif                           
            </div>
        </div>  
    </div>
@endsection
