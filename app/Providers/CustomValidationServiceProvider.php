<?php

namespace App\Providers;

use App\Repositories\AccountRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        // Float validation
        Validator::extend('float', function ($attribute, $value, $parameters) {
            return is_numeric($value) && is_float((float) $value);
        });
        // Check if two parameters are not equal
        Validator::extend('not_equal_to', function ($attribute, $value, $parameters) {
            return $value !== request()->get(current($parameters));
        });
        // Validator to check if user has sufficient balance for transference with given parameter value
        Validator::extend('has_balance', function ($attribute, $value, $parameters) {
            return app(AccountRepository::class)->findBy(['user_id' => $value])->balance >= request()->get(current($parameters));
        });
    }
}
