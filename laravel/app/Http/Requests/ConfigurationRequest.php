<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationRequest extends FormRequest
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
            'api_key' => 'required|max:255',
            'number_cpus' => 'required|numeric',
            'electricity_cost' => 'required|numeric',
            'fiat_currency_symbol' => 'required|max:5',
            'crypto_currency_symbol' => 'required|max:60',
        ];
    }
}
