@extends('layouts.admin')

@section('title', 'المستخدمون')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-1">المستخدمون</h1>
        <p class="text-muted mb-0">إدارة مستخدمي النظام وصلاحياتهم</p>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-primary">        <i data-feather="plus"></i>
        مستخدم جديد
    </a>
</div>

<div class="row mb-4">

    <div class="col-md-3">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-muted">إجمالي المستخدمين</p>
                    <h2 class="mb-0">24</h2>
                </div>
                <div class="stat-icon stat-total">
                    <i data-feather="users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-muted">المشرفون</p>
                    <h2 class="mb-0">3</h2>
                </div>
                <div class="stat-icon stat-new">
                    <i data-feather="shield"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-muted">الموظفون</p>
                    <h2 class="mb-0">7</h2>
                </div>
                <div class="stat-icon stat-progress">
                    <i data-feather="briefcase"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1 text-muted">المواطنون</p>
                    <h2 class="mb-0">14</h2>
                </div>
                <div class="stat-icon stat-resolved">
                    <i data-feather="user"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="row">

            <div class="col-md-4">
                <label class="form-label">البحث</label>
                <input type="text" class="form-control" placeholder="ابحث باسم المستخدم أو البريد...">
            </div>

            <div class="col-md-3">
                <label class="form-label">الدور</label>
                <select class="form-select">
                    <option>الكل</option>
                    <option>مشرف</option>
                    <option>موظف بلدي</option>
                    <option>مواطن</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">الحالة</label>
                <select class="form-select">
                    <option>الكل</option>
                    <option>فعال</option>
                    <option>غير فعال</option>
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
        <h5 class="card-title mb-0">قائمة المستخدمين</h5>
    </div>

    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الدور</th>
                <th>الحالة</th>
                <th>تاريخ الإنشاء</th>
                <th>الإجراءات</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>1</td>
                <td>أحمد محمد</td>
                <td>admin@example.com</td>
                <td><span class="badge bg-dark">مشرف</span></td>
                <td><span class="badge bg-success">فعال</span></td>
                <td>2026-07-01</td>
                <td class="text-nowrap">
                <a href="{{ route('users.show', 1) }}" class="btn btn-sm btn-info">عرض</a>                    <a href="{{ route('users.edit', 1) }}" class="btn btn-sm btn-warning">تعديل</a>                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>سارة علي</td>
                <td>officer@example.com</td>
                <td><span class="badge bg-primary">موظف بلدي</span></td>
                <td><span class="badge bg-success">فعال</span></td>
                <td>2026-07-02</td>
                <td class="text-nowrap">
                <a href="{{ route('users.show', 2) }}" class="btn btn-sm btn-info">عرض</a>                    <a href="{{ route('users.edit', 2) }}" class="btn btn-sm btn-warning">تعديل</a>                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>ليلى حسن</td>
                <td>citizen@example.com</td>
                <td><span class="badge bg-secondary">مواطن</span></td>
                <td><span class="badge bg-success">فعال</span></td>
                <td>2026-07-03</td>
                <td class="text-nowrap">
                <a href="{{ route('users.show', 3) }}" class="btn btn-sm btn-info">عرض</a>                    <a href="{{ route('users.edit', 3) }}" class="btn btn-sm btn-warning">تعديل</a>                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>

            <tr>
                <td>4</td>
                <td>خالد عمر</td>
                <td>khaled@example.com</td>
                <td><span class="badge bg-secondary">مواطن</span></td>
                <td><span class="badge bg-danger">غير فعال</span></td>
                <td>2026-07-04</td>
                <td class="text-nowrap">
                <a href="{{ route('users.show', 4) }}" class="btn btn-sm btn-info">عرض</a>                    <a href="{{ route('users.edit', 4) }}" class="btn btn-sm btn-warning">تعديل</a>                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>
            </tbody>

        </table>
    </div>
</div>

@endsection