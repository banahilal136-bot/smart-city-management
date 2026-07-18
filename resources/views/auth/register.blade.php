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


    <form action="#" method="POST">

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
                autocomplete="name"
            >

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
                autocomplete="email"
            >

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
                autocomplete="tel"
            >

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
            >

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
            >

        </div>


        <!-- Register Button -->
        <button
            type="button"
            class="auth-submit"
            onclick="window.location.href='{{ url('/login') }}'"
        >
            إنشاء الحساب
        </button>


        <!-- Login Link -->
        <div class="auth-bottom-link">

            لديك حساب بالفعل؟

            <a href="{{ url('/login') }}">
                تسجيل الدخول
            </a>

        </div>

    </form>

@endsection