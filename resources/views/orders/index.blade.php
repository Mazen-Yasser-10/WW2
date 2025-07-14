<x-layouts.app :title="__('Orders')">


    @section('content')
        <h1>All Orders</h1>

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Cart ID</th>
                <th>Weapon</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Created At</th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->cart_id }}</td>
                    <td>{{ $order->weapon_listing_id }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
        </table>
    @endsection

</x-layouts.app>
