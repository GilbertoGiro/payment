<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * PermissionServiceProvider constructor.
     * @param $app
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

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
