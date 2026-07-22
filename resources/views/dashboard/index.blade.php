@extends('layouts.admin')

@section('title', 'لوحة التحكم')

@section('content')

<div class="mb-4">
    <h1 class="page-title">مرحباً بك، {{ auth()->user()->name }} 👋</h1>
    <p class="page-subtitle">إليك نظرة عامة على البلاغات في المدينة</p>
</div>

<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-title">إجمالي البلاغات</div>
                    <div class="stat-number">256</div>
                    <p class="stat-desc">جميع البلاغات المسجلة</p>
                </div>
                <div class="stat-icon stat-total">
                    <i data-feather="sliders"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-title" style="color:#11857a;">بلاغات جديدة</div>
                    <div class="stat-number">32</div>
                    <p class="stat-desc">في انتظار المعالجة</p>
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
                    <div class="stat-number">75</div>
                    <p class="stat-desc">جار العمل عليها</p>
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
                    <div class="stat-number">149</div>
                    <p class="stat-desc">بلاغات تم حلها</p>
                </div>
                <div class="stat-icon stat-done">
                    <i data-feather="check-circle"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row g-4 mb-4">

    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title">خريطة البلاغات</h5>
            </div>
            <div class="card-body">
                <div class="dashboard-map">
                    <div class="map-pin pin-red" style="top: 55px; right: 120px;"></div>
                    <div class="map-pin pin-orange" style="top: 85px; right: 250px;"></div>
                    <div class="map-pin pin-purple" style="top: 40px; left: 120px;"></div>
                    <div class="map-pin pin-blue" style="bottom: 55px; right: 220px;"></div>
                    <div class="map-pin pin-green" style="bottom: 35px; left: 70px;"></div>
                </div>

                <div class="map-legend">
                    <span><span class="box" style="background:#0e8076;"></span> جديد</span>
                    <span><span class="box" style="background:#f59e0b;"></span> قيد المعالجة</span>
                    <span><span class="box" style="background:#22c55e;"></span> تم الحل</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">آخر البلاغات</h5>
                <a href="{{ route('reports.index') }}" class="btn btn-sm btn-primary">عرض الكل</a>
            </div>

            <div class="card-body pt-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>العنوان</th>
                            <th>النوع</th>
                            <th>الحالة</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>إنارة معطلة في الشارع الرئيسي</td>
                            <td>إنارة</td>
                            <td><span class="badge bg-primary">جديد</span></td>
                            <td>2024-05-20</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>حفرة في طريق القصر محمد</td>
                            <td>طرق</td>
                            <td><span class="badge bg-warning">قيد المعالجة</span></td>
                            <td>2024-05-20</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>تسرب مياه في الشارع العام</td>
                            <td>مياه</td>
                            <td><span class="badge bg-warning">قيد المعالجة</span></td>
                            <td>2024-05-19</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>تجمع نفايات بالقرب من الحديقة</td>
                            <td>نفايات</td>
                            <td><span class="badge bg-success">تم الحل</span></td>
                            <td>2024-05-18</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>عمود إنارة مائل وخطر</td>
                            <td>إنارة</td>
                            <td><span class="badge bg-success">تم الحل</span></td>
                            <td>2024-05-17</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-2">
                    <a href="{{ route('reports.index') }}" class="text-decoration-none" style="color:#2f7e77;font-weight:700;">
                        عرض جميع البلاغات ←
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="mb-3">
    <h3 class="quick-actions-title">إجراءات سريعة</h3>
</div>

<div class="row g-4">

    <div class="col-md-6 col-xl-3">
        <a href="{{ route('map.index') }}" class="text-decoration-none">
            <div class="quick-action">
                <i data-feather="map-pin"></i>
                <span>الخريطة</span>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-xl-3">
        <a href="{{ route('report-types.index') }}" class="text-decoration-none">
            <div class="quick-action">
                <i data-feather="grid"></i>
                <span>أنواع البلاغات</span>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-xl-3">
        <a href="{{ route('reports.index') }}" class="text-decoration-none">
            <div class="quick-action">
                <i data-feather="file-text"></i>
                <span>جميع البلاغات</span>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-xl-3">
        <a href="{{ route('reports.create') }}" class="text-decoration-none">
            <div class="quick-action">
                <i data-feather="plus"></i>
                <span>بلاغ جديد</span>
            </div>
        </a>
    </div>

</div>

@endsection