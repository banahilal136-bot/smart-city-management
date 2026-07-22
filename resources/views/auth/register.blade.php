@extends('layouts.auth')

@section('title', 'إنشاء حساب - Smart City')

@section('content')

    <div class="auth-form-header">

        <h2>
            إنشاء حساب جديد
        </h2>

        <p>
            أنشئ حسابك كمواطن لتتمكن من تقديم البلاغات ومتابعتها.
        </p>

    </div>


    <form action="{{ route('register.store') }}" method="POST">

        @csrf


        <!-- Full Name -->
        <div class="auth-field">

            <label for="name">
                الاسم الكامل
            </label>

            <input
                type="text"
                id="name"
                name="name"
                class="auth-input"
                placeholder="أدخل الاسم الكامل"
                value="{{ old('name') }}"
                autocomplete="name"
                required
                autofocus
            >

            @error('name')
                <div
                    style="
                        margin-top: 6px;
                        color: #dc2626;
                        font-size: 11px;
                        font-weight: 700;
                    "
                >
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Email -->
        <div class="auth-field">

            <label for="email">
                البريد الإلكتروني
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="auth-input"
                placeholder="example@email.com"
                value="{{ old('email') }}"
                autocomplete="email"
                required
            >

            @error('email')
                <div
                    style="
                        margin-top: 6px;
                        color: #dc2626;
                        font-size: 11px;
                        font-weight: 700;
                    "
                >
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Phone -->
        <div class="auth-field">

            <label for="phone">
                رقم الهاتف
            </label>

            <input
                type="tel"
                id="phone"
                name="phone"
                class="auth-input"
                placeholder="أدخل رقم الهاتف"
                value="{{ old('phone') }}"
                autocomplete="tel"
                required
            >

            @error('phone')
                <div
                    style="
                        margin-top: 6px;
                        color: #dc2626;
                        font-size: 11px;
                        font-weight: 700;
                    "
                >
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Password -->
        <div class="auth-field">

            <label for="password">
                كلمة المرور
            </label>

            <input
                type="password"
                id="password"
                name="password"
                class="auth-input"
                placeholder="أدخل كلمة المرور"
                autocomplete="new-password"
                required
            >

            @error('password')
                <div
                    style="
                        margin-top: 6px;
                        color: #dc2626;
                        font-size: 11px;
                        font-weight: 700;
                    "
                >
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- Confirm Password -->
        <div class="auth-field">

            <label for="password_confirmation">
                تأكيد كلمة المرور
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="auth-input"
                placeholder="أعد إدخال كلمة المرور"
                autocomplete="new-password"
                required
            >

        </div>


        <!-- Register Button -->
        <button
            type="submit"
            class="auth-submit"
        >
            إنشاء الحساب
        </button>


        <!-- Login Link -->
        <div class="auth-bottom-link">

            لديك حساب بالفعل؟

            <a href="{{ route('login') }}">
                تسجيل الدخول
            </a>

        </div>

    </form>

@endsection