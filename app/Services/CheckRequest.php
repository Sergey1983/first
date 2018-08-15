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



	
	public static function return_checked_tourists_and_docs($tourists_array, $documents_array, $tour)

	{

		$tourist_ids = [];

		foreach ($tourists_array as $tourist_number => $tourist_from_request) {

			$documents_array[$tourist_number] = self::AddDocExistsStatus($documents_array[$tourist_number]);

			$number_of_existing_docs = self::NumberOfExistingDocs($documents_array[$tourist_number]);

// dump('$number_of_existing_docs', $number_of_existing_docs);

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


				if(!empty($differences = self::TouristFromRequestIsDifferentFromTouristInDB($tourist_from_request, $tourist_id_in_db)))  

				{

					$tourists_array[$tourist_number]['check_info']['differences'] = $differences;

					$tourists_array[$tourist_number]['check_info']['to_be_updated'] = true;


				} 


			} 


			else { // No document for tourist from request is found in db



				$tourist_to_check = array_filter($tourist_from_request, function($k) {return ($k != 'phone' AND $k !='email'); }, ARRAY_FILTER_USE_KEY);

				$tourist_already_exists_in_this_tour = false;

				// Let's check if this tour exists:

				if(!is_null($tour)) {

					//Let's check if one of the tour's tourists has the same values as tourist in the request:

					foreach($tour->tourists as $tourist) {

						$tourist_id = $tourist->id;

						$tourist = array_intersect_key($tourist->toArray(), parent::$keys_tourist);

						$tourist = array_filter($tourist, function($k) {return ($k != 'phone' AND $k !='email'); }, ARRAY_FILTER_USE_KEY);

						if($tourist_already_exists_in_this_tour = $tourist == $tourist_to_check) {

							$tourists_array[$tourist_number]['check_info']['exists'] = true;

							$tourists_array[$tourist_number]['check_info']['id'] = $tourist_id;

							break;
						}
					}

				} 

// dump('$tourist_from_request', $tourist_from_request);
// dump('$tourist_already_exists_in_this_tour', $tourist_already_exists_in_this_tour); 

				// If tour doesnt exist or if it does but tourist is new:

				if(!$tourist_already_exists_in_this_tour) {


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



		}

// dump('$tourists_array', $tourists_array); die();
		//Let's check if there are docs in request which are the same:



		foreach ($documents_array as $tourist_number1 => $docs_array1) {
			
			foreach ($docs_array1 as $doc_number1 => $doc_values1) {

				$doc_type_and_number1 = $doc_values1['doc_type'].$doc_values1['doc_number'];

				$documents_array2 = array_filter($documents_array, function($k) use($tourist_number1) {return ($k > $tourist_number1); }, ARRAY_FILTER_USE_KEY);

					foreach($documents_array2 as $tourist_number2 => $docs_array2) {

						foreach ($docs_array2 as $doc_number2 => $doc_values2) {
							
							$doc_type_and_number2 = $doc_values2['doc_type'].$doc_values2['doc_number'];

							if ($doc_type_and_number1 === $doc_type_and_number2) {

								$t1 = $tourist_number1+1;
								$t2 = $tourist_number2+1;

								$fatal_error['fatal_error'] = true;
								$fatal_error['type'] = 'same_doc_type_and_number';
								$fatal_error['message'] = ['Два одинаковых документа в заявке. У туриста под номером '.$t2.' вбит такой же документ!', 'Два одинаковых документа в заявке. У туриста под номером '.$t1.' вбит такой же документ!'];
								$fatal_error['tourists_numbers'] = [$tourist_number1, $tourist_number2];

								return $fatal_error;

							}

						}

					}

				}

			}



		$to_return['tourists'] = $tourists_array;
		$to_return['documents'] = $documents_array;

// dump('$to_return[documents]', $to_return['documents']);
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

							} else {
								
								$doc_is_Not_in_tour_tourist = true;
							}
						

						} // End foreach


					} else {

						$doc_exists = $existing_documents[0];

						$doc_is_Not_in_tour_tourist = empty(Tour_tourist::where('doc0', $existing_documents[0]->id)

								->orWhere('doc1', $existing_documents[0]->id)->first());
					}


				} else {

					$doc_exists = null;
				}

				$documents_array[$doc_id]['check_info']['exists'] = empty($doc_exists) ? false : true;




				if(!empty($doc_exists)) {

					$documents_array[$doc_id]['check_info']['id'] = $doc_exists->id;


				if($doc_is_Not_in_tour_tourist) {

					$documents_array[$doc_id]['check_info']['doc_is_Not_in_tour_tourist'] = true;

				} else {

						// CHECK IF EXISTING DOCUMENTS FROM REQUEST NEED TO BE UPDATED: 


						$found_difference = false;



						foreach(array_flip(parent::$key_doc_changable) as $key ) {


							if(isset($doc_values[$key])) {

								if($found_difference = ($doc_values[$key] != $doc_exists->{$key})) {

									break;
								}

							}

						}





						if($found_difference)

						{

							$documents_array[$doc_id]['check_info']['to_be_updated'] = true;

							$doc_in_db = array_intersect_key($doc_exists->toArray(), parent::$keys_document);

							$differences = array_diff_assoc($doc_in_db, $doc_values);

							if(in_array($doc_in_db['doc_type'], array("Внутррос. паспорт", "Св-во о рождении"))) {

								unset($differences['date_expire']);
							}


							if(in_array($doc_in_db['doc_type'], array("Загран. паспорт", "Св-во о рождении", "Другой документ"))) {

								unset($differences['who_issued']);
								unset($differences['address_pass']);
								unset($differences['address_real']);
							}
							//For situations where in DB there is 'who_issued' (or other fields) == null, we delete the null values.
								// foreach ($differences as $key => $difference) {
									
								// 	if(is_null($difference)) {

								// 		unset($differences[$key]);
								// 	}
								// }

							$documents_array[$doc_id]['check_info']['differences'] = $differences;

						}

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

				$if = ($doc_values['check_info']['exists'] == true AND !isset($doc_values['check_info']['doc_is_Not_in_tour_tourist']) );

				$number_of_existing_docs = ($if) ? $number_of_existing_docs+=1 : $number_of_existing_docs;

			}

			return $number_of_existing_docs;
	}



	public static function getDocTouristId($documents_array)

	{


		foreach ($documents_array as $key => $document_values) {
			
			if(
				$document_values['check_info']['exists']!=false

				AND !is_null($document_values['check_info']['id']) 

				AND !isset($document_values['check_info']['doc_is_Not_in_tour_tourist'])

			   ) 

			{

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

		// foreach ($documents_array as $doc_array) {

		// 	if(isset($doc_array['check_info']['doc_is_Not_in_tour_tourist'])){

		// 		$docs_belong_to_same_tourist = true;

		// 		return $docs_belong_to_same_tourist;
		// 	}

		// }


		$tourist1 = Document::find($documents_array[0]['check_info']['id'])->tourist->id;

		$tourist2 = Document::find($documents_array[1]['check_info']['id'])->tourist->id;		

		$docs_belong_to_same_tourist = ($tourist1 == $tourist2);

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

// dump('$tourists_and_documents', $tourists_and_documents);

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

// dump($Update, $Exists);

		$NoNew = !(in_array(false, $Exists));

// dump($NoNew);

		if($Update) { $return = 'update'; } else { $return  = $NoNew ? 'checkifsame': 'save'; }


// dump('$return', $return);
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