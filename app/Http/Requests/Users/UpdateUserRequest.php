<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $user = $this->route('user');

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
                Rule::unique('users', 'email')->ignore($user),
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

            'role' => [
                'required',
                Rule::in([
                    User::ROLE_ADMIN,
                    User::ROLE_EMPLOYEE,
                    User::ROLE_CITIZEN,
                ]),
            ],

            'status' => [
                'required',
                Rule::in([
                    User::STATUS_ACTIVE,
                    User::STATUS_INACTIVE,
                ]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يرجى إدخال اسم المستخدم.',

            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',

            'phone.required' => 'يرجى إدخال رقم الهاتف.',

            'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل.',

            'role.required' => 'يرجى تحديد دور المستخدم.',
            'role.in' => 'الدور المحدد غير صالح.',

            'status.required' => 'يرجى تحديد حالة الحساب.',
            'status.in' => 'حالة الحساب المحددة غير صالحة.',

            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ];
    }
}