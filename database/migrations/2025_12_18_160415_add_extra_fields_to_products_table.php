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
            $table->decimal('deal_price', 10, 2)->nullable()->after('deal_enabled');
            $table->decimal('display_price', 10, 2)->nullable()->after('deal_price');
            $table->decimal('percentage_off', 5, 2)->nullable()->after('display_price');
            $table->boolean('is_out_of_stock')->default(false)->after('is_active');
            $table->integer('sort_order')->default(0)->after('is_out_of_stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['deal_price', 'display_price', 'percentage_off', 'is_out_of_stock', 'sort_order']);
        });
    }
};
