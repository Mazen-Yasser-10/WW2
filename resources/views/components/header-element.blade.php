@props(['header'])

@if(strpos($_SERVER['REQUEST_URI'],  $header ) === 0)
<a href="{{ $header }}" class="text-blue-600 font-bold [text-shadow:0_0_10px_blue]">{{ $slot }} </a>  

@else
<a href="{{ $header }}" class="">{{ $slot }}</a> 
@endif