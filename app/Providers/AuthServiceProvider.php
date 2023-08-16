<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public static $permission = [
        'index-user' => ['superadmin', 'admin'],
        'show-user' => ['superadmin', 'admin'],
        'create-user' => ['superadmin'],
        'store-user' => ['superadmin'],
        'edit-user' => ['superadmin'],
        'update-user' => ['superadmin'],
        'destroy-user' => ['superadmin'],
    ];

    /**
     * The policy mappings for the application.
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

        // Digunakan untuk mengeksekusi keadaan sebelum mengecek role user  
        Gate::before(function(User $user) {
            if ($user->role == 'superadmin') {
                return true;
            }
        });

        foreach (self::$permission as $action => $roles) {
            Gate::define($action, function (User $user) use ($roles) {
                if (in_array($user->role, $roles)) {
                    return true;
                }
            });
        }
    }
}
