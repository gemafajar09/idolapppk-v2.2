<button type="{{$type}}" class="btn btn-{{$class}}" onclick="{{$onclick}}">
@if($name != '')
    {{$name}}
@else
    {{$span}}
@endif
</button>
