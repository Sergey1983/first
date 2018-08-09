<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Country;
use App\Operator;
use App\User;
use App\Airport;



class TourSearchViewComposer

{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */

    protected $countries;

    protected $operators;

    protected $managers;

    protected $report_types = ['operator' => 'Туроператоры', 'country' => 'Страны', 'user_id' => 'Менеджеры', 'city_from' => 'Город отправл.', 'tour_type' => 'По продуктам'];

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    
    {
        // Dependencies automatically resolved by service container...
        setlocale(LC_COLLATE, 'ru_RU', 'ru_RU.utf8');

       
        $countries = Airport::all()->sortBy('country')->pluck('country')->unique()->toArray();

        $countries = array_combine($countries, $countries);

        $this->countries = $countries;


        $operators = Operator::orderBy('name')->pluck('name', 'name');

        $this->operators = $operators;


        $managers = array_flip(User::all()->pluck('id', 'name')->toArray() );

        $this->managers = $managers;



    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)

    {


        $data = [


        'countries' => $this->countries, 

        'operators' => $this->operators,

        'managers' => $this->managers,

        'report_types' => $this->report_types

        
        ];


        $view->with($data);
    }
}