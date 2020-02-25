<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProduct extends FormRequest
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
            'product_name' => 'required',
			'select_category' => 'required',
			'select_multiple_category' => 'required',
			'product_description'   => 'required',
			'select_image'  => 'required|mimes:png,jpeg,jpg',
			'price'			=>	'required|numeric',		
			'discount'     => 'required|numeric',
        ];
    }
}
