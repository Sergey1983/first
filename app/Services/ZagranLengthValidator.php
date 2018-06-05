<?php

namespace App\Services;


class ZagranLengthValidator {

    public function Validate($attribute, $value, $parameters, $validator) {
        
        return strlen($value) <= 7;

    }

    public function Replace($message, $attribute, $rule, $parameters) {

    	return 'Не больше 7 символов!';

    }
}