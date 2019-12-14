
@php
    $menu = Request::segment(2);
@endphp
<ul class="abstract-nav-breadcrumb">
    <li @if ($menu == 'choose-investment')
        class="active"
    @endif>
        <a href="/investor-servicing/choose-investment">
            <p>Choose an Investment</p>
        </a>
    </li>
    @if ($site->id == 1)
        @switch($menu)
            @case('choose-investment')
                <li>
                    <a><p>Cap Table Overview </p></a>
                </li>
                <li>
                    <a><p>Distributions</p></a>
                </li>
                <li>
                    <a><p>Reporting</p></a>
                </li>
                <li>
                    <a><p>Tax Documents</p></a>
                </li>
                @break
            @case('upload-new-property')
                <li class="active">
                    <a>
                        <p>Upload New Property</p>
                    </a>
                </li>
                @break
            @case('create')
                <li class="active">
                    <a>
                        <p>Upload New Property</p>
                    </a>
                </li>
                @break
            @default
                <li @if ($menu == 'cap-table-mgmt')
                    class="active"
                    @endif>
                    <a href="{{'/investor-servicing/cap-table-mgmt/'.$type.'/'.strtolower(str_random(30)).'/'.$id }}"><p>Cap Table Overview </p></a>
                </li>
                <li @if ($menu == 'distributions')
                    class="active"
                    @endif>
                    <a href="{{'/investor-servicing/distributions/'.$type.'/'.strtolower(str_random(30)).'/'.$id }}"><p>Distributions</p></a>
                </li>
                <li @if ($menu == 'reports')
                    class="active"
                    @endif>
                    <a href="{{'/investor-servicing/reports/'.$type.'/'.strtolower(str_random(30)).'/'.$id }}"><p>Reporting</p></a>
                </li>
                <li @if ($menu == 'tax-document')
                    class="active"
                    @endif>
                    <a href="{{'/investor-servicing/tax-document/'.$type.'/'.strtolower(str_random(30)).'/'.$id }}"><p>Tax Documents</p></a>
                </li>
        @endswitch

    @endif
</ul>
