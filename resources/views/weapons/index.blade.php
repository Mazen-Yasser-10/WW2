<x-layouts.app :title="__('Weapons Marketplace')">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-gray-900 via-red-900 to-gray-800 py-8 mb-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-2">WW2 Weapons Marketplace</h1>
                <p class="text-gray-300">Military Equipment Trading Platform</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-xl rounded-lg">
        <div class="px-6 py-8">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Weapons Arsenal</h2>
                        <p class="text-gray-400">Military Equipment Inventory</p>
                    </div>
                </div>
                @if(auth()->user()->role === 'government')
                    <flux:button variant="primary" href="{{ route('weapons.create') }}" class="bg-red-600 hover:bg-red-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Weapon
                    </flux:button>
                @endif
            </div>

            <!-- Filters -->
            <div class="mb-8">
                <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter Arsenal
                    </h3>
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Weapon Type</label>
                            <select name="weapon_type" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">All Weapon Types</option>
                                @foreach($weaponTypes as $type)
                                    <option value="{{ $type->id }}" {{ request('weapon_type') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Country</label>
                            <select name="country" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">All Countries</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Market Type</label>
                            <select name="market_type" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">All Markets</option>
                                <option value="national" {{ request('market_type') == 'national' ? 'selected' : '' }}>National</option>
                                <option value="international" {{ request('market_type') == 'international' ? 'selected' : '' }}>International</option>
                            </select>
                        </div>

                        <div class="flex flex-col justify-end">
                            <div class="flex space-x-2">
                                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200">
                                    Search
                                </button>
                                <button type="button" onclick="window.location='{{ route('weapons.index') }}'" class="bg-gray-600 hover:bg-gray-500 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200">
                                    Clear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                @if(auth()->user()->role === 'general')
                    <div class="mt-4">
                        <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-semibold">Add New Weapon</h4>
                                        <p class="text-gray-400 text-sm">Expand the military arsenal</p>
                                    </div>
                                </div>
                                <a href="{{ route('weapons.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                                    Add Weapon
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            

            <!-- Weapons Grid -->
            @if($weapons->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($weapons as $weapon)
                        <div class="bg-gray-700 border border-gray-600 rounded-lg overflow-hidden hover:shadow-xl hover:border-blue-500 transition-all duration-300">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-xl font-bold text-white">{{ $weapon->weapon->name }}</h3>
                                    <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                                <div class="space-y-3 mb-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-400">Type:</span>
                                        <span class="text-white font-semibold">{{ $weapon->weapon->weaponType->name }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-400">Country:</span>
                                        <span class="text-white font-semibold">{{ $weapon->country->name }}</span>
                                    </div>
                                </div>

                                <!-- Available Listing -->
                                @if($weapon)
                                    <div class="bg-gray-800 rounded-lg p-4 mb-4 border border-gray-600">
                                        <h4 class="text-sm font-medium text-gray-300 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                            </svg>
                                            Available Listing
                                        </h4>
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-white font-medium">{{ $weapon->country->name }}</span>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $weapon->market_type === 'international' ? 'bg-blue-900 text-blue-200' : 'bg-green-900 text-green-200' }}">
                                                    {{ ucfirst($weapon->market_type) }}
                                                </span>
                                            </div>
                                            <span class="text-xl font-bold text-green-400">${{ number_format($weapon->price, 2) }}</span>
                                        </div>
                                        <div class="text-sm text-gray-400">
                                            <span class="font-medium">{{ $weapon->quantity }}</span> units available
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-red-900/20 border border-red-800 rounded-lg p-4 mb-4">
                                        <div class="text-sm text-red-300 text-center">
                                            No listing available
                                        </div>
                                    </div>
                                @endif

                                <div class="flex space-x-2">
                                    <a href="{{ route('weapons.show', $weapon) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 text-center">
                                        View Details
                                    </a>
                                    @if(auth()->user()->role === 'government')
                                        <a href="{{ route('weapons.edit', $weapon) }}" class="bg-gray-600 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                                            Edit
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $weapons->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-gray-700 rounded-lg border border-gray-600">
                    <div class="text-gray-400 text-8xl mb-6">⚔️</div>
                    <h3 class="text-2xl font-bold text-white mb-4">No Weapons Found</h3>
                    <p class="text-gray-400 mb-6 max-w-md mx-auto">The arsenal is empty or no weapons match your current filters. Add some weapons to get started.</p>
                    @if(auth()->user()->role === 'government')
                        <a href="{{ route('weapons.create') }}" class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add First Weapon
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
</x-layouts.app>