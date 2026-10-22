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

        Admin::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'role' => 'Admin',
                'password' => Hash::make('admin111')
            ]
        );

        \App\Models\Configer::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'AccueVault',
                'logo' => null,
                'logo_two' => null,
                'video' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'companydetail' => 'AccueVault is a trusted provider of genuine PVA accounts for businesses and marketers. We deliver manually created, secure, and high-quality accounts with fast delivery and reliable customer support.',
                'phone' => '+1 (555) 019-2834',
                'email' => 'support@accuevault.com',
                'address' => '123 Market Street, Suite 400, New York, NY 10001',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'youtube' => 'https://youtube.com',
                'instagram' => 'https://instagram.com',
            ]
        );

        if (\App\Models\Product::count() === 0) {
            \App\Models\Product::create([
                'category' => 'social_media',
                'tag' => 'Best Seller',
                'popularity' => 'hot',
                'product_logo' => null,
                'bg_color_1' => '#064e3b',
                'bg_color_2' => '#022c22',
                'product_color' => '#10b981',
                'product_name' => 'Gmail PVA Accounts (Aged)',
                'feature_list' => '100% Phone Verified, Aged 6-12 Months, Recovery Email Included, Worldwide IP Created',
                'product_desc' => 'High quality aged Gmail PVA accounts suitable for email marketing, developer consoles, and social profiles.',
                'status' => 'active',
            ]);

            \App\Models\Product::create([
                'category' => 'social_media',
                'tag' => 'Popular',
                'popularity' => 'popular',
                'product_logo' => null,
                'bg_color_1' => '#1e3a8a',
                'bg_color_2' => '#0f172a',
                'product_color' => '#38bdf8',
                'product_name' => 'Twitter / X PVA Accounts',
                'feature_list' => 'Real Phone Verified, Custom Avatars, Ready to Post, Instant Delivery',
                'product_desc' => 'Verified Twitter/X accounts ready for automation, branding, and marketing campaigns.',
                'status' => 'active',
            ]);
        }


    }
}
