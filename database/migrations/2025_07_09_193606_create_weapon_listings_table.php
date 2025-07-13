<?php

use App\Models\Weapon;
use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weapon_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Weapon::class)
                ->constrained('weapons')
                ->onDelete('cascade');
            $table->foreignIdFor(Country::class)
                ->constrained()
                ->onDelete('cascade');
            $table->enum('marketType' , ['national', 'international'])
                ->default('national');
            $table->boolean('is_available')
                ->default(true);
            $table->decimal('price', 10, 2)
                ->default(0.00)
                ->comment('Price in the local currency of the country');
            $table->integer('quantity')
                ->default(0);    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapon_listings');
    }
};
