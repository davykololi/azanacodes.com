<?php

namespace App\Providers;

use App\Http\ViewComposers\CategoryComposer;
use App\Http\ViewComposers\FooterCategoryComposer;
use App\Http\ViewComposers\TagComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Using class based composers
        View::composer('layouts.app',CategoryComposer::class);
        View::composer('partials.frontend_footer',FooterCategoryComposer::class);
        View::composer('layouts.app',TagComposer::class);
    }
}
