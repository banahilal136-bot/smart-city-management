<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Smart City')
    </title>

    <!-- Cairo Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >

    <!-- AdminKit CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('admin/css/app.css') }}"
    >

    <!-- Custom CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('admin/css/custom.css') }}"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family: 'Cairo', sans-serif !important;

            background:
                linear-gradient(
                    135deg,
                    #f4faf8 0%,
                    #e9f5f2 50%,
                    #f7fbfa 100%
                ) !important;
        }

        .auth-page {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 20px;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 1050px;

            min-height: 620px;

            display: grid;
            grid-template-columns: 1fr 1fr;

            overflow: hidden;

            border-radius: 30px;

            background: #ffffff;

            box-shadow:
                0 25px 70px
                rgba(15, 107, 96, 0.16);
        }


        /* =========================
           Branding Side
        ========================= */

        .auth-brand-side {
            position: relative;

            padding: 55px 45px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            overflow: hidden;

            background:
                linear-gradient(
                    160deg,
                    #0f6b60 0%,
                    #07564d 100%
                );

            color: #ffffff;
        }

        .auth-brand-side::before {
            content: '';

            position: absolute;

            width: 330px;
            height: 330px;

            top: -120px;
            left: -130px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.07);
        }

        .auth-brand-side::after {
            content: '';

            position: absolute;

            width: 250px;
            height: 250px;

            bottom: -100px;
            right: -90px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.06);
        }


        /* Logo */

        .auth-logo {
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;

            gap: 14px;
        }

        .auth-logo-icon {
            width: 64px;
            height: 64px;

            border-radius: 20px;

            background:
                linear-gradient(
                    135deg,
                    #ffffff,
                    #e8f6f2
                );

            color: #167063;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            box-shadow:
                0 12px 26px
                rgba(0, 0, 0, 0.20);
        }

        .auth-logo-icon svg {
            width: 42px;
            height: 42px;

            fill: none;

            stroke: currentColor;

            stroke-width: 3;

            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .auth-logo-text {
            display: flex;
            flex-direction: column;
        }

        .auth-logo-title {
            font-size: 25px !important;
            font-weight: 900;

            color: #ffffff !important;

            line-height: 1.3;
        }

        .auth-logo-subtitle {
            margin-top: 3px;

            font-size: 12px !important;
            font-weight: 700;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.76
                ) !important;
        }


        /* Branding Content */

        .auth-brand-content {
            position: relative;
            z-index: 2;

            margin: 50px 0;
        }

        .auth-brand-content h1 {
            margin-bottom: 18px;

            color: #ffffff !important;

            font-size: 34px !important;
            font-weight: 900 !important;

            line-height: 1.5;
        }

        .auth-brand-content p {
            margin: 0;

            max-width: 420px;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.78
                ) !important;

            font-size: 14px !important;

            line-height: 2;
        }


        /* Features */

        .auth-features {
            position: relative;
            z-index: 2;

            display: flex;
            flex-direction: column;

            gap: 12px;
        }

        .auth-feature {
            display: flex;
            align-items: center;

            gap: 10px;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.90
                );

            font-size: 13px;
            font-weight: 700;
        }

        .auth-feature-icon {
            width: 27px;
            height: 27px;

            border-radius: 9px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.13
                );
        }


        /* =========================
           Form Side
        ========================= */

        .auth-form-side {
            padding: 55px 55px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #ffffff;
        }

        .auth-form-container {
            width: 100%;
            max-width: 410px;
        }

        .auth-form-header {
            margin-bottom: 32px;
        }

        .auth-form-header h2 {
            margin: 0 0 8px;

            color: #1f2937 !important;

            font-size: 27px !important;
            font-weight: 900 !important;
        }

        .auth-form-header p {
            margin: 0;

            color: #7b8794 !important;

            font-size: 13px !important;

            line-height: 1.8;
        }


        /* Inputs */

        .auth-field {
            margin-bottom: 19px;
        }

        .auth-field label {
            display: block;

            margin-bottom: 8px;

            color: #374151;

            font-size: 13px !important;
            font-weight: 800;
        }

        .auth-input-wrapper {
            position: relative;
        }

        .auth-input {
            width: 100%;
            height: 49px;

            padding: 0 16px;

            border:
                1px solid
                #e1e8e6 !important;

            border-radius:
                14px !important;

            outline: none;

            background:
                #f9fbfb !important;

            color:
                #1f2937 !important;

            font-family:
                'Cairo',
                sans-serif !important;

            font-size:
                13px !important;

            transition:
                all 0.2s ease;
        }

        .auth-input:focus {
            background:
                #ffffff !important;

            border-color:
                #2f8f83 !important;

            box-shadow:
                0 0 0 4px
                rgba(
                    47,
                    143,
                    131,
                    0.10
                );
        }

        .auth-input::placeholder {
            color: #a1aaa8;
        }


        /* Buttons */

        .auth-submit {
            width: 100%;
            height: 50px;

            margin-top: 7px;

            border: none;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #2f8f83,
                    #167063
                );

            color: #ffffff;

            font-family:
                'Cairo',
                sans-serif;

            font-size: 14px;
            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 10px 22px
                rgba(
                    47,
                    143,
                    131,
                    0.22
                );

            transition:
                all 0.2s ease;
        }

        .auth-submit:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 14px 28px
                rgba(
                    47,
                    143,
                    131,
                    0.28
                );
        }


        /* Bottom Link */

        .auth-bottom-link {
            margin-top: 25px;

            text-align: center;

            color: #7b8794;

            font-size: 13px;
        }

        .auth-bottom-link a {
            color: #167063;

            font-weight: 900;

            text-decoration: none;
        }

        .auth-bottom-link a:hover {
            color: #0f6b60;

            text-decoration: underline;
        }


        /* =========================
           Responsive
        ========================= */

        @media (max-width: 900px) {

            .auth-wrapper {
                max-width: 600px;

                grid-template-columns: 1fr;
            }

            .auth-brand-side {
                min-height: 300px;

                padding: 35px 30px;
            }

            .auth-brand-content {
                margin: 35px 0;
            }

            .auth-brand-content h1 {
                font-size: 27px !important;
            }

            .auth-features {
                display: none;
            }

            .auth-form-side {
                padding: 45px 30px;
            }
        }

        @media (max-width: 480px) {

            .auth-page {
                padding: 15px;
            }

            .auth-wrapper {
                border-radius: 22px;
            }

            .auth-brand-side {
                padding: 30px 22px;
            }

            .auth-form-side {
                padding: 35px 22px;
            }

            .auth-logo-title {
                font-size: 21px !important;
            }

            .auth-form-header h2 {
                font-size: 23px !important;
            }
        }

    </style>

    @stack('styles')
