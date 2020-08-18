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
            'document_type'     => 'required',
            'document'          => 'required|numeric|digits_between:6,15',
            'customer_name'     => 'required',
            'customer_lastname' => 'required',
            'customer_email'    => 'required|email',
            'customer_mobile'   => 'required|numeric|digits_between:6,15',
            'address'           => 'required',
            'quantity'          => 'required|in:1,2,3',
            'product_id'        => 'required|numeric',
        ];
    }
}
