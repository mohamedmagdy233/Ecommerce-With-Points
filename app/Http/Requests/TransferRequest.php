<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransferRequest extends FormRequest
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
            'from_id' => 'required|exists:customers,id',
            'to_id' => 'required|exists:customers,id',
            'points' => 'required|numeric',

        ];
    }

    protected function update(): array
    {
        return [
            'from_id' => 'required|exists:customers,id',
            'to_id' => 'required|exists:customers,id',
            'points' => 'required|numeric',
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
