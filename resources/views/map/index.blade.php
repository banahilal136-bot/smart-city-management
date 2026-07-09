@extends('layouts.admin')

@section('title', 'خريطة البلاغات')

@section('content')

<style>
    .map-page .main-map {
        height: 560px;
        border-radius: 18px;
        background:
            linear-gradient(135deg, rgba(223,238,234,.92), rgba(247,250,249,.92)),
            repeating-linear-gradient(0deg, transparent 0 38px, rgba(75,142,136,.08) 39px),
            repeating-linear-gradient(90deg, transparent 0 38px, rgba(75,142,136,.08) 39px);
        border: 1px solid #edf0f2;
        position: relative;
        overflow: hidden;
    }

    .map-page .map-road {
        position: absolute;
        background: rgba(75,142,136,.18);
        border-radius: 30px;
    }

    .map-page .road-1 {
        width: 85%;
        height: 18px;
        top: 42%;
        right: 7%;
        transform: rotate(-8deg);
    }

    .map-page .road-2 {
        width: 18px;
        height: 80%;
        top: 10%;
        right: 48%;
        transform: rotate(12deg);
    }

    .map-page .road-3 {
        width: 65%;
        height: 14px;
        bottom: 22%;
        left: 8%;
        transform: rotate(14deg);
    }

    .map-page .report-pin {
        position: absolute;
        width: 34px;
        height: 34px;
        border-radius: 50% 50% 50% 0;
        transform: rotate(-45deg);
        box-shadow: 0 8px 18px rgba(0,0,0,.20);
        cursor: pointer;
        transition: .2s;
    }

    .map-page .report-pin:hover {
        transform: rotate(-45deg) scale(1.12);
    }

    .map-page .report-pin::after {
        content: "";
        position: absolute;
        width: 12px;
        height: 12px;
        background: #fff;
        border-radius: 50%;
        top: 11px;
        left: 11px;
    }

    .map-page .pin-new {
        background: #0e8076;
    }

    .map-page .pin-progress {
        background: #f2a72a;
    }

    .map-page .pin-done {
        background: #42a85f;
    }

    .map-page .pin-danger {
        background: #dc3545;
    }

    .map-page .map-label {
        position: absolute;
        background: #ffffff;
        border: 1px solid #edf0f2;
        color: #1f2937;
        padding: 8px 12px;
        border-radius: 14px;
        font-weight: 800;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        font-size: 13px;
        white-space: nowrap;
    }

    .map-page .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        color: #6b7280;
    }

    .map-page .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 4px;
        display: inline-block;
    }

    .map-page .report-location-item {
        border: 1px solid #edf0f2;
        border-radius: 16px;
        padding: 14px;
        margin-bottom: 12px;
        transition: .2s;
        background: #fff;
    }

    .map-page .report-location-item:hover {
        border-color: #bcd9d5;
        transform: translateY(-2px);
    }

    .map-page .report-location-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .map-page .report-location-meta {
        color: #6b7280;
        font-size: 13px;
    }
</style>

