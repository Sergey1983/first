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

        View::composer(
            ['Tours2.tours2_table', 'layouts.tours2_table', 'Airports.create_or_update', 'Airports.index'], 'App\Http\ViewComposers\TourSearchViewComposer'
        );

        View::composer(
            ['*'], 'App\Http\ViewComposers\HeadingsViewComposer'
        );

        View::composer(
            ['User.create', 'User.edit', 'Tours2.CreateOrUpdate.*', 'layouts.tours2_table'], 'App\Http\ViewComposers\BranchesViewComposer'
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