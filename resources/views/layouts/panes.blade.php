@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2" id="nav">
            <h1>{{$nav['header']}}</h1>
            <ul>
                @foreach( $nav['links'] as $l )
                    <li
                        @if( $l['current'] == true )
                                class="current"
                            @endif
                    >
                        <a href="{{$l['href']}}">{{$l['text']}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12" id="pane-nav">
                <a href="/account-settings/verification">
                @if( $category == 'account-settings' )
                    <img src="/img/nav/account-settings-selected.png">
                @else
                    <img src="/img/nav/account-settings.png">
                @endif
                </a>

                @if( $category == 'properties' )
                    <img src="/img/nav/my-properties-selected.png">
                @else
                    <img src="/img/nav/my-properties.png">
                @endif

                @if( $category == 'investor-servicing' ) 
                    <img src="/img/nav/investor-servicing-selected.png">
                @else
                    <img src="/img/nav/investor-servicing.png">
                @endif
                    
                @if( $category == 'create-digital-security' )
                    <img src="/img/nav/create-digital-security-selected.png">
                @else
                    <img src="/img/nav/create-digital-security.png">
                @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="body-frame">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
@endsection