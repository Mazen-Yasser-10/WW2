<x-layouts.app :title="__('Shopping Cart')">
    <div class="min-h-screen bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-900/50 border border-red-800 text-red-300 px-6 py-4 rounded-xl mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">🛒 Your Arsenal Cart</h1>
                <p class="text-gray-400">Review your selected weapons before deployment</p>
                @if(isset($selectedCountry))
                    <div class="flex justify-center mt-3">
                        <span class="text-xs bg-blue-900 text-blue-200 px-3 py-1 rounded-full">
                            💱 Prices displayed in {{ ucfirst(str_replace('_', ' ', $selectedCountry)) }} Currency
                        </span>
                    </div>
                @endif
            </div>

            @if($cartItems->isEmpty())
                <div class="bg-gray-800 rounded-2xl shadow-2xl p-12 text-center">
                    <div class="w-32 h-32 mx-auto mb-6 bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 1.5M7 13l1.5 1.5M13 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4">Your Cart is Empty</h2>
                    <p class="text-gray-400 mb-8">No weapons selected for your mission yet.</p>
                    <a href="{{ route('weapons.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                        </svg>
                        Browse Weapons Marketplace
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        @foreach($cartItems as $cart)
                            @foreach($cart->orders as $order)
                                <div class="bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 overflow-hidden hover:border-gray-600 transition-all duration-300">
                                    <div class="p-6">
                                        <div class="flex items-center space-x-6">
                                            <div class="w-24 h-24 bg-gradient-to-br from-gray-700 to-gray-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                </svg>
                                            </div>

                                            <!-- Weapon Details -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-start justify-between">
                                                    <div>
                                                        <h3 class="text-xl font-bold text-white mb-2">{{ $order->weaponListing->weapon->name }}</h3>
                                                        <div class="space-y-1">
                                                            <div class="flex items-center text-sm text-gray-400">
                                                                <span class="inline-flex items-center px-2 py-1 rounded bg-blue-900/50 text-blue-300 mr-2">
                                                                    {{ $order->weaponListing->weapon->weaponType->name }}
                                                                </span>
                                                                <span class="inline-flex items-center px-2 py-1 rounded bg-green-900/50 text-green-300">
                                                                    🌍 {{ $order->weaponListing->country->name }}
                                                                </span>
                                                            </div>
                                                            <p class="text-gray-400 text-sm">Market: 
                                                                <span class="font-medium text-gray-300">{{ ucfirst($order->weaponListing->market_type) }}</span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <!-- Remove Item -->
                                                    <form action="{{ route('cart.remove', $order->id) }}" method="POST" class="ml-4">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-red-400 hover:text-red-300 p-2 rounded-lg hover:bg-red-900/20 transition-all duration-200"
                                                                onclick="return confirm('Remove this weapon from cart?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Quantity and Price -->
                                                <div class="mt-4 flex items-center justify-between">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex items-center space-x-2">
                                                            <span class="text-gray-400 text-sm">Quantity:</span>
                                                            <span class="bg-gray-700 px-3 py-1 rounded-lg text-white font-medium">{{ $order->quantity }}</span>
                                                        </div>
                                                        <div class="text-sm text-gray-400">
                                                            {{ $order->unit_local_price }} × {{ $order->quantity }}
                                                            <div class="text-xs">${{ number_format($order->weaponListing->price, 2) }} USD each</div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-2xl font-bold text-green-400">
                                                            {{ $order->local_price }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">${{ number_format($order->total_price, 2) }} USD</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 p-6 sticky top-8">
                            <h2 class="text-2xl font-bold text-white mb-6">📋 Order Summary</h2>
                            
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-gray-400">
                                    <span>Total Items:</span>
                                    <span class="font-medium text-white">{{ $totalItems }}</span>
                                </div>
                                <div class="flex justify-between text-gray-400">
                                    <span>Subtotal:</span>
                                    <div class="text-right">
                                        <span class="font-medium text-white">{{ $totalLocalAmount }}</span>
                                        <div class="text-xs text-gray-500">${{ number_format($totalAmount, 2) }} USD</div>
                                    </div>
                                </div>
                                <div class="flex justify-between text-gray-400">
                                    <span>Shipping:</span>
                                    <span class="font-medium text-green-400">FREE</span>
                                </div>
                                <div class="border-t border-gray-700 pt-4">
                                    <div class="flex justify-between">
                                        <span class="text-xl font-bold text-white">Total:</span>
                                        <div class="text-right">
                                            <span class="text-2xl font-bold text-green-400">{{ $totalLocalAmount }}</span>
                                            <div class="text-xs text-gray-500">${{ number_format($totalAmount, 2) }} USD</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <form action="{{ route('cart.checkout') }}" method="GET" class="w-full">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 font-bold text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                                        🚀 Proceed to Checkout
                                    </button>
                                </form>

                                <button onclick="window.location='{{ route('weapons.index') }}'" 
                                        class="w-full bg-gray-700 text-gray-300 px-6 py-3 rounded-xl hover:bg-gray-600 transition-all duration-200 font-medium">
                                    ← Continue Shopping
                                </button>

                                <form action="{{ route('cart.clear') }}" method="POST" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full bg-red-900/50 text-red-400 px-6 py-3 rounded-xl hover:bg-red-900/70 transition-all duration-200 font-medium border border-red-800"
                                            onclick="return confirm('Are you sure you want to clear your entire cart?')">
                                        🗑️ Clear Cart
                                    </button>
                                </form>
                            </div>

                            <!-- Security Notice -->
                            <div class="mt-6 p-4 bg-blue-900/20 rounded-xl border border-blue-800">
                                <div class="flex items-center space-x-2 text-blue-300 text-sm">
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <span>Secure military-grade encryption protected</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>