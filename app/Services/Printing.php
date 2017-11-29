<?php

namespace App\Services;

use App\Tour;

use App\Document;

class Printing

{

	public static function tour_type($tour_type)
	
	{
	
		    switch($tour_type) {

                case 'packet_tour':

                      $tour_type = "Пакетный";

                      break;

                case 'hotel':

                      $tour_type = "Отельный";

                      break;

                case 'avia':

                      $tour_type = "Авиа";

                      break;


            }

            return $tour_type;
	
	}

  public static function tour_type_reverse($tour_type)
  
  {
  
        switch($tour_type) {

                case "Пакетный":

                      $tour_type = 'packet_tour';

                      break;

                case "Отельный":

                      $tour_type = 'hotel';

                      break;

                case "Авиа":

                      $tour_type = 'avia';

                      break;


            }

            return $tour_type;
  
  }





  public static function doc_type($doc_type) {


        $doc_type = $doc_type === 'contract' ? "Договор" : "Допсоглашение";

        return $doc_type;


  }





   public static function process_template ($template, $id) {

      $tour = Tour::find($id);

      //$first_manager

      $offset = 0;

      while(strpos($template, '<tr id="tourists_info">', $offset) !== false) {

        $startsAt = strpos($template, '<tr id="tourists_info">') + strlen('<tr id="tourists_info">');
        $endsAt = strpos($template, "</tr>", $startsAt);
        $tourists_tr = substr($template, $startsAt, $endsAt - $startsAt);

        $processed_tourist_strings = self::process_tourists($tour, $tourists_tr);

        $template = str_replace('<tr id="tourists_info">'.$tourists_tr.'</tr>', $processed_tourist_strings, $template);

        $offset = $endsAt + strlen("</tr>");

      }


      $first_manager = self::findManager($id);

      //$number_of_adults, $number_of_children

      $eighteen = \Carbon\Carbon::now()->subYears(18)->startOfDay();

        $adults = $tour->tourists->where('birth_date', '<', $eighteen)->count();

        $children = $tour->tourists->count() - $adults;

      // $date_hotel

      $date_hotel = is_null($tour->date_hotel)
      ? $tour->date_depart 
      : date("Y-m-d" ,strtotime("+1 days", strtotime($tour->date_depart)) );


      // $visa

      $visa = $tour->visa_add_people === 0 ? 'Есть для всех туристов' : $tour->visa_people;

      // $noexitinsurance

      $noexit_insurance = $tour->noexit_insurance_add_people===0 ? $tour->noexit_insurance : $tour->noexit_insurance_people;



      $dictionary = [

        '$id' => $tour->id,

        '$first_manager' => $first_manager,

        '$created' => date('Y-m-d', strtotime($tour->created_at)),

        '$buyerName' => $tour->buyer->first()->name,

        '$buyerLastName' => $tour->buyer->first()->lastName,

        '$operator_full_pay' => is_null($tour->operator_full_pay)? "<span style='color: red'>ДАТА ОТСУТСТВУЕТ</span>" : $tour->operator_full_pay,

        '$adults' => $adults,

        '$children' => $children,

        '$country' => $tour->country,

        '$date_depart' => $tour->date_depart,

        '$date_return' =>  date("Y-m-d" ,strtotime("+".$tour->nights." days", strtotime($tour->date_depart)) ),

        '$hotel' => $tour->hotel,

        '$room' => $tour->room,

        '$date_hotel' => $date_hotel,

        '$food' => $tour->food_type,

        '$sightseeing' => empty($tour->sightseeing) ? "___" : $tour->sightseeing,

        '$transfer' => $tour->transfer,

        '$visa' => $visa,

        '$med_insurance' => $tour->med_insurance === 0 ? 'Нет' : 'Есть для всех туристов', 

        '$noexit_insurance' => $noexit_insurance,

        '$city_from' => $tour->city_from,

        '$city_return' => $tour->city_return,

        '$extra_info' => is_null($tour->extra_info) ? '________________________________________________________' : $tour->extra_info,

        '$price_rub' => number_format($tour->price_rub, '0', '', ' '),

        '$price' => number_format($tour->price,  '0', '', ' '),

        '$today' => date('Y-m-d'),

        '$operator' => $tour->operator_model->description,

        '$nights' => $tour->nights,


      ];


      $from = array_keys($dictionary);
      $to = array_values($dictionary);


      $template = str_replace($from, $to, $template);

      
   return $template;

   }


    public static function process_tourists($tour, $tourists_tr) {

    $tourists = $tour->tourists;

    $new_strings = '';

    foreach ($tourists as $tourist) {

      $document = self::get_document($tourist, 'doc0');

      if ($tourist->pivot->doc1 !== null )  
        {
          
          $document = $document."\n".self::get_document($tourist, 'doc1');
          
           }
      
      $dictionary = [

        '$tourist+name' => $tourist->name, 
        '$tourist+lastName' => $tourist->lastName,
        '$tourist+gender' => $tourist->gender,
        '$tourist+birth_date' => $tourist->birth_date,
        '$tourist+doc_number' => $document, 

       ];

       $new_string = $tourists_tr;

       $new_strings .= '<tr style="text-align: center">'.str_replace(array_keys($dictionary), array_values($dictionary), $new_string).'</tr>';


    }

    return $new_strings;

  }
 



  public static function findManager ($id) {

      $tour = Tour::find($id);

      if(!empty($tour->previous_tours->sortBy('created_at')->first()->user->name)) {
        
        $user = $tour->previous_tours->sortBy('created_at')->first()->user;

        $first_manager = $user->name.' '.$user->last_name;

      } else { $first_manager = "Менеджер не установлен"; }

      return $first_manager;

  }

  public static function get_document($tourist, $docX) {

        $document = Document::find($tourist->pivot->$docX);

        $document = $document->seria == 0 ? $document->doc_number : substr($document->doc_number, 0, $document->seria).' '.substr($document->doc_number, $document->seria);

        return $document;
}



}

