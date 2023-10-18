<?php

namespace App\Providers;
use App\Models\Chirp;
use App\Models\User;
use App\Policies\ChirpPolicy;
use Illuminate\Support\Facades\Gate;


// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Chirp::class => ChirpPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('update-chirpe', [ChirpPolicy::class, 'update']);
    }
}
