<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\WeaponListing;
use App\Models\Order;
use Illuminate\Database\Seeder;

class CartsSeeder extends Seeder
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

        // Add cart items for some users (about 30% of general users)
        $usersWithCarts = $users->random(ceil($users->count() * 0.3));

        foreach ($usersWithCarts as $user) {
            // Create a cart for the user
            $cart = Cart::create([
                'user_id' => $user->id,
                'status' => 'open',
            ]);

            // Each user gets 1-5 items in their cart
            $numItems = rand(1, 5);
            $selectedListings = $weaponListings->random(min($numItems, $weaponListings->count()));

            foreach ($selectedListings as $listing) {
                // Create orders (cart items) for this cart
                $quantity = rand(1, min(3, $listing->quantity));
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
