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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->string('order_number')->unique()->index();
                $table->unsignedBigInteger('user_id')->nullable()->index();
                $table->string('customer_name');
                $table->string('customer_email')->index();
                $table->string('customer_phone')->nullable();
                $table->text('notes')->nullable();
                $table->string('payment_method')->default('usdt_trc20');
                $table->string('payment_status')->default('pending')->index(); // pending, paid, failed, refunded
                $table->string('status')->default('pending')->index(); // pending, processing, completed, cancelled
                $table->integer('total_quantity')->default(1);
                $table->decimal('total_price', 10, 2)->default(0.00);
                $table->longText('delivery_credentials')->nullable();
                $table->text('admin_notes')->nullable();
                $table->string('ip_address')->nullable();
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            });
        }

        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('order_id')->index();
                $table->unsignedBigInteger('product_id')->nullable()->index();
                $table->string('product_name');
                $table->string('category')->nullable();
                $table->string('tag')->nullable();
                $table->integer('quantity')->default(1);
                $table->decimal('unit_price', 10, 2)->default(0.00);
                $table->decimal('subtotal', 10, 2)->default(0.00);
                $table->string('product_logo')->nullable();
                $table->timestamps();

                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
