<?php

namespace App\Services;

use App\Tourist;

use App\Tour2;


class TouristServices {


public static function UpdateOtherToursWithTourists($tourists)

	{
		

		foreach ($tourists as $tourist) {

			$tours[] = $tourist->tour2s;

		}


		return $tours;

	}


}
