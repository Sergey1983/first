<?php

namespace App\Services;


class ZagranSeriaNot00 {

    public function Validate($attribute, $value, $parameters, $validator) {
        
        return $value != '00';

    }

    public function Replace($message, $attribute, $rule, $parameters) {

    	return 'Не = 00!';

    }
}