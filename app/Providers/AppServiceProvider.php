<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;  
use Illuminate\Support\Facades\Auth;

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
        // Definisikan Gate untuk admin
        Gate::define('admin', function (User $user) {
            return $user->id_role === 1; // 1: Admin
        });

        // Definisikan Gate untuk owner
        Gate::define('owner', function (User $user) {
            return $user->id_role === 2; // 2: Owner
        });
        
    }
}
