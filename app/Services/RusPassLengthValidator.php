<?php

namespace App\Services;


class RusPassLengthValidator {

    public function Validate($attribute, $value, $parameters, $validator) {
        
        return strlen($value) <= 6;

    }

    public function Replace($message, $attribute, $rule, $parameters) {

    	return 'Не больше 6 символов!';

    }
}