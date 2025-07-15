<div class="inline-flex items-center bg-gradient-to-r from-green-800 to-green-900 rounded-xl px-4 py-2 border border-green-700 shadow-lg">
    <div class="flex items-center space-x-3">
        <!-- Cash Icon -->
        <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
            </svg>
        </div>
        
        <!-- Balance Info -->
        <div class="flex flex-col">
            <span class="text-xs text-green-300 font-medium">War Funds</span>
            <span class="text-lg font-bold text-white">{{ auth()->user()->formatted_cash }}</span>
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
<div id="addFundsModal" class="fixed inset-0 bg-black bg-opacity-90 backdrop-blur-md hidden z-[99999] flex items-center justify-center p-4" style="position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important;">
    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6 w-full max-w-sm mx-auto shadow-2xl transform transition-all duration-300 scale-95 opacity-0 relative" id="modalContent" style="position: relative !important; z-index: 100000 !important;">
        <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-white mb-2">💰 Add War Funds</h3>
            <p class="text-gray-400 text-sm">Increase your operational budget</p>
        </div>
        
        <form action="{{ route('user.add-funds') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Amount ($)</label>
                    <input type="number" 
                           name="amount" 
                           step="0.01" 
                           min="1" 
                           max="10000" 
                           required 
                           placeholder="Enter amount..."
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200">
                </div>
                
                <!-- Quick Amount Buttons -->
                <div class="grid grid-cols-4 gap-2">
                    <button type="button" onclick="setAmount(100)" class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded text-sm transition-colors">$100</button>
                    <button type="button" onclick="setAmount(500)" class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded text-sm transition-colors">$500</button>
                    <button type="button" onclick="setAmount(1000)" class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded text-sm transition-colors">$1K</button>
                    <button type="button" onclick="setAmount(5000)" class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded text-sm transition-colors">$5K</button>
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
    
    // Prevent any interference with page content
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.zIndex = '99999';
    
    modal.classList.remove('hidden');
    
    // Prevent body scroll and interaction
    document.body.style.overflow = 'hidden';
    document.body.style.position = 'relative';
    
    // Stop event propagation
    modal.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
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
    
    // Restore body scroll and position
    document.body.style.overflow = '';
    document.body.style.position = '';
    
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
