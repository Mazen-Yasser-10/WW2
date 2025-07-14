<x-layouts.app :title="('Create Order')">

@section('content')
    <h1>Create New Order</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        <label for="cart_id">Select Cart:</label>
        <select name="cart_id" required>
            @foreach($carts as $cart)
                <option value="{{ $cart->id }}">Cart #{{ $cart->id }}</option>
            @endforeach
        </select>

        <label for="weapon_listing_id">Select Weapon:</label>
        <select name="weapon_listing_id" required>
            @foreach($weapons as $weapon)
                <option value="{{ $weapon->id }}">{{ $weapon->name }} - ${{ $weapon->price }}</option>
            @endforeach
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" min="1" required>

        <button type="submit">Place Order</button>
    </form>
@endsection

</x-layouts.app>
