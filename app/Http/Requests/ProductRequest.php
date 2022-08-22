<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required | max:100',
            'content' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'company_id' => 'required_without:company_name',
           // 'company_name' => 'required_without:company_id'
        ];
    }
}