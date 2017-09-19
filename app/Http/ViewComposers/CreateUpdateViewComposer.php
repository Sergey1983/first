<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Cities;
use App\Country;
use App\Food;
use App\Operator;
use App\Airport;



class CreateUpdateViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $cities;

    protected $countries;

    protected $food_type;

    protected $operators;


    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...


        $cities = Cities::select('city', 'popularity')->get()->toArray();

        usort($cities, 'App\Services\SortNullAlwaysLast::cmp');

        foreach ($cities as $key => $value) {

            $city = $value['city'];

            unset($cities[$key]);

            $cities[$city] = $city;
            
        }
        
        $this->cities = $cities;

        

        $countries = Country::select('country', 'popularity')->get()->toArray();

        usort($countries, 'App\Services\SortNullAlwaysLast::cmp');

        foreach ($countries as $key => $value) {

            $country = $value['country'];

            unset($countries[$key]);

            $countries[$country] = $country;
            
        }
        

        $this->countries = $countries;

        $food_type = Food::all()->pluck('food_type', 'food_type');

        $this->food_type = $food_type;

        $operators = Operator::all()->pluck('name', 'name');

        $this->operators = $operators;


    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)

    {

        $nights = range(1, 31);
        array_unshift($nights,"");
        unset($nights[0]);

        $data = [

        'cities' => $this->cities,

        'nights' => $nights,

        'countries' => $this->countries, 

        'currency' => ['usd'=>'USD', 'eur'=>'EUR', 'rub'=>"RUB"], 

        'food_type' => $this->food_type, 

        'operators' => $this->operators,

        'transfer' => ['Групповой'=>'Групповой', 'indiv'=>'Индивидуальный', 'none'=>"Нет"],

        'med_insurance' => [0 =>'Нет', 1 => 'Есть'], 

        'noexit_insurance' => ['Есть'=>'Есть', 'Есть страховка визовый риск'=>'Есть страховка "визовый риск"', 'Есть с франшизой 15%'=>'Есть с франшизой 15%', 'Нет'=> 'Нет'],

        'visa' => ['Есть'=>'Есть', 'Есть Pro-Visa'=>'Есть Pro-Visa', 'Нет'=>'Нет', 'Визовая поддержка'=>"Визовая поддержка"],

        'source' => ['Онлайн-консультант'=>'Онлайн-консультант', 'Онлайн-бронирование'=>'Онлайн-бронирование', 'Заявка на поиск тура'=>'Заявка на поиск тура', 'Пришел в офис'=>'Пришел в офис', 'Постоянный клиент'=>'Постоянный клиент', 'Cоцсети' => 'Соцсети'], 

        'choose_doc' => ['Загран. паспорт'=>'Загран. паспорт', 'Внутррос. паспорт'=>'Внутррос. паспорт',  'Св-во о рождении' => 'Св-во о рождении', 'Другой документ' => 'Другой документ'], 

        'gender' => ['Мужчина' => 'Мужчина', 'Женщина' => 'Женщина']
        
        ];


        $view->with($data);
    }
}