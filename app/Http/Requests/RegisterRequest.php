<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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


    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'min:11'],
            'address' => ['nullable', 'string', 'max:255'],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'password.required' => 'كلمة المرور مطلوبة',
            'phone.required' => 'رقم الهاتف مطلوب',
            'address.required' => 'العنوان مطلوب',
        ];

    }
}
