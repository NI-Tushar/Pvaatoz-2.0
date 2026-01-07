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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('tag')->nullable();
            $table->enum('popularity', ['hot', 'popular'])->nullable();
            $table->string('product_logo')->nullable();
            // Background gradient class for Tailwind (e.g., from-emerald-500 to-teal-600)
            $table->string('bg_color')->nullable();
            // Product color (used for badges, price, etc.)
            $table->string('product_color')->nullable();
            $table->string('product_name');
            $table->text('product_desc')->nullable();
            $table->json('feature_list')->nullable();
            $table->enum('status', ['active', 'disabled'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
