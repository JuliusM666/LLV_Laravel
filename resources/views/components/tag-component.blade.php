@php
    $color = 255-10*$popularity;
    
@endphp
<button type={{$type}} value="{{$tag}}"   name="{{$buttonName}}" style="{{'background-color:rgb('.$color.', '.$color.', 255)'}}" class=" text-black  uppercase text-xs px-4 py-2 rounded-full shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button"
  >
  
  @if(strlen($tag)<10)
    {{"#".$tag}}
  @else
    {{ "#" .substr($tag,0,10).'...' }}
  @endif
</button>