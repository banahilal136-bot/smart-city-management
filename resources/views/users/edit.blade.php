@extends('layouts.admin')

@section('title', 'تعديل مستخدم')

@section('content')

<style>
    .user-edit-page .form-help-card {
        border-radius: 18px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .user-edit-page .user-profile-mini {
        text-align: center;
    }

    .user-edit-page .user-avatar-large {
        width: 86px;
        height: 86px;
        border-radius: 50%;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        font-weight: 900;
        margin: 0 auto 16px;
    }

    .user-edit-page .info-row {
        padding: 13px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .user-edit-page .info-row:last-child {
        border-bottom: 0;
    }

    .user-edit-page .info-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .user-edit-page .info-value {
        color: #1f2937;
        font-weight: 800;
    }

    .user-edit-page .permission-item {
        padding: 14px;
        border: 1px solid #edf0f2;
        border-radius: 14px;
        margin-bottom: 12px;
        background: #ffffff;
    }

    .user-edit-page .permission-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .user-edit-page .permission-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }
</style>

<div class="user-edit-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">تعديل بيانات المستخدم</h1>
            <p class="page-subtitle">تحديث معلومات المستخدم ودوره وحالته داخل النظام</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('users.show', 1) }}" class="btn btn-primary">
                عرض المستخدم
            </a>

            <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
                رجوع إلى المستخدمين
            </a>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">بيانات المستخدم</h5>
                    <small class="text-muted">تعديل البيانات الأساسية للمستخدم</small>
                </div>

                <div class="card-body">

                    <form action="#" method="POST">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">الاسم الكامل</label>
                                <input type="text" class="form-control" value="أحمد محمد">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" value="admin@example.com">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="text" class="form-control" value="0999999999">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">الدور</label>
                                <select class="form-select">
                                    <option selected>مشرف</option>
                                    <option>موظف بلدي</option>
                                    <option>مواطن</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">الحالة</label>
                                <select class="form-select">
                                    <option selected>فعال</option>
                                    <option>غير فعال</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">تاريخ الإنشاء</label>
                                <input type="date" class="form-control" value="2026-07-01">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">كلمة مرور جديدة</label>
                                <input type="password" class="form-control" placeholder="اتركيها فارغة إذا لا تريدين تغييرها">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control" placeholder="تأكيد كلمة المرور الجديدة">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">ملاحظة إدارية</label>
                                <textarea class="form-control" rows="4" placeholder="اكتبي ملاحظة عن هذا المستخدم إن وجدت..."></textarea>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('users.index') }}" class="btn btn-light">
                                إلغاء
                            </a>

                            <button type="button" class="btn btn-primary">
                                حفظ التعديلات
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card form-help-card mb-4">
                <div class="card-body user-profile-mini">

                    <div class="user-avatar-large">أ</div>

                    <h5 class="card-title mb-1">أحمد محمد</h5>
                    <p class="text-muted mb-2">admin@example.com</p>

                    <span class="badge bg-primary">مشرف</span>
                    <span class="badge bg-success">فعال</span>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">معلومات الحساب</h5>
                </div>

                <div class="card-body">

                    <div class="info-row">
                        <div class="info-label">رقم المستخدم</div>
                        <div class="info-value">#1</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">تاريخ الإنشاء</div>
                        <div class="info-value">2026-07-01</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">آخر تحديث</div>
                        <div class="info-value">2026-07-08</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">آخر تسجيل دخول</div>
                        <div class="info-value">2026-07-09</div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">صلاحيات الدور</h5>
                </div>

                <div class="card-body">

                    <div class="permission-item">
                        <div class="permission-title">إدارة المستخدمين</div>
                        <p class="permission-desc">
                            يمكنه عرض وإضافة وتعديل وحذف المستخدمين.
                        </p>
                    </div>

                    <div class="permission-item">
                        <div class="permission-title">إدارة البلاغات</div>
                        <p class="permission-desc">
                            يمكنه عرض البلاغات وتعديل حالتها ومتابعة التفاصيل.
                        </p>
                    </div>

                    <div class="permission-item mb-0">
                        <div class="permission-title">لوحة التحكم</div>
                        <p class="permission-desc">
                            يمكنه متابعة الإحصائيات العامة داخل النظام.
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection