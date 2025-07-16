<x-layouts.app :title="__('Weapon details')">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800 py-8 mb-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-2">Weapon Details</h1>
                <p class="text-gray-300">Military Equipment Specification</p>
            </div>
        </div>
    </div>
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

    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-gray-800 border border-gray-700 overflow-hidden shadow-xl rounded-lg">
        <div class="px-6 py-8">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ $weapon->name }}</h2>
                        <p class="text-gray-400">{{ $weapon->country->name }} • {{ $weapon->weapon->weaponType->name }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <flux:button variant="ghost" href="{{ route('weapons.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white border-gray-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Market
                    </flux:button>
                    @if(auth()->user()->role === 'admin')
                        <flux:button variant="primary" href="{{ route('weapons.edit', $weapon) }}" class="bg-blue-600 hover:bg-blue-700">
                            Edit Weapon
                        </flux:button>
                    @endif
                </div>
            </div>

            <!-- Weapon Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Weapon Image -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                        <div class="aspect-square bg-gray-600 rounded-lg flex items-center justify-center mb-4">
                            @if($weapon->weapon->image)
                                <img src="{{ $weapon->weapon->image }}" alt="{{ $weapon->weapon->name }}" 
                                     class="w-40 h-40 object-cover rounded-lg"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            @else
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="text-sm">{{ $weapon->weapon->name }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-600">
                                <span class="text-gray-400">Price</span>
                                <span class="text-green-400 font-bold text-lg">${{ number_format($weapon->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-600">
                                <span class="text-gray-400">Available</span>
                                <span class="text-blue-400 font-semibold">{{ $weapon->quantity }} units</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-400">Status</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $weapon->is_available ? 'bg-green-900 text-green-200' : 'bg-red-900 text-red-200' }}">
                                    {{ $weapon->is_available ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Weapon Information -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                        <h3 class="text-xl font-semibold text-white mb-4">Weapon Specifications</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-400">Weapon Type</dt>
                                    <dd class="mt-1 text-lg text-white font-semibold">{{ $weapon->weapon->weaponType->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-400">Country of Origin</dt>
                                    <dd class="mt-1 text-lg text-white font-semibold">{{ $weapon->country->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-400">Currency</dt>
                                    <dd class="mt-1 text-lg text-white font-semibold">{{ $weapon->country->currency }}</dd>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-400">Listing ID</dt>
                                    <dd class="mt-1 text-lg text-white font-mono">#{{ $weapon->id }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-400">Market Access</dt>
                                    <dd class="mt-1">
                                        @if(auth()->user()->role === 'government')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-900 text-green-200">
                                                Government Access
                                            </span>
                                        @elseif(auth()->user()->role === 'general')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-900 text-blue-200">
                                                International Access
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-900 text-purple-200">
                                                Administrator Access
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($weapon->weapon->description)
                        <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                            <h3 class="text-xl font-semibold text-white mb-4">Description</h3>
                            <p class="text-gray-300 leading-relaxed">{{ $weapon->weapon->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Purchase Section -->
            <div class="bg-gray-700 rounded-lg p-6 border border-gray-600">
                <h3 class="text-xl font-semibold text-white mb-6">Purchase Options</h3>
                
                @if($weapon->is_available && $weapon->quantity > 0)
                    <div class="bg-gray-800 rounded-lg p-6 border border-gray-600">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h4 class="text-lg font-semibold text-white">Available Listing</h4>
                                <p class="text-gray-400">Direct purchase from military supplier</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-green-400">${{ number_format($weapon->price, 2) }}</div>
                                <div class="text-sm text-gray-400">per unit</div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="text-center p-3 bg-gray-700 rounded-lg">
                                <div class="text-lg font-semibold text-white">{{ $weapon->quantity }}</div>
                                <div class="text-sm text-gray-400">Units Available</div>
                            </div>
                            <div class="text-center p-3 bg-gray-700 rounded-lg">
                                <div class="text-lg font-semibold text-white">{{ $weapon->country->name }}</div>
                                <div class="text-sm text-gray-400">Origin Country</div>
                            </div>
                            <div class="text-center p-3 bg-gray-700 rounded-lg">
                                <div class="text-lg font-semibold text-green-400">In Stock</div>
                                <div class="text-sm text-gray-400">Status</div>
                            </div>
                        </div>

                        @php
                            $canPurchase = false;
                            switch(auth()->user()->role) {
                                case 'government':
                                    $canPurchase = $weapon->weapon->country_id === auth()->user()->country_id;
                                    break;
                                case 'general':
                                    $canPurchase = $weapon->weapon->country_id !== auth()->user()->country_id;
                                    break;
                                case 'admin':
                                    $canPurchase = true;
                                    break;
                            }
                        @endphp

                        @if($canPurchase)
                            <form action="{{ route('cart.add', $weapon) }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="weapon_listing_id" value="{{ $weapon->id }}">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <label for="quantity" class="block text-sm font-medium text-gray-300 mb-2">Quantity</label>
                                        <select name="quantity" id="quantity" class="w-full bg-gray-600 border border-gray-500 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @for($i = 1; $i <= min(10, $weapon->quantity); $i++)
                                                <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'unit' : 'units' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Total Price</label>
                                        <div class="bg-gray-600 border border-gray-500 rounded-lg px-4 py-3">
                                            <span id="totalPrice" class="text-xl font-bold text-green-400">${{ number_format($weapon->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0h3m9 0v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2-2v6"></path>
                                    </svg>
                                    Add to Cart
                                </button>
                            </form>

                            <script>
                                document.getElementById('quantity').addEventListener('change', function() {
                                    const quantity = this.value;
                                    const unitPrice = {{ $weapon->price }};
                                    const totalPrice = quantity * unitPrice;
                                    document.getElementById('totalPrice').textContent = '$' + totalPrice.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                                });
                            </script>
                        @else
                            <div class="text-center py-6 bg-red-900/20 border border-red-800 rounded-lg">
                                <svg class="w-12 h-12 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.996-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <h4 class="text-lg font-semibold text-red-300 mb-2">Access Restricted</h4>
                                <p class="text-red-400">
                                    @if(auth()->user()->role === 'government')
                                        Government users can only purchase domestic weapons from {{ auth()->user()->country->name }}.
                                    @else
                                        General users can only purchase weapons from foreign countries.
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-600/50 border border-gray-600 rounded-lg">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-2.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                        </svg>
                        <h4 class="text-lg font-semibold text-gray-300 mb-2">Out of Stock</h4>
                        <p class="text-gray-400">This weapon is currently not available for purchase.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</x-layouts.app>