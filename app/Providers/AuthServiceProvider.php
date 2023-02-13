<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('all', fn($user) => in_array($user->role ,['admin','editor','author','contributer']));
        Gate::define('author', fn($user) => in_array($user->role ,['admin','editor','author']));
        Gate::define('editor', fn($user) => in_array($user->role ,['admin','editor']));
        Gate::define('admin', fn($user) => $user->role == 'admin');
    }
}
