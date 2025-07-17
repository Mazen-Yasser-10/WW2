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
        <div class="bg-gray-800 rounded-2xl shadow-xl border border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-8 py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="text-2xl">🔧</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Weapon Modifications</h2>
                        <p class="text-red-100">Update your weapon's details and market availability</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <form action="{{ route('weapons.update', $weapon) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div class="border-l-4 border-red-500 pl-4">
                            <h3 class="text-xl font-semibold text-white mb-1">Basic Information</h3>
                            <p class="text-gray-400">Modify the core properties of your weapon</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">🏷️ Weapon Name</label>
                                <input 
                                    type="text"
                                    name="name" 
                                    value="{{ old('name', $weapon->name) }}"
                                    placeholder="e.g., M1 Garand, Tiger Tank" 
                                    required 
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                />
                                @error('name')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">🎯 Weapon Type</label>
                                <select 
                                    name="weapon_type_id" 
                                    required
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200">
                                    <option value="" class="text-gray-400">Select weapon category</option>
                                    @foreach($weaponTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('weapon_type_id', $weapon->weapon_type_id) == $type->id ? 'selected' : '' }} class="text-white">
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('weapon_type_id')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">🌍 Manufacturing Country</label>
                                <select 
                                    name="country_id" 
                                    required
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200">
                                    <option value="" class="text-gray-400">Select manufacturing nation</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id', $weapon->country_id) == $country->id ? 'selected' : '' }} class="text-white">
                                            🏳️ {{ $country->name }}
                                        </option>
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
                        <div class="border-l-4 border-red-500 pl-4">
                            <h3 class="text-xl font-semibold text-white mb-1">Market Configuration</h3>
                            <p class="text-gray-400">Update pricing and availability for the global market</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">🌐 Market Availability</label>
                                <select 
                                    name="market_type" 
                                    required
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200">
                                    <option value="" class="text-gray-400">Choose market scope</option>
                                    <option value="international" {{ old('market_type', $weapon->weaponListing->market_type ?? '') == 'international' ? 'selected' : '' }} class="text-white">
                                        🌍 International Market
                                    </option>
                                    <option value="national" {{ old('market_type', $weapon->weaponListing->market_type ?? '') == 'national' ? 'selected' : '' }} class="text-white">
                                        🏠 National Only
                                    </option>
                                </select>
                                @error('market_type')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">💵 Unit Price ($)</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">$</span>
                                    <input 
                                        type="number" 
                                        name="price" 
                                        value="{{ old('price', $weapon->weaponListing->price ?? '') }}"
                                        placeholder="0.00" 
                                        step="0.01" 
                                        min="0" 
                                        required 
                                        class="w-full pl-8 pr-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                        oninput="updatePricePreview(this.value)"
                                    />
                                </div>
                                <div id="price-preview" class="text-xs text-gray-400 mt-1">
                                    Base price in USD
                                </div>
                                @error('price')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">📦 Available Quantity</label>
                                <div class="relative">
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        value="{{ old('quantity', $weapon->weaponListing->quantity ?? '') }}"
                                        placeholder="Stock amount" 
                                        min="1" 
                                        required 
                                        class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                        oninput="updateStockIndicator(this.value)"
                                    />
                                    <div class="mt-2 flex items-center space-x-2">
                                        <div class="flex-1 bg-gray-600 rounded-full h-2">
                                            <div id="stock-bar" class="h-full bg-red-500 rounded-full transition-all duration-300" style="width: {{ min(($weapon->weaponListing->quantity ?? 0) / 100 * 100, 100) }}%"></div>
                                        </div>
                                        <span id="stock-text" class="text-xs text-gray-400">{{ $weapon->weaponListing->quantity ?? 0 }} units</span>
                                    </div>
                                </div>
                                @error('quantity')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-700">
                        <button 
                            type="button" 
                            onclick="window.location='{{ route('weapons.show', $weapon) }}'"
                            class="px-6 py-3 bg-gray-700 border-2 border-gray-600 text-gray-300 rounded-lg hover:bg-gray-600 hover:border-gray-500 transition-all duration-200 font-medium"
                        >
                            ↩️ Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 font-bold shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            <span class="flex items-center space-x-2">
                                <span>🔧</span>
                                <span>Update Weapon</span>
                            </span>
                        </button>
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
        if (document.getElementById('preview-stock')) {
            document.getElementById('preview-stock').textContent = `📦 ${value} in stock`;
        }
    }

    function updatePricePreview(price) {
        if (!price || price <= 0) {
            document.getElementById('price-preview').textContent = 'Base price in USD';
            if (document.getElementById('preview-price')) {
                document.getElementById('preview-price').textContent = '$0.00';
            }
            return;
        }

        // Currency conversion rates (WWII era)
        const rates = {
            germany: 2.5,
            england: 0.25,
            soviet: 5.3,
            switzerland: 4.3
        };

        // Update currency preview if elements exist
        if (document.getElementById('price-germany')) {
            document.getElementById('price-germany').textContent = (price * rates.germany).toFixed(2) + ' RM';
            document.getElementById('price-england').textContent = '£' + (price * rates.england).toFixed(2);
            document.getElementById('price-soviet').textContent = (price * rates.soviet).toFixed(2) + ' ₽';
            document.getElementById('price-switzerland').textContent = (price * rates.switzerland).toFixed(2) + ' CHF';
        }
        
        // Update main preview
        if (document.getElementById('preview-price')) {
            document.getElementById('preview-price').textContent = '$' + parseFloat(price).toFixed(2);
        }
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