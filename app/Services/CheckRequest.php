<?php

namespace App\Services;

use App\Services\SortRequest;

use App\Tour;

use App\Tourist;

use App\Tour_tourist;

use App\Document;


/**
*
*/
class CheckRequest extends RequestVariables
{

	public static function checkTourForUpdates($request_sorted_tour, $id)

	{

    	RequestVariables::init();


        $tour = Tour::find($id);

        $tour = array_intersect_key($tour->toArray(), parent::$keys_tour);

        $differences = array_diff_assoc($tour, $request_sorted_tour);

        $is_tour_same = empty($differences);


		return $is_tour_same;

	}



	
	public static function return_checked_tourists_and_docs($tourists_array, $documents_array)

	{

		$tourist_ids = [];

		foreach ($tourists_array as $tourist_number => $tourist_from_request) {
			

			$documents_array[$tourist_number] = self::AddDocExistsStatus($documents_array[$tourist_number]);

			$number_of_existing_docs = self::NumberOfExistingDocs($documents_array[$tourist_number]);



			if($number_of_existing_docs > 0) { //Documents from request are found in DB


				if ($number_of_existing_docs == 2) {

				if(( $ids_or_true = self::TwoDocsBelongToSameTourist($documents_array[$tourist_number]) )!== true) {

					$fatal_error['fatal_error'] = true;
					$fatal_error['type'] = 'diff_docs';
					$fatal_error['message'] = 'Эти два документа принадлежат двум разным туристам. Туристу не могут принадлежать документы другого туриста!';
					$fatal_error['tourist_number'] = $tourist_number;
					$fatal_error['ids'] = $ids_or_true;

					return $fatal_error;


					}

				}


				$tourist_id_in_db = self::getDocTouristId($documents_array[$tourist_number]);

				$tourists_array[$tourist_number]['check_info']['exists'] = true;

				$tourists_array[$tourist_number]['check_info']['id'] = $tourist_id_in_db;

				$is_same_tourist = array_search($tourist_id_in_db, $tourist_ids);

				if ($is_same_tourist !== false) {

					$t1 = $is_same_tourist+1;
					$t2 = $tourist_number+1;
					$fatal_error['fatal_error'] = true;
					$fatal_error['type'] = 'sameid';
					$fatal_error['message'] = ['Документы этого туриста принадлежат туристу с id:'.$tourist_id_in_db.'. У туриста под номером '.$t2.' тоже документы этого туриста!', 'Документы этого туриста принадлежат туристу с id:'.$tourist_id_in_db.'. Турист под номером '.$t1.' тоже документы этого туриста!'];
					$fatal_error['tourists_numbers'] = [$is_same_tourist, $tourist_number];
					$fatal_error['same_id'] = $tourist_id_in_db;

					return $fatal_error;

				} else {

					$tourist_ids[$tourist_number] = $tourist_id_in_db;

				};




					if(!empty($differences = self::TouristFromRequestIsDifferentFromTouristInDB($tourist_from_request, $tourist_id_in_db)))  {

						$tourists_array[$tourist_number]['check_info']['differences'] = $differences;

						$tourists_array[$tourist_number]['check_info']['to_be_updated'] = true;


					} 


			} 


			else { // No document from request is found in db


				$tourist_to_check = array_filter($tourist_from_request, function($k) {return ($k != 'phone' AND $k !='email'); }, ARRAY_FILTER_USE_KEY);

				$tourists_in_db = Tourist::where($tourist_to_check)->get();


				$tourists_array[$tourist_number]['check_info']['exists'] = $tourists_in_db->isEmpty() ? false  : true;

				if ($tourists_in_db->isNotEmpty()) {

					$tourists_array[$tourist_number]['check_info']['to_choose'] = true;

					if($tourists_in_db->count() == 1 ) {

						$tour_info = self::LastTourInfo($tourists_in_db[0]); 

						$tourists_array[$tourist_number]['check_info']['id'][$tourists_in_db[0]->id]['last_tour'] = $tour_info;

					} else {

						foreach ($tourists_in_db as $key => $tourist_in_db) {

							$tour_info = self::LastTourInfo($tourist_in_db); 
							
							$tourists_array[$tourist_number]['check_info']['id'][$tourist_in_db->id]['last_tour'] = $tour_info;

						}

					}


				}

			}



		}


		$to_return['tourists'] = $tourists_array;
		$to_return['documents'] = $documents_array;


		return $to_return;
	}




