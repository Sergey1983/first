<?php

namespace App\Services;


class Accounting

{

    public static function index() {

            return view('Accounting.accounting')->with('accounting', true);

  }

}
