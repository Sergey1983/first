<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

use App\Tourist;

use App\Tour;

use App\User;


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


// dump(request()->all());      

      if(request()->allchecked == 'false') {

        $rules = 

          [
            'city_from' => 'required',
            'country' => 'required',
            'airport' => 'required',
            'operator' => 'required',
            'nights' => 'required',
            'date_depart' => 'required|date_format:Y-m-d|after_or_equal:today',
            'hotel' => 'required',
            'room' => 'required',
            'food_type' => 'required',
            'currency' => 'required',
            'price_rub' => 'required|regex: /^\d+(\.\d+)?$/|numeric|max:99999999',
            'transfer' => 'required',
            'noexit_insurance' => 'required',
            'med_insurance' => 'required',
            'visa' => 'required',
            'source' => 'required',
            'operator_full_pay' => 'required|date_format:Y-m-d|before_or_equal:date_depart', 
            'name.*' => 'required|regex: /^[а-яёА-ЯЁ-]+$/u|string|max:255',
            'lastName.*' => 'required|regex: /^[а-яёА-ЯЁ-]+$/u|string|max:255',
            'patronymic.*' => 'required|regex: /^[а-яёА-ЯЁ-]+$/u|string|max:255',
            'nameEng.*' => 'required|regex: /[a-zA-Z\-]/u|string|max:255',
            'lastNameEng.*' => 'required|regex: /[a-zA-Z\-]/u|string|max:255', 
            'birth_date.*' => 'required|date_format:Y-m-d',
            'citizenship.*' => 'required',
            'gender.*' => 'required',
            'email.*' => 'nullable|email|string|max:50',
            'phone.*' => 'nullable|regex: /^\+?\d+$/|string|min:10|max:20', 
            'doc_type.*.*' => 'required',
            'date_issue.*.*' => 'required|date_format:Y-m-d',
            'date_expire.*.*' => 'required|date_format:Y-m-d',
            'is_buyer' => 'required',
            'is_tourist' => 'required',   

           ];


           if(request()->user()->isAdmin() ) {

            $rules['branch_id'] = 'required';

           }

           if (isset(request()->doc_type)) {

             $rus_pass_for_buyer_exists = false;

             $not_foreign_countries = array("Россия", "Абхазия", "Казахстан", "Такджикистан", "Киргизия", "Беларусь", "Украина");

            if(!in_array(request()->country, $not_foreign_countries)) {

               $foreing_country = true;

              }


             foreach (request()->doc_type as $tourist_id => $doc_types) {

                  if(isset($foreing_country)) {

                   $for_pass_4_foreing_country_exists = false;

                  }
               
                foreach ($doc_types as $doc_id => $value) {



                      if($value ==  "Загран. паспорт") {


                        $rules['doc_number.'.$tourist_id.'.'.$doc_id] = 'required|numeric|max_zagran';

                        $rules['doc_seria.'.$tourist_id.'.'.$doc_id] = 'required|digits:2';


                        if(isset($foreing_country)) {

                          $for_pass_4_foreing_country_exists = true;

                        }

                      }

                      if($value ==  "Загран не готов") {

                        $rules['doc_number.'.$tourist_id.'.'.$doc_id] = 'required|numeric';

                        if(isset($foreing_country)) {

                          $for_pass_4_foreing_country_exists = true;

                        }

                      }


                      elseif($value ==  "Внутррос. паспорт") {


                        $rules['doc_number.'.$tourist_id.'.'.$doc_id] = 'required|numeric|max_rus_pass';

                        $rules['doc_seria.'.$tourist_id.'.'.$doc_id] = 'required|digits:4';

                        if($tourist_id == request()->is_buyer) {

                            $rus_pass_for_buyer_exists = true;

                            $rules['who_issued.'.$tourist_id.'.'.$doc_id] = 'required:is_buyer,==,'.$tourist_id;
                            $rules['address_pass.'.$tourist_id.'.'.$doc_id] = 'required:is_buyer,==,'.$tourist_id;
                            $rules['address_real.'.$tourist_id.'.'.$doc_id] = 'required:is_buyer,==,'.$tourist_id;
                        
                        }

                          $rules['date_expire.'.$tourist_id.'.'.$doc_id] = 'nullable';

                      }  


                      elseif($value == "Св-во о рождении"){

                          $rules['date_expire.'.$tourist_id.'.'.$doc_id] = 'nullable';
                          $rules['doc_number.'.$tourist_id.'.'.$doc_id] = ['required', 'regex: /^[ a-zA-Z0-9а-яёА-ЯЁ№-]+$/u', 'string', 'max:255'];


                      }

                      else {

                        $rules['doc_number.'.$tourist_id.'.'.$doc_id] = ['required', 'regex: /^[ a-zA-Z0-9а-яёА-ЯЁ-]+$/u', 'string', 'max:255'];


                      }


                  }

                  if((isset($foreing_country)) && !$for_pass_4_foreing_country_exists) {

                    if(!($tourist_id == request()->is_buyer && request()->is_tourist == 0)) {

                      $rules['for_pas.'.$tourist_id] = 'required';

                    }
                    
                  }

              } 


              if(!$rus_pass_for_buyer_exists) {


                  $rules['rus_pas.'.request()->is_buyer] = 'required';


              }

          }



          foreach (request()->cancel_patronymic as  $id => $cancel_patronymic) {

              if($cancel_patronymic == 1) {
             
               $rules['patronymic.'.$id] = []; 
             
             }

            } 


           if(request()->currency != 'RUB') {

            $rules['price'] = 'required|regex: /^\d+(\.\d+)?$/|numeric|max:99999999';

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

           if(request()->country == 'Россия') {

            $rules['doc_type.*.*'] = 'not_in:Загран. паспорт';

           }

           $number_of_tourists = count(request()->name);


          if($number_of_tourists == 1){

            $rules['is_tourist'] = 'required|not_in:0';

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






           $inputed_tourists_id = array();


      } else {

        $rules = [];

          // Check that existing tourist id is choosen

          if(isset(request()->check_info_tourists)) {

            foreach (request()->check_info_tourists as $key_tourist => $values) {

                if($values['exists'] == 'true') {

                  $rules['check_info_tourists.'.$key_tourist.'.id'] = 'required';

                }
            
            }
          }

      }


// dd($rules);
           return $rules;

    }


    public function messages()
    {

      $messages = [
                'name.*regex' => 'Только рус. буквы и "-"!',
                'name.*max' => 'Не больше 255 символов!', 
                'lastName.*regex' => 'Только рус. буквы и "-"!', 
                'lastName.*max' => 'Не больше 255 символов!', 
                'patronymic.*regex' => 'Только рус. буквы и "-"!', 
                'patronymic.*max' => 'Не больше 255 символов!', 
                'nameEng.*regex' => 'Только лат. буквы и "-"!', 
                'nameEng.*max' => 'Не больше 255 символов!', 
                'lastNameEng.*regex' => 'Только лат. буквы и "-"!', 
                'lastNameEng.*max' => 'Не больше 255 символов!', 
                // 'doc_fullnumber.*distinct' => 'В одном туре не может быть 2-х одинаковых паспортов!',
                'phone.*regex' => 'Только + и цифры!',
                'phone.*min' => 'Минимум 11 цифр',
                'phone.*max' => 'Не больше 20 символов!', 
                'email.*email' => 'Это не email!',
                'email.*max' => 'Не больше 50 символов!', 
                // 'doc_fullnumber.*required' => 'Введите значение!',
                'doc_seria.*digits' => ":digits цифры!",
                // 'doc_seria.*.*digits:4' => "4 цифры!",
                'doc_number.*numeric' => "Только цифры",
                'doc_number.*regex' => 'Цирфы, буквы лат. и рус., и "-"! ', 
                'doc_number.*max' => 'Не больше 255 символов!',
                'is_buyer.required' => 'Выберите заказчика!',
                'is_tourist.required' => 'Выберите "да" или "нет"!',
                'who_issued.*required' => 'Для заказчика обязательно!',
                'address_pass.*required' => 'Для заказчика обязательно!',
                'address_real.*required' => 'Для заказчика обязательно!',
                'rus_pas.*' => 'Закачик должен иметь российский паспорт!',
                'for_pas.*' => 'Для данного тура нужен загранпаспорт!',
                'doc_type.*.*not_in' => "При поездках по России не требуется!",       
                'is_tourist.*not_in' => "Должен быть хотя бы 1 турист!",                
                'date_depart.*after_or_equal' => 'Равно или позже сегодня!',
                '*.required' => 'Введите значение!',
                'date_depart.date_format' => 'Формат даты дд.мм.гггг!',
                'operator_full_pay.date_format' => 'Формат даты дд.мм.гггг!',
                'operator_full_pay.before_or_equal' => 'Раньше или равно дате вылета!',
                'birth_date.*date_format' => 'Формат даты дд.мм.гггг!',
                'date_issue.*.date_format' => 'Формат даты дд.мм.гггг!',
                'date_expire.*.date_format' => 'Формат даты дд.мм.гггг!',
                'price.regex' => 'Сумма к оплате: только цифры и (одна) точка. Правильно: "1000" и "1000.25". Неправильно: "1000,25"',
                'price_rub.regex' => 'Сумма к оплате: только цифры и (одна) точка. Правильно: "1000" и "1000.25". Неправильно: "1000,25"',
                'price.max' => 'Не больше чем 99999999 (если стоимость больше - бери деньги и беги в Казахстан!',
                'price_rub.max' => 'Не больше чем 99999999 (если стоимость больше - бери деньги и беги в Казахстан!',
                'price.numeric' => 'Цена - это число!',
                'price_rub.numeric' => 'Цена - это число!',
                'check_info_tourists.*.id.required' => 'Нужно выбрать!',
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
