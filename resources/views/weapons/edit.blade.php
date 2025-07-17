<x-layouts.app :title="__('Edit Weapon')">
    <div class="max-w-5xl mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800 mb-2">⚔️ Edit Weapon</h1>
                    <p class="text-slate-600">Update your weapon's specifications and market settings</p>
                </div>
                <flux:button variant="outline" href="{{ route('weapons.index') }}" class="border-slate-300 text-slate-700 hover:bg-slate-50">
                    ← Back to Arsenal
                </flux:button>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-8 py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="text-2xl">🔧</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Weapon Modifications</h2>
                        <p class="text-amber-100">Update your weapon's details and market availability</p>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-black">
                <form action="{{ route('weapons.update', $weapon) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                                <span class="text-xl">⚙️</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-1">Basic Information</h3>
                                <p class="text-gray-600">Modify the core properties of your weapon</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <span>🏷️</span>
                                    <span>Weapon Name</span>
                                </flux:label>
                                <flux:input 
                                    name="name" 
                                    value="{{ old('name', $weapon->name) }}"
                                    placeholder="e.g., M1 Garand, Tiger Tank" 
                                    required 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-200 hover:border-gray-300"
                                />
                                <flux:error name="name" class="text-red-500 text-sm" />
                            </div>

                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <span>🎯</span>
                                    <span>Weapon Type</span>
                                </flux:label>
                                <flux:select 
                                    name="weapon_type_id" 
                                    placeholder="Select weapon category"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-200 hover:border-gray-300"
                                >
                                    @foreach($weaponTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('weapon_type_id', $weapon->weapon_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="weapon_type_id" class="text-red-500 text-sm" />
                            </div>

                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <span>🌍</span>
                                    <span>Manufacturing Country</span>
                                </flux:label>
                                <flux:select 
                                    name="country_id" 
                                    placeholder="Select manufacturing nation"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-200 hover:border-gray-300"
                                >
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id', $weapon->country_id) == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="country_id" class="text-red-500 text-sm" />
                            </div>
                        </div>
                    </div>

                    <!-- Market Configuration Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <span class="text-xl">💰</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-1">Market Configuration</h3>
                                <p class="text-gray-600">Update pricing and availability for the global market</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <span>🌐</span>
                                    <span>Market Availability</span>
                                </flux:label>
                                <flux:select 
                                    name="market_type" 
                                    placeholder="Choose market scope"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 hover:border-gray-300"
                                >
                                    <option value="international" {{ old('market_type', $weapon->weaponListing->market_type ?? '') == 'international' ? 'selected' : '' }}>
                                        🌍 International Market
                                    </option>
                                    <option value="national" {{ old('market_type', $weapon->weaponListing->market_type ?? '') == 'national' ? 'selected' : '' }}>
                                        🏠 National Only
                                    </option>
                                </flux:select>
                                <flux:error name="market_type" class="text-red-500 text-sm" />
                            </div>

                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <span>💵</span>
                                    <span>Unit Price ($)</span>
                                </flux:label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">$</span>
                                    <flux:input 
                                        type="number" 
                                        name="price" 
                                        value="{{ old('price', $weapon->weaponListing->price ?? '') }}"
                                        placeholder="0.00" 
                                        step="0.01" 
                                        min="0" 
                                        required 
                                        class="w-full pl-8 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 hover:border-gray-300"
                                        oninput="updatePricePreview(this.value)"
                                    />
                                </div>
                                <div id="price-preview" class="text-xs text-gray-500 mt-1">
                                    Base price in USD
                                </div>
                                <flux:error name="price" class="text-red-500 text-sm" />
                            </div>

                            <div class="space-y-2">
                                <flux:label class="text-sm font-semibold text-gray-700 flex items-center space-x-2">
                                    <span>📦</span>
                                    <span>Available Quantity</span>
                                </flux:label>
                                <div class="relative">
                                    <flux:input 
                                        type="number" 
                                        name="quantity" 
                                        value="{{ old('quantity', $weapon->weaponListing->quantity ?? '') }}"
                                        placeholder="Stock amount" 
                                        min="1" 
                                        required 
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 hover:border-gray-300"
                                        oninput="updateStockIndicator(this.value)"
                                    />
                                    <div class="mt-2 flex items-center space-x-2">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                                            <div id="stock-bar" class="h-full bg-green-500 rounded-full transition-all duration-300" style="width: {{ min(($weapon->weaponListing->quantity ?? 0) / 100 * 100, 100) }}%"></div>
                                        </div>
                                        <span id="stock-text" class="text-xs text-gray-500">{{ $weapon->weaponListing->quantity ?? 0 }} units</span>
                                    </div>
                                </div>
                                <flux:error name="quantity" class="text-red-500 text-sm" />
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <flux:button 
                            variant="outline" 
                            type="button" 
                            onclick="window.location='{{ route('weapons.show', $weapon) }}'"
                            class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 font-medium hover:border-gray-400 hover:shadow-md"
                        >
                            ↩️ Cancel
                        </flux:button>
                        <flux:button 
                            type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-amber-600 to-amber-700 text-white rounded-lg hover:from-amber-700 hover:to-amber-800 transition-all duration-200 font-bold shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            <span class="flex items-center space-x-2">
                                <span>🔧</span>
                                <span>Update Weapon</span>
                            </span>
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>

<script>
    // Real-time form updates
    function updateStockIndicator(value) {
        const percentage = Math.min((value / 100) * 100, 100);
        document.getElementById('stock-bar').style.width = percentage + '%';
        document.getElementById('stock-text').textContent = `${value} units`;
        document.getElementById('preview-stock').textContent = `📦 ${value} in stock`;
    }

    function updatePricePreview(price) {
        if (!price || price <= 0) {
            document.getElementById('price-preview').textContent = 'Base price in USD';
            document.getElementById('preview-price').textContent = '$0.00';
            return;
        }

        // Currency conversion rates (WWII era)
        const rates = {
            germany: 2.5,
            england: 0.25,
            soviet: 5.3,
            switzerland: 4.3
        };

        // Update currency preview
        document.getElementById('price-germany').textContent = (price * rates.germany).toFixed(2) + ' RM';
        document.getElementById('price-england').textContent = '£' + (price * rates.england).toFixed(2);
        document.getElementById('price-soviet').textContent = (price * rates.soviet).toFixed(2) + ' ₽';
        document.getElementById('price-switzerland').textContent = (price * rates.switzerland).toFixed(2) + ' CHF';
        
        // Update main preview
        document.getElementById('preview-price').textContent = '$' + parseFloat(price).toFixed(2);
    }

    // Update weapon name in preview
    document.querySelector('input[name="name"]').addEventListener('input', function(e) {
        document.getElementById('preview-name').textContent = e.target.value || 'Weapon Name';
    });

    // Update weapon type in preview
    document.querySelector('select[name="weapon_type_id"]').addEventListener('change', function(e) {
        const selectedOption = e.target.options[e.target.selectedIndex];
        document.getElementById('preview-type').textContent = selectedOption.text || 'Unknown Type';
    });

    // Initialize currency preview on page load
    const initialPrice = document.querySelector('input[name="price"]').value;
    if (initialPrice) {
        updatePricePreview(initialPrice);
    }

    // Form validation enhancement
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<span class="flex items-center space-x-2"><span>⏳</span><span>Updating...</span></span>';
        submitBtn.disabled = true;
    });
</script>