<ul class="abstract-nav-breadcrumb">
    @component('headers.sub-item', ["path" => "/view-investment"])
        Choose an Investment
    @endcomponent
    @if (!isset($type))
        <li>
            <a><p>Performance Snapshot</p></a>
        </li>
        <li>
            <a><p>Reports</p></a>
        </li>
        <li>
            <a><p>Tax Documents</p></a>
        </li>
        <li>
            <a><p>Trade</p></a>
        </li>
    @else

        @component('headers.sub-item', [
            "path" => '/ownership-snapshot/'. $type. '/'.strtolower(str_random(30)). '/' .$id,
            "prefix" => "/ownership-snapshot"
        ])
            Performance Snapshot
        @endcomponent
        @component('headers.sub-item', [
            "path" => '/reports/'. $type. '/'.strtolower(str_random(30)). '/' .$id,
            "prefix" => "/reports"
        ])
            Reports
        @endcomponent
        @component('headers.sub-item', [
            "path" => '/tax-documents/'. $type. '/'.strtolower(str_random(30)). '/' .$id,
            "prefix" => "/tax-documents"
        ])
            Tax Documents
        @endcomponent
        @component('headers.sub-item', [
            "path" => '/trade/'. $type. '/'.strtolower(str_random(30)). '/' .$id,
            "prefix" => "/trade"
        ])
            Trade
        @endcomponent
    @endif
</ul>
