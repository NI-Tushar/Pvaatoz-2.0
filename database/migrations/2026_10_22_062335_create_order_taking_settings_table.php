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
        Schema::create('order_taking_settings', function (Blueprint $table) {
            $table->id();
            
            // Telegram settings
            $table->string('telegram_address')->default('@licytm');
            $table->string('telegram_bot_token')->nullable();
            $table->string('telegram_chat_id')->nullable();
            $table->boolean('is_telegram_enabled')->default(true);

            // Discord settings
            $table->string('discord_address')->default('lucytm1');
            $table->text('discord_webhook_url')->nullable();
            $table->boolean('is_discord_enabled')->default(true);

            // Email settings
            $table->string('email_address')->default('nitushar06@gmail.com');
            $table->boolean('is_email_enabled')->default(true);

            $table->timestamps();
        });

        // Insert initial default settings row
        \Illuminate\Support\Facades\DB::table('order_taking_settings')->insert([
            'telegram_address' => '@licytm',
            'discord_address' => 'lucytm1',
            'email_address' => 'nitushar06@gmail.com',
            'is_telegram_enabled' => true,
            'is_discord_enabled' => true,
            'is_email_enabled' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_taking_settings');
    }
};
