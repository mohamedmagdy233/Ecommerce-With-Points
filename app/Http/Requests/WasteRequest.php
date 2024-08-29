<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WasteRequest extends FormRequest
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
            'value_in_points' => 'required',
            'quantity' => 'required',
            'customer_id' => 'required|exists:customers,id',

        ];
    }

    protected function update(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'value_in_points' => 'required',
            'quantity' => 'required',
            'customer_id' => 'required|exists:customers,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب ادخال الاسم',
            'description.required' => 'يجب ادخال الوصف',
            'value_in_points.required' => 'يجب ادخال القيمة',
            'quantity.required' => 'يجب ادخال الكمية',
            'customer_id.required' => 'يجب ادخال العميل',
        ];
    }
}
