<?php

namespace App\Services;


class IsBuyerIsTourist {



	public static function buyer ($request, $i) {

            if ($request['is_buyer'] == $i) { 

                $is_buyer = 1;

                $is_tourist = $request['is_tourist']; // Buyer can be a tourist or not (1 or 0)

            } else {

                $is_buyer = 0;

                $is_tourist = 1; // Tourist (no buyer) is always tourist

            }

            return ['is_buyer' => $is_buyer, 'is_tourist' => $is_tourist];

	}



}