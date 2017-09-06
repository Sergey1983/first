<?php

namespace App\Services;

use App\Tourist;

use App\Tour;


class TouristServices {


public static function UpdateOtherToursWithTourists($tourists)

	{
		

		foreach ($tourists as $tourist) {

			$tours[] = $tourist->tours;

		}


		return $tours;

	}


}
