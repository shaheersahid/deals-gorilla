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
        // Drop the old product_variants table
        Schema::dropIfExists('product_variants');

        // Create new flexible product_variants table
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('sku')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_price', 10, 2)->nullable(); // Original/strike-through price
            $table->decimal('cost_price', 10, 2)->nullable(); // Cost for profit calculation
            $table->integer('stock')->default(0);
            $table->string('barcode')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');

        // Recreate original structure
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('size');
            $table->string('color_code');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }
};
