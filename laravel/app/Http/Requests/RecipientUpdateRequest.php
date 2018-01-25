<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientUpdateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'thumbnail' => 'image|max:500|dimensions:max_width=300',
            'type' => 'required|max:255',
            'shares' => 'numeric',
            'balance' => 'numeric',
            'start_date' => 'date_format:Y-m-d'
        ];
    }
}
