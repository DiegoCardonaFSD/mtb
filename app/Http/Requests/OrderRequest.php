<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'customer_name'     => 'required',
            'customer_email'    => 'required|email',
            'customer_mobile'   => 'required|numeric',
            'quantity'          => 'required|in:1,2,3',
            'product_id'        => 'required|numeric',
        ];
    }
}
