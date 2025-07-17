<x-layouts.app :title="__('Send Order via Email')">
    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 mb-2">📧 Send Military Order</h1>
                    <p class="text-slate-600">Send weapon orders and payment instructions via secure email</p>
                </div>
                <flux:button variant="outline" href="{{ route('weapons.index') }}" class="border-slate-300 text-slate-700 hover:bg-slate-50">
                    ← Back to Arsenal
                </flux:button>
            </div>
        </div>
        @if ($errors->any())
            <div class="mt-4">
                <div class="bg-red-500 text-white p-4 rounded-lg">
                    <h3 class="font-semibold">Please fix the following errors:</h3>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-gray-800 rounded-2xl shadow-xl border border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-8 py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="text-2xl">📮</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Order Communication</h2>
                        <p class="text-red-100">Send weapon requisitions and financial transfers</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <form action="{{ route('orders.send-email') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-6">
                        <div class="border-l-4 border-red-500 pl-4">
                            <h3 class="text-xl font-semibold text-white mb-1">Recipient Information</h3>
                            <p class="text-gray-400">Select the officer who will receive this order</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">🎯 Select Recipient</label>
                                <select 
                                    name="recipient_user_id" 
                                    required
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200"
                                >
                                    <option value="" class="text-gray-400">Select a recipient...</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" data-email="{{ $user->email }}" class="text-white">
                                            {{ $user->name }} ({{ ucfirst($user->role) }}) - {{ $user->country->name ?? 'Unknown' }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-red-400 text-sm"></span>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">📧 Recipient Email</label>
                                <input 
                                    name="recipient_email" 
                                    type="email"
                                    placeholder="Email will auto-populate"
                                    readonly
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-gray-300 placeholder-gray-400"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="border-l-4 border-blue-500 pl-4">
                            <h3 class="text-xl font-semibold text-white mb-1">Military Requisition</h3>
                            <p class="text-gray-400">Specify weapons and equipment needed</p>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">📋 Order Subject</label>
                                <input 
                                    name="subject" 
                                    value="{{ old('subject') }}"
                                    placeholder="e.g., Urgent: Tank Division Reinforcement Request" 
                                    required 
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                />
                                <span class="text-red-400 text-sm"></span>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">🎖️ Weapons & Equipment List (CSV Format)</label>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-2">
                                    <div class="text-xs font-medium text-blue-800 mb-1">📊 CSV Format Guide:</div>
                                    <div class="text-xs text-blue-600 font-mono">
                                        Weapon Name, Quantity
                                    </div>
                                    <div class="text-xs text-blue-600 mt-1">
                                        Example: M1 Garand, 50
                                    </div>
                                </div>
                                <textarea 
                                    name="weapons_list" 
                                    rows="10"
                                    placeholder="Enter weapons in CSV format (one per line):&#10;&#10;Weapon Name, Quantity&#10;M1 Garand, 50&#10;Tiger I Tank, 5&#10;Thompson SMG, 25&#10;Ammunition Crate, 100&#10;Medical Kit, 15&#10;Radio Set, 10&#10;&#10;Use commas to separate: Name, Quantity"
                                    required 
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 resize-none font-mono text-sm"
                                    oninput="updateWeaponsPreview(this.value)"
                                >{{ old('weapons_list') }}</textarea>
                                <span class="text-red-400 text-sm"></span>
                                <div class="flex items-center justify-between text-xs text-gray-400">
                                    <span>📋 Use CSV format for structured data entry</span>
                                    <span id="csv-count" class="font-medium">0 items</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="border-l-4 border-green-500 pl-4">
                            <h3 class="text-xl font-semibold text-white mb-1">Financial Transfer</h3>
                            <p class="text-gray-400">Add funds to recipient's account for procurement</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">💵 Transfer Amount (USD)</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 font-medium">$</span>
                                    <input 
                                        type="number" 
                                        name="cash_amount" 
                                        value="{{ old('cash_amount') }}"
                                        placeholder="0.00" 
                                        step="0.01" 
                                        min="0" 
                                        max="1000000"
                                        required 
                                        class="w-full pl-8 pr-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200"
                                        oninput="updateCashPreview(this.value)"
                                    />
                                </div>
                                <span class="text-red-400 text-sm"></span>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-300">📝 Transfer Purpose</label>
                                <select 
                                    name="transfer_purpose" 
                                    class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200"
                                >
                                    <option value="weapon_procurement" class="text-white">Weapon Procurement</option>
                                    <option value="equipment_upgrade" class="text-white">Equipment Upgrade</option>
                                    <option value="emergency_supplies" class="text-white">Emergency Supplies</option>
                                    <option value="maintenance_fund" class="text-white">Maintenance Fund</option>
                                    <option value="operation_budget" class="text-white">Operation Budget</option>
                                </select>
                            </div>
                        </div>

                        <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-300">Your Current Balance:</span>
                                    <span class="text-lg font-bold text-green-400">${{ number_format(auth()->user()->cash ?? 0, 2) }}</span>
                                </div>
                                <div id="balance-after" class="text-sm text-gray-400">
                                    After transfer: ${{ number_format(auth()->user()->cash ?? 0, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="border-l-4 border-purple-500 pl-4">
                            <h3 class="text-xl font-semibold text-white mb-1">Additional Instructions</h3>
                            <p class="text-gray-400">Include any special orders or tactical information</p>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-300">📄 Message Body</label>
                            <textarea 
                                name="message_body" 
                                rows="6"
                                placeholder="Additional instructions, tactical information, deployment details, or special requirements...&#10;&#10;Include:&#10;- Deployment timeline&#10;- Priority levels&#10;- Special handling instructions&#10;- Contact information for coordination"
                                class="w-full px-4 py-3 bg-gray-700 border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 resize-none"
                            >{{ old('message_body') }}</textarea>
                            <div class="text-xs text-gray-400">
                                Optional: Add any strategic details or coordination requirements.
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-600">
                        <button 
                            type="button" 
                            onclick="window.location='{{ route('weapons.index') }}'"
                            class="px-6 py-3 border-2 border-gray-500 text-gray-300 bg-gray-700 rounded-lg hover:bg-gray-600 transition-all duration-200 font-medium"
                        >
                            ↩️ Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 font-bold shadow-lg hover:shadow-xl transform hover:scale-105"
                        >
                            <span class="flex items-center space-x-2">
                                <span>📧</span>
                                <span>Send Order</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('select[name="recipient_user_id"]').addEventListener('change', function(e) {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const email = selectedOption.getAttribute('data-email');
            document.querySelector('input[name="recipient_email"]').value = email || '';
            
            document.getElementById('preview-recipient').textContent = selectedOption.text || 'Select recipient...';
        });

        // Update cash preview
        function updateCashPreview(amount) {
            const currentBalance = {{ auth()->user()->cash ?? 0 }};
            const transferAmount = parseFloat(amount) || 0;
            const balanceAfter = currentBalance - transferAmount;
            
            document.getElementById('balance-after').textContent = `After transfer: $${balanceAfter.toFixed(2)}`;
            document.getElementById('preview-amount').textContent = `$${transferAmount.toFixed(2)}`;
            
            // Warning if insufficient funds
            if (balanceAfter < 0) {
                document.getElementById('balance-after').className = 'text-sm text-red-400 font-medium';
                document.getElementById('balance-after').textContent = `⚠️ Insufficient funds! Deficit: $${Math.abs(balanceAfter).toFixed(2)}`;
            } else {
                document.getElementById('balance-after').className = 'text-sm text-gray-400';
            }
        }

        document.querySelector('input[name="subject"]').addEventListener('input', function(e) {
            document.getElementById('preview-subject').textContent = e.target.value || 'Enter subject...';
        });

        function updateWeaponsPreview(csvText) {
            const lines = csvText.split('\n').filter(line => line.trim() !== '');
            const previewContainer = document.getElementById('preview-weapons');
            const countElement = document.getElementById('csv-count');
            
            if (lines.length === 0) {
                previewContainer.innerHTML = '<div class="bg-white border border-gray-200 rounded p-2"><div class="text-xs text-gray-500">No weapons specified...</div></div>';
                countElement.textContent = '0 items';
                return;
            }
            
            let tableHTML = `
                <div class="bg-white border border-gray-200 rounded overflow-hidden">
                    <div class="bg-gray-50 px-3 py-2 border-b">
                        <div class="grid grid-cols-2 gap-4 text-xs font-medium text-gray-600">
                            <div>Weapon Name</div>
                            <div>Quantity</div>
                        </div>
                    </div>
                    <div class="max-h-32 overflow-y-auto">
            `;
            
            let validItems = 0;
            lines.forEach((line, index) => {
                const columns = line.split(',').map(col => col.trim());
                if (columns.length >= 2) {
                    validItems++;
                    const [weapon, qty] = columns;
                    
                    tableHTML += `
                        <div class="grid grid-cols-2 gap-4 p-3 text-sm border-b border-gray-100 hover:bg-gray-50">
                            <div class="font-medium text-gray-800" title="${weapon || 'N/A'}">${weapon || 'N/A'}</div>
                            <div class="font-bold text-blue-600">${qty || 'N/A'}</div>
                        </div>
                    `;
                }
            });
            
            tableHTML += `
                    </div>
                </div>
            `;
            
            previewContainer.innerHTML = tableHTML;
            countElement.textContent = `${validItems} items`;
        }

        document.querySelector('textarea[name="weapons_list"]').addEventListener('input', function(e) {
            updateWeaponsPreview(e.target.value);
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = document.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<span class="flex items-center space-x-2"><span>⏳</span><span>Sending...</span></span>';
            submitBtn.disabled = true;
        });
    </script>
</x-layouts.app>
