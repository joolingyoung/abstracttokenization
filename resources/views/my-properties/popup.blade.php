@extends('my-properties.properties-template')
@section('title', $title )

@section('body')
    <popup-component
        title="You Did It!"
        type="recurring" 
        user="{{ Auth::id() }}"
        info="<h5>Please stand by...</h5><p>We are creating your digital security and adding it to the blockchain. This could take up to 90 seconds to complete.</p>"
        loadermsg="<p>You will be brought to your property on the Abstract Marketplace once the process is complete</p>"
        loader="true"
        url="{{ '/marketplace/details/'.$type.'/'.strtolower(str_random(30)).'/'.$id }}">
    </popup-component>
@endsection