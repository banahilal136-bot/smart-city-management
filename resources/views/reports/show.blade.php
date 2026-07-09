@extends('layouts.admin')

@section('title', 'تفاصيل البلاغ')

@section('content')

<style>
    .report-show-page .info-item {
        padding: 14px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .report-show-page .info-item:last-child {
        border-bottom: 0;
    }

    .report-show-page .info-label {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .report-show-page .info-value {
        font-weight: 800;
        color: #1f2937;
        font-size: 16px;
    }

    .report-show-page .map-box {
        height: 280px;
        border-radius: 16px;
        background: linear-gradient(135deg, #dfeeea, #f7faf9);
        border: 1px solid #edf0f2;
        position: relative;
        overflow: hidden;
    }

    .report-show-page .map-pin-big {
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #4b8e88;
        text-align: center;
        font-weight: 800;
    }

    .report-show-page .map-pin-big svg {
        width: 45px;
        height: 45px;
        margin-bottom: 8px;
    }

    .report-show-page .image-placeholder {
        height: 220px;
        border-radius: 16px;
        background: #f5f7f8;
        border: 1px dashed #cfd8dc;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #6b7280;
        font-weight: 700;
    }

    .report-show-page .image-placeholder svg {
        width: 42px;
        height: 42px;
        margin-bottom: 10px;
        color: #4b8e88;
    }

    .report-show-page .timeline-item {
        position: relative;
        padding-right: 28px;
        margin-bottom: 22px;
    }

    .report-show-page .timeline-item::before {
        content: "";
        position: absolute;
        right: 7px;
        top: 6px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #4b8e88;
    }

    .report-show-page .timeline-item::after {
        content: "";
        position: absolute;
        right: 12px;
        top: 22px;
        width: 2px;
        height: calc(100% + 8px);
        background: #edf0f2;
    }

    .report-show-page .timeline-item:last-child::after {
        display: none;
    }

    .report-show-page .timeline-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 3px;
    }

    .report-show-page .timeline-date {
        color: #6b7280;
        font-size: 13px;
    }
</style>

<div class="report-show-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">تفاصيل البلاغ</h1>
            <p class="page-subtitle">عرض معلومات البلاغ ومتابعة حالة المعالجة</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('reports.edit', 1) }}" class="btn btn-primary">
                تعديل البلاغ
            </a>

            <a href="{{ route('reports.index') }}" class="btn btn-outline-primary">
                رجوع إلى البلاغات
            </a>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">إنارة معطلة في الشارع الرئيسي</h5>
                        <small class="text-muted">رقم البلاغ: #101</small>
                    </div>

                    <span class="badge bg-primary">جديد</span>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">نوع البلاغ</div>
                                <div class="info-value">إنارة</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">تاريخ الإضافة</div>
                                <div class="info-value">2024-05-20</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">اسم المواطن</div>
                                <div class="info-value">أحمد محمد</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-label">رقم الهاتف</div>
                                <div class="info-value">09xxxxxxxx</div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="info-item">
                                <div class="info-label">العنوان التفصيلي</div>
                                <div class="info-value">شارع الجامعة - بالقرب من الحديقة العامة</div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="info-item">
                                <div class="info-label">وصف البلاغ</div>
                                <div class="info-value">
                                    يوجد عطل في إنارة الشارع الرئيسي مما يسبب ضعف الرؤية ليلاً ويؤثر على حركة المواطنين.
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">موقع البلاغ</h5>
                </div>

                <div class="card-body">
                    <div class="map-box">
                        <div class="map-pin-big">
                            <i data-feather="map-pin"></i>
                            <div>شارع الجامعة</div>
                            <small class="text-muted">Latitude: 35.9306 - Longitude: 36.6339</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">صورة البلاغ</h5>
                </div>

                <div class="card-body">
                    <div class="image-placeholder">
                        <i data-feather="image"></i>
                        <div>لا توجد صورة حالياً</div>
                        <small>سيتم عرض الصورة بعد ربط الباك</small>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">تحديث حالة البلاغ</h5>
                </div>

                <div class="card-body">
                    <label class="form-label">الحالة الحالية</label>
                    <select class="form-select mb-3">
                        <option selected>جديد</option>
                        <option>قيد المعالجة</option>
                        <option>تم الحل</option>
                    </select>

                    <label class="form-label">ملاحظة التحديث</label>
                    <textarea class="form-control mb-3" rows="4" placeholder="اكتبي ملاحظة عن الإجراء المتخذ..."></textarea>

                    <button type="button" class="btn btn-primary w-100">
                        حفظ التحديث
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">سجل التحديثات</h5>
                </div>

                <div class="card-body">

                    <div class="timeline-item">
                        <div class="timeline-title">تم إنشاء البلاغ</div>
                        <div class="timeline-date">2024-05-20 - بواسطة المواطن</div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-title">تمت مراجعة البلاغ</div>
                        <div class="timeline-date">2024-05-20 - بواسطة الموظف البلدي</div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-title">بانتظار بدء المعالجة</div>
                        <div class="timeline-date">الحالة الحالية: جديد</div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection