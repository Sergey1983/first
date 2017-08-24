<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function login () {



        if (! auth()->attempt(request(['email', 'password'])) ) {

            return back()->withErrors(['message'=>'Check your credentials']);

        }


        return redirect('/tours_2');

    }

    public function logout () {

        auth()->logout();

        return redirect('/');

    }


}
