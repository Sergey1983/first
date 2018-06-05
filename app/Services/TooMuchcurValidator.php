<?php

namespace App\Services;


class TooMuchcurValidator {

    public function toomuchcurValidate($attribute, $value, $parameters, $validator) {
        return false;
    }

}