<?php

namespace App\Providers;

use App\Repositories\Contracts\UserRepositorieInterface;
use App\Repositories\Eloquent\EloquentUserRepositoriy;
use App\Repositories\Json\JsonUserRepository;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\ServiceProvider;

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



    public function boot()
    {
        $this->app->bind(UserRepositorieInterface::class, JsonUserRepository::class);
    }

}
