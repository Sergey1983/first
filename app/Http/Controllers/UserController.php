<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{

    public function index () {

        $users = User::all();

        return view('user.show', compact('users'));

    }



    public function create () {

    	return view('user.create');

    }

    public function store () {

    	$this->validate(request(), [

    		'name' => 'required', 

    		'email' => 'required|unique:users,email', 

            'password' => 'required|confirmed' 

    		]);


        $user = new User;

        $user->name = request('name');

        $user->role_id = 2;

        $user->email = request('email');

        $user->password = bcrypt(request('password'));

        $user->permission = 0;

        $user->save();

        return redirect()->route('user.index');

    }


    public function edit($id) {

        $user = User::find($id);

        return view('user.edit', compact('user'));



    }


    public function update ($id) {

        $this->validate(request(), [

            'name' => 'required', 

            'email' => 'required|email', 

            'password' => 'required|confirmed',

            ]);


        $user = User::find($id);

        $user->name = request('name');

        $user->email = request('email');

        $user->password = bcrypt(request('password'));

        $user->save();

        return redirect()->route('user.edit', $id);


    }


    public function update_permission ($id) {

        $this->validate(request(), [

            'permission' => 'required' 

            ]);


        $user = User::find($id);

        $user->permission = request('permission');

        $user->save();

        return redirect()->route('user.edit', $id);


    }


    public function destroy($id) {

        User::destroy($id);

        return redirect()->route('user.index');



    }

}
