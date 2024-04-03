@php
  $name="tagButton";
  $type="submit";
@endphp
<form  method="GET" action="{{ route('locations.index') }}" >
@csrf
<input class="hidden" name="category" value="Tag" />
<input class="hidden" type="search" name="search" value="{{$tag}}"/>
<x-tag-component  :tag="$tag" :popularity="$popularity" :buttonName="$name" :type="$type"/>
</form>