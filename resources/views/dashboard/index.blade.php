@extends('layouts.admin')

@section('title', 'لوحة التحكم')

@section('content')

<div class="mb-4">
    <h1 class="h3 mb-1">لوحة التحكم</h1>
    <p class="text-muted mb-0">نظرة عامة على بلاغات المدينة الذكية</p>
</div>

<div class="row">

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-muted">إجمالي البلاغات</p>
                    <h2 class="mb-0">256</h2>
                    <small class="text-muted">كل البلاغات المسجلة</small>
                </div>
                <div class="stat-icon stat-total">
                    <i data-feather="file-text"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-muted">بلاغات جديدة</p>
                    <h2 class="mb-0">32</h2>
                    <small class="text-muted">بانتظار المراجعة</small>
                </div>
                <div class="stat-icon stat-new">
                    <i data-feather="alert-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-muted">قيد المعالجة</p>
                    <h2 class="mb-0">75</h2>
                    <small class="text-muted">جار العمل عليها</small>
                </div>
                <div class="stat-icon stat-progress">
                    <i data-feather="clock"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-muted">تم الحل</p>
                    <h2 class="mb-0">149</h2>
                    <small class="text-muted">بلاغات معالجة</small>
                </div>
                <div class="stat-icon stat-resolved">
                    <i data-feather="check-circle"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">خريطة البلاغات</h5>
            </div>

            <div class="card-body">
                <div class="report-map">
                    <div class="map-pin pin-red"></div>
                    <div class="map-pin pin-blue"></div>
                    <div class="map-pin pin-orange"></div>
                    <div class="map-pin pin-green"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">آخر البلاغات</h5>
                <a href="{{ route('reports.index') }}" class="btn btn-sm btn-primary">عرض الكل</a>            </div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>النوع</th>
                        <th>الحالة</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>إنارة معطلة في الشارع الرئيسي</td>
                        <td>إنارة</td>
                        <td><span class="badge bg-primary">جديد</span></td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>حفرة في الطريق العام</td>
                        <td>طرق</td>
                        <td><span class="badge bg-warning">قيد المعالجة</span></td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>تسرب مياه</td>
                        <td>مياه</td>
                        <td><span class="badge bg-success">تم الحل</span></td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

@endsection