<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            return $this->store();
        } elseif (request()->isMethod('put')) {
            return $this->update();
        }
    }

    public function store()
    {
        return [
            'award_points' => 'required',
            'quantity' => 'required',
            'prices' => 'required',
            'total_award_points' => 'required',
            'delivery_type' => 'required',
            'address' => 'required',
            'customer_id' => 'required',
            'use_points' => 'required',
            'total_price' => 'required'
        ];


    }

    public function update()
    {
        return [
            'award_points' => 'required',
            'quantity' => 'required',
            'prices' => 'required',
            'total_award_points' => 'required',
            'delivery_type' => 'required',
            'address' => 'required',
            'customer_id' => 'required',
            'use_points' => 'required',
            'total_price' => 'required'
        ];

    }
}
