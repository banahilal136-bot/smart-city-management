@extends('layouts.admin')

@section('title', 'أنواع البلاغات')

@section('content')

<style>
    .report-types-page .type-icon {
        width: 48px;
        height: 48px;
        border-radius: 16px;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .report-types-page .type-icon svg {
        width: 24px;
        height: 24px;
    }

    .report-types-page .type-name {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 3px;
    }

    .report-types-page .type-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }

    .report-types-page .table-actions {
        display: flex;
        gap: 8px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .report-types-page .filter-card {
        border-radius: 18px;
    }

    .report-types-page .guide-box {
        padding: 16px;
        border-radius: 16px;
        border: 1px solid #edf0f2;
        background: #fff;
        height: 100%;
    }

    .report-types-page .guide-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 6px;
    }

    .report-types-page .guide-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }
</style>

<div class="report-types-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">أنواع البلاغات</h1>
            <p class="page-subtitle">إدارة التصنيفات التي يختارها المواطن عند إرسال البلاغ</p>
        </div>

        <a href="{{ route('report-types.create') }}" class="btn btn-primary">
            <i data-feather="plus-circle"></i>
            نوع بلاغ جديد
        </a>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">إجمالي الأنواع</div>
                        <div class="stat-number">8</div>
                        <p class="stat-desc">كل أنواع البلاغات</p>
                    </div>
                    <div class="stat-icon stat-total">
                        <i data-feather="tag"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#11857a;">أنواع فعالة</div>
                        <div class="stat-number">6</div>
                        <p class="stat-desc">ظاهرة للمواطنين</p>
                    </div>
                    <div class="stat-icon stat-new">
                        <i data-feather="check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#f2a72a;">الأكثر استخداماً</div>
                        <div class="stat-number">طرق</div>
                        <p class="stat-desc">حسب البلاغات الحالية</p>
                    </div>
                    <div class="stat-icon stat-progress">
                        <i data-feather="trending-up"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#42a85f;">بلاغات مصنفة</div>
                        <div class="stat-number">120</div>
                        <p class="stat-desc">مرتبطة بأنواع البلاغات</p>
                    </div>
                    <div class="stat-icon stat-done">
                        <i data-feather="file-text"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card filter-card mb-4">
        <div class="card-header">
            <h5 class="card-title">تصفية أنواع البلاغات</h5>
        </div>

        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-5">
                    <label class="form-label">بحث</label>
                    <input type="text" id="typeSearch" class="form-control" placeholder="ابحث باسم النوع أو الوصف...">
                </div>

                <div class="col-md-3">
                    <label class="form-label">الحالة</label>
                    <select id="typeStatusFilter" class="form-select">
                        <option value="">كل الحالات</option>
                        <option value="فعال">فعال</option>
                        <option value="غير فعال">غير فعال</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">الأولوية</label>
                    <select id="typePriorityFilter" class="form-select">
                        <option value="">الكل</option>
                        <option value="عالية">عالية</option>
                        <option value="متوسطة">متوسطة</option>
                        <option value="منخفضة">منخفضة</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" id="filterTypesBtn" class="btn btn-primary w-100">
                        تصفية
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="guide-box">
                <div class="guide-title">تنظيم البلاغات</div>
                <p class="guide-desc">
                    تساعد الأنواع على تصنيف البلاغات مثل الطرق، النظافة، الإنارة، والمياه.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="guide-box">
                <div class="guide-title">تسهيل المتابعة</div>
                <p class="guide-desc">
                    يمكن للموظف معرفة القسم المناسب لمعالجة البلاغ حسب نوع المشكلة.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="guide-box">
                <div class="guide-title">تحسين الإحصائيات</div>
                <p class="guide-desc">
                    تظهر لوحة التحكم عدد البلاغات حسب التصنيف وتساعد الإدارة في اتخاذ القرار.
                </p>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title">قائمة أنواع البلاغات</h5>
                <small class="text-muted">عرض وتعديل الأنواع المستخدمة في النظام</small>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نوع البلاغ</th>
                            <th>عدد البلاغات</th>
                            <th>الأولوية</th>
                            <th>الحالة</th>
                            <th>تاريخ الإضافة</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody id="typesTable">

                        <tr>
                            <td>1</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="type-icon">
                                        <i data-feather="map"></i>
                                    </div>
                                    <div>
                                        <div class="type-name">طرق</div>
                                        <p class="type-desc">مشاكل الحفر والأرصفة والازدحام</p>
                                    </div>
                                </div>
                            </td>
                            <td>35</td>
                            <td><span class="badge bg-danger">عالية</span></td>
                            <td><span class="badge bg-success">فعال</span></td>
                            <td>2026-07-01</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('report-types.edit', 1) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="type-icon">
                                        <i data-feather="trash-2"></i>
                                    </div>
                                    <div>
                                        <div class="type-name">نظافة</div>
                                        <p class="type-desc">تراكم النفايات ومشاكل الحاويات</p>
                                    </div>
                                </div>
                            </td>
                            <td>28</td>
                            <td><span class="badge bg-warning">متوسطة</span></td>
                            <td><span class="badge bg-success">فعال</span></td>
                            <td>2026-07-02</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('report-types.edit', 2) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="type-icon">
                                        <i data-feather="zap"></i>
                                    </div>
                                    <div>
                                        <div class="type-name">إنارة</div>
                                        <p class="type-desc">أعطال أعمدة الإنارة والكهرباء العامة</p>
                                    </div>
                                </div>
                            </td>
                            <td>21</td>
                            <td><span class="badge bg-warning">متوسطة</span></td>
                            <td><span class="badge bg-success">فعال</span></td>
                            <td>2026-07-03</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('report-types.edit', 3) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="type-icon">
                                        <i data-feather="droplet"></i>
                                    </div>
                                    <div>
                                        <div class="type-name">مياه</div>
                                        <p class="type-desc">تسرب المياه أو مشاكل الشبكة</p>
                                    </div>
                                </div>
                            </td>
                            <td>14</td>
                            <td><span class="badge bg-danger">عالية</span></td>
                            <td><span class="badge bg-success">فعال</span></td>
                            <td>2026-07-04</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('report-types.edit', 4) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="type-icon">
    <i data-feather="sun"></i>
</div>
<div>
    <div class="type-name">حدائق</div>
    <p class="type-desc">مشاكل الحدائق والمساحات الخضراء</p>
</div>
                                </div>
                            </td>
                            <td>6</td>
                            <td><span class="badge bg-secondary">منخفضة</span></td>
                            <td><span class="badge bg-danger">غير فعال</span></td>
                            <td>2026-07-05</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('report-types.edit', 5) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById('filterTypesBtn').addEventListener('click', function () {
        let searchValue = document.getElementById('typeSearch').value.toLowerCase().trim();
        let statusValue = document.getElementById('typeStatusFilter').value.trim();
        let priorityValue = document.getElementById('typePriorityFilter').value.trim();

        let rows = document.querySelectorAll('#typesTable tr');

        rows.forEach(function (row) {
            let typeInfo = row.children[1].textContent.toLowerCase().trim();
            let priority = row.children[3].textContent.trim();
            let status = row.children[4].textContent.trim();

            let matchSearch = typeInfo.includes(searchValue);

            let matchStatus =
                statusValue === '' ||
                status === statusValue;

            let matchPriority =
                priorityValue === '' ||
                priority === priorityValue;

            row.style.display = (matchSearch && matchStatus && matchPriority) ? '' : 'none';
        });
    });
</script>

@endsection