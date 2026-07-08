@extends('layouts.admin')

@section('title', 'إضافة نوع بلاغ جديد')

@section('content')

<style>
    .report-type-form-page .form-help-card {
        border-radius: 18px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .report-type-form-page .type-preview {
        text-align: center;
    }

    .report-type-form-page .preview-icon {
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

    .report-type-form-page .preview-icon svg {
        width: 38px;
        height: 38px;
    }

    .report-type-form-page .guide-item {
        padding: 14px;
        border: 1px solid #edf0f2;
        border-radius: 14px;
        background: #fff;
        margin-bottom: 12px;
    }

    .report-type-form-page .guide-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .report-type-form-page .guide-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }
</style>

<div class="report-type-form-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">إضافة نوع بلاغ جديد</h1>
            <p class="page-subtitle">إنشاء تصنيف جديد ليتم استخدامه عند إرسال البلاغات</p>
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
                    <small class="text-muted">أدخلي معلومات النوع الذي سيظهر للمواطنين</small>
                </div>

                <div class="card-body">

                    <form action="#" method="POST">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">اسم النوع</label>
                                <input type="text" class="form-control" placeholder="مثال: طرق">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">الأيقونة</label>
                                <select class="form-select">
                                    <option selected disabled>اختاري أيقونة</option>
                                    <option value="map">طرق</option>
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
                                    <option selected disabled>اختاري الأولوية</option>
                                    <option>عالية</option>
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
                                    <option selected disabled>اختاري القسم</option>
                                    <option>قسم الطرق</option>
                                    <option>قسم النظافة</option>
                                    <option>قسم الإنارة</option>
                                    <option>قسم المياه</option>
                                    <option>قسم الحدائق</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">تاريخ الإضافة</label>
                                <input type="date" class="form-control" value="2026-07-09">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">وصف النوع</label>
                                <textarea class="form-control" rows="4" placeholder="اكتبي وصفاً مختصراً لنوع البلاغ..."></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">ملاحظات داخلية</label>
                                <textarea class="form-control" rows="3" placeholder="ملاحظات إدارية لا تظهر للمواطنين..."></textarea>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('report-types.index') }}" class="btn btn-light">
                                إلغاء
                            </a>

                            <button type="button" class="btn btn-primary">
                                حفظ نوع البلاغ
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
                        <i data-feather="tag"></i>
                    </div>

                    <h5 class="card-title">نوع بلاغ جديد</h5>
                    <p class="text-muted mb-0">
                        سيتم استخدام هذا النوع لتصنيف البلاغات وتوجيهها للقسم المناسب.
                    </p>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">إرشادات الإدخال</h5>
                </div>

                <div class="card-body">

                    <div class="guide-item">
                        <div class="guide-title">اسم واضح</div>
                        <p class="guide-desc">
                            اختاري اسماً قصيراً ومفهوماً مثل طرق، نظافة، إنارة.
                        </p>
                    </div>

                    <div class="guide-item">
                        <div class="guide-title">أولوية مناسبة</div>
                        <p class="guide-desc">
                            الأولوية تساعد الموظفين على معرفة البلاغات الأكثر أهمية.
                        </p>
                    </div>

                    <div class="guide-item mb-0">
                        <div class="guide-title">وصف مختصر</div>
                        <p class="guide-desc">
                            الوصف يوضح للمواطن متى يجب اختيار هذا النوع عند إرسال البلاغ.
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection