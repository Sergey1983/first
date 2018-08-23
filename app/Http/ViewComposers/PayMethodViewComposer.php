<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\PayMethod;


class PayMethodViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $pay_methods;


    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {

        $pay_methods = PayMethod::all()->pluck('name', 'id')->toArray();
        
        $this->pay_methods = $pay_methods;


        // dd($this->branches);

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

            'pay_methods' => $this->pay_methods      
        ];


        $view->with($data);
    }
}