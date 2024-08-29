<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required',

        ];
    }

    protected function update(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'يجب ادخال الاسم',
            'description.required' => 'يجب ادخال الوصف',
            'price.required' => 'يجب ادخال السعر',
            'quantity.required' => 'يجب ادخال الكمية',
            'image.required' => 'يجب ادخال الصورة',

        ];
    }
}
