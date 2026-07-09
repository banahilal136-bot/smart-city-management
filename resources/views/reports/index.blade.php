@extends('layouts.admin')

@section('title', 'جميع البلاغات')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-1">جميع البلاغات</h1>
        <p class="text-muted mb-0">عرض ومتابعة بلاغات المواطنين</p>
    </div>

    <a href="{{ route('reports.create') }}" class="btn btn-primary">        <i data-feather="plus"></i>
        بلاغ جديد
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="row">

            <div class="col-md-4">
                <label class="form-label">البحث</label>
                <input type="text" class="form-control" placeholder="ابحث بعنوان البلاغ...">
            </div>

            <div class="col-md-3">
                <label class="form-label">نوع البلاغ</label>
                <select class="form-select">
                    <option>الكل</option>
                    <option>إنارة</option>
                    <option>طرق</option>
                    <option>مياه</option>
                    <option>نفايات</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">الحالة</label>
                <select class="form-select">
                    <option>الكل</option>
                    <option>جديد</option>
                    <option>قيد المعالجة</option>
                    <option>تم الحل</option>
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-success w-100">تصفية</button>
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">قائمة البلاغات</h5>
    </div>

    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>عنوان البلاغ</th>
                <th>النوع</th>
                <th>الموقع</th>
                <th>الحالة</th>
                <th>التاريخ</th>
                <th>الإجراءات</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>1</td>
                <td>إنارة معطلة في الشارع الرئيسي</td>
                <td>إنارة</td>
                <td>شارع الجامعة</td>
                <td><span class="badge bg-primary">جديد</span></td>
                <td>2026-07-08</td>
                <td>
                <a href="{{ route('reports.show', 1) }}" class="btn btn-sm btn-info">عرض</a>                   <a href="{{ route('reports.edit', 1) }}" class="btn btn-sm btn-warning">تعديل</a>
                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>حفرة في الطريق العام</td>
                <td>طرق</td>
                <td>الطريق الرئيسي</td>
                <td><span class="badge bg-warning">قيد المعالجة</span></td>
                <td>2026-07-07</td>
                <td>
                <a href="{{ route('reports.show', 2) }}" class="btn btn-sm btn-info">عرض</a>                   <a href="{{ route('reports.edit', 2) }}" class="btn btn-sm btn-warning">تعديل</a>
                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>تسرب مياه في الحي الشرقي</td>
                <td>مياه</td>
                <td>الحي الشرقي</td>
                <td><span class="badge bg-success">تم الحل</span></td>
                <td>2026-07-06</td>
                <td>
               
                <a href="{{ route('reports.show', 3) }}" class="btn btn-sm btn-info">عرض</a>                   <a href="{{ route('reports.edit', 3) }}" class="btn btn-sm btn-warning">تعديل</a>
                <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection