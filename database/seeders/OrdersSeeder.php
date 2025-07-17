<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\WeaponListing;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'general')->get();
        $weaponListings = WeaponListing::where('is_available', true)
            ->where('quantity', '>', 0)
            ->get();

        // Create completed orders for about 50% of general users
        $usersWithOrders = $users->random(ceil($users->count() * 0.5));

        foreach ($usersWithOrders as $user) {
            // Each user gets 1-3 completed orders (separate carts)
            $numOrders = rand(1, 3);

            for ($i = 0; $i < $numOrders; $i++) {
                // Create a cart for this completed order
                $cart = Cart::create([
                    'user_id' => $user->id,
                    'status' => 'submitted', // This represents a completed order
                ]);

                // Add 1-3 items to this order
                $numItems = rand(1, 3);
                $selectedListings = $weaponListings->random(min($numItems, $weaponListings->count()));

                foreach ($selectedListings as $listing) {
                    $quantity = rand(1, min(5, $listing->quantity));
                    
                    Order::create([
                        'cart_id' => $cart->id,
                        'weapon_listing_id' => $listing->id,
                        'quantity' => $quantity,
                        'total_price' => $listing->price * $quantity,
                    ]);
                }
            }
        }
    }
}
