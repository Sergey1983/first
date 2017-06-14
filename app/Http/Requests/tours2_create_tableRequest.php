<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tours2_create_tableRequest extends FormRequest
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


        return [

          'сity_from' => 'required',
          'hotel' => 'required',
          'name.*' => 'required',
          'lastName.*' => 'required',
          'birth_date.*' => 'required',
          'doc_fullnumber.*' => 'required|distinct|unique:tourists,doc_fullnumber'

            
        ];


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
                'doc_fullnumber.*unique' => 'Пасспорт уже есть в Базе Данных!',
                'doc_fullnumber.*distinct' => 'В одном туре не может быть 2-х одинаковых паспортов!'
                ];
    }

}
