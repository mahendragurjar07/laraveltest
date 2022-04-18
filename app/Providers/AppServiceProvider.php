<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
          
            if (!empty(Auth::guard(request()->guard)->user()->id)) {
                $password = Auth::guard(request()->guard)->user()->password;
               
            }
            return \Illuminate\Support\Facades\Hash::check($value, $password);
        });
    }
}
