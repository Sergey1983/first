<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Tourist;

class DeleteCustomValidator {

		private $columns;

		private $columns_validate;

		private $columns_replace;


		public function __construct() {

			$columns = Tourist::getTableFields();
	
			$columns_validate = array();
			$columns_replace = array();

				foreach ($columns as $key => $column_name) {
	   		
	   			$columns_validate[$key] = "{$column_name}FailValidate";

				$columns_replace[$key] = "{$column_name}FailReplace";

			}

		$this->columns = $columns;
		$this->columns_validate = $columns_validate;
		$this->columns_replace = $columns_replace;



		}




	   	public function index() {

	   		dump($this->columns);
	   		dump($this->columns_replace);
	   		dump($this->columns_validate);
	   		die();
		   	}









	
}