<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Smart City Management System')</title>

    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">

           <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}">
    <div class="brand-mark city-logo">
    <svg viewBox="0 0 64 64" aria-hidden="true">
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
        <circle cx="25" cy="8" r="2" />
        <path d="M48 31L54 26V54" />
    </svg>
</div>

    <div class="brand-text">
        <span class="brand-title">Smart City</span>
        <span class="brand-subtitle">نظام إدارة البلاغات</span>
    </div>
</a>

            <ul class="sidebar-nav">

                <li class="sidebar-header">
                    القائمة الرئيسية
                </li>

                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}">
                        <i class="align-middle" data-feather="grid"></i>
                        <span class="align-middle">لوحة التحكم</span>
                    </a>
                </li>

                <li class="sidebar-header">
                    البلاغات
                </li>

                <li class="sidebar-item {{ request()->routeIs('reports.index') || request()->routeIs('reports.show') || request()->routeIs('reports.edit') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('reports.index') }}">
                        <i class="align-middle" data-feather="list"></i>
                        <span class="align-middle">جميع البلاغات</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('reports.create') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('reports.create') }}">
                        <i class="align-middle" data-feather="plus-circle"></i>
                        <span class="align-middle">بلاغ جديد</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('map.index') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('map.index') }}">
                        <i class="align-middle" data-feather="map-pin"></i>
                        <span class="align-middle">الخريطة</span>
                    </a>
                </li>

                <li class="sidebar-header">
                    الإدارة
                </li>

                <li class="sidebar-item {{ request()->routeIs('users.index') || request()->routeIs('users.create') || request()->routeIs('users.show') || request()->routeIs('users.edit') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('users.index') }}">
                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">المستخدمون</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('report-types.index') || request()->routeIs('report-types.create') || request()->routeIs('report-types.edit') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('report-types.index') }}">
                        <i class="align-middle" data-feather="tag"></i>
                        <span class="align-middle">أنواع البلاغات</span>
                    </a>
                </li>

            </ul>

        </div>
    </nav>
    <!-- End Sidebar -->

    <div class="main">

        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-light navbar-bg">

        <button class="sidebar-toggle js-sidebar-toggle d-lg-none" type="button" aria-label="فتح القائمة">
    <i data-feather="menu"></i>
</button>

            <button type="button" id="themeToggle" class="theme-switch-fancy" aria-label="تبديل الوضع">
                <span class="theme-switch-shine"></span>
                <span id="themeIcon" class="theme-switch-icon">🌙</span>
            </button>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align ms-auto">

                    <li class="nav-item me-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="ابحث عن بلاغ...">
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>

                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                            <span class="top-user">
                                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="user">
                                <span>
                                    <p class="name">
    {{ auth()->user()->name }}
</p>

<p class="role">
    @switch(auth()->user()->role)
        @case('admin')
            Admin
            @break

        @case('employee')
            Employee
            @break

        @case('citizen')
            Citizen
            @break

        @default
            User
    @endswitch
</p>
                                </span>
                            </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">الملف الشخصي</a>
                            <a class="dropdown-item" href="#">الإعدادات</a>
                            <div class="dropdown-divider"></div>
                            <form
    action="{{ route('logout') }}"
    method="POST"
    style="margin: 0;"
>
    @csrf

    <button
        type="submit"
        class="dropdown-item"
    >
        <i data-feather="log-out"></i>
        تسجيل الخروج
    </button>
</form>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
        <!-- End Navbar -->

        <main class="content">
            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </main>

    </div>
</div>

<script src="{{ asset('admin/js/app.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');

        if (!themeToggle || !themeIcon) {
            return;
        }

        function applyTheme(theme) {
            const isDark = theme === 'dark';

            document.body.classList.toggle('dark-mode', isDark);
            themeToggle.classList.toggle('is-dark', isDark);

            themeIcon.textContent = isDark ? '☀️' : '🌙';

            themeToggle.setAttribute(
                'aria-label',
                isDark ? 'تفعيل الوضع النهاري' : 'تفعيل الوضع الليلي'
            );

            localStorage.setItem('theme', theme);
        }

        const savedTheme = localStorage.getItem('theme') || 'light';
        applyTheme(savedTheme);

        themeToggle.addEventListener('click', function () {
            const currentTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            applyTheme(newTheme);
        });

        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>

</body>
</html>