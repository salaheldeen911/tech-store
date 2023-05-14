<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAdminRequest extends FormRequest
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
            'name' => ['string', 'required', 'max:40'],
            'email' => ['string', 'required', 'email', 'max:60', 'unique:users,email'],
            "expire_at" => ['date', 'required'],
            'password' => ['string', 'required', 'min:8'],
            'phone' => ['string', 'required', 'unique:users,phone', 'digits:11', 'regex:/^(\+201|01|00201)[0-2,5]{1}[0-9]{8}/'],
            'role' => ['in:1,2,3', 'required'],
        ];
    }
}
