<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @param ViewFactory $view
     */
    public function boot()
    {
        view()->composer('blocks.block-header', 'App\Http\ViewComposers\MenuComposer');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}