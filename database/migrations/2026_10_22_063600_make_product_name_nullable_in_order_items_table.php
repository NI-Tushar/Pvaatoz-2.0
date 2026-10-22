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
        // 1. Make product_name nullable with default in order_items table
        if (Schema::hasTable('order_items')) {
            DB::statement("ALTER TABLE `order_items` MODIFY `product_name` VARCHAR(255) NULL DEFAULT 'Product'");
        }

        // 2. Fix any product in products table that has an empty or null product_name
        if (Schema::hasTable('products')) {
            $emptyProducts = DB::table('products')
                ->whereNull('product_name')
                ->orWhere('product_name', '')
                ->get();

            foreach ($emptyProducts as $p) {
                $newName = !empty($p->tag) ? $p->tag : (!empty($p->category) ? ucwords(str_replace('_', ' ', $p->category)) : 'Product #' . $p->id);
                DB::table('products')->where('id', $p->id)->update(['product_name' => $newName]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('order_items')) {
            DB::statement("ALTER TABLE `order_items` MODIFY `product_name` VARCHAR(255) NOT NULL");
        }
    }
};
