<div class="inline-flex items-center bg-gradient-to-r from-green-800 to-green-900 rounded-xl px-4 py-2 border border-green-700 shadow-lg">
    <div class="flex items-center space-x-3">
        <!-- Currency Symbol -->
        <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
            @php
                $converter = new \App\Services\CurrencyConverter();
                $symbol = $converter->getCurrencySymbol(auth()->user()->country->name);
            @endphp
            <span class="text-white text-lg">{{ $symbol }}</span>
        </div>
        
        <!-- Balance Info -->
        <div class="flex flex-col">
            <span class="text-xs text-green-300 font-medium">War Funds</span>
            <span class="text-lg font-bold text-white">{{ auth()->user()->getFormattedCashAttribute($symbol) }}</span>
            @if(auth()->user()->country)
                <span class="text-xs text-green-400">{{ in_array(auth()->user()->country->name, ['Switzerland', 'Germany', 'Soviet Union', 'England','United Kingdom']) ? auth()->user()->country->name : 'United States' }} Currency</span>
            @endif
        </div>
        
        <!-- Quick Actions -->
        <div class="flex items-center space-x-1 ml-2">
            <button onclick="showAddFundsModal()" 
                    class="w-6 h-6 bg-green-600 hover:bg-green-500 rounded flex items-center justify-center transition-colors duration-200" 
                    title="Add Funds">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Add Funds Modal (hidden by default) -->
<div id="addFundsModal" class="fixed inset-0 bg-black bg-opacity-90 backdrop-blur-md hidden z-50 flex items-center justify-center p-4">
    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6 w-full max-w-sm mx-auto shadow-2xl transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-white mb-2">💰 Add War Funds</h3>
            <p class="text-gray-400 text-sm">Increase your operational budget
                @if(auth()->user()->country)
                    ({{ in_array(auth()->user()->country->name, ['Switzerland', 'Germany', 'Soviet Union', 'England','United Kingdom']) ? auth()->user()->country->name : 'United States' }} Currency)
                @endif
            </p>
        </div>
        
        <form action="{{ route('user.add-funds') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Amount @if(auth()->user()->country && auth()->user()->country->currency)
                            ({{ in_array(auth()->user()->country->name, ['Switzerland', 'Germany', 'Soviet Union', 'England','United Kingdom']) ? auth()->user()->country->name : 'United States' }} Currency)
                        @else
                            ($)
                        @endif
                    </label>
                    <input type="number" 
                           name="amount" 
                           step="0.01" 
                           min="1" 
                           max="100000" 
                           required 
                           placeholder="Enter amount..."
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200">
                </div>
                
                <!-- Quick Amount Buttons -->
                <div class="grid grid-cols-4 gap-2">
                    @php
                        $converter = new \App\Services\CurrencyConverter();
                        $country = auth()->user()->country->name;
                        $amounts = [100, 500, 1000, 5000];
                    @endphp
                    @foreach($amounts as $amount)
                        @php
                            $convertedAmount = $converter->convert($amount, $country);
                            $symbol = $converter->getCurrencySymbol($country);
                            $displayText = $amount >= 1000 ? 
                                ($symbol === '£' ? $symbol . ($convertedAmount >= 1000 ? number_format($convertedAmount/1000, 1) . 'K' : $convertedAmount) : 
                                ($convertedAmount >= 1000 ? number_format($convertedAmount/1000, 1) . 'K' : $convertedAmount) . ' ' . $symbol) :
                                ($symbol === '£' ? $symbol . $convertedAmount : $convertedAmount . ' ' . $symbol);
                        @endphp
                        <button type="button" onclick="setAmount({{ $convertedAmount }})" class="px-0 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded text-sm transition-colors">{{ $displayText }}</button>
                    @endforeach
                </div>
            </div>
            
            <div class="flex space-x-3 mt-6">
                <button type="button" 
                        onclick="hideAddFundsModal()" 
                        class="flex-1 px-4 py-2 border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">
                    Cancel
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 font-medium">
                    Add Funds
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showAddFundsModal() {
    const modal = document.getElementById('addFundsModal');
    const modalContent = document.getElementById('modalContent');
    
    modal.classList.remove('hidden');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
    
    // Animate modal in
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function hideAddFundsModal() {
    const modal = document.getElementById('addFundsModal');
    const modalContent = document.getElementById('modalContent');
    
    // Animate modal out
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    // Restore body scroll
    document.body.style.overflow = '';
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function setAmount(amount) {
    document.querySelector('input[name="amount"]').value = amount;
}

// Close modal when clicking outside (on backdrop only)
document.getElementById('addFundsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        e.preventDefault();
        e.stopPropagation();
        hideAddFundsModal();
    }
});

// Prevent modal content clicks from closing modal
document.getElementById('modalContent').addEventListener('click', function(e) {
    e.stopPropagation();
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('addFundsModal');
        if (!modal.classList.contains('hidden')) {
            e.preventDefault();
            hideAddFundsModal();
        }
    }
});
</script>
