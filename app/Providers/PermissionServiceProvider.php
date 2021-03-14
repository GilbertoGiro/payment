<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        Validator::extend('can', function ($attribute, $value, $parameters) {
            return boolval(app(UserRepository::class)->hasPermission($value, $parameters));
        });
    }
}
