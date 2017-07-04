<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class findPassengersRequest extends FormRequest
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
            'tour' => 'required|exists:tour2s,id'
        ];
    }

        public function messages()
    {
        return [
            'tour.required' => 'Введите номер заявки!',
            'tour.exists:tour2s,id' => 'Заявки нет в базе!',

        ];

    }
}
