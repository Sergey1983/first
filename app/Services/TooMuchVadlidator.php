<?php

namespace App\Services;


class TooMuchValidator {

    public function toomuchValidate($attribute, $value, $parameters, $validator) {
        return false;
    }

}