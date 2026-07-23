<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'report_type_id' => [
                'required',
                'integer',
                'exists:report_types,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
                'max:5000',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'address' => [
                'required',
                'string',
                'max:2000',
            ],

            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],

            'status' => [
                'nullable',
                'in:new,in_progress,resolved',
            ],

            'remove_image' => [
                'nullable',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'report_type_id.required' => 'يرجى اختيار نوع البلاغ.',
            'report_type_id.integer' => 'نوع البلاغ المحدد غير صحيح.',
            'report_type_id.exists' => 'نوع البلاغ المحدد غير موجود.',

            'title.required' => 'عنوان البلاغ مطلوب.',
            'title.string' => 'عنوان البلاغ يجب أن يكون نصًا.',
            'title.max' => 'عنوان البلاغ يجب ألا يتجاوز 255 حرفًا.',

            'description.required' => 'وصف البلاغ مطلوب.',
            'description.string' => 'وصف البلاغ يجب أن يكون نصًا.',
            'description.max' => 'وصف البلاغ يجب ألا يتجاوز 5000 حرف.',

            'image.image' => 'الملف المرفوع يجب أن يكون صورة.',
            'image.mimes' => 'صيغة الصورة يجب أن تكون JPG أو JPEG أو PNG أو WEBP.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 5 ميغابايت.',

            'address.required' => 'عنوان موقع البلاغ مطلوب.',
            'address.string' => 'عنوان الموقع يجب أن يكون نصًا.',
            'address.max' => 'عنوان الموقع طويل جدًا.',

            'latitude.required' => 'يرجى تحديد موقع البلاغ على الخريطة.',
            'latitude.numeric' => 'خط العرض غير صحيح.',
            'latitude.between' => 'قيمة خط العرض غير صحيحة.',

            'longitude.required' => 'يرجى تحديد موقع البلاغ على الخريطة.',
            'longitude.numeric' => 'خط الطول غير صحيح.',
            'longitude.between' => 'قيمة خط الطول غير صحيحة.',

            'status.in' => 'حالة البلاغ المحددة غير صحيحة.',
            'remove_image.boolean' => 'قيمة حذف الصورة غير صحيحة.',
        ];
    }
}