<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - غير مسموح</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Cairo', sans-serif;
            background:
                radial-gradient(circle at top right, rgba(71, 181, 160, 0.18), transparent 25%),
                radial-gradient(circle at bottom left, rgba(15, 118, 110, 0.15), transparent 25%),
                linear-gradient(135deg, #0f172a 0%, #111827 45%, #0b1220 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #ffffff;
        }

        .error-wrapper {
            width: 100%;
            max-width: 760px;
        }

        .error-card {
            position: relative;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(14px);
            border-radius: 28px;
            padding: 48px 34px;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        }

        .error-card::before {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            top: -80px;
            left: -80px;
            background: rgba(79, 209, 197, 0.10);
            border-radius: 50%;
        }

        .error-card::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            bottom: -70px;
            right: -70px;
            background: rgba(45, 212, 191, 0.08);
            border-radius: 50%;
        }

        .error-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(45, 212, 191, 0.12);
            color: #7ce7da;
            border: 1px solid rgba(124, 231, 218, 0.25);
            padding: 10px 18px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .error-icon {
            width: 94px;
            height: 94px;
            margin: 0 auto 24px;
            border-radius: 24px;
            background: linear-gradient(135deg, #1f8f82, #49c5b6);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 35px rgba(73, 197, 182, 0.30);
        }

        .error-icon svg {
            width: 46px;
            height: 46px;
            stroke: white;
        }

        .error-code {
            font-size: 70px;
            font-weight: 800;
            line-height: 1;
            margin: 0 0 12px;
            color: #ffffff;
            letter-spacing: 2px;
        }

        .error-title {
            font-size: 33px;
            font-weight: 800;
            margin: 0 0 14px;
            color: #ffffff;
        }

        .error-text {
            margin: 0 auto 28px;
            max-width: 520px;
            font-size: 18px;
            line-height: 1.9;
            color: #d1d5db;
        }

        .error-note {
            margin: 0 auto 32px;
            max-width: 520px;
            font-size: 14px;
            color: #9ca3af;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            padding: 14px 24px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 800;
            transition: 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 180px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2f8f83, #49c5b6);
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(73, 197, 182, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(73, 197, 182, 0.35);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.14);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.14);
            transform: translateY(-2px);
        }

        .mini-help {
            margin-top: 24px;
            font-size: 13px;
            color: #94a3b8;
        }

        @media (max-width: 768px) {
            .error-card {
                padding: 38px 22px;
                border-radius: 22px;
            }

            .error-code {
                font-size: 56px;
            }

            .error-title {
                font-size: 26px;
            }

            .error-text {
                font-size: 16px;
            }

            .btn {
                width: 100%;
                min-width: unset;
            }
        }
    </style>
</head>
<body>

    <div class="error-wrapper">
        <div class="error-card">

            <div class="error-badge">
                Smart City Management System
            </div>

            <div class="error-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.5 10.5V7.875a4.5 4.5 0 10-9 0V10.5m-.75 0h10.5A1.5 1.5 0 0118.75 12v6A1.5 1.5 0 0117.25 19.5H6.75A1.5 1.5 0 015.25 18v-6a1.5 1.5 0 011.5-1.5z" />
                </svg>
            </div>

            <h1 class="error-code">403</h1>

            <h2 class="error-title">
                غير مسموح لك بالدخول إلى هذه الصفحة
            </h2>

            <p class="error-text">
                يبدو أن هذه الصفحة مخصصة لصلاحيات مختلفة عن صلاحية حسابك الحالي.
                يمكنك العودة إلى لوحة التحكم أو الانتقال إلى ملفك الشخصي.
            </p>

            <p class="error-note">
                إذا كنت تعتقد أن هذا خطأ، يمكنك التواصل مع المشرف أو تسجيل الدخول بحساب يمتلك الصلاحيات المناسبة.
            </p>

            <div class="action-buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        العودة إلى لوحة التحكم
                    </a>

                    <a href="{{ route('profile.show') }}" class="btn btn-secondary">
                        الذهاب إلى الملف الشخصي
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        تسجيل الدخول
                    </a>

                    <a href="{{ url('/') }}" class="btn btn-secondary">
                        الصفحة الرئيسية
                    </a>
                @endauth
            </div>

            <div class="mini-help">
                Smart City • Access Restricted
            </div>

        </div>
    </div>

</body>
</html>