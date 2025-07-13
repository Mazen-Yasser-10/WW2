@props(['weapon'])

<a href="{{ route('weapons.show', $weapon->id) }}" >
<div class="flex flex-col text-center p-4 bg-indigo-950/50 rounded-xl   border border-transparent hover:border-blue-900 group transition-colors duration-300 space-y-3 ">
    <div class="self-start text-sm">{{ $weapon->weapon->country->name }}</div>

    <div class="flex justify-between  mt-auto">
        
        <x-logo  :url="$weapon->weapon->image" />
    </div>
    <div class="py-8 text-center">
        <h3 class="group-hover:text-blue-900 text-xl font-bold transition-colors duration-300">
            {{ $weapon->weapon->name }}

        </h3>
        <p class="text-sm">Price: {{ $weapon->price.' '.$weapon->weapon->country->currency }}</p>
        
    </div>
    <div class="flex justify-between items-center">
        @if(!$weapon->is_available)
            <span class="text-red-500 font-semibold">Out Of Stock</span>
        @else    
        <span class="text-sm text-gray-500">{{ $weapon->quantity }} available</span>
        @endif
        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors duration-300">
            Add to cart
        </button>
    </div>    

</div> 
</a>   
