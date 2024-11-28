<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use App\Models\Medecin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        
        $this->registerPolicies();

        // Définir les guards d'authentification pour les médecins
        Gate::define('isMedecin', function ($user) {
            return $user instanceof Medecin;
        });
    }
}
