<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
        if (request()->isMethod('put')) {
            return $this->update();
        } else {
            return $this->store();
        }
    }

    protected function store(): array
    {
        return [
            'name' => 'required',
            'user_name' => 'required|unique:admins,user_name',
            'code' => 'required|unique:admins,code',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required',
        ];
    }

    protected function update(): array
    {
        return [
            'name' => 'required',
            'user_name' => 'required|unique:admins,user_name,' . $this->admin,
            'code' => 'required|unique:admins,code,'  . $this->admin,
            'email' => 'required|email|unique:admins,email,' . $this->admin,
            'password' => 'nullable|min:6|confirmed',
            'role_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => 'صيغة الصورة غير مسموحة',
            'name.required' => 'يجب ادخال الاسم',
            'email.required' => 'يجب ادخال الإيميل',
            'email.unique' => 'الإيميل مستخدم من قبل',
            'password.required_without' => 'يجب ادخال كلمة مرور',
            'password.min' => 'الحد الادني لكلمة المرور : 6 أحرف',
        ];
    }
}
