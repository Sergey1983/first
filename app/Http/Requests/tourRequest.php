<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

use App\Tourist;

use App\Tour;



class tourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

      if(request()->allchecked == 'false') {

        $rules = 

          [
            'city_from' => 'required',
            'country' => 'required',
            'airport' => 'required',
            'operator' => 'required',
            'nights' => 'required',
            'date_depart' => 'required',
            'hotel' => 'required',
            'room' => 'required',
            'food_type' => 'required',
            'currency' => 'required',
            'price_rub' => 'required',
            'transfer' => 'required',
            'noexit_insurance' => 'required',
            'med_insurance' => 'required',
            'visa' => 'required',
            'source' => 'required', 

            'name.*' => ['required', 'regex: /^[а-яёА-ЯЁ-]+$/u'],
            'lastName.*' => ['required', 'regex: /^[а-яёА-ЯЁ-]+$/u'],

            // 'name.*' => ['required', 'regex: /^[x{0430}-\x{044F}\x{0410}-\x{042F}-]+$/u'],
            // 'lastName.*' => ['required', 'regex: /^[x{0430}-\x{044F}\x{0410}-\x{042F}-]+$/u'],
            'nameEng.*' => ['required', 'regex: /[a-zA-Z\-]/u'],
            'lastNameEng.*' => ['required', 'regex: /[a-zA-Z\-]/u'], 
            'birth_date.*' => 'required',
            'citizenship.*' => 'required',
            'gender.*' => 'required',
            'email.*' => 'nullable|email',
            'phone.*' => [
                            'nullable',
                            'min:10',
                            'regex: /^\+?\d+$/',

                          ], 
            'doc_type.*.*' => 'required',
            // 'doc_seria.*.*' => 'required|digits_between:2,4',
            'date_issue.*.*' => 'required',
            'date_expire.*.*' => 'required',
            // 'doc_fullnumber.*' => 'required|digits_between:3,15', 
            'is_buyer' => 'required',
            'is_tourist' => 'required',   
           ];


           if (isset(request()->doc_type)) {

             foreach (request()->doc_type as $tourist_id => $doc_types) {
               
                foreach ($doc_types as $doc_id => $value) {


                  if($value == "Загран. паспорт" OR $value ==  "Внутррос. паспорт") {

                    $rules['doc_number.'.$tourist_id.'.'.$doc_id] = 'required|numeric';

                    $rules['doc_seria.'.$tourist_id.'.'.$doc_id] = ($value == "Загран. паспорт") 

                                                                    ? 'required|digits:2' 

                                                                    : 'required|digits:4';



                  } else {

                    $rules['doc_number.'.$tourist_id.'.'.$doc_id] = ['required', 'regex: /^[a-zA-Z0-9а-яёА-ЯЁ-]+$/u'];


                  }


             //      $rules['doc_number.'.$tourist_id.'.'.$doc_id] = 

             //      ($value == "Загран. паспорт" OR $value ==  "Внутррос. паспорт")

             //      ? 'required|numeric' 

             //      : ['required', 'regex: /^[a-zA-Z0-9\x{0430}-\x{044F}\x{0410}-\x{042F}-]+$/u'];
                
             //    }

             //      $rules['doc_seria.'.$tourist_id.'.'.$doc_id] = 

             //      ($value == "Загран. паспорт" OR $value ==  "Внутррос. паспорт")

             //      ? 'required|numeric' 

             //      : ['required', 'regex: /^[a-zA-Z0-9\x{0430}-\x{044F}\x{0410}-\x{042F}-]+$/u'];

             // }

                  }
              } 
          }





           if(request()->currency != 'RUB') {

            $rules['price'] = 'required';

           }

           if(request()->is_credit == 1) {

            $rules['first_payment'] = 'required';
            $rules['bank'] = 'required';

           }


           if(request()->noexit_insurance_add_people == 1) {

            $rules['noexit_insurance_people'] = 'required';

           }


           if(request()->visa_add_people == 1) {

            $rules['visa_people'] = 'required';

           }

           if(request()->change_sightseeing == 1) {

            $rules['sightseeing'] = 'required';

           }

           if(request()->tour_type == 'Авиа') {

            $rules['extra_info'] = 'required';

           }
           
           if(request()->city_return_add == 1) {

            $rules['city_return'] = 'required';

           }



           $request_array = request()->all();



           $request_array['city_from']= request()->input('city_from'); // city_from to be 'null' or value
           $request_array['is_buyer']= request()->input('is_buyer'); // is_buyer to be 'null' or value
           $request_array['is_tourist']= request()->input('is_tourist'); // is_tourist  to be 'null' or value



           $update = request()->input('is_update'); // is_update to be '0' (CREATE) or 1 (UPDATE)
   
           $keys_tourist = ['name', 'lastName', 'birth_date', 'doc_fullnumber'];
           $keys_tour = ['city_from', 'hotel'];
           $keys_buyer = ['is_buyer', 'is_tourist'];
           $keys_timestamps = ['created_at', 'updated_at'];
           $keys_hidden = ['allchecked', 'tour_exists', 'is_update'];



           $request_array_tour = array_intersect_key($request_array, array_flip($keys_tour));
           $request_array_tourist = array_intersect_key($request_array, array_flip($keys_tourist));



           $number_of_tourists = count(request()->name);



           $inputed_tourists_id = array();


           // $cannot_changetourist = $bool = filter_var($request_array['allchecked'], FILTER_VALIDATE_BOOLEAN); // TRUE (cannot) OR FALSE (can!)



            // Check if passport already exists in the DB. 

            // If tourist belongs to a tour different from this one:

     

        //   for($i=0; $i<$number_of_tourists; $i++) {

        //       $tourist_attr_same_asindb_count=0;


        //         if ($tourist = Tourist::where('doc_fullnumber', $request_array_tourist['doc_fullnumber'][$i])->first() ) {

        //             // If so, check other input fields of tourist who has this passport:

        //               $here_unnecessary_attr = ['doc_fullnumber'];

        //               $request_array_tourist_no_doc = array_diff_key($request_array_tourist, ['doc_fullnumber' => 0]);

        //               $tourist_attr_to_check_count = count($request_array_tourist_no_doc);


        //               foreach ($request_array_tourist_no_doc as $attribute => $values) { 

        //                             if( $tourist->$attribute != $values[$i] ) {

        //                               if($cannot_changetourist) {


        //                                 if($tourist->tours->count() > $update) {

        //                                 // If other field is different, create a rule (always returns false) with value from DB:

        //                                 $value_from_DB = $tourist->$attribute;

        //                                 $attribute_to_lower = strtolower($attribute);

        //                                 $rules["$attribute.$i"] = "{$attribute_to_lower}_fail:$value_from_DB"; 
        //                                 // validation rule-name can be lowercase only

        //                                   }

        //                                 }
        //                                 // }

        //                             } else { 


        //                                 // If other field is same:

        //                                 $tourist_attr_same_asindb_count+=1;


        //                                   if($tourist_attr_same_asindb_count == $tourist_attr_to_check_count) {

        //                                     $array=array();

        //                                     $array['tourist_id'] = $tourist->id;

        //                                     if ($request_array['is_buyer'] == $i) { 

        //                                         $array['is_buyer'] = 1;

        //                                         $array['is_tourist'] = $request_array['is_tourist']; // Buyer can be a tourist or not (1 or 0)

        //                                     } else {

        //                                         $array['is_buyer'] = 0;

        //                                         $array['is_tourist'] = 1; // Tourist (no buyer) is always tourist

        //                                     }

        //                                     $inputed_tourists_id[] = $array;

        //                                   }


        //                             }

                
        //                 }

        //         }


        //    }




        // if(count($inputed_tourists_id) == $number_of_tourists) {

        //      // Check if such tour exists in the DB:

        //      $tour_already_exists = false;

        //      $tour_where_clause = array();

        //      foreach ($request_array_tour as $key => $value) {
               
        //           $tour_where_clause[] = [$key, $value];
        //      }



        //      $tour_duplicates = Tour::where($tour_where_clause)->get();


        //      if(empty($tour_duplicates->toArray() ) ) {

        //        $tour_duplicates = null;

        //      } else {

        //         foreach ($tour_duplicates as $tour_duplicate) {

        //           if(count($tour_duplicate->tourists) == $number_of_tourists) {

        //             foreach ($tour_duplicate->tourists as $tourist) {

        //               $tour_duplicate_pivot_array[] = array_diff_key($tourist->pivot->toArray(), array_flip($keys_timestamps), ['tour_id'=>0]);

        //             }



        //             if ($tour_duplicate_pivot_array == $inputed_tourists_id) {


        //               $tour_already_exists = true;

        //               $same_tour_id = $tour_duplicate->id;


        //               $rules["tour_exists"] = "tour_exists: $same_tour_id";



        //             }


        //           }

        //         }

        //      }

        // }

    
           
          // Check if such Заявка exists

          // Check if such tour exists

          // If tour exists, check how many tourists are attached to it and compare with number of tourists

          // if tour->tourist->count() = $tour_exists->tourist->count()

          // Проверить doc_fullnumber всех туристов из input-a, есть ли турист с таким doc_fullnumber  в базе. 

          // Если да, проверить, соотвествуют ли массив id всех туристов массиву tour->tourist;

          // Если да, проверить, совпадают ли остальные поля туристов из input-a c тем, что есть в tourist в базе.

          // Если да, выкинуть правило "Точно такая же заявка уже существует в базе!"


         

// 
        // dd($rules);

} else {

  $rules = [];
}
           return $rules;

    }


    public function messages()
    {

      $messages = [
                '*.required' => 'Введите значение!',
                'name.*regex' => 'Только рус. буквы и "-"!', 
                'lastName.*regex' => 'Только рус. буквы и "-"!', 
                'nameEng.*regex' => 'Только лат. буквы и "-"!', 
                'lastNameEng.*regex' => 'Только лат. буквы и "-"!', 
                // 'doc_fullnumber.*distinct' => 'В одном туре не может быть 2-х одинаковых паспортов!',
                'phone.*regex' => 'Только + и цифры!',
                'phone.*min' => 'Минимум 11 цифр',
                'email.*email' => 'Это не email!',
                // 'doc_fullnumber.*required' => 'Введите значение!',
                'doc_seria.*digits' => ":digits цифры!",
                // 'doc_seria.*.*digits:4' => "4 цифры!",
                'doc_number.*numeric' => "Только цифры",
                'doc_number.*regex' => 'Цирфы, буквы лат. и рус., и "-"! ', 
                'is_buyer.required' => 'Выберите заказчика!',
                'is_tourist.required' => 'Выберите "да" или "нет"!',

                ];

      $update = request()->input('is_update');

        if($update == '0') {

          $messages['tour_exists.tour_exists'] = "Такая заявка уже есть БД. Номер заявки :index";

        } elseif($update == '1') {

          $messages['tour_exists.tour_exists'] = "Нечего обновлять!";

        }


        $columns = Tourist::FieldsForValidation();


        $columns = array_flip($columns);


      // Create required and fail rule for every field

      // foreach ($columns as $key => $value) {

      //     $key_required = "$key.*required"; 

      //     $messages[$key_required] = 'Введите значение!';

      //       $key_to_lower = strtolower($key);
          
      //     $key_fail = "$key.*{$key_to_lower}_fail"; // // Rule-name can be only lowercase

      //     $value_fail = "В других заявках как ':index'";

      //     $messages[$key_fail] = $value_fail;

      // }

           return $messages;


    }

}
