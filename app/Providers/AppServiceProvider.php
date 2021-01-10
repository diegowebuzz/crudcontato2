<?php

namespace App\Providers;

use App\Repositorios\ContatosRepositorio;
use App\Repositorios\EloquentContatos;
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
        $this->app->singleton(ContatosRepositorio::class, EloquentContatos::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
