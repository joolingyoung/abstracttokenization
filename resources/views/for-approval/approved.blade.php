@extends('layouts.session')
@section('title', $title )

@section('content')
    <div class="for_approval_background">  
        <div class="for_approval_content">
            <div class="for_approval_header">
                <h2><?= $title?></h2>
            </div>
            <div class="for_approval_body">                
                <span class="for_approval_info"><?= $info?></span><br/>
            </div>
        </div>  
    </div>
@endsection
