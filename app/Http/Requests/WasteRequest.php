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
            'points_transferred' => 'required',
            'waste_section_id' => 'required|exists:waste_sections,id',
            'quantity' => 'required',
            'customer_id' => 'required|exists:customers,id',

        ];
    }

    protected function update(): array
    {
        return [
            'points_transferred' => 'required',
            'waste_section_id' => 'required|exists:waste_sections,id',
            'quantity' => 'required',
            'customer_id' => 'required|exists:customers,id',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'يجب ادخال العميل',
            'waste_section_id.required' => 'يجب ادخال القسم',
            'quantity.required' => 'يجب ادخال الكمية',
            'points_transferred.required' => 'يجب ادخال نقاط التحويل',


        ];
    }
}
