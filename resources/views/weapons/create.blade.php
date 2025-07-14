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
        <div class="bg-black rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
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
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Basic Information</h3>
                            <p class="text-gray-600">Define the core properties of your weapon</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700">Weapon Name</flux:label>
                                <flux:input 
                                    name="name" 
                                    placeholder="e.g., M1 Garand, Tiger Tank" 
                                    required 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                />
                                <flux:error name="name" class="text-red-500 text-sm" />
                            </div>

                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700">Weapon Type</flux:label>
                                <flux:select 
                                    name="weapon_type_id" 
                                    placeholder="Select weapon category"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                >
                                    @foreach($weaponTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="weapon_type_id" class="text-red-500 text-sm" />
                            </div>

                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700">Damage Rating</flux:label>
                                <flux:input 
                                    type="number" 
                                    name="damage" 
                                    placeholder="Combat effectiveness (0-3000)" 
                                    min="0" 
                                    max="3000"
                                    required 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                />
                                <flux:error name="damage" class="text-red-500 text-sm" />
                            </div>

                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700">Manufacturing Country</flux:label>
                                <flux:select 
                                    name="country_id" 
                                    placeholder="Select manufacturing nation"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                >
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">🏳️ {{ $country->name }}</option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="country_id" class="text-red-500 text-sm" />
                            </div>
                        </div>
                    </div>

                    <!-- Market Configuration Section -->
                    <div class="space-y-6">
                        <div class="border-l-4 border-blue-500 pl-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Market Configuration</h3>
                            <p class="text-gray-600">Set pricing and availability for the global market</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700">Market Availability</flux:label>
                                <flux:select 
                                    name="market_type" 
                                    placeholder="Choose market scope"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                >
                                    <option value="international">🌍 International Market</option>
                                    <option value="national">🏠 National Only</option>
                                </flux:select>
                                <flux:error name="market_type" class="text-red-500 text-sm" />
                            </div>

                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700">Unit Price ($)</flux:label>
                                <flux:input 
                                    type="number" 
                                    name="price" 
                                    placeholder="0.00" 
                                    step="0.01" 
                                    min="0" 
                                    required 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                />
                                <flux:error name="price" class="text-red-500 text-sm" />
                            </div>

                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700">Available Quantity</flux:label>
                                <flux:input 
                                    type="number" 
                                    name="quantity" 
                                    placeholder="Stock amount" 
                                    min="1" 
                                    required 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                />
                                <flux:error name="quantity" class="text-red-500 text-sm" />
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <flux:button 
                            variant="outline" 
                            type="button" 
                            onclick="window.location='{{ route('weapons.index') }}'"
                            class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 font-medium"
                        >
                            Cancel
                        </flux:button>
                        <flux:button 
                            type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 font-bold shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            🚀 Deploy Weapon
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>