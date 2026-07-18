@extends('layouts.auth')

@section('title', 'تسجيل الدخول - Smart City')

@section('content')

    <div class="auth-form-header">

        <h2>
            أهلاً بعودتك 👋
        </h2>

        <p>
            أدخل بيانات حسابك للوصول إلى نظام إدارة البلاغات.
        </p>

    </div>


    <form action="#" method="POST">

        @csrf


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
                autocomplete="email"
            >

        </div>


        <!-- Password -->
        <div class="auth-field">

            <label for="password">
                كلمة المرور
            </label>

            <div class="auth-input-wrapper">

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="auth-input"
                    placeholder="أدخل كلمة المرور"
                    autocomplete="current-password"
                >

            </div>

        </div>


        <!-- Remember Me -->
        <div
            style="
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 15px;
                margin-bottom: 18px;
            "
        >

            <label
                style="
                    display: flex;
                    align-items: center;
                    gap: 7px;
                    margin: 0;
                    cursor: pointer;
                    color: #6b7280;
                    font-size: 12px !important;
                "
            >

                <input
                    type="checkbox"
                    name="remember"
                    style="
                        width: 16px;
                        height: 16px;
                        accent-color: #2f8f83;
                    "
                >

                تذكرني

            </label>


            <a
                href="#"
                style="
                    color: #167063;
                    font-size: 12px;
                    font-weight: 800;
                    text-decoration: none;
                "
            >
                نسيت كلمة المرور؟
            </a>

        </div>


        <!-- Login Button -->
        <button
            type="button"
            class="auth-submit"
            onclick="window.location.href='{{ route('dashboard') }}'"
        >
            تسجيل الدخول
        </button>


        <!-- Register Link -->
        <div class="auth-bottom-link">

            ليس لديك حساب؟

            <a href="{{ url('/register') }}">
                إنشاء حساب جديد
            </a>

        </div>

    </form>

@endsection