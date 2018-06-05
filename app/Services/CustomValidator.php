<?php

namespace App\Services;

use Illuminate\Support\Facades\Schema;
use App\Tourist;

class CustomValidator {


		private $columns;

		private $columns_validate;

		private $columns_replace;


		public function __construct() {

			$columns = Tourist::FieldsForValidation();
	
			$columns_validate = array();
			$columns_replace = array();

				foreach ($columns as $key => $column_name) {
	   		
	   			$columns_validate[$key] = "{$column_name}FailValidate";

				$columns_replace[$key] = "{$column_name}FailReplace";

				}

			$this->columns = $columns;
			$this->columns_validate = $columns_validate;
			$this->columns_replace = $columns_replace;

		// dump($this->columns_validate);
		// dump($this->columns_replace);
		// die();

		}


	    function __call($func, $params) {


	    	if((in_array($func, $this->columns_validate)) or (in_array($func, [0 =>'tourexistsValidate']))) { // CustomValidator@column_nameFailValidate

	    		return false;

	    	} elseif (in_array($func, $this->columns_replace) or (in_array($func, [0 =>'tourexistsReplace']))) { // CustomValidator@column_nameFailReplace

	    		$parameters = $params[3][0]; //get parameters (here: value from DB)
	    		$message = $params[0];

	    		return str_replace([':index'], $parameters, $message);

	    	} else { // If method doesn't exists, Laravel outputs 'false' as default, to prevent it, return jibberish.

	    	return 'there is no method like this, idiot!:)'; 

	    	}

	    }



		// private $columns;

		// // private $columns_validate;

		// // private $columns_replace;


		// public function __construct() {

		// 	$columns = Tourist::FieldsForValidation();


		// 	// $columns_validate = array();
		// 	// $columns_replace = array();

		// 	// 	foreach ($this->columns as $key => $column_name) {
	   		
	 //  //  			$columns_validate[$key] = "{$column_name}FailValidate";

		// 	// 	$columns_validate[$key] = "{$column_name}FailReplace";

	 //  //  			}

		// 	$this->columns = $columns;
		// 	// $this->columns_validate = $columns_validate;
		// 	// $this->columns_replace = $columns_replace;
		
		// }

		// dump($columns);
		// die();


	   	// $columns = Tourist::FieldsForValidation();

	   	// $columns_validate = array();

	   	// $columns_replace = array();

	   // 	foreach ($this->columns as $key => $column_name) {
	   		
	   // 			$columns_validate[$key] = "{$column_name}FailValidate";

				// $columns_validate[$key] = "{$column_name}FailReplace";

	   // 	}


	   	// public function index() {

	   	// 	dump($this->columns);
	   	// 	dump($this->$columns_validate);
	   	// }



	   	// private $columns_validate = array('nameFailValidate', 'lastNameFailValidate', 'birth_dateFailValidate');

	   	// private $columns_replace = array('nameFailReplace', 'lastNameFailReplace', 'birth_dateFailReplace');











		// private $array_validate = array('fullnameFailValidate', 'smthFailValidate');

		// private $array_replace = array('fullnameFailReplace', 'smthFailReplace');



	 //    function __call($func, $params) {

	 //    	if(in_array($func, $this->array_validate)) {

	 //    		return false;

	 //    	} elseif (in_array($func, $this->array_replace)) {

	 //    		$parameters = $params[3][0];
	 //    		$message = $params[0];

	 //    		return str_replace([':index'], $parameters, $message);

	 //    	} else {

	 //    	return 'there is no method like this, idiot!:)';

	 //    	}

	 //    }




	
	// public function fullnameFailValidate($attribute, $value, $parameters, $validator)

	// {
		
	// 	return false;

	// }


	// public function fullnameFailReplacer($message, $attribute, $rule, $parameters)
	
	// {
		
	// 	return str_replace([':index'], $parameters, $message);

	// }


	// public function smthFailValidate($attribute, $value, $parameters, $validator)

	// {
		
	// 	return false;

	// }


	// public function smthFailReplacer($message, $attribute, $rule, $parameters)
	
	// {
		
	// 	return str_replace([':index'], $parameters, $message);

	// }






	
}
