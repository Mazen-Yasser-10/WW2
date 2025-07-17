<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Cart;
use App\Models\WeaponListing;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cart::class)
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(WeaponListing::class)
                ->constrained()
                ->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2)
                ->default(0.00);   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
