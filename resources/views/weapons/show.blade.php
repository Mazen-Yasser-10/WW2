<x-layouts.app :title="__('Weapon details')">
    <!-- Weapon details view -->
    
    <div class="pt-10">
        
        <div class="max-w-x mx-auto mt-6">
            <div class=" bg-indigo-950/50 shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4">{{ $weapon->weapon->name }}</h2>
                <div class ="flex justify-between  mt-auto">
                    <x-logo :url="$weapon->weapon->image" />
                </div>
                <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $weapon->weapon->description }}</p>
                <p class="text-gray-700 dark:text-gray-300 mb-4">Country: {{ $weapon->weapon->country->name }}</p>
                <p class="text-gray-700 dark:text-gray-300 mb-4">Type: {{ $weapon->weapon->weaponType->name }}</p>
                <p class="text-gray-700 dark:text-gray-300 mb-4">Price: {{ $weapon->price.' '.$weapon->weapon->country->currency }}</p>
                @if($weapon->is_available)
                    <p class="text-green-500 font-semibold mb-4">Available</p>
                @else
                    <p class="text-red-500 font-semibold mb-4">Out Of Stock</p>
                @endif    
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors duration-300 ml-150">
                    Add to cart
                </button>
        </div>

    </div>
</div>
</x-layouts.app>