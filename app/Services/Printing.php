<?php

namespace App\Services;

use App\Tour;

use App\Document;

use App\Branch;


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




   public static function process_template ($template, $tour) {

      //$first_manager


      setlocale(LC_ALL, 'ru_RU');

      $offset = 0;

      while(strpos($template, '<tr id="tourists_info">', $offset) !== false) {

        $startsAt = strpos($template, '<tr id="tourists_info">') + strlen('<tr id="tourists_info">');
        $endsAt = strpos($template, "</tr>", $startsAt);
        $tourists_tr = substr($template, $startsAt, $endsAt - $startsAt);

        $processed_tourist_strings = self::process_tourists($tour, $tourists_tr);

        $template = str_replace('<tr id="tourists_info">'.$tourists_tr.'</tr>', $processed_tourist_strings, $template);

        $offset = $endsAt + strlen("</tr>");

      }


      $first_manager = self::findManager($tour);

      //$number_of_adults, $number_of_children


      $still_child_if_younger = strtotime($tour->date_depart." + ".($tour->nights+1)." days -18 years");

      // dump($still_child_if_younger);

      // dump(strftime('%Y-%m-%d', $still_child_if_younger));

      // dump(strftime('%d %B %Y',  $still_child_if_younger));

      // dump($tour->tourists->where('birth_date', '>=', strftime('%Y-%m-%d', $still_child_if_younger))->pluck('name'));

        $children = $tour->tourists->where('birth_date', '>=', strftime('%Y-%m-%d', $still_child_if_younger))->count();

        $adults = $tour->tourists->count() - $children;

      // $date_hotel

      $date_hotel = $tour->date_hotel == 0

        ? strtotime($tour->date_depart) 
      
        : strtotime("+1 days", strtotime($tour->date_depart)) ;


      // $visa

      $visa = $tour->visa_add_people === 0 ? $tour->visa." для всех туристов" : $tour->visa_people;

      // $noexitinsurance

      $noexit_insurance = $tour->noexit_insurance_add_people===0 ? $tour->noexit_insurance : $tour->noexit_insurance_people;

      $buyer_pass = $tour->buyer->first()->documents->where('doc_type', "Внутррос. паспорт")->first();

      $f = new \NumberFormatter("ru", \NumberFormatter::SPELLOUT);

      $spellpricerub = $f->format($tour->price_rub);

      if($tour->currency == 'RUB') {

        $spellpricecur = null;
      
      } else {

          switch($tour->currency) {

            case('USD'): $spellpricecur = nl2br($f->format($tour->price).' условных единиц (у.е.), '.PHP_EOL.'1 у.е. равна 1 доллар США '.PHP_EOL.'по курсу туроператора на день оплаты'); break;
            case('EUR'): $spellpricecur = $f->format($tour->price).' условных единиц (у.е.), 1 у.е. равна 1 евро по курсу туроператора на день оплаты'; break;

          }

      }

      $manager = $tour->previous_tours->sortBy('created_at')->first()->user;

      $dictionary = [

        '$id' => $tour->id,

        '$first_manager' => $first_manager,

        '$created' => strftime('%d %B %Y', strtotime($tour->created_at)),

        '$buyerName' => $tour->buyer->first()->name,

        '$buyerLastName' => $tour->buyer->first()->lastName,

        '$buyerPatronymic' => $tour->buyer->first()->patronymic,

        '$buyerPhone' => $tour->buyer->first()->phone,

        '$buyerEmail' => $tour->buyer->first()->email,

        '$operator_full_pay' => is_null($tour->operator_full_pay)? "<span style='color: red'>ДАТА ОТСУТСТВУЕТ</span>" : strftime('%d %B %Y', strtotime($tour->operator_full_pay)),

        '$adults' => $adults,

        '$children' => $children,

        '$country' => $tour->country,

        '$airport' => $tour->airport,

        '$date_depart' => strftime('%d %B %Y', strtotime($tour->date_depart)),

        '$date_return' =>  strftime('%d %B %Y', strtotime("+".$tour->nights." days", $date_hotel)),

        '$date_hotel' => strftime('%d %B %Y', $date_hotel),

        '$hotel' => $tour->hotel,

        '$room' => $tour->room,

        '$food' => $tour->food_type,

        '$sightseeing' => empty($tour->sightseeing) ? "___" : $tour->sightseeing,

        '$transfer' => $tour->transfer,

        '$visa' => $visa,

        '$med_insurance' => $tour->med_insurance === 0 ? 'Нет' : 'Есть для всех туристов', 

        '$noexit_insurance' => $noexit_insurance,

        '$city_from' => $tour->city_from,

        '$city_return' => $tour->city_return,

        '$extra_info' => is_null($tour->extra_info) ? '________________________________________________________' : nl2br($tour->extra_info),

        '$price_rub' => number_format($tour->price_rub, '0', '', ' '),

        '$price' => $tour->currency == 'RUB' ? null : number_format($tour->price,  '0', '', ' '),

        '$spellpricerub' => $spellpricerub.' рублей',

        '$spellpricecur' => $spellpricecur,

        '$today' => strftime('%d %B %Y'),

        '$operator' => nl2br($tour->operator_model->description),

        '$nights' => $tour->nights,

        '$seria' => substr($buyer_pass->doc_number, 0, $buyer_pass->seria),

        '$doc_number' => substr($buyer_pass->doc_number, $buyer_pass->seria),

        '$date_issued' => $buyer_pass->date_issue,

        '$who_issued' => $buyer_pass->who_issued,

        '$address_pass' => $buyer_pass->address_pass,

        '$address_real' => $buyer_pass->address_real,

        '$managerName' => $manager->name,

        '$managerLastName' => $manager->name,

        '$managerPatronymic' => $manager->patronymic,

        '$branch_details' => nl2br($tour->branch->details)

      ];


      $from = array_keys($dictionary);
      $to = array_values($dictionary);


      $template = str_replace($from, $to, $template);

   return $template;

   }


    public static function process_tourists($tour, $tourists_tr) {

      setlocale(LC_TIME, 'ru_RU');

      $tourists = $tour->tourists;

      $new_strings = '';

      foreach ($tourists as $tourist) {

        $is_foreign = false;

        $document = self::get_document($tourist, $is_foreign);

        
        $dictionary = [

          '$tourist+name' => $is_foreign ? $tourist->nameEng : $tourist->name, 
          '$tourist+lastName' => $is_foreign ? $tourist->lastNameEng : $tourist->lastName,
          '$tourist+patronymic' => $is_foreign ? null : $tourist->patronymic,
          '$tourist+gender' => $tourist->gender,
          '$tourist+birth_date' => strftime('%d %B %Y', strtotime($tourist->birth_date)),
          '$tourist+doc_number' => $document, 

         ];

         $new_string = $tourists_tr;

         $new_strings .= '<tr style="text-align: center">'.str_replace(array_keys($dictionary), array_values($dictionary), $new_string).'</tr>';


      }

      return $new_strings;

  }
 



  public static function findManager ($tour) {

      if(!empty($user = $tour->previous_tours->sortBy('created_at')->first()->user)) {
        
        $first_manager = $user->last_name.' '.substr($user->last_name, 0, 2).'.'.substr($user->patronymic, 0, 2);

      } else { 

        $first_manager = "Менеджер не установлен"; 

      }

      return $first_manager;

  }

  public static function get_document($tourist, &$is_foreign) {

       

       for($i=0; $i<=1; $i++) {

        if(!is_null(Document::find($tourist->pivot->{'doc'.$i})))

          {

            $document = Document::find($tourist->pivot->{'doc'.$i});

             if ($document->doc_type == "Загран. паспорт") {

              $is_foreign = true;

              break;

             }

        }

      }


        $document = $document->seria == 0 ? $document->doc_number : substr($document->doc_number, 0, $document->seria).' '.substr($document->doc_number, $document->seria);

        return $document;
}



}

