@extends('layouts.admin')

@section('title', 'جميع البلاغات')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title">جميع البلاغات</h1>
        <p class="page-subtitle">إدارة ومتابعة البلاغات الواردة من المواطنين</p>
    </div>

    <a href="{{ route('reports.create') }}" class="btn btn-primary">
        <i data-feather="plus-circle"></i>
        بلاغ جديد
    </a>
</div>

<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-title">إجمالي البلاغات</div>
                    <div class="stat-number">128</div>
                    <p class="stat-desc">كل البلاغات المسجلة</p>
                </div>
                <div class="stat-icon stat-total">
                    <i data-feather="file-text"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="stat-title" style="color:#11857a;">بلاغات جديدة</div>
                    <div class="stat-number">24</div>
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
                    <div class="stat-number">46</div>
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
                    <div class="stat-number">58</div>
                    <p class="stat-desc">بلاغات منتهية</p>
                </div>
                <div class="stat-icon stat-done">
                    <i data-feather="check-circle"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">تصفية البلاغات</h5>
    </div>

    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-4">
                <label class="form-label">بحث</label>
                <input type="text" id="reportSearch" class="form-control" placeholder="ابحث بعنوان البلاغ أو الموقع...">
            </div>

            <div class="col-md-3">
                <label class="form-label">نوع البلاغ</label>
                <select id="typeFilter" class="form-select">
                    <option value="">كل الأنواع</option>
                    <option value="إنارة">إنارة</option>
                    <option value="طرق">طرق</option>
                    <option value="مياه">مياه</option>
                    <option value="نفايات">نفايات</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">الحالة</label>
                <select id="statusFilter" class="form-select">
                    <option value="">كل الحالات</option>
                    <option value="جديد">جديد</option>
                    <option value="قيد المعالجة">قيد المعالجة</option>
                    <option value="تم الحل">تم الحل</option>
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="button" id="filterReportsBtn" class="btn btn-primary w-100">
                    تصفية
                </button>
            </div>

        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="card-title">قائمة البلاغات</h5>
            <small class="text-muted">عرض كل البلاغات مع الحالة والموقع</small>
        </div>
    </div>

    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان البلاغ</th>
                        <th>النوع</th>
                        <th>الحالة</th>
                        <th>الموقع</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody id="reportsTable">

                    <tr>
                        <td>1</td>
                        <td>إنارة معطلة في الشارع الرئيسي</td>
                        <td>إنارة</td>
                        <td><span class="badge bg-primary">جديد</span></td>
                        <td>شارع الجامعة</td>
                        <td>2024-05-20</td>
                        <td>
                            <a href="{{ route('reports.show', 1) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                            <a href="{{ route('reports.edit', 1) }}" class="btn btn-sm btn-warning">تعديل</a>
                            <a href="#" class="btn btn-sm btn-danger">حذف</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>حفرة في الطريق الرئيسي</td>
                        <td>طرق</td>
                        <td><span class="badge bg-warning">قيد المعالجة</span></td>
                        <td>دوار البلدية</td>
                        <td>2024-05-19</td>
                        <td>
                            <a href="{{ route('reports.show', 2) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                            <a href="{{ route('reports.edit', 2) }}" class="btn btn-sm btn-warning">تعديل</a>
                            <a href="#" class="btn btn-sm btn-danger">حذف</a>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>تسرب مياه في الشارع العام</td>
                        <td>مياه</td>
                        <td><span class="badge bg-warning">قيد المعالجة</span></td>
                        <td>حي النصر</td>
                        <td>2024-05-18</td>
                        <td>
                            <a href="{{ route('reports.show', 3) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                            <a href="{{ route('reports.edit', 3) }}" class="btn btn-sm btn-warning">تعديل</a>
                            <a href="#" class="btn btn-sm btn-danger">حذف</a>
                        </td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>تجمع نفايات بالقرب من الحديقة</td>
                        <td>نفايات</td>
                        <td><span class="badge bg-success">تم الحل</span></td>
                        <td>الحديقة العامة</td>
                        <td>2024-05-17</td>
                        <td>
                            <a href="{{ route('reports.show', 4) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                            <a href="{{ route('reports.edit', 4) }}" class="btn btn-sm btn-warning">تعديل</a>
                            <a href="#" class="btn btn-sm btn-danger">حذف</a>
                        </td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td>عمود إنارة مائل وخطر</td>
                        <td>إنارة</td>
                        <td><span class="badge bg-success">تم الحل</span></td>
                        <td>شارع السوق</td>
                        <td>2024-05-16</td>
                        <td>
                            <a href="{{ route('reports.show', 5) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                            <a href="{{ route('reports.edit', 5) }}" class="btn btn-sm btn-warning">تعديل</a>
                            <a href="#" class="btn btn-sm btn-danger">حذف</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('filterReportsBtn').addEventListener('click', function () {
        let searchValue = document.getElementById('reportSearch').value.toLowerCase().trim();
        let typeValue = document.getElementById('typeFilter').value.trim();
        let statusValue = document.getElementById('statusFilter').value.trim();

        let rows = document.querySelectorAll('#reportsTable tr');

        rows.forEach(function (row) {
            let title = row.children[1].textContent.toLowerCase().trim();
            let type = row.children[2].textContent.trim();
            let status = row.children[3].textContent.trim();
            let location = row.children[4].textContent.toLowerCase().trim();

            let matchSearch =
                title.includes(searchValue) ||
                location.includes(searchValue);

            let matchType =
                typeValue === '' ||
                type === typeValue;

            let matchStatus =
                statusValue === '' ||
                status === statusValue;

            if (matchSearch && matchType && matchStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection