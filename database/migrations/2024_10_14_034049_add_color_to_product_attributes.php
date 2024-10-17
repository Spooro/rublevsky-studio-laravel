<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the product_attributes table if it doesn't exist
        if (!Schema::hasTable('product_attributes')) {
            Schema::create('product_attributes', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('display_name');
                $table->timestamps();
            });
        }

        // Now insert the color attribute
        DB::table('product_attributes')->insertOrIgnore([
            'name' => 'color',
            'display_name' => 'Color',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the color attribute
        DB::table('product_attributes')->where('name', 'color')->delete();

        // If you want to drop the entire table when rolling back, uncomment the next line
        // Schema::dropIfExists('product_attributes');
    }
};
