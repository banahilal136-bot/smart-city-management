<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Smart City Management System')</title>

    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
</head>

<body>
<div class="wrapper">

    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">

            <a class="sidebar-brand" href="/dashboard">
                <span class="align-middle">
                    Smart City
                    <br>
                    <small>إدارة البلاغات</small>
                </span>
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

            <form class="d-none d-sm-inline-block me-3">
                <div class="input-group input-group-navbar">
                    <input type="text" class="form-control" placeholder="ابحث عن بلاغ...">
                    <button class="btn" type="button">
                        <i class="align-middle" data-feather="search"></i>
                    </button>
                </div>
            </form>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item">
                        <span class="nav-link text-dark">
                            مرحباً، Admin
                        </span>
                    </li>
                </ul>
            </div>

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