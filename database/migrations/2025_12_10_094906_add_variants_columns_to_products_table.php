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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('has_variants')->default(false)->after('is_active');
            $table->decimal('price', 10, 2)->nullable()->after('sku');
            $table->decimal('compare_price', 10, 2)->nullable()->after('price');
            $table->decimal('cost_price', 10, 2)->nullable()->after('compare_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['has_variants', 'price', 'compare_price', 'cost_price']);
        });
    }
};
