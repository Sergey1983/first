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
                'document_num.*' => 'required|integer',

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
}
