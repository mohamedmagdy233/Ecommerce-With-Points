<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => 'required|exists:customers,phone',
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return
            [
                'password.required' => 'يجب ادخال كلمة المرور',
                'phone.required' => 'يجب ادخال رقم الهاتف',
                'phone.exists' => 'رقم الهاتف غير صحيح',

            ];
    }
}
