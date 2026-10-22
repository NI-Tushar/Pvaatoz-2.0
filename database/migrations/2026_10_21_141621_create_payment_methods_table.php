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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // usdt_trc20, usdc_erc20, solana, btc
            $table->string('name');
            $table->string('currency', 10);
            $table->string('network')->nullable();
            $table->string('icon')->nullable();
            $table->text('wallet_address')->nullable();
            $table->text('api_key')->nullable();
            $table->text('api_secret')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('ipn_secret')->nullable();
            $table->string('qr_code')->nullable();
            $table->text('instructions')->nullable();
            $table->decimal('exchange_rate', 16, 8)->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->json('extra_settings')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
