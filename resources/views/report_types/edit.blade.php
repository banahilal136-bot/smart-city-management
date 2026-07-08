@extends('layouts.admin')

@section('title', 'تعديل نوع بلاغ')

@section('content')

<style>
    .report-type-edit-page .form-help-card {
        border-radius: 18px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .report-type-edit-page .type-preview {
        text-align: center;
    }

    .report-type-edit-page .preview-icon {
        width: 86px;
        height: 86px;
        border-radius: 24px;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }

    .report-type-edit-page .preview-icon svg {
        width: 38px;
        height: 38px;
    }

    .report-type-edit-page .info-row {
        padding: 13px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .report-type-edit-page .info-row:last-child {
        border-bottom: 0;
    }

    .report-type-edit-page .info-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .report-type-edit-page .info-value {
        color: #1f2937;
        font-weight: 800;
    }

    .report-type-edit-page .guide-item {
        padding: 14px;
        border: 1px solid #edf0f2;
        border-radius: 14px;
        background: #fff;
        margin-bottom: 12px;
    }

    .report-type-edit-page .guide-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .report-type-edit-page .guide-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }
</style>

<div class="report-type-edit-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">تعديل نوع البلاغ</h1>
            <p class="page-subtitle">تحديث بيانات التصنيف المستخدم لتنظيم البلاغات</p>
        </div>

        <a href="{{ route('report-types.index') }}" class="btn btn-outline-primary">
            رجوع إلى أنواع البلاغات
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">بيانات نوع البلاغ</h5>
                    <small class="text-muted">تعديل معلومات النوع الحالي</small>
                </div>

                <div class="card-body">

                    <form action="#" method="POST">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">اسم النوع</label>
                                <input type="text" class="form-control" value="طرق">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">الأيقونة</label>
                                <select class="form-select">
                                    <option value="map" selected>طرق</option>
                                    <option value="trash-2">نظافة</option>
                                    <option value="zap">إنارة</option>
                                    <option value="droplet">مياه</option>
                                    <option value="sun">حدائق</option>
                                    <option value="alert-triangle">طارئ</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">الأولوية</label>
                                <select class="form-select">
                                    <option selected>عالية</option>
                                    <option>متوسطة</option>
                                    <option>منخفضة</option>
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
                                <label class="form-label">القسم المسؤول</label>
                                <select class="form-select">
                                    <option selected>قسم الطرق</option>
                                    <option>قسم النظافة</option>
                                    <option>قسم الإنارة</option>
                                    <option>قسم المياه</option>
                                    <option>قسم الحدائق</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">تاريخ الإضافة</label>
                                <input type="date" class="form-control" value="2026-07-01">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">وصف النوع</label>
                                <textarea class="form-control" rows="4">مشاكل الحفر والأرصفة والازدحام والطرق المتضررة داخل المدينة.</textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">ملاحظات داخلية</label>
                                <textarea class="form-control" rows="3" placeholder="ملاحظات إدارية لا تظهر للمواطنين...">يتم تحويل البلاغات المرتبطة بهذا النوع إلى قسم الطرق.</textarea>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('report-types.index') }}" class="btn btn-light">
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
                <div class="card-body type-preview">

                    <div class="preview-icon">
                        <i data-feather="map"></i>
                    </div>

                    <h5 class="card-title">طرق</h5>
                    <p class="text-muted mb-3">
                        مشاكل الحفر والأرصفة والازدحام.
                    </p>

                    <span class="badge bg-danger">عالية</span>
                    <span class="badge bg-success">فعال</span>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">معلومات النوع</h5>
                </div>

                <div class="card-body">

                    <div class="info-row">
                        <div class="info-label">رقم النوع</div>
                        <div class="info-value">#1</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">عدد البلاغات المرتبطة</div>
                        <div class="info-value">35 بلاغ</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">تاريخ الإضافة</div>
                        <div class="info-value">2026-07-01</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">آخر تحديث</div>
                        <div class="info-value">2026-07-08</div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">تنبيهات مهمة</h5>
                </div>

                <div class="card-body">

                    <div class="guide-item">
                        <div class="guide-title">تغيير الحالة</div>
                        <p class="guide-desc">
                            عند جعل النوع غير فعال لن يظهر للمواطن عند إنشاء بلاغ جديد.
                        </p>
                    </div>

                    <div class="guide-item">
                        <div class="guide-title">تغيير الاسم</div>
                        <p class="guide-desc">
                            يفضّل اختيار اسم واضح حتى يفهم المواطن نوع البلاغ بسهولة.
                        </p>
                    </div>

                    <div class="guide-item mb-0">
                        <div class="guide-title">البلاغات المرتبطة</div>
                        <p class="guide-desc">
                            حذف النوع لاحقاً يحتاج الانتباه للبلاغات المرتبطة به.
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection