<x-layouts.app :title="__('My Orders')">
    <div class="min-h-screen bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">📋 Military Orders Command</h1>
                    <p class="text-gray-400">Monitor and manage all operational deployments</p>
                </div>
                <a href="{{ route('orders.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 font-bold shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to orders
                </a>
            </div>
            @if($orders->isEmpty())
                <div class="bg-gray-800 rounded-2xl shadow-2xl p-12 text-center border border-gray-700">
                    <div class="w-32 h-32 mx-auto mb-6 bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-4">No Active Orders</h2>
                    <p class="text-gray-400 mb-8">No military operations have been deployed yet.</p>
                </div>
            @else
                <div class="bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 overflow-hidden">
                    
                    <div class="bg-gradient-to-r from-red-800 to-red-900 px-8 py-6">
                        
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            ⚔️ Active Operations
                            
                            <span class="ml-4 bg-red-700 text-red-100 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $orders->count() }} Orders
                            </span>
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                        Operation ID
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                        Commander
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                        Weapon System
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                        Deployment
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                        Cost
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                        Date Deployed
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-700/50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                                    <span class="text-white font-bold text-sm">#{{ $order->id }}</span>
                                                </div>
                                                <div>
                                                    <p class="text-white font-medium">Order #{{ $order->id }}</p>
                                                    <p class="text-gray-400 text-sm">Cart: #{{ $order->cart_id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center mr-3">
                                                    <span class="text-white text-sm font-bold">
                                                        {{ substr($order->cart->user->name ?? 'U', 0, 1) }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="text-white font-medium">{{ $order->cart->user->name ?? 'Unknown' }}</p>
                                                    <p class="text-gray-400 text-sm">{{ $order->cart->user->role ?? 'User' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div>
                                                <p class="text-white font-medium">{{ $order->weaponListing->weapon->name ?? 'Unknown Weapon' }}</p>
                                                <div class="flex items-center space-x-2 mt-1">
                                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-blue-900/50 text-blue-300">
                                                        {{ $order->weaponListing->weapon->weaponType->name ?? 'Unknown Type' }}
                                                    </span>
                                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-900/50 text-green-300">
                                                        🌍 {{ $order->weaponListing->country->name ?? 'Unknown' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-white font-bold text-lg">{{ $order->quantity }}</div>
                                                <span class="text-gray-400 ml-2">units</span>
                                            </div>
                                            <p class="text-gray-400 text-sm">
                                                ${{ number_format($order->weaponListing->price ?? 0, 2) }} each
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-2xl font-bold text-green-400">
                                                ${{ number_format($order->total_price, 2) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-900/50 text-green-300 border border-green-800">
                                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                                Deployed
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <p class="text-gray-400 text-sm">{{ $order->created_at->format('H:i') }} • {{ $order->created_at->diffForHumans() }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gray-700/50 px-8 py-4 border-t border-gray-600">
                        <div class="flex items-center justify-between">
                            <div class="text-gray-400 text-sm">
                                Total Operations: <span class="text-white font-medium">{{ $orders->count() }}</span>
                            </div>
                            <div class="text-gray-400 text-sm">
                                Total Investment: <span class="text-green-400 font-bold">${{ number_format($orders->sum('total_price'), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
