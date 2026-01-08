<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     SliderSeeder::class,
        // ]);

        // User::create([
        //     'name' => 'User',
        //     'phone' => '01643381009',
        //     'email' => 'user@gmail.com',
        //     'password' => Hash::make('user111')
        // ]);

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('admin111')
        ]);


    }
}