	public static function AddDocExistsStatus ($documents_array)

	{

			foreach ($documents_array as $doc_id => $doc_values) {

				$existing_documents = Document::where([['doc_type', '=', $doc_values['doc_type']], ['doc_number', '=', $doc_values['doc_number']]])->get();


				if($existing_documents->isNotEmpty()) {

					if ($existing_documents->count() > 1) {

						foreach ($existing_documents as $key => $existing_document) {
							
							if( !empty(Tour_tourist::where('doc0', $existing_document->id)

								->orWhere('doc1', $existing_document->id)->first()) ) {

							$doc_exists = $existing_document;


							}
						}


					} else {

						$doc_exists = $existing_documents[0];
					}

				} else {

					$doc_exists = null;
				}

				$documents_array[$doc_id]['check_info']['exists'] = empty($doc_exists) ? false : true;




				if(!empty($doc_exists)) {

					$documents_array[$doc_id]['check_info']['id'] = $doc_exists->id;

					// CHECK IF EXISTING DOCUMENTS FROM REQUEST NEED TO BE UPDATED: 

					if ( ($doc_values['date_issue'] != $doc_exists->date_issue) OR ($doc_values['date_expire'] != $doc_exists->date_expire)

						OR (isset($doc_values['who_issued']) AND ($doc_values['who_issued'] != $doc_exists->who_issued))

						OR (isset($doc_values['address_pass']) AND ($doc_values['address_pass'] != $doc_exists->address_pass))
 
 						OR (isset($doc_values['address_real']) AND ($doc_values['address_real'] != $doc_exists->address_real))
					 ) 

					{

						$documents_array[$doc_id]['check_info']['to_be_updated'] = true;

						$doc_in_db = array_intersect_key($doc_exists->toArray(), parent::$keys_document);

						$differences = array_diff_assoc($doc_in_db, $doc_values);

						$documents_array[$doc_id]['check_info']['differences'] = $differences;

						}

				}

			}

			
			return $documents_array;

	}

	public static function AddTouristExistsStatus ($tourist_array) {

		$tourist_exists = Tourist::where($tourist_array)->get();



	}


	public static function NumberOfExistingDocs($documents_array)
	{

			$number_of_existing_docs = 0;

			foreach ($documents_array as $doc_id => $doc_values) {

				$number_of_existing_docs = ($doc_values['check_info']['exists'] == true) ? $number_of_existing_docs+=1 : $number_of_existing_docs;

			}

			return $number_of_existing_docs;
	}



	public static function getDocTouristId($documents_array)

	{


		foreach ($documents_array as $key => $document_values) {
			
			if($document_values['check_info']['exists']!=false AND !is_null($document_values['check_info']['id'])) {

				return Document::find($document_values['check_info']['id'])->tourist->id;

			}
		}



	}

	public static function TouristFromRequestIsDifferentFromTouristInDB ($tourist_from_request, $tourist_id){

		$tourist_in_db = array_intersect_key(Tourist::find($tourist_id)->toArray(), parent::$keys_tourist);

		$differences = array_diff_assoc($tourist_in_db, $tourist_from_request);

		foreach ($differences as $key => $value) {
			
			if($key == 'cancel_patronymic') {
			
				unset($differences[$key]);

			}
		}

		foreach ($differences as $key => $value) {
			
			if($key == 'patronymic' && $value == null) {
			
				$differences[$key] = "Отсутствует";

			}
		}


        return $differences;

	}

	public static function TwoDocsBelongToSameTourist($documents_array) {

		$tourist1 = Document::find($documents_array[0]['check_info']['id'])->tourist->id;

		$tourist2 = Document::find($documents_array[1]['check_info']['id'])->tourist->id;		

		$docs_belong_to_same_tourist =  ($tourist1 == $tourist2);

		if (!$docs_belong_to_same_tourist) {

			$docs_belong_to_same_tourist  = [$tourist1, $tourist2];
		}


		return $docs_belong_to_same_tourist;

	}



	// public static function checkIfAllNew($tourists_and_documents) {

	// 	$allNew = true;

	// 		do {

	// 		foreach ($tourists_and_documents['tourists'] as $tourist_id => $tourist) {


	// 			$allNew = $tourist['check_info']['exists'] == true ? false : true;

