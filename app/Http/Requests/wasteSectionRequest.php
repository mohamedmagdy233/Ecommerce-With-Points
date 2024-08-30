<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class wasteSectionRequest extends FormRequest
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
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'point_per_one' => 'required|numeric',
        ];
    }

    protected function update(): array
    {
        return [
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'point_per_one' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'يجب ادخال الاسم',
            'image.required' => 'يجب ادخال الصورة',
            'image.mimes' => 'يجب ان تكون الصورة jpeg,jpg,png,gif',
            'image.max' => 'يجب ان لا يزيد الصورة عن 10000kb',
            'point_per_one.required' => 'يجب ادخال نقطة لكل وحدة',
            'point_per_one.numeric' => 'يجب ادخال نقطة لكل وحدة عددية',


        ];
    }
}