<div class="map-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">خريطة البلاغات</h1>
            <p class="page-subtitle">عرض مواقع البلاغات وتوزيعها حسب الحالة والنوع</p>
        </div>

        <a href="{{ route('reports.index') }}" class="btn btn-outline-primary">
            رجوع إلى البلاغات
        </a>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">إجمالي المواقع</div>
                        <div class="stat-number">5</div>
                        <p class="stat-desc">بلاغات على الخريطة</p>
                    </div>
                    <div class="stat-icon stat-total">
                        <i data-feather="map"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#11857a;">جديدة</div>
                        <div class="stat-number">2</div>
                        <p class="stat-desc">بانتظار المعالجة</p>
                    </div>
                    <div class="stat-icon stat-new">
                        <i data-feather="alert-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#f2a72a;">قيد المعالجة</div>
                        <div class="stat-number">2</div>
                        <p class="stat-desc">يتم العمل عليها</p>
                    </div>
                    <div class="stat-icon stat-progress">
                        <i data-feather="clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#42a85f;">تم الحل</div>
                        <div class="stat-number">1</div>
                        <p class="stat-desc">بلاغ منتهي</p>
                    </div>
                    <div class="stat-icon stat-done">
                        <i data-feather="check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">الخريطة</h5>
                        <small class="text-muted">تمثيل تجريبي لمواقع البلاغات داخل المدينة</small>
                    </div>

                    <div class="d-flex gap-3">
                        <span class="legend-item">
                            <span class="legend-dot" style="background:#0e8076;"></span>
                            جديد
                        </span>

                        <span class="legend-item">
                            <span class="legend-dot" style="background:#f2a72a;"></span>
                            قيد المعالجة
                        </span>

                        <span class="legend-item">
                            <span class="legend-dot" style="background:#42a85f;"></span>
                            تم الحل
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="main-map">

                        <div class="map-road road-1"></div>
                        <div class="map-road road-2"></div>
                        <div class="map-road road-3"></div>

                        <div class="map-label" style="top: 45px; right: 55px;">شارع الجامعة</div>
                        <div class="map-label" style="top: 170px; left: 80px;">دوار البلدية</div>
                        <div class="map-label" style="bottom: 70px; right: 120px;">الحديقة العامة</div>

                        <a href="{{ route('reports.show', 1) }}" title="إنارة معطلة">
                            <div class="report-pin pin-new" style="top: 105px; right: 170px;"></div>
                        </a>

                        <a href="{{ route('reports.show', 2) }}" title="حفرة في الطريق">
                            <div class="report-pin pin-progress" style="top: 210px; left: 180px;"></div>
                        </a>

                        <a href="{{ route('reports.show', 3) }}" title="تسرب مياه">
                            <div class="report-pin pin-progress" style="bottom: 145px; right: 300px;"></div>
                        </a>

                        <a href="{{ route('reports.show', 4) }}" title="تجمع نفايات">
                            <div class="report-pin pin-done" style="bottom: 85px; left: 120px;"></div>
                        </a>

                        <a href="{{ route('reports.show', 5) }}" title="عمود إنارة خطر">
                            <div class="report-pin pin-danger" style="top: 80px; left: 260px;"></div>
                        </a>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">بلاغات قريبة</h5>
                    <small class="text-muted">اضغطي على عرض لفتح تفاصيل البلاغ</small>
                </div>

                <div class="card-body">

                    <div class="report-location-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="report-location-title">إنارة معطلة في الشارع الرئيسي</div>
                                <div class="report-location-meta">إنارة - شارع الجامعة</div>
                            </div>
                            <span class="badge bg-primary">جديد</span>
                        </div>

                        <a href="{{ route('reports.show', 1) }}" class="btn btn-sm btn-outline-primary mt-3">
                            عرض التفاصيل
                        </a>
                    </div>

                    <div class="report-location-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="report-location-title">حفرة في الطريق الرئيسي</div>
                                <div class="report-location-meta">طرق - دوار البلدية</div>
                            </div>
                            <span class="badge bg-warning">قيد المعالجة</span>
                        </div>

                        <a href="{{ route('reports.show', 2) }}" class="btn btn-sm btn-outline-primary mt-3">
                            عرض التفاصيل
                        </a>
                    </div>

                    <div class="report-location-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="report-location-title">تجمع نفايات بالقرب من الحديقة</div>
                                <div class="report-location-meta">نفايات - الحديقة العامة</div>
                            </div>
                            <span class="badge bg-success">تم الحل</span>
                        </div>

                        <a href="{{ route('reports.show', 4) }}" class="btn btn-sm btn-outline-primary mt-3">
                            عرض التفاصيل
                        </a>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">ملاحظة</h5>
                </div>

                <div class="card-body">
                    <div class="alert alert-success mb-0">
                        هذه خريطة تجريبية للواجهة. لاحقاً يمكن لجماعة الباك ربطها مع
                        <strong>Google Maps API</strong>
                        وإحداثيات البلاغات من قاعدة البيانات.
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection