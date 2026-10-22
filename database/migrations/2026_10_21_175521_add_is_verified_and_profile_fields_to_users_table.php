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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'is_verified')) {
                $table->string('is_verified')->default('Verified')->after('user_type');
            }
            if (!Schema::hasColumn('users', 'completion_percentage')) {
                $table->integer('completion_percentage')->default(100)->after('is_verified');
            }
            if (!Schema::hasColumn('users', 'balance')) {
                $table->decimal('balance', 10, 2)->default(0.00)->after('completion_percentage');
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable()->after('balance');
            }
            if (!Schema::hasColumn('users', 'present_address')) {
                $table->string('present_address')->nullable()->after('gender');
            }
            if (!Schema::hasColumn('users', 'present_city')) {
                $table->string('present_city')->nullable()->after('present_address');
            }
            if (!Schema::hasColumn('users', 'present_country')) {
                $table->string('present_country')->nullable()->after('present_city');
            }
            if (!Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('present_country');
            }
            if (!Schema::hasColumn('users', 'nationality')) {
                $table->string('nationality')->nullable()->after('date_of_birth');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'is_verified',
                'completion_percentage',
                'balance',
                'gender',
                'present_address',
                'present_city',
                'present_country',
                'date_of_birth',
                'nationality',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
