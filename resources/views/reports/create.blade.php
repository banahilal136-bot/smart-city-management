@extends('layouts.admin')

@section('title', 'إضافة بلاغ جديد')

@section('content')

<style>
    .create-report-page .form-section-title {
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 18px;
        color: #1f2937;
    }

    .create-report-page .report-map-box {
        height: 310px;
        border-radius: 16px;
        background: linear-gradient(135deg, #dfeeea, #f7faf9);
        border: 1px solid #edf0f2;
        position: relative;
        overflow: hidden;
    }

    .create-report-page .map-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #2f7e77;
        text-align: center;
        font-weight: 800;
    }

    .create-report-page .map-center svg {
        width: 42px;
        height: 42px;
        margin-bottom: 10px;
    }

    .create-report-page .location-chip {
        position: absolute;
        background: #4b8e88;
        color: #fff;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 6px 14px rgba(0,0,0,0.12);
    }
</style>

<div class="create-report-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">إضافة بلاغ جديد</h1>
            <p class="page-subtitle">إدخال بيانات بلاغ جديد وتحديد موقعه على الخريطة</p>
        </div>

        <a href="{{ route('reports.index') }}" class="btn btn-outline-primary">
            رجوع إلى البلاغات
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">بيانات البلاغ</h5>
                </div>

                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">

                        <div class="row g-3">

                            <div class="col-md-8">
                                <label class="form-label">عنوان البلاغ</label>
                                <input type="text" class="form-control" placeholder="مثال: إنارة معطلة في الشارع الرئيسي">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">نوع البلاغ</label>
                                <select class="form-select">
                                    <option selected disabled>اختاري النوع</option>
                                    <option>إنارة</option>
                                    <option>طرق</option>
                                    <option>مياه</option>
                                    <option>نفايات</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">وصف البلاغ</label>
                                <textarea class="form-control" rows="5" placeholder="اكتبي تفاصيل المشكلة بشكل واضح..."></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">اسم المواطن</label>
                                <input type="text" class="form-control" placeholder="اسم مقدم البلاغ">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="text" class="form-control" placeholder="مثال: 09xxxxxxxx">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">العنوان التفصيلي</label>
                                <input type="text" class="form-control" placeholder="مثال: شارع الجامعة - جانب الحديقة العامة">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">خط العرض Latitude</label>
                                <input type="text" class="form-control" placeholder="مثال: 35.9306">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">خط الطول Longitude</label>
                                <input type="text" class="form-control" placeholder="مثال: 36.6339">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">صورة البلاغ</label>
                                <input type="file" class="form-control">
                                <small class="text-muted">يمكن إضافة صورة توضح المشكلة</small>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('reports.index') }}" class="btn btn-light">
                                إلغاء
                            </a>

                            <button type="button" class="btn btn-primary">
                                حفظ البلاغ
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">تحديد الموقع</h5>
                </div>

                <div class="card-body">
                    <div class="report-map-box">
                        <div class="location-chip" style="top: 35px; right: 35px;">موقع مقترح</div>
                        <div class="location-chip" style="bottom: 45px; left: 35px; background:#f3a62c;">منطقة البلاغ</div>

                        <div class="map-center">
                            <i data-feather="map-pin"></i>
                            <div>الخريطة التفاعلية</div>
                            <small class="text-muted">لاحقاً سيتم ربطها مع Google Maps</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">ملاحظات</h5>
                </div>

                <div class="card-body">
                    <div class="alert alert-success mb-3">
                        الحالة الافتراضية للبلاغ الجديد ستكون:
                        <strong>جديد</strong>
                    </div>

                    <div class="alert alert-warning mb-0">
                        عند ربط الباك سيتم حفظ البيانات في جدول
                        <strong>reports</strong>
                        مع نوع البلاغ والموقع.
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection