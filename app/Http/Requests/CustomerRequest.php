<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|unique:customers,phone',
            'address' => 'required',
        ];
    }

    protected function update(): array
    {
        return [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('customers', 'email')->ignore($this->id),
            ],

            'phone' => ['required',
                Rule::unique('customers', 'phone')->ignore($this->id)],
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'يجب ادخال الاسم',
            'email.required' => 'يجب ادخال البريد الالكتروني',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل',
            'phone.required' => 'يجب ادخال رقم الهاتف',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل',
            'address.required' => 'يجب ادخال العنوان',

        ];
    }
}
