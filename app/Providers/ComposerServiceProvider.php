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
            ['Tours.CreateOrEdit.create', 'Tours.CreateOrEdit.edit'], 'App\Http\ViewComposers\CreateUpdateViewComposer'
        );

        View::composer(
            ['Tours.Index.tours_filters', 'Airports.create_or_update', 'Airports.index', 'Statistics.index', 'Statistics.statistics_for_one'], 'App\Http\ViewComposers\TourSearchViewComposer'
        );

        View::composer(
            ['*'], 'App\Http\ViewComposers\HeadingsViewComposer'
        );

        View::composer(
            ['User.create', 'User.edit', 'Tours.CreateOrEdit.*', 'Tours.Index.tours_filters'], 'App\Http\ViewComposers\BranchesViewComposer'
        );

        View::composer(
            ['PayMethods.*', 'Payment.Tourist.*'], 'App\Http\ViewComposers\PayMethodViewComposer'
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