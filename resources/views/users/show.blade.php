@extends('layouts.admin')

@section('title', 'عرض مستخدم')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-1">تفاصيل المستخدم</h1>
        <p class="text-muted mb-0">عرض بيانات المستخدم ودوره داخل النظام</p>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        رجوع إلى المستخدمين
    </a>
</div>

<div class="row">

    <div class="col-lg-4">

        <div class="card">
            <div class="card-body text-center">

                <div class="stat-icon stat-total mx-auto mb-3">
                    <i data-feather="user"></i>
                </div>

                <h4>أحمد محمد</h4>
                <p class="text-muted mb-2">admin@example.com</p>

                <span class="badge bg-dark mb-2">مشرف / مدير</span>
                <br>
                <span class="badge bg-success">فعال</span>

                <hr>

                <p class="mb-1">
                    <strong>رقم الهاتف:</strong>
                    0999999999
                </p>

                <p class="mb-1">
                    <strong>تاريخ الإنشاء:</strong>
                    2026-07-01
                </p>

                <p class="mb-0">
                    <strong>آخر تحديث:</strong>
                    2026-07-08
                </p>

            </div>
        </div>

    </div>

    <div class="col-lg-8">

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">صلاحيات المستخدم</h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <strong>إدارة المستخدمين</strong>
                            <p class="text-muted mb-0">يمكنه عرض وإضافة وتعديل المستخدمين.</p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <strong>إدارة البلاغات</strong>
                            <p class="text-muted mb-0">يمكنه عرض وتعديل وحذف البلاغات.</p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <strong>لوحة التحكم</strong>
                            <p class="text-muted mb-0">يمكنه متابعة الإحصائيات العامة.</p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <strong>الخريطة</strong>
                            <p class="text-muted mb-0">يمكنه عرض مواقع البلاغات على الخريطة.</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">آخر نشاطات المستخدم</h5>
            </div>

            <div class="card-body">

                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>تسجيل دخول</strong>
                        <span class="text-muted">2026-07-08</span>
                    </div>
                    <p class="text-muted mb-0 mt-1">
                        قام المستخدم بتسجيل الدخول إلى النظام.
                    </p>
                </div>

                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>عرض البلاغات</strong>
                        <span class="text-muted">2026-07-08</span>
                    </div>
                    <p class="text-muted mb-0 mt-1">
                        قام المستخدم بفتح صفحة جميع البلاغات.
                    </p>
                </div>

                <div>
                    <div class="d-flex justify-content-between">
                        <strong>تعديل بيانات بلاغ</strong>
                        <span class="text-muted">2026-07-07</span>
                    </div>
                    <p class="text-muted mb-0 mt-1">
                        قام المستخدم بتعديل حالة أحد البلاغات.
                    </p>
                </div>

            </div>
        </div>

    </div>

</div>

<div class="mt-4 d-flex justify-content-end gap-2">
    <a href="{{ route('users.edit', 1) }}" class="btn btn-warning">
        تعديل المستخدم
    </a>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        رجوع
    </a>
</div>

@endsection