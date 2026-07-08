@extends('layouts.admin')

@section('title', 'المستخدمون')

@section('content')

<style>
    .users-page .user-avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
    }

    .users-page .user-name {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 3px;
    }

    .users-page .user-email {
        color: #6b7280;
        font-size: 13px;
    }

    .users-page .filter-card {
        border-radius: 18px;
    }

    .users-page .table-actions {
        display: flex;
        gap: 8px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .users-page .role-card {
        min-height: 145px;
    }

    .users-page .role-icon {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
    }

    .users-page .role-icon svg {
        width: 28px;
        height: 28px;
    }
</style>

<div class="users-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">المستخدمون</h1>
            <p class="page-subtitle">إدارة حسابات المستخدمين وصلاحياتهم داخل النظام</p>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i data-feather="user-plus"></i>
            مستخدم جديد
        </a>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">إجمالي المستخدمين</div>
                        <div class="stat-number">24</div>
                        <p class="stat-desc">كل حسابات النظام</p>
                    </div>
                    <div class="stat-icon stat-total">
                        <i data-feather="users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#11857a;">المشرفون</div>
                        <div class="stat-number">3</div>
                        <p class="stat-desc">إدارة كاملة للنظام</p>
                    </div>
                    <div class="stat-icon stat-new">
                        <i data-feather="shield"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#f2a72a;">الموظفون</div>
                        <div class="stat-number">7</div>
                        <p class="stat-desc">متابعة ومعالجة البلاغات</p>
                    </div>
                    <div class="stat-icon stat-progress">
                        <i data-feather="briefcase"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#42a85f;">المواطنون</div>
                        <div class="stat-number">14</div>
                        <p class="stat-desc">مرسلو البلاغات</p>
                    </div>
                    <div class="stat-icon stat-done">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card filter-card mb-4">
        <div class="card-header">
            <h5 class="card-title">تصفية المستخدمين</h5>
        </div>

        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">بحث</label>
                    <input type="text" id="userSearch" class="form-control" placeholder="ابحث بالاسم أو البريد الإلكتروني...">
                </div>

                <div class="col-md-3">
                    <label class="form-label">الدور</label>
                    <select id="userRoleFilter" class="form-select">
                        <option value="">كل الأدوار</option>
                        <option value="مشرف">مشرف</option>
                        <option value="موظف بلدي">موظف بلدي</option>
                        <option value="مواطن">مواطن</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">الحالة</label>
                    <select id="userStatusFilter" class="form-select">
                        <option value="">كل الحالات</option>
                        <option value="فعال">فعال</option>
                        <option value="غير فعال">غير فعال</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" id="filterUsersBtn" class="btn btn-primary w-100">
                        تصفية
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card role-card">
                <div class="card-body text-center">
                    <div class="role-icon mx-auto" style="background:#dff3e6;color:#2f7e77;">
                        <i data-feather="shield"></i>
                    </div>
                    <h5 class="card-title">المشرف / المدير</h5>
                    <p class="text-muted mb-0">إدارة المستخدمين، البلاغات، الإحصائيات، وأنواع البلاغات.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card role-card">
                <div class="card-body text-center">
                    <div class="role-icon mx-auto" style="background:#fff1d8;color:#f2a72a;">
                        <i data-feather="briefcase"></i>
                    </div>
                    <h5 class="card-title">الموظف البلدي</h5>
                    <p class="text-muted mb-0">مراجعة البلاغات وتحديث الحالة وإضافة الملاحظات.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card role-card">
                <div class="card-body text-center">
                    <div class="role-icon mx-auto" style="background:#d9f0ec;color:#0b7d73;">
                        <i data-feather="user"></i>
                    </div>
                    <h5 class="card-title">المواطن</h5>
                    <p class="text-muted mb-0">إرسال البلاغات وتحديد الموقع ومتابعة حالة البلاغ.</p>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title">قائمة المستخدمين</h5>
                <small class="text-muted">عرض وإدارة جميع مستخدمي النظام</small>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>المستخدم</th>
                            <th>رقم الهاتف</th>
                            <th>الدور</th>
                            <th>الحالة</th>
                            <th>تاريخ الإنشاء</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody id="usersTable">

                        <tr>
                            <td>1</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">أ</div>
                                    <div>
                                        <div class="user-name">أحمد محمد</div>
                                        <div class="user-email">admin@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>0999999999</td>
                            <td><span class="badge bg-primary">مشرف</span></td>
                            <td><span class="badge bg-success">فعال</span></td>
                            <td>2026-07-01</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('users.show', 1) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                                    <a href="{{ route('users.edit', 1) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">س</div>
                                    <div>
                                        <div class="user-name">سارة علي</div>
                                        <div class="user-email">officer@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>0988888888</td>
                            <td><span class="badge bg-warning">موظف بلدي</span></td>
                            <td><span class="badge bg-success">فعال</span></td>
                            <td>2026-07-02</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('users.show', 2) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                                    <a href="{{ route('users.edit', 2) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">ل</div>
                                    <div>
                                        <div class="user-name">ليلى حسن</div>
                                        <div class="user-email">citizen@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>0977777777</td>
                            <td><span class="badge bg-secondary">مواطن</span></td>
                            <td><span class="badge bg-success">فعال</span></td>
                            <td>2026-07-03</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('users.show', 3) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                                    <a href="{{ route('users.edit', 3) }}" class="btn btn-sm btn-warning">تعديل</a>
                                    <a href="#" class="btn btn-sm btn-danger">حذف</a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar">خ</div>
                                    <div>
                                        <div class="user-name">خالد عمر</div>
                                        <div class="user-email">khaled@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>0966666666</td>
                            <td><span class="badge bg-secondary">مواطن</span></td>
                            <td><span class="badge bg-danger">غير فعال</span></td>
                            <td>2026-07-04</td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('users.show', 4) }}" class="btn btn-sm btn-outline-primary">عرض</a>
                                    <a href="{{ route('users.edit', 4) }}" class="btn btn-sm btn-warning">تعديل</a>
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
    document.getElementById('filterUsersBtn').addEventListener('click', function () {
        let searchValue = document.getElementById('userSearch').value.toLowerCase().trim();
        let roleValue = document.getElementById('userRoleFilter').value.trim();
        let statusValue = document.getElementById('userStatusFilter').value.trim();

        let rows = document.querySelectorAll('#usersTable tr');

        rows.forEach(function (row) {
            let name = row.children[1].textContent.toLowerCase().trim();
            let phone = row.children[2].textContent.toLowerCase().trim();
            let role = row.children[3].textContent.trim();
            let status = row.children[4].textContent.trim();

            let matchSearch =
                name.includes(searchValue) ||
                phone.includes(searchValue);

            let matchRole =
                roleValue === '' ||
                role.includes(roleValue);

            let matchStatus =
                statusValue === '' ||
                status === statusValue;

            row.style.display = (matchSearch && matchRole && matchStatus) ? '' : 'none';
        });
    });
</script>

@endsection