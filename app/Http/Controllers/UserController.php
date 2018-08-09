<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{

    public function index () {

        $users = User::all();

        return view('User.show', compact('users'));

    }



    public function create () {

    	return view('User.create');

    }

    public function store () {

    	$this->validate(request(), [

    		'name' => 'required', 

            'last_name' => 'required',

            'patronymic' => 'required',

    		'email' => 'required|unique:users,email', 

            'branch_id' =>'required',

            'password' => 'required|confirmed' 

    		]);


        $user = new User;

        $user->name = request('name');

        $user->last_name = request('last_name');

        $user->patronymic = request('patronymic');

        $user->role_id = 2;

        $user->email = request('email');

        $user->branch_id = request('branch_id');

        $user->password = bcrypt(request('password'));

        $user->permission = 0;

        $user->save();

        return redirect()->route('user.index');

    }


    public function edit(User $user) {

        return view('User.edit', compact('user'));

    }


    public function update (User $user) {


        $validation_rules = [

            'name' => 'required', 

            'last_name' => 'required',

            'patronymic' => 'required',

            'email' => 'required|email', 

            'branch_id' =>'required',

            'password' => 'required|confirmed' 

            ];

        if (request('email') != $user->email) 

        {
        
            $validation_rules['password'] = 'required|confirmed';

        }

        $messages = [

            'password.required' => 'При изменении имейла нужно ввести пароль',

            'password.confirmed' => 'При изменении имейла нужно подтвердить пароль'

                        ];



        $this->validate(request(), $validation_rules, $messages);


        $user->name = request('name');

        $user->last_name = request('last_name');

        $user->patronymic = request('patronymic');

        $user->email = request('email');

        $user->branch_id = request('branch_id');

        $user->password = bcrypt(request('password'));

        $user->save();

        return redirect()->route('user.edit', $user);


    }


    public function update_permission (User $user) {

        $this->validate(request(), [

            'permission' => 'required' 

            ]);


        $user->permission = request('permission');

        $user->save();

        return redirect()->route('user.edit', $user);


    }


    public function destroy(User $user) {

        $user->active = 0;

        $user->save();

        return redirect()->route('user.index');

    }

    public function make_active(User $user) {

        $user->active = 1;

        $user->save();

        return redirect()->route('user.index');

    }


}
