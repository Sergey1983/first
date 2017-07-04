<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Tourist;

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

      $rules = 

         [

          'сity_from' => 'required',
          'hotel' => 'required',
          'name.*' => 'required',
          'lastName.*' => 'required',
          'birth_date.*' => 'required',
          'doc_fullnumber.*' => 'required|digits_between:3,15', 
          'is_buyer' => 'required',
          'is_tourist' => 'required'
            
        ];

        $names = request()->get('name');
        $lastNames = request()->get('lastName');
        $birth_date = request()->get('birth_date'); 
        $doc_fullnumbers = request()->get('doc_fullnumber'); 
        $is_buyer = request()->get('is_buyer');
        $is_tourist = request()->get('is_tourist'); 


        for ($i=0; $i<count($names); $i++) {

          $tourist = Tourist::where('doc_fullnumber', $doc_fullnumbers[$i])->first();

          if($tourist &&)

        }

        return $rules;

    }




    public function messages()
    {
        return [
                'сity_from.required' => 'Введите город!',
                'hotel.required' => 'Введите отель!',
                'name.*required' => 'Введите имя!',
                'lastName.*required' => 'Введите фамилию!',
                'birth_date.*required' => 'Введите дату рождения!',
                'doc_fullnumber.*required' => 'Введите номер пасспорта!',
                // 'doc_fullnumber.*unique' => 'Пасспорт уже есть в Базе Данных!',
                'doc_fullnumber.*distinct' => 'В одном туре не может быть 2-х одинаковых паспортов!',
                'is_buyer.required' => 'Выберите заказчика!',
                'is_tourist.required' => 'Выберите "да" или "нет"!'
                ];
    }

}
