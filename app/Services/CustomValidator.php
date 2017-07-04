<?php

namespace App\Services;

class CustomValidator {
	
	public function documentNumFailValidate($attribute, $value, $parameters, $validator)

	{
		
		return false;

	}

	public function documentNumFailReplacer($message, $attribute, $rule, $parameters)
	
	{
		
		return str_replace([':index'], $parameters, $message);

	}
}