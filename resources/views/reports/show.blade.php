@extends('layouts.admin')

@section('title', 'تفاصيل البلاغ')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-1">تفاصيل البلاغ</h1>
        <p class="text-muted mb-0">عرض معلومات البلاغ ومتابعة حالته</p>
    </div>

    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
        رجوع إلى البلاغات
    </a>
</div>

<div class="row">

    <div class="col-lg-8">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">إنارة معطلة في الشارع الرئيسي</h5>
                <span class="badge bg-primary">جديد</span>
            </div>

            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">نوع البلاغ</p>
                        <h6>إنارة</h6>
                    </div>

                    <div class="col-md-6">
                        <p class="text-muted mb-1">الموقع</p>
                        <h6>شارع الجامعة</h6>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">تاريخ الإرسال</p>
                        <h6>2026-07-08</h6>
                    </div>

                    <div class="col-md-6">
                        <p class="text-muted mb-1">الأولوية</p>
                        <h6>متوسطة</h6>
                    </div>
                </div>

                <hr>

                <p class="text-muted mb-1">وصف المشكلة</p>
                <p>
                    يوجد عطل في الإنارة في الشارع الرئيسي بالقرب من الجامعة،
                    مما يسبب ضعفاً في الرؤية ليلاً ويؤثر على سلامة المواطنين.
                </p>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">صورة البلاغ</h5>
            </div>

            <div class="card-body">
                <div class="text-center p-5 bg-light rounded">
                    <i data-feather="image" style="width: 60px; height: 60px;"></i>
                    <p class="text-muted mt-3 mb-0">
                        هنا ستظهر صورة البلاغ بعد ربط رفع الصور مع الباك
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-4">

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">موقع البلاغ على الخريطة</h5>
            </div>

            <div class="card-body">
                <div class="report-map">
                    <div class="map-pin pin-red"></div>
                </div>

                <div class="mt-3">
                    <p class="mb-1">
                        <strong>Latitude:</strong> 33.5138
                    </p>
                    <p class="mb-0">
                        <strong>Longitude:</strong> 36.2765
                    </p>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">تحديث حالة البلاغ</h5>
            </div>

            <div class="card-body">
                <form action="#" method="POST">

                    <div class="mb-3">
                        <label class="form-label">الحالة</label>
                        <select class="form-select" name="status">
                            <option value="new">جديد</option>
                            <option value="in_progress">قيد المعالجة</option>
                            <option value="resolved">تم الحل</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ملاحظة</label>
                        <textarea class="form-control" name="note" rows="3" placeholder="أضف ملاحظة حول معالجة البلاغ..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        حفظ التحديث
                    </button>

                </form>
            </div>
        </div>

    </div>

</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">سجل تحديثات البلاغ</h5>
    </div>

    <div class="card-body">

        <div class="border-bottom pb-3 mb-3">
            <div class="d-flex justify-content-between">
                <strong>تم إنشاء البلاغ</strong>
                <span class="text-muted">2026-07-08</span>
            </div>
            <p class="text-muted mb-0 mt-1">
                قام المواطن بإرسال البلاغ وإضافة الموقع والوصف.
            </p>
        </div>

        <div class="border-bottom pb-3 mb-3">
            <div class="d-flex justify-content-between">
                <strong>تمت مراجعة البلاغ</strong>
                <span class="text-muted">2026-07-08</span>
            </div>
            <p class="text-muted mb-0 mt-1">
                قام الموظف البلدي بمراجعة البلاغ.
            </p>
        </div>

        <div>
            <div class="d-flex justify-content-between">
                <strong>الحالة الحالية</strong>
                <span class="badge bg-primary">جديد</span>
            </div>
            <p class="text-muted mb-0 mt-1">
                البلاغ بانتظار بدء المعالجة.
            </p>
        </div>

    </div>
</div>

@endsection