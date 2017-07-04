<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Test;


class TestFormRequest extends FormRequest

{

    public function authorize()

    {
        return true;
    }

 
    public function rules()
    
    {
        
           
            $rules = [

                'fullname.*' => 'required', 
                'document_num.*' => 'required|digits_between:3,15',

            ];

            $documentNums = request()->get('document_num');
            $fullnames = request()->get('fullname');

            for ($i = 0; $i <count($documentNums); $i++) {

                $user = Test::where('document_num', $documentNums[$i])->first();

                
                if($user && ($user->fullname != $fullnames[$i])) {

                    $rules['document_num.'.$i] = 'document_num_fail:'.$i.'';

                }
            }

        return $rules;

    }

    
    public function messages()
    
    {
        return [

            'document_num.*' => [
                'document_num_fail' => 'Input-ed user name doesn`t match his/her name in DB for specified :attribute (field position/number: :index)',
            ]

        ];
    }

    public function attributes()
   
    {
        return [

        'document_num.*' => 'document number',

        ];
    }










}
