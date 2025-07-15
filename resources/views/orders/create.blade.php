<x-layouts.app :title="__('Create New Order')">
    <div class="min-h-screen bg-gray-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">📋 Create Military Order</h1>
                <p class="text-gray-400">Deploy weapons for strategic operations</p>
            </div>

            <!-- Order Form -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-red-800 to-red-900 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        ⚔️ Order Configuration
                    </h2>
                </div>

                <form action="{{ route('orders.store') }}" method="POST" class="p-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Cart Selection -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Operation Cart</label>
                                <select 
                                    name="cart_id" 
                                    required 
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                >
                                    <option value="">Select operational cart...</option>
                                    @foreach($carts as $cart)
                                        <option value="{{ $cart->id }}">
                                            Cart #{{ $cart->id }} - {{ $cart->user->name ?? 'Unknown User' }} 
                                            ({{ ucfirst($cart->status) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('cart_id')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Weapon Selection -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Weapon System</label>
                                <select 
                                    name="weapon_listing_id" 
                                    required 
                                    id="weapon-select"
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                >
                                    <option value="">Select weapon system...</option>
                                    @foreach($weapons as $weapon)
                                        <option value="{{ $weapon->id }}" 
                                                data-price="{{ $weapon->price }}"
                                                data-stock="{{ $weapon->quantity }}">
                                            {{ $weapon->weapon->name }} - 
                                            {{ $weapon->weapon->weaponType->name }} 
                                            ({{ $weapon->country->name }}) - 
                                            ${{ number_format($weapon->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('weapon_listing_id')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">Deployment Quantity</label>
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    placeholder="Units to deploy" 
                                    min="1" 
                                    required 
                                    id="quantity-input"
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                />
                                @error('quantity')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                                <div id="stock-info" class="text-gray-400 text-sm hidden">
                                    Available stock: <span id="available-stock">0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Order Summary -->
                        <div class="space-y-6">
                            <!-- Order Preview -->
                            <div class="bg-gray-700/50 rounded-xl p-6 border border-gray-600">
                                <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                                    🎯 Mission Summary
                                </h3>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Unit Price:</span>
                                        <span class="text-white font-medium" id="unit-price">$0.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Quantity:</span>
                                        <span class="text-white font-medium" id="quantity-display">0</span>
                                    </div>
                                    <div class="border-t border-gray-600 pt-3">
                                        <div class="flex justify-between">
                                            <span class="text-lg font-bold text-white">Total Cost:</span>
                                            <span class="text-2xl font-bold text-green-400" id="total-price">$0.00</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Weapon Details -->
                                <div id="weapon-details" class="mt-6 p-4 bg-gray-800/50 rounded-lg hidden">
                                    <h4 class="text-white font-medium mb-2">Weapon Specifications:</h4>
                                    <div class="text-sm text-gray-400" id="weapon-info">
                                        Select a weapon to view details
                                    </div>
                                </div>
                            </div>

                            <!-- Mission Notes -->
                            <div class="bg-blue-900/20 rounded-xl p-4 border border-blue-800">
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-blue-300 font-medium text-sm">Mission Guidelines</p>
                                        <p class="text-blue-200 text-sm mt-1">
                                            Ensure weapon compatibility with operational requirements. 
                                            Verify quantity availability before deployment authorization.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-8 border-t border-gray-600 mt-8">
                        <button 
                            type="button" 
                            onclick="window.location='{{ route('orders.index') }}'"
                            class="px-6 py-3 border-2 border-gray-500 text-gray-300 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all duration-200 font-medium"
                        >
                            Cancel Mission
                        </button>
                        <button 
                            type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 font-bold shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            🚀 Deploy Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Dynamic Calculations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const weaponSelect = document.getElementById('weapon-select');
            const quantityInput = document.getElementById('quantity-input');
            const unitPriceDisplay = document.getElementById('unit-price');
            const quantityDisplay = document.getElementById('quantity-display');
            const totalPriceDisplay = document.getElementById('total-price');
            const weaponDetails = document.getElementById('weapon-details');
            const weaponInfo = document.getElementById('weapon-info');
            const stockInfo = document.getElementById('stock-info');
            const availableStock = document.getElementById('available-stock');

            function updateCalculations() {
                const selectedOption = weaponSelect.options[weaponSelect.selectedIndex];
                const quantity = parseInt(quantityInput.value) || 0;
                
                if (selectedOption.value) {
                    const price = parseFloat(selectedOption.dataset.price) || 0;
                    const stock = parseInt(selectedOption.dataset.stock) || 0;
                    const total = price * quantity;
                    
                    unitPriceDisplay.textContent = '$' + price.toFixed(2);
                    quantityDisplay.textContent = quantity;
                    totalPriceDisplay.textContent = '$' + total.toFixed(2);
                    
                    // Show weapon details
                    weaponDetails.classList.remove('hidden');
                    weaponInfo.textContent = selectedOption.textContent;
                    
                    // Show stock info
                    stockInfo.classList.remove('hidden');
                    availableStock.textContent = stock;
                    
                    // Validate quantity against stock
                    if (quantity > stock) {
                        quantityInput.classList.add('border-red-500');
                        quantityInput.classList.remove('border-gray-600');
                    } else {
                        quantityInput.classList.remove('border-red-500');
                        quantityInput.classList.add('border-gray-600');
                    }
                } else {
                    unitPriceDisplay.textContent = '$0.00';
                    quantityDisplay.textContent = '0';
                    totalPriceDisplay.textContent = '$0.00';
                    weaponDetails.classList.add('hidden');
                    stockInfo.classList.add('hidden');
                }
            }

            weaponSelect.addEventListener('change', updateCalculations);
            quantityInput.addEventListener('input', updateCalculations);
        });
    </script>
</x-layouts.app>
