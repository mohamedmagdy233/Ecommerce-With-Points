<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'image' => 'image|required|max:10000',
        ];
    }

    protected function update(): array
    {
        return [
            'name' => 'required',
            'image' => 'image|required|max:10000',
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'يجب ادخال الاسم',
            'image.required' => 'يجب ادخال الصورة',
            'image.mimes' => 'يجب ان تكون الصورة jpeg,jpg,png,gif',


        ];
    }
}
