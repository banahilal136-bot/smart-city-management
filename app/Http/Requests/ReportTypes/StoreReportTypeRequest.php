<?php

namespace App\Http\Requests\ReportTypes;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:report_types,name',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:255',
            ],

            'priority' => [
                'required',
                'in:low,medium,high',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],

            'department' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'internal_notes' => [
                'nullable',
                'string',
                'max:3000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم نوع البلاغ مطلوب.',
            'name.string' => 'اسم نوع البلاغ يجب أن يكون نصًا.',
            'name.max' => 'اسم نوع البلاغ يجب ألا يتجاوز 255 حرفًا.',
            'name.unique' => 'يوجد نوع بلاغ بهذا الاسم مسبقًا.',

            'icon.string' => 'قيمة الأيقونة غير صحيحة.',
            'icon.max' => 'قيمة الأيقونة طويلة جدًا.',

            'priority.required' => 'يرجى اختيار أولوية نوع البلاغ.',
            'priority.in' => 'الأولوية المحددة غير صحيحة.',

            'status.required' => 'يرجى اختيار حالة نوع البلاغ.',
            'status.in' => 'الحالة المحددة غير صحيحة.',

            'department.string' => 'اسم القسم يجب أن يكون نصًا.',
            'department.max' => 'اسم القسم يجب ألا يتجاوز 255 حرفًا.',

            'description.string' => 'الوصف يجب أن يكون نصًا.',
            'description.max' => 'الوصف يجب ألا يتجاوز 2000 حرف.',

            'internal_notes.string' => 'الملاحظات الداخلية يجب أن تكون نصًا.',
            'internal_notes.max' => 'الملاحظات الداخلية يجب ألا تتجاوز 3000 حرف.',
        ];
    }
}