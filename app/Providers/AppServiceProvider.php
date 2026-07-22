<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 🚨 TEMPORARY BYPASS: Changed to ID 2 for your Admin account
        Gate::before(function ($user, $ability) {
            if ($user->id === 2) { 
                 
                return true; 
            }
        });
    }
}