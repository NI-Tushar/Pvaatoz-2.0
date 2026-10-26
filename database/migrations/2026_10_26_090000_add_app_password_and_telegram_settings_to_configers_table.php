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
        Schema::table('configers', function (Blueprint $table) {
            if (!Schema::hasColumn('configers', 'app_password')) {
                $table->string('app_password')->nullable()->after('email');
            }
            if (!Schema::hasColumn('configers', 'telegram_bot_token')) {
                $table->string('telegram_bot_token')->nullable()->after('telegram');
            }
            if (!Schema::hasColumn('configers', 'telegram_chat_id')) {
                $table->string('telegram_chat_id')->nullable()->after('telegram_bot_token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('configers', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('configers', 'app_password')) {
                $columnsToDrop[] = 'app_password';
            }
            if (Schema::hasColumn('configers', 'telegram_bot_token')) {
                $columnsToDrop[] = 'telegram_bot_token';
            }
            if (Schema::hasColumn('configers', 'telegram_chat_id')) {
                $columnsToDrop[] = 'telegram_chat_id';
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
