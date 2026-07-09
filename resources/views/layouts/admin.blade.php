<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Smart City Management System')</title>

    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">resources/views/layouts/admin.blade.php

</head>

<body>
<div class="wrapper">

    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">

        <a class="sidebar-brand" href="{{ route('dashboard') }}">
    <span>Smart City</span>
    <span class="brand-subtitle">إدارة البلاغات</span>
</a>

            <ul class="sidebar-nav">

                <li class="sidebar-header">
                    القائمة الرئيسية
                </li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="/dashboard">
                        <i class="align-middle" data-feather="grid"></i>
                        <span class="align-middle">لوحة التحكم</span>
                    </a>
                </li>

                <li class="sidebar-header">
                    البلاغات
                </li>

                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('reports.index') }}">                        <i class="align-middle" data-feather="list"></i>
                        <span class="align-middle">جميع البلاغات</span>
                    </a>
                </li>

                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('reports.create') }}">                        <i class="align-middle" data-feather="plus-circle"></i>
                        <span class="align-middle">بلاغ جديد</span>
                    </a>
                </li>

                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('map.index') }}">                        <i class="align-middle" data-feather="map-pin"></i>
                        <span class="align-middle">الخريطة</span>
                    </a>
                </li>

                <li class="sidebar-header">
                    الإدارة
                </li>

                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('users.index') }}">                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">المستخدمون</span>
                    </a>
                </li>

                <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('report-types.index') }}">                        <i class="align-middle" data-feather="tag"></i>
                        <span class="align-middle">أنواع البلاغات</span>
                    </a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="main">

        <nav class="navbar navbar-expand navbar-light navbar-bg">

            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <nav class="navbar navbar-expand navbar-light navbar-bg">

<a class="sidebar-toggle js-sidebar-toggle">
    <i class="hamburger align-self-center"></i>
</a>

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
                        <p class="name">أحمد محمد</p>
                        <p class="role">Admin</p>
                    </span>
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">الملف الشخصي</a>
                <a class="dropdown-item" href="#">الإعدادات</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">تسجيل الخروج</a>
            </div>
        </li>
    </ul>
</div>

</nav>

        </nav>

        <main class="content">
            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </main>

    </div>
</div>

<script src="{{ asset('admin/js/app.js') }}"></script>
</body>
</html>