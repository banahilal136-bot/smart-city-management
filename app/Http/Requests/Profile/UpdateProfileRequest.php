<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($this->user()->id),
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'password' => [
                'nullable',
                'string',
                'confirmed',
                Password::min(8),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يرجى إدخال الاسم.',
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
            'phone.required' => 'يرجى إدخال رقم الهاتف.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
            'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل.',
        ];
    }
}