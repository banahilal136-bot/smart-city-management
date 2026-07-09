@extends('layouts.admin')

@section('title', 'أنواع البلاغات')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-1">أنواع البلاغات</h1>
        <p class="text-muted mb-0">إدارة وتصنيف أنواع البلاغات في النظام</p>
    </div>

    <a href="{{ route('report-types.create') }}" class="btn btn-primary">        <i data-feather="plus"></i>
        نوع جديد
    </a>
</div>

<div class="row">

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="stat-icon stat-total mx-auto mb-3">
                    <i data-feather="zap"></i>
                </div>
                <h5>إنارة</h5>
                <p class="text-muted mb-2">بلاغات أعطال الإنارة</p>
                <span class="badge bg-success">فعال</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="stat-icon stat-new mx-auto mb-3">
                    <i data-feather="truck"></i>
                </div>
                <h5>طرق</h5>
                <p class="text-muted mb-2">بلاغات الطرق والحفر</p>
                <span class="badge bg-success">فعال</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="stat-icon stat-progress mx-auto mb-3">
                    <i data-feather="droplet"></i>
                </div>
                <h5>مياه</h5>
                <p class="text-muted mb-2">بلاغات تسرب المياه</p>
                <span class="badge bg-success">فعال</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="stat-icon stat-resolved mx-auto mb-3">
                    <i data-feather="trash-2"></i>
                </div>
                <h5>نفايات</h5>
                <p class="text-muted mb-2">بلاغات النظافة والنفايات</p>
                <span class="badge bg-success">فعال</span>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">قائمة أنواع البلاغات</h5>
    </div>

    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>اسم النوع</th>
                <th>الوصف</th>
                <th>الحالة</th>
                <th>عدد البلاغات</th>
                <th>الإجراءات</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>1</td>
                <td>إنارة</td>
                <td>أعطال الإنارة في الشوارع والمرافق</td>
                <td><span class="badge bg-success">فعال</span></td>
                <td>45</td>
                <td class="text-nowrap">
                <a href="{{ route('report-types.edit', 1) }}" class="btn btn-sm btn-warning">تعديل</a>                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>طرق</td>
                <td>مشاكل الطرق والحفر والأرصفة</td>
                <td><span class="badge bg-success">فعال</span></td>
                <td>67</td>
                <td class="text-nowrap">
                <a href="{{ route('report-types.edit', 2) }}" class="btn btn-sm btn-warning">تعديل</a>                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>مياه</td>
                <td>تسربات المياه والمشاكل المتعلقة بها</td>
                <td><span class="badge bg-success">فعال</span></td>
                <td>29</td>
                <td class="text-nowrap">
                <a href="{{ route('report-types.edit', 3) }}" class="btn btn-sm btn-warning">تعديل</a>                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>

            <tr>
                <td>4</td>
                <td>نفايات</td>
                <td>بلاغات النظافة وتجمع النفايات</td>
                <td><span class="badge bg-success">فعال</span></td>
                <td>38</td>
                <td class="text-nowrap">
                <a href="{{ route('report-types.edit', 4) }}" class="btn btn-sm btn-warning">تعديل</a>                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>
            </tbody>

        </table>
    </div>
</div>

@endsection