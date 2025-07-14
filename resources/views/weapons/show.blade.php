<x-layouts.app :title="__('Weapon details')">

    <div class="bg-black overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg leading-6 font-medium text-gray-900">{{ $weapon->name }}</h2>
                <div class="flex space-x-3">
                    <flux:button variant="ghost" href="{{ route('weapons.index') }}">
                        Back to Weapons
                    </flux:button>
                    @if(auth()->user()->role === 'general')
                        <flux:button variant="primary" href="{{ route('weapons.edit', $weapon) }}">
                            Edit Weapon
                        </flux:button>
                    @endif
                </div>
            </div>

            <!-- Weapon Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Weapon Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $weapon->weaponType->name }}</dd>
                    </div>
                </div>
            </div>

            <!-- Available Listings -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Available Listings</h3>
                
                @if($weapon->weaponListings->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($weapon->weaponListings as $listing)
                            <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-lg font-semibold text-gray-900">${{ number_format($listing->price, 2) }}</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $listing->marketType === 'international' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($listing->marketType) }}
                                    </span>
                                </div>
                                
                                <div class="space-y-2 text-sm text-gray-600">
                                    <div class="flex justify-between">
                                        <span>Country:</span>
                                        <span class="font-medium">{{ $listing->country->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Quantity:</span>
                                        <span class="font-medium">{{ $listing->quantity }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Status:</span>
                                        <span class="font-medium {{ $listing->is_available ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $listing->is_available ? 'Available' : 'Out of Stock' }}
                                        </span>
                                    </div>
                                </div>

                                @if($listing->is_available && $listing->quantity > 0 && auth()->user()->role !== 'general')
                                    <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                                        @csrf
                                        <input type="hidden" name="weapon_listing_id" value="{{ $listing->id }}">
                                        <div class="flex items-center space-x-2">
                                            <flux:input type="number" name="quantity" value="1" min="1" max="{{ $listing->quantity }}" class="w-20" />
                                            <flux:button type="submit" variant="primary" size="sm" class="flex-1">
                                                Add to Cart
                                            </flux:button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">No listings available for this weapon.</p>
                        @if(auth()->user()->role === 'general')
                            <flux:button variant="primary" href="{{ route('weapons.edit', $weapon) }}" class="mt-4">
                                Add Listing
                            </flux:button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>