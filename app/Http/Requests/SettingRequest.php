<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
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
            'logo' => 'nullable|image',
            'footer_logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'title_ar' => 'required',
            'title_en' => 'required',
            'footer_ar' => 'required',
            'footer_en' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
            'instagram' => 'required',
            'location_ar' => 'required',
            'location_en' => 'required',
            'location_url' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];
    }

    protected function update(): array
    {
        return [
            'logo.required' => 'اللوجو مطلوب',
            'favicon.required' => 'الايكون مطلوب',
            'title_ar.required' => 'العنوان باللغة العربية مطلوب',
            'title_en.required' => 'العنوان باللغة الإنجليزية مطلوب',
            'footer_ar.required' => 'التذييل باللغة العربية مطلوب',
            'footer_en.required' => 'التذييل باللغة الإنجليزية مطلوب',
            'facebook.required' => 'حساب الفيسبوك مطلوب',
            'twitter.required' => 'حساب تويتر مطلوب',
            'youtube.required' => 'حساب يوتيوب مطلوب',
            'instagram.required' => 'حساب إنستجرام مطلوب',
            'location_ar.required' => 'العنوان باللغة العربية مطلوب',
            'location_en.required' => 'العنوان باللغة الإنجليزية مطلوب',
            'location_url.required' => 'رابط الموقع مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
        ];
    }

    public function messages()
    {
        return [
            'logo.image' => 'صورة غير صالحة',
            'favicon.image' => 'صورة غير صالحة',
        ];
    }
}
