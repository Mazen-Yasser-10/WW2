<x-layouts.app :title="__('Create Weapon')">
    <div class="max-w-5xl mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800 mb-2">⚔️ Create New Weapon</h1>
                    <p class="text-slate-600">Add a new weapon to your country's arsenal</p>
                </div>
                <flux:button variant="outline" href="{{ route('weapons.index') }}" class="border-slate-300 text-slate-700 hover:bg-slate-50">
                    ← Back to Arsenal
                </flux:button>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-gray-800 rounded-2xl shadow-xl border border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-8 py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="text-2xl">🛡️</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Weapon Specifications</h2>
                        <p class="text-red-100">Configure your weapon's details and market availability</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <form action="{{ route('weapons.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div class="border-l-4 border-red-500 pl-4">
                            <h3 class="text-xl font-semibold text-white mb-1">Basic Information</h3>
                            <p class="text-gray-400">Define the core properties of your weapon</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Weapon Name</label>
                                <input 
                                    type="text"
                                    name="name" 
                                    placeholder="e.g., M1 Garand, Tiger Tank" 
                                    required 
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                />
                                @error('name')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Weapon Type</label>
                                <select 
                                    name="weapon_type_id" 
                                    required
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200">
                                    <option value="" class="text-gray-400">Select weapon category</option>
                                    @foreach($weaponTypes as $type)
                                        <option value="{{ $type->id }}" class="text-white">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('weapon_type_id')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Damage Rating</label>
                                <input 
                                    type="number" 
                                    name="damage" 
                                    placeholder="Combat effectiveness (0-3000)" 
                                    min="0" 
                                    max="3000"
                                    required 
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                />
                                @error('damage')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Manufacturing Country</label>
                                <select 
                                    name="country_id" 
                                    required
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200">
                                    <option value="" class="text-gray-400">Select manufacturing nation</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" class="text-white">🏳️ {{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Market Configuration Section -->
                    <div class="space-y-6">
                        <div class="border-l-4 border-blue-500 pl-4">
                            <h3 class="text-xl font-semibold text-white mb-1">Market Configuration</h3>
                            <p class="text-gray-400">Set pricing and availability for the global market</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Market Availability</label>
                                <select 
                                    name="market_type" 
                                    required
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
                                    <option value="" class="text-gray-400">Choose market scope</option>
                                    <option value="international" class="text-white">🌍 International Market</option>
                                    <option value="national" class="text-white">🏠 National Only</option>
                                </select>
                                @error('market_type')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Unit Price ($)</label>
                                <input 
                                    type="number" 
                                    name="price" 
                                    placeholder="0.00" 
                                    step="0.01" 
                                    min="0" 
                                    required 
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                />
                                @error('price')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Available Quantity</label>
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    placeholder="Stock amount" 
                                    min="1" 
                                    required 
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                />
                                @error('quantity')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-600">
                        <button 
                            type="button" 
                            onclick="window.location='{{ route('weapons.index') }}'"
                            class="px-6 py-3 border-2 border-gray-500 text-gray-300 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all duration-200 font-medium"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 font-bold shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            🚀 Deploy Weapon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>