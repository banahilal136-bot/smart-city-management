@extends('layouts.admin')

@section('title', 'إضافة مستخدم جديد')

@section('content')

<style>
    .user-form-page .form-help-card {
        border-radius: 18px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .user-form-page .role-info-item {
        padding: 14px;
        border: 1px solid #edf0f2;
        border-radius: 14px;
        margin-bottom: 12px;
        background: #fff;
    }

    .user-form-page .role-info-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .user-form-page .role-info-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }

    .user-form-page .form-icon-box {
        width: 70px;
        height: 70px;
        border-radius: 22px;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .user-form-page .form-icon-box svg {
        width: 34px;
        height: 34px;
    }
</style>

<div class="user-form-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">إضافة مستخدم جديد</h1>
            <p class="page-subtitle">إنشاء حساب مستخدم وتحديد دوره داخل النظام</p>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
            رجوع إلى المستخدمين
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">بيانات المستخدم</h5>
                    <small class="text-muted">أدخلي معلومات المستخدم الأساسية</small>
                </div>

                <div class="card-body">

                    <form action="#" method="POST">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">الاسم الكامل</label>
                                <input type="text" class="form-control" placeholder="مثال: أحمد محمد">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" placeholder="example@email.com">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="text" class="form-control" placeholder="09xxxxxxxx">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">الدور</label>
                                <select class="form-select">
                                    <option selected disabled>اختاري الدور</option>
                                    <option>مشرف</option>
                                    <option>موظف بلدي</option>
                                    <option>مواطن</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">كلمة المرور</label>
                                <input type="password" class="form-control" placeholder="********">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control" placeholder="********">
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
                                <input type="date" class="form-control" value="2026-07-09">
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('users.index') }}" class="btn btn-light">
                                إلغاء
                            </a>

                            <button type="button" class="btn btn-primary">
                                حفظ المستخدم
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card form-help-card mb-4">
                <div class="card-body text-center">
                    <div class="form-icon-box mx-auto">
                        <i data-feather="user-plus"></i>
                    </div>

                    <h5 class="card-title">مستخدم جديد</h5>
                    <p class="text-muted mb-0">
                        بعد ربط الباك سيتم حفظ بيانات المستخدم في جدول users وربطه بالدور المناسب.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">شرح الأدوار</h5>
                </div>

                <div class="card-body">

                    <div class="role-info-item">
                        <div class="role-info-title">مشرف</div>
                        <p class="role-info-desc">
                            يمتلك صلاحية إدارة المستخدمين والبلاغات والإحصائيات.
                        </p>
                    </div>

                    <div class="role-info-item">
                        <div class="role-info-title">موظف بلدي</div>
                        <p class="role-info-desc">
                            يتابع البلاغات ويعدل حالتها ويضيف ملاحظات المعالجة.
                        </p>
                    </div>

                    <div class="role-info-item mb-0">
                        <div class="role-info-title">مواطن</div>
                        <p class="role-info-desc">
                            يرسل البلاغات ويتابع حالتها من خلال النظام.
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection