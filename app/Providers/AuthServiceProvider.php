<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
   
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
         User::class => UserPolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();
            //haveaccess = name del Gate // User obtiene el usuario logeado
            //$perm comprueba el slug del permissions
        Gate::define('haveaccess', function (User $user, $perm){
            // dd($perm); resive el permisos 
            return $user->havePermission($perm); 
            //return $perm;
        });
    }
}
