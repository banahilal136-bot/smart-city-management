@extends('layouts.admin')

@section('title', 'تفاصيل المستخدم')

@section('content')

<style>
    .user-show-page .profile-card {
        border-radius: 20px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .user-show-page .user-avatar-xl {
        width: 105px;
        height: 105px;
        border-radius: 50%;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        font-weight: 900;
        margin: 0 auto 18px;
    }

    .user-show-page .info-item {
        padding: 14px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .user-show-page .info-item:last-child {
        border-bottom: 0;
    }

    .user-show-page .info-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .user-show-page .info-value {
        color: #1f2937;
        font-weight: 800;
    }

    .user-show-page .permission-box,
    .user-show-page .activity-box {
        padding: 15px;
        border: 1px solid #edf0f2;
        border-radius: 15px;
        background: #fff;
        margin-bottom: 12px;
    }

    .user-show-page .permission-title,
    .user-show-page .activity-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .user-show-page .permission-desc,
    .user-show-page .activity-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }

    .user-show-page .mini-stat {
        border-radius: 18px;
        min-height: 130px;
    }

    .user-show-page .mini-stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-show-page .mini-stat-icon svg {
        width: 26px;
        height: 26px;
    }
</style>

<div class="user-show-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">تفاصيل المستخدم</h1>
            <p class="page-subtitle">عرض معلومات الحساب والدور والنشاط داخل النظام</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('users.edit', 1) }}" class="btn btn-primary">
                تعديل المستخدم
            </a>

            <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
                رجوع إلى المستخدمين
            </a>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-4">

            <div class="card profile-card mb-4">
                <div class="card-body text-center">

                    <div class="user-avatar-xl">أ</div>

                    <h4 class="mb-1">أحمد محمد</h4>
                    <p class="text-muted mb-3">admin@example.com</p>

                    <span class="badge bg-primary">مشرف</span>
                    <span class="badge bg-success">فعال</span>

                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <a href="{{ route('users.edit', 1) }}" class="btn btn-sm btn-primary">
                            تعديل
                        </a>

                        <a href="#" class="btn btn-sm btn-danger">
                            تعطيل الحساب
                        </a>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">معلومات الحساب</h5>
                </div>

                <div class="card-body">

                    <div class="info-item">
                        <div class="info-label">رقم المستخدم</div>
                        <div class="info-value">#1</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">الاسم الكامل</div>
                        <div class="info-value">أحمد محمد</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">البريد الإلكتروني</div>
                        <div class="info-value">admin@example.com</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">رقم الهاتف</div>
                        <div class="info-value">0999999999</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">تاريخ الإنشاء</div>
                        <div class="info-value">2026-07-01</div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-lg-8">

            <div class="row g-4 mb-4">

                <div class="col-md-4">
                    <div class="card mini-stat">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-title">البلاغات</div>
                                <div class="stat-number">12</div>
                                <p class="stat-desc">بلاغات مرتبطة بالحساب</p>
                            </div>

                            <div class="mini-stat-icon" style="background:#dff3e6;color:#2f7e77;">
                                <i data-feather="file-text"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mini-stat">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-title">قيد المعالجة</div>
                                <div class="stat-number">4</div>
                                <p class="stat-desc">بلاغات لم تنته بعد</p>
                            </div>

                            <div class="mini-stat-icon" style="background:#fff1d8;color:#f2a72a;">
                                <i data-feather="clock"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mini-stat">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stat-title">تم الحل</div>
                                <div class="stat-number">8</div>
                                <p class="stat-desc">بلاغات مكتملة</p>
                            </div>

                            <div class="mini-stat-icon" style="background:#d9f0ec;color:#0b7d73;">
                                <i data-feather="check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">صلاحيات المستخدم</h5>
                    <small class="text-muted">الصلاحيات الحالية حسب الدور المحدد</small>
                </div>

                <div class="card-body">

                    <div class="permission-box">
                        <div class="permission-title">إدارة المستخدمين</div>
                        <p class="permission-desc">
                            يمكن للمشرف عرض وإضافة وتعديل المستخدمين داخل النظام.
                        </p>
                    </div>

                    <div class="permission-box">
                        <div class="permission-title">إدارة البلاغات</div>
                        <p class="permission-desc">
                            يمكنه متابعة البلاغات وتعديل حالتها والاطلاع على تفاصيلها.
                        </p>
                    </div>

                    <div class="permission-box mb-0">
                        <div class="permission-title">إدارة أنواع البلاغات</div>
                        <p class="permission-desc">
                            يمكنه إضافة وتعديل أنواع البلاغات المستخدمة في النظام.
                        </p>
                    </div>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">آخر النشاطات</h5>
                    <small class="text-muted">آخر العمليات المرتبطة بهذا المستخدم</small>
                </div>

                <div class="card-body">

                    <div class="activity-box">
                        <div class="activity-title">تسجيل دخول إلى النظام</div>
                        <p class="activity-desc">تم تسجيل الدخول بتاريخ 2026-07-09 الساعة 10:30 صباحاً</p>
                    </div>

                    <div class="activity-box">
                        <div class="activity-title">تعديل حالة بلاغ</div>
                        <p class="activity-desc">تم تغيير حالة بلاغ حفرة في الطريق إلى قيد المعالجة.</p>
                    </div>

                    <div class="activity-box mb-0">
                        <div class="activity-title">إضافة نوع بلاغ جديد</div>
                        <p class="activity-desc">تمت إضافة نوع بلاغ جديد ضمن تصنيف النظافة العامة.</p>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">بلاغات مرتبطة بالمستخدم</h5>
                    <small class="text-muted">بيانات تجريبية لحين ربط الصفحة بالباك</small>
                </div>

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان البلاغ</th>
                                    <th>النوع</th>
                                    <th>الحالة</th>
                                    <th>التاريخ</th>
                                    <th class="text-center">الإجراء</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>حفرة في الطريق</td>
                                    <td>طرق</td>
                                    <td><span class="badge bg-warning">قيد المعالجة</span></td>
                                    <td>2026-07-05</td>
                                    <td class="text-center">
                                        <a href="{{ route('reports.show', 1) }}" class="btn btn-sm btn-outline-primary">
                                            عرض
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>تراكم نفايات</td>
                                    <td>نظافة</td>
                                    <td><span class="badge bg-success">تم الحل</span></td>
                                    <td>2026-07-04</td>
                                    <td class="text-center">
                                        <a href="{{ route('reports.show', 2) }}" class="btn btn-sm btn-outline-primary">
                                            عرض
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>عطل إنارة</td>
                                    <td>إنارة</td>
                                    <td><span class="badge bg-primary">جديد</span></td>
                                    <td>2026-07-03</td>
                                    <td class="text-center">
                                        <a href="{{ route('reports.show', 3) }}" class="btn btn-sm btn-outline-primary">
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection