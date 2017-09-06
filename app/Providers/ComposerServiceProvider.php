<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{


public function boot()
    {
        // Using class based composers...
        View::composer(
            ['Tours2.tours2_create', 'Tours2.tours2_edit'], 'App\Http\ViewComposers\CreateUpdateViewComposer'
        );

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }


}