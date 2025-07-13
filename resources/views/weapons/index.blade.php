<x-layouts.app :title="__('Weapons Marketplace')">
    <div class="bg-black overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg leading-6 font-medium text-gray-900">Weapons Marketplace</h2>
                @if(auth()->user()->role === 'government')
                    <flux:button variant="primary" href="{{ route('weapons.create') }}">
                        Add New Weapon
                    </flux:button>
                @endif
            </div>

            <!-- Filters -->
            <div class="mb-6">
                <form method="GET" class="flex flex-wrap gap-4">
                    <flux:select name="weapon_type" placeholder="All Weapon Types">
                        @foreach($weaponTypes as $type)
                            <option value="{{ $type->id }}" {{ request('weapon_type') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:select name="country" placeholder="All Countries">
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </flux:select>

                    <flux:select name="market_type" placeholder="All Markets">
                        <option value="national" {{ request('market_type') == 'national' ? 'selected' : '' }}>National</option>
                        <option value="international" {{ request('market_type') == 'international' ? 'selected' : '' }}>International</option>
                    </flux:select>

                    <flux:button type="submit" variant="outline">Filter</flux:button>
                    <flux:button type="button" variant="ghost" onclick="window.location='{{ route('weapons.index') }}'">Clear</flux:button>
                </form>
                <div class="mt-4">
                    @if(auth()->user()->role === 'general')
                        <div class="inline-block w-auto">
                            <flux:navlist.item icon="plus" :href="route('weapons.create')" wire:navigate class="w-auto">
                                {{ __('Add New Weapon') }}
                            </flux:navlist.item>
                        </div>
                    @endif
                </div>
            </div>
            

            <!-- Weapons Grid -->
            @if($weapons->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($weapons as $weapon)
                        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $weapon->weapon->name }}</h3>
                                    <span class="text-2xl">⚔️</span>
                                </div>
                                
                                <div class="text-sm text-gray-600 mb-3">
                                    <p><strong>Type:</strong> {{ $weapon->weapon->weaponType->name }}</p>
                                </div>

                                <!-- Available Listing -->
                                @if($weapon)
                                    <div class="space-y-2 mb-4">
                                        <h4 class="text-sm font-medium text-gray-700">Available from:</h4>
                                        <div class="flex items-center justify-between text-xs bg-gray-50 p-2 rounded">
                                            <div class="flex items-center space-x-2">
                                                <span class="font-medium">{{ $weapon->country->name }}</span>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $weapon->market_type === 'international' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ ucfirst($weapon->market_type) }}
                                                </span>
                                            </div>
                                            <span class="font-semibold text-green-600">${{ number_format($weapon->price, 2) }}</span>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Quantity: {{ $weapon->quantity }} available
                                        </div>
                                    </div>
                                @else
                                    <div class="text-sm text-gray-500 mb-4">
                                        No listing available
                                    </div>
                                @endif

                                <div class="flex space-x-2">
                                    <flux:button variant="outline" href="{{ route('weapons.show', $weapon) }}" size="sm" class="flex-1">
                                        View Details
                                    </flux:button>
                                    @if(auth()->user()->role === 'government')
                                        <flux:button variant="ghost" href="{{ route('weapons.edit', $weapon) }}" size="sm">
                                            Edit
                                        </flux:button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $weapons->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">⚔️</div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No weapons found</h3>
                    <p class="text-gray-500 mb-4">No weapons match your current filters.</p>
                    @if(auth()->user()->role === 'government')
                        <flux:button variant="primary" href="{{ route('weapons.create') }}">
                            Add First Weapon
                        </flux:button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>