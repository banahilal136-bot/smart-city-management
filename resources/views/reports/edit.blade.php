@extends('layouts.admin')

@section('title', 'تعديل البلاغ')

@section('content')

<style>
    .edit-report-page .report-map-box {
        height: 300px;
        border-radius: 16px;
        background: linear-gradient(135deg, #dfeeea, #f7faf9);
        border: 1px solid #edf0f2;
        position: relative;
        overflow: hidden;
    }

    .edit-report-page .map-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #2f7e77;
        text-align: center;
        font-weight: 800;
    }

    .edit-report-page .map-center svg {
        width: 42px;
        height: 42px;
        margin-bottom: 10px;
    }

    .edit-report-page .status-box {
        background: #f8fafb;
        border: 1px solid #edf0f2;
        border-radius: 16px;
        padding: 18px;
    }

    .edit-report-page .info-mini {
        padding: 12px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .edit-report-page .info-mini:last-child {
        border-bottom: 0;
    }

    .edit-report-page .info-mini span {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .edit-report-page .info-mini strong {
        color: #1f2937;
        font-size: 15px;
    }
</style>

<div class="edit-report-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">تعديل البلاغ</h1>
            <p class="page-subtitle">تعديل بيانات البلاغ وتحديث حالته وموقعه</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('reports.show', 1) }}" class="btn btn-primary">
                عرض التفاصيل
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
                        <h5 class="card-title">بيانات البلاغ</h5>
                        <small class="text-muted">رقم البلاغ: #101</small>
                    </div>

                    <span class="badge bg-primary">جديد</span>
                </div>

                <div class="card-body">

                    <form action="#" method="POST" enctype="multipart/form-data">

                        <div class="row g-3">

                            <div class="col-md-8">
                                <label class="form-label">عنوان البلاغ</label>
                                <input type="text" class="form-control" value="إنارة معطلة في الشارع الرئيسي">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">نوع البلاغ</label>
                                <select class="form-select">
                                    <option selected>إنارة</option>
                                    <option>طرق</option>
                                    <option>مياه</option>
                                    <option>نفايات</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">وصف البلاغ</label>
                                <textarea class="form-control" rows="5">يوجد عطل في إنارة الشارع الرئيسي مما يسبب ضعف الرؤية ليلاً ويؤثر على حركة المواطنين.</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">اسم المواطن</label>
                                <input type="text" class="form-control" value="أحمد محمد">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="text" class="form-control" value="09xxxxxxxx">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">العنوان التفصيلي</label>
                                <input type="text" class="form-control" value="شارع الجامعة - بالقرب من الحديقة العامة">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">خط العرض Latitude</label>
                                <input type="text" class="form-control" value="35.9306">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">خط الطول Longitude</label>
                                <input type="text" class="form-control" value="36.6339">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">حالة البلاغ</label>
                                <select class="form-select">
                                    <option selected>جديد</option>
                                    <option>قيد المعالجة</option>
                                    <option>تم الحل</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">تغيير صورة البلاغ</label>
                                <input type="file" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">ملاحظة التعديل</label>
                                <textarea class="form-control" rows="3" placeholder="اكتبي سبب التعديل أو ملاحظة للموظف المسؤول..."></textarea>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('reports.index') }}" class="btn btn-light">
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

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">ملخص البلاغ</h5>
                </div>

                <div class="card-body">

                    <div class="status-box mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">الحالة الحالية</span>
                            <span class="badge bg-primary">جديد</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">نوع البلاغ</span>
                            <strong>إنارة</strong>
                        </div>
                    </div>

                    <div class="info-mini">
                        <span>تاريخ الإنشاء</span>
                        <strong>2024-05-20</strong>
                    </div>

                    <div class="info-mini">
                        <span>آخر تحديث</span>
                        <strong>2024-05-20</strong>
                    </div>

                    <div class="info-mini">
                        <span>الموظف المسؤول</span>
                        <strong>لم يتم التعيين بعد</strong>
                    </div>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">موقع البلاغ</h5>
                </div>

                <div class="card-body">
                    <div class="report-map-box">
                        <div class="map-center">
                            <i data-feather="map-pin"></i>
                            <div>شارع الجامعة</div>
                            <small class="text-muted">يمكن تعديل الإحداثيات من النموذج</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">تنبيه</h5>
                </div>

                <div class="card-body">
                    <div class="alert alert-warning mb-0">
                        بعد ربط الباك سيتم حفظ التعديلات في قاعدة البيانات وتحديث سجل البلاغ تلقائياً.
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection