<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Paginator::useBootstrap();

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            static $siteConfig = null;
            if ($siteConfig === null) {
                try {
                    $siteConfig = \App\Models\Configer::latest()->first();
                } catch (\Throwable $e) {
                    $siteConfig = null;
                }

                if (!$siteConfig) {
                    $siteConfig = new \App\Models\Configer([
                        'name' => config('app.name', 'AccueVault'),
                        'email' => 'support@accuevault.com',
                        'phone' => '+1 (555) 019-2834',
                        'address' => '123 Market Street, Suite 400, New York, NY 10001',
                        'companydetail' => 'AccueVault is a trusted provider of genuine PVA accounts for businesses and marketers. We deliver manually created, secure, and high-quality accounts with fast delivery and reliable customer support.',
                        'facebook' => 'https://facebook.com',
                        'twitter' => 'https://twitter.com',
                        'youtube' => 'https://youtube.com',
                        'instagram' => 'https://instagram.com',
                        'video' => 'https://www.youtube.com',
                    ]);
                }
            }

            $view->with('configer', $siteConfig);
        });
    }

}
