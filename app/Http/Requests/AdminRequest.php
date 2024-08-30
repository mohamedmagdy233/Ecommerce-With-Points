<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        if ($this->isMethod('put')) {
            return $this->update();
        } else {
            return $this->store();
        }
    }

    protected function store(): array
    {
        return [
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|unique:admins,user_name|max:255',
            'code' => 'required|string|unique:admins,code|max:50',
            'email' => 'required|email|unique:admins,email|max:255',
            'phone' => 'required|string|unique:admins,phone|max:20',
            'password' => 'required|string|min:6|confirmed',
            'permissions' => 'required|array', // Validate that permissions is an array
            'permissions.*' => 'in:' . implode(',', array_column(\App\Enums\RoleEnum::cases(), 'value')), // Validate each permission
        ];
    }

    protected function update(): array
    {
        return [
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|unique:admins,user_name,' . $this->admin . '|max:255',
            'code' => 'required|string|unique:admins,code,'  . $this->admin . '|max:50',
            'email' => 'required|email|unique:admins,email,' . $this->admin . '|max:255',
            'phone' => 'required|string|unique:admins,phone,' . $this->admin . '|max:20',
            'password' => 'nullable|string|min:6|confirmed',
            'permissions' => 'required|array', // Validate that permissions is an array
            'permissions.*' => 'in:' . implode(',', array_column(\App\Enums\RoleEnum::cases(), 'value')), // Validate each permission
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'يجب ادخال الاسم',
            'user_name.required' => 'يجب ادخال اسم المستخدم',
            'user_name.unique' => 'اسم المستخدم مستخدم من قبل',
            'code.required' => 'يجب ادخال كود المستخدم',
            'email.required' => 'يجب ادخال الإيميل',
            'email.unique' => 'الإيميل مستخدم من قبل',
            'phone.required' => 'يجب ادخال رقم الهاتف',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل',
            'password.required' => 'يجب ادخال كلمة مرور',
            'password.min' => 'الحد الادني لكلمة المرور : 6 أحرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'permissions.required' => 'يجب اختيار صلاحيات',
            'permissions.*.in' => 'صلاحية غير صحيحة',
        ];
    }
}
