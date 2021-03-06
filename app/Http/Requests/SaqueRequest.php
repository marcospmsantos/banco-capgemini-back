<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaqueRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'valor' => array(
                'required',
                'regex:/^([1-9]){1}([\d]){0,11}?(\.[0]{1,2})?$/'
            ),
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'valor.required' => 'É necessário informar um valor',
            'valor.regex' => 'Valor precisa ser maior que R$ 1,00 e não pode centavos',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
