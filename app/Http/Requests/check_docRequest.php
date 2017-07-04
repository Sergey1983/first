<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class check_docRequest extends FormRequest

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

            'doc_fullnumber.*' => 'required',
        
        ];
    }

    public function messages()

    {
         return [ 

         'doc_fullnumber.*required' => 'Введите номер паспорта!',

         ];
    }
}
