<?php

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
        Schema::table('users', function (Blueprint $table) {
            // Add cash column with default value of 0.00
            $table->decimal('cash', 10, 2)
                ->default(0.00)
                ->after('role')
                ->comment('User\'s cash balance in the local currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the cash column if it exists
            $table->dropColumn('cash');
        });
    }
};
