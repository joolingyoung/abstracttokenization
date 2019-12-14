@php
    $menu = Request::segment(2);
    $submenu = Request::segment(3);
@endphp
@if ($site->id == 1)
<ul class="abstract-nav-breadcrumb abstract-nav-breadcrumb-addon">

    @component('headers.sub-item', ["path" => "/security-flow/step-1/choose"])
        Choose Digital Security
    @endcomponent

    @if ($menu == 'step-1' && $submenu == 'choose')
        <li>
            <a><p>Upload Property Photos</p></a>
        </li>
        <li>
            <a><p>Digital Security Details</p></a>
        </li>
        <li>
            <a><p>Investment Highlights</p></a>
        </li>
        <li>
            <a><p>Exisiting Ownership</p></a>
        </li>
        <li>
            <a><p>Diligence Documents</p></a>
        </li>
        <li>
            <a><p>Key Deal Points</p></a>
        </li>
        <li>
            <a><p>Capital Stack</p></a>
        </li>
        <li>
            <a><p>Meet the Sponsors</p></a>
        </li>
        <li>
            <a><p>Preview &amp; Submit</p></a>
        </li>
    @else
        @component('headers.sub-item', ["path" => "/security-flow/step-1/upload-photos"])
            Upload Property Photos
        @endcomponent
        @component('headers.sub-item', ["path" => "/security-flow/step-1/details"])
            Digital Security Details
        @endcomponent
        @component('headers.sub-item', ["path" => "/security-flow/step-1/highlights"])
            Investment Highlights
        @endcomponent
        @component('headers.sub-item', ["path" => "/security-flow/step-2/ownership"])
            Exisiting Ownership
        @endcomponent
        @component('headers.sub-item', ["path" => "/security-flow/step-3/diligence"])
            Diligence Documents
        @endcomponent
        @component('headers.sub-item', ["path" => "/security-flow/step-4/key-points"])
            Key Deal Points
        @endcomponent
        @component('headers.sub-item', ["path" => "/security-flow/step-5/capital-stack"])
            Capital Stack
        @endcomponent
        @component('headers.sub-item', ["path" => "/security-flow/step-6/meet-sponsors"])
            Meet the Sponsors
        @endcomponent
        @component('headers.sub-item', ["path" => "/security-flow/step-7/preview"])
            Preview &amp; Submit
        @endcomponent
    @endif
</ul>
@endif
