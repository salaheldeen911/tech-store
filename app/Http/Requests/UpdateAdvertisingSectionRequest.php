<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertisingSectionRequest extends FormRequest
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
            "id" => "required",
            "brand_id" => "required_without:category_id",
            "category_id" => "required_without:brand_id",
            "image" => "mimes:png,jpg,jpeg|max:5048",
            "lable" => "mimes:png,jpg,jpeg|max:5048",
        ];
    }
}
