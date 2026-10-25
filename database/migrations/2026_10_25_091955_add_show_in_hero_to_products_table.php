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
            $table->boolean('show_in_hero')->default(false)->after('status');
        });

        // Initialize the first 12 active products as enabled for hero showcase
        \Illuminate\Support\Facades\DB::table('products')
            ->where('status', 'active')
            ->orderBy('id', 'asc')
            ->limit(12)
            ->update(['show_in_hero' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('show_in_hero');
        });
    }
};