	// 			if(!$allNew) {break;}


	// 			foreach ($tourists_and_documents['documents'][$tourist_id] as $doc_id => $document) {

	// 				$allNew = $document['check_info']['exists'] == true ? false : true;

	// 				if(!$allNew) {break;}

	// 			}

	// 		}


	// 	} while(0);

	// 	return $allNew;

	// }

	public static function checkWhatToDo($tourists_and_documents) {

		$Update = false;

		$Exists = [];

			do {

			foreach ($tourists_and_documents['tourists'] as $tourist_id => $tourist) {

				$Exists[] = $tourist['check_info']['exists'];

				if(isset($tourist['check_info']['to_be_updated']) ){

					{$Update = true; break;}

				} else if (isset($tourist['check_info']['to_choose'])) {

					{$Update = true; break;}

				}

			

				foreach ($tourists_and_documents['documents'][$tourist_id] as $doc_id => $doc_values) {

					$Exists[] = $doc_values['check_info']['exists'];

					if(isset($doc_values['check_info']['to_be_updated'])) {

					{$Update = true; break;}

				}	
					
							

			}

		}

		} while(0);

		$NoNew = !(in_array(false, $Exists));

		if($Update) { $return = 'update'; } else { $return  = $NoNew ? 'checkifsame': 'save'; }

		return $return;

	}



	public static function LastTourInfo($tourist_in_db) {

		$tour_info = array_intersect_key($tourist_in_db->tours->last()->toArray(), array_flip(['id', 'country', 'date_depart', 'hotel']) );

		return $tour_info;
	}


	public static function CheckIfTourTouristDocsExists ($tour_array, $tour_buyer, $checked_tourists_and_documents) {


		$same = true;

		$tours = Tour::where(array_intersect_key($tour_array, parent::$keys_tour))->get();


		do {

			if($tours->isEmpty()) {

				$same = false; break;

			} else if ($tours->isNotEmpty()) {

				foreach ($tours as $key => $tour ) {

						$this_same = true;

					do {


						$tour_tourists = $tour->tour_tourist;


						$this_same = self::checkIfBuyerSame($tour_buyer, $checked_tourists_and_documents, $tour->id);

						if(!$this_same) 

							{ break; }


						if(count($tour_tourists)!= count($checked_tourists_and_documents['tourists'])) {

							$this_same = false; break;

						}




						$tourist_ids_array = $tour_tourists->pluck('tourist_id')->toArray();

						$document_ids_array = array_merge($tour_tourists->pluck('doc0')->toArray(), $tour_tourists->pluck('doc1')->toArray());


						foreach ($document_ids_array as $key => $value) {

							if($value == null) {unset($document_ids_array[$key]);}
						}


						$count_doc_ids_in_request = 0; 


						foreach ($checked_tourists_and_documents['tourists'] as $tourist_number => $tourist_values) {

							
							$this_same = in_array($tourist_values['check_info']['id'], $tourist_ids_array);
							
							if(!$this_same) {break;}



							foreach ($checked_tourists_and_documents['documents'][$tourist_number] as $doc_number => $doc_values) {

								$this_same = in_array($doc_values['check_info']['id'], $document_ids_array);

								if(!$this_same) {break;} else {$count_doc_ids_in_request +=1; }

							}


						}


						if($count_doc_ids_in_request != count($document_ids_array)) { $this_same = false; break; }

					} while(0);

						if(!$this_same){

							$same = false;

							break;

						} else if ($this_same === true) {

								$tour_id = $tour->id;
								
								$same= [];

								$same['same_tour_id'] = $tour_id;

								break;
								
						}

				}

			}

		} while(0);

		return $same;

	}


	public static function checkIfBuyerSame($request_buyer, $checked_tourists_and_documents, $id) {

		$touristbuyer_in_db = Tour_tourist::where([['tour_id','=', $id], ['is_buyer','=', 1]])->first();

		$buyer_in_db_id = $touristbuyer_in_db->tourist_id;

		$istourist_in_db = $touristbuyer_in_db->is_tourist;


		$IsBuyerSame = $buyer_in_db_id == $checked_tourists_and_documents['tourists'][$request_buyer['is_buyer']]['check_info']['id'];

		$IsTouristSame = $istourist_in_db == $request_buyer['is_tourist'];


		return ($IsBuyerSame AND $IsTouristSame);

	}

}