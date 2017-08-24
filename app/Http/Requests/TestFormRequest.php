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
                'smth.*'=> 'required',
                'document_num.*' => 'required|digits_between:3,15',

            ];

            $fullnames = request()->get('fullname');
            $smths = request()->get('smth');
            $documentNums = request()->get('document_num');



            for ($i = 0; $i <count($documentNums); $i++) {

                $user = Test::where('document_num', $documentNums[$i])->first();


                
                if($user) {

                    if($user->fullname != $fullnames[$i]) {

                        $rules['fullname.'.$i] = "fullname_fail:$user->fullname";

                    } 

                    if ($user->smth != $smths[$i]) {

                        $rules['smth.'.$i] = "smth_fail:$user->smth";

                    }


                }
            }

        return $rules;

  
                          

    }


    public function messages() {

        return 

        [
             'fullname.*fullname_fail' => 'Прежнее имя :index',
             'smth.*smth_fail' => 'Прежнее smth :index',

        ];

    }













}