</head>


<body>

<button
    type="button"
    id="themeToggle"
    class="theme-switch-fancy"
    aria-label="تبديل الوضع"
>
    <span class="theme-switch-shine"></span>
    <span id="themeIcon" class="theme-switch-icon">🌙</span>
</button>

    <main class="auth-page">

        <div class="auth-wrapper">

            <!-- Branding Side -->
            <section class="auth-brand-side">

                <div class="auth-logo">

                    <div class="auth-logo-icon">

                        <svg
                            viewBox="0 0 64 64"
                            aria-hidden="true"
                        >
                            <path d="M8 54H56" />
                            <path d="M14 54V27L25 19L36 27V54" />
                            <path d="M28 54V14H48V54" />

                            <path d="M18 32H22" />
                            <path d="M18 39H22" />
                            <path d="M18 46H22" />

                            <path d="M30 21H34" />
                            <path d="M30 28H34" />
                            <path d="M30 35H34" />
                            <path d="M30 42H34" />

                            <path d="M40 21H44" />
                            <path d="M40 28H44" />
                            <path d="M40 35H44" />
                            <path d="M40 42H44" />

                            <path d="M25 19V11" />
                            <path d="M21 11H29" />

                            <circle
                                cx="25"
                                cy="8"
                                r="2"
                            />

                            <path d="M48 31L54 26V54" />
                        </svg>

                    </div>

                    <div class="auth-logo-text">

                        <span class="auth-logo-title">
                            Smart City
                        </span>

                        <span class="auth-logo-subtitle">
                            نظام إدارة البلاغات
                        </span>

                    </div>

                </div>


                <div class="auth-brand-content">

    <span class="auth-brand-eyebrow">
        ✦ منصة المدينة الذكية
    </span>

    <h1>
        <span class="auth-headline-main">
            مدينة أذكى،
        </span>

        <span class="auth-headline-accent">
            خدمات أفضل
        </span>
    </h1>

    <p>
        منصة موحدة لتقديم البلاغات ومتابعتها
        والمساهمة في تحسين جودة الخدمات داخل المدينة.
    </p>

</div>


                <div class="auth-features">

                    <div class="auth-feature">

                        <span class="auth-feature-icon">
                            ✓
                        </span>

                        تقديم البلاغات بسهولة

                    </div>

                    <div class="auth-feature">

                        <span class="auth-feature-icon">
                            ✓
                        </span>

                        متابعة حالة البلاغ

                    </div>

                    <div class="auth-feature">

                        <span class="auth-feature-icon">
                            ✓
                        </span>

                        المساهمة في تطوير المدينة

                    </div>

                </div>

            </section>


            <!-- Page Content -->
            <section class="auth-form-side">

                <div class="auth-form-container">

                    @yield('content')

                </div>

            </section>

        </div>

    </main>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');

            const savedTheme = localStorage.getItem('theme');

            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                themeToggle.classList.add('is-dark');
                themeIcon.textContent = '☀️';
            }

            themeToggle.addEventListener('click', function () {

                document.body.classList.toggle('dark-mode');

                const isDark =
                    document.body.classList.contains('dark-mode');

                themeToggle.classList.toggle('is-dark', isDark);

                themeIcon.textContent =
                    isDark ? '☀️' : '🌙';

                localStorage.setItem(
                    'theme',
                    isDark ? 'dark' : 'light'
                );
            });

        });
    </script>

</body>

</html>