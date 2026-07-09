@extends('layouts.admin')

@section('title', 'خريطة البلاغات')

@section('content')

<div class="mb-4">
    <h1 class="h3 mb-1">خريطة البلاغات</h1>
    <p class="text-muted mb-0">عرض مواقع البلاغات على الخريطة</p>
</div>

<div class="row">

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">الخريطة التفاعلية</h5>
            </div>

            <div class="card-body">
                <div class="report-map" style="height: 430px;">
                    <div class="map-pin pin-red" title="بلاغ جديد"></div>
                    <div class="map-pin pin-blue" title="بلاغ جديد"></div>
                    <div class="map-pin pin-orange" title="قيد المعالجة"></div>
                    <div class="map-pin pin-green" title="تم الحل"></div>
                </div>

                <div class="mt-3 d-flex gap-4 flex-wrap">
                    <span><span class="badge bg-primary">&nbsp;</span> جديد</span>
                    <span><span class="badge bg-warning">&nbsp;</span> قيد المعالجة</span>
                    <span><span class="badge bg-success">&nbsp;</span> تم الحل</span>
                </div>

                <small class="text-muted d-block mt-2">
                    حالياً الخريطة شكلية، وبعدها سيتم ربطها مع Google Maps API.
                </small>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">بلاغات على الخريطة</h5>
            </div>

            <div class="card-body">

                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>إنارة معطلة</strong>
                        <span class="badge bg-primary">جديد</span>
                    </div>
                    <p class="text-muted mb-1 mt-2">شارع الجامعة</p>
                    <a href="{{ route('reports.show', 1) }}" class="btn btn-sm btn-outline-primary">
                        عرض التفاصيل
                    </a>
                </div>

                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>حفرة في الطريق</strong>
                        <span class="badge bg-warning">قيد المعالجة</span>
                    </div>
                    <p class="text-muted mb-1 mt-2">الطريق الرئيسي</p>
                    <a href="{{ route('reports.show', 2) }}" class="btn btn-sm btn-outline-primary">
                        عرض التفاصيل
                    </a>
                </div>

                <div>
                    <div class="d-flex justify-content-between">
                        <strong>تسرب مياه</strong>
                        <span class="badge bg-success">تم الحل</span>
                    </div>
                    <p class="text-muted mb-1 mt-2">الحي الشرقي</p>
                    <a href="{{ route('reports.show', 3) }}" class="btn btn-sm btn-outline-primary">
                        عرض التفاصيل
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection