<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest
{
    protected $mainRules =  [
        "data.name" => ['required', 'min:2'],
        "data.title" => ['required', 'min:20', 'max:254', 'string'],
        "data.used" => "boolean|nullable",
        "data.category_id" => "required|exists:categories,id",
        "data.discount" => "required_with:data.discount|lt:data.price|regex:/^\d+(\.\d{1,2})?$/|gt:-1|max:999999.99",
        "data.price" => "required_with:data.price|gt:data.discount|regex:/^\d+(\.\d{1,2})?$/|gt:0|max:999999.99",
        "data.brand_id" => "required|exists:brands,id",
        "data.color_id" => "required|exists:colors,id",
        "data.quantity" => "required|numeric|gt:0|max:120",
        'data.images' => 'required_if:oldImages,==,false|max:4',
        "data.images.*" => "required_if:oldImages,==,false",
        "dataDetails.description" => "required",
    ];
    // image|mimes:png,jpg,jpeg|max:5048|
}
