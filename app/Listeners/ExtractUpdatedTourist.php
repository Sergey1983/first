<?php

namespace App\Listeners;

use App\Events\TouristUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Http\Controllers\ToursController;


class ExtractUpdatedTourist
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TouristUpdated  $event
     * @return void
     */
    public function handle(TouristUpdated $event)
    {
        dump($event);

    }
}
