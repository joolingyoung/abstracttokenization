<li @if (strpos('/'.Request::path(), $prefix ?? $path) === 0)
        class="active"
    @endif>
<a href="{{$path}}">
    <p>{{$slot}}</p>
</a>
</li>
