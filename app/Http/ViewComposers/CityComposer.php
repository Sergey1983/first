<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Cities;


class CityComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $cities;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...


        $cities = Cities::all()->pluck('city', 'city');
        
        $this->cities = $cities;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('cities', $this->cities);
    }
}