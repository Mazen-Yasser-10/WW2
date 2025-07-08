<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Generated QR Codes</h1>

    @if(count($qrCodes) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($qrCodes as $entry)
                <div class="border p-4 rounded shadow-sm bg-gray-50">
                    <p class="text-sm text-gray-700">Email: {{ $entry['user']['email'] }}</p>
                    <img src="{{ $entry['qr'] }}" alt="QR Code for {{ $entry['user']['name'] }}" class="mt-2 mx-auto" />
                </div>
            @endforeach
        </div>
    @else
        <p>No QR codes found.</p>
    @endif
</div>
