<?php

namespace App\Http\Requests\BackEnd\OutCome;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'desc' => 'required',
            'value' => 'required',
            'date' => 'required',
            'category_id' => 'required',
        ];
    }
}
