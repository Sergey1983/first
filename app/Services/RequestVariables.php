<?php

namespace App\Services;

class RequestVariables {



	protected static $keys_tour;

	protected static $keys_tourist;

	protected static $keys_document;

	protected static $keys_buyer;

	protected static $keys_timestamps;

	protected static $keys_hidden;

	protected static $keys_check_info;

	protected static $keys_user;


	public static function init() {

		self::$keys_tour = array_flip(['city_from', 'country', 'airport', 'operator', 'nights', 'date_depart', 'date_hotel', 'hotel', 'room', 'add_rooms', 'food_type', 'change_food_type' , 'currency', 'price', 'price_rub', 'is_credit', 'first_payment', 'bank',  'transfer', 'noexit_insurance', 'noexit_insurance_add_people', 'noexit_insurance_people', 'med_insurance', 'visa', 'visa_people', 'visa_add_people', 'change_sightseeing',  'sightseeing', 'extra_info', 'source', 'add_source', 'extra_info']);

        self::$keys_tourist = array_flip(['name', 'lastName', 'nameEng', 'lastNameEng', 'birth_date', 'citizenship', 'gender', 'phone', 'email', 'doc_fullnumber']);


        self::$keys_document = array_flip(['doc_type', 'doc_seria', 'doc_number', 'date_issue', 'date_expire']);

        self::$keys_buyer = array_flip(['is_buyer', 'is_tourist']);

        self::$keys_timestamps = array_flip(['created_at', 'updated_at']);

        self::$keys_hidden = array_flip(['cannot_change_old_tourists', 'tour_exists', 'is_update']);

        self::$keys_check_info = array_flip(['check_info']);

        self::$keys_user = array_flip(['user_id']);


	}

}