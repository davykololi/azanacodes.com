<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
        Model::preventLazyLoading(!app()->isProduction());
        DB::whenQueryingForLongerThan(500, function(Connection $connection){
        Log::warning("Database queries exceeded 5 seconds on {$connection->getName()}");
        });
    }
}
