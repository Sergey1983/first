<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Branch;


class BranchesViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $branches;


    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {

        $branches = Branch::all()->pluck('name', 'id')->toArray();
        
        $this->branches = $branches;

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

            'branches' => $this->branches      
        ];


        $view->with($data);
    }
}