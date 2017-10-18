<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Currency;

class ConvertRequest extends FormRequest
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
        $currency = new Currency;
        $prepared_currency = implode(',', array_keys($currency->list_of_currency()));

        return [
            'amount' => 'required|between:0,'.PHP_INT_MAX,
            'from' => 'required|in:' . $prepared_currency,
            'to' => 'required|in:' . $prepared_currency
        ];
    }
}
