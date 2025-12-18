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
        $products = DB::table('products')->whereNotNull('brand_id')->get();
        
        foreach ($products as $product) {
            DB::table('brand_product')->insert([
                'product_id' => $product->id,
                'brand_id' => $product->brand_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('brand_product')->truncate();
    }
};
