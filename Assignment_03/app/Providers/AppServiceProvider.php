<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        $this->app->bind('App\Contracts\Dao\MajorDaoInterface', 'App\Dao\MajorDao');
        $this->app->bind('App\Contracts\Services\MajorServiceInterface', 'App\Services\MajorService');

        $this->app->bind('App\Contracts\Dao\StudentDaoInterface', 'App\Dao\StudentDao');
        $this->app->bind('App\Contracts\Services\StudentServiceInterface', 'App\Services\StudentService');

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();

    }
}