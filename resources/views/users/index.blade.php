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
        flex-shrink: 0;
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

    .users-page .empty-users {
        padding: 45px 20px;
        text-align: center;
        color: #6b7280;
    }

    .users-page .empty-users svg {
        width: 42px;
        height: 42px;
        margin-bottom: 12px;
        color: #2f8f83;
    }

    body.dark-mode .users-page .user-name {
        color: #e5e7eb;
    }

    body.dark-mode .users-page .user-email {
        color: #9ca3af;
    }
</style>


<div class="users-page">

    <!-- Page Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">

        <div>

            <h1 class="page-title">
                المستخدمون
            </h1>

            <p class="page-subtitle">
                إدارة حسابات المستخدمين وصلاحياتهم داخل النظام
            </p>

        </div>


        <a
            href="{{ route('users.create') }}"
            class="btn btn-primary"
        >
            <i data-feather="user-plus"></i>

            مستخدم جديد
        </a>

    </div>


    <!-- Success Message -->
    @if (session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="إغلاق"
            ></button>

        </div>

    @endif


    <!-- Error Message -->
    @if (session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="إغلاق"
            ></button>

        </div>

    @endif


    <!-- Statistics -->
    <div class="row g-4 mb-4">


        <!-- Total Users -->
        <div class="col-md-6 col-xl-3">

            <div class="card stat-card">

                <div
                    class="card-body d-flex justify-content-between align-items-center"
                >

                    <div>

                        <div class="stat-title">
                            إجمالي المستخدمين
                        </div>

                        <div class="stat-number">
                            {{ $totalUsers }}
                        </div>

                        <p class="stat-desc">
                            كل حسابات النظام
                        </p>

                    </div>


                    <div class="stat-icon stat-total">

                        <i data-feather="users"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- Admins -->
        <div class="col-md-6 col-xl-3">

            <div class="card stat-card">

                <div
                    class="card-body d-flex justify-content-between align-items-center"
                >

                    <div>

                        <div
                            class="stat-title"
                            style="color:#11857a;"
                        >
                            المشرفون
                        </div>

                        <div class="stat-number">
                            {{ $adminCount }}
                        </div>

                        <p class="stat-desc">
                            إدارة كاملة للنظام
                        </p>

                    </div>


                    <div class="stat-icon stat-new">

                        <i data-feather="shield"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- Employees -->
        <div class="col-md-6 col-xl-3">

            <div class="card stat-card">

                <div
                    class="card-body d-flex justify-content-between align-items-center"
                >

                    <div>

                        <div
                            class="stat-title"
                            style="color:#f2a72a;"
                        >
                            الموظفون
                        </div>

                        <div class="stat-number">
                            {{ $employeeCount }}
                        </div>

                        <p class="stat-desc">
                            متابعة ومعالجة البلاغات
                        </p>

                    </div>


                    <div class="stat-icon stat-progress">

                        <i data-feather="briefcase"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- Citizens -->
        <div class="col-md-6 col-xl-3">

            <div class="card stat-card">

                <div
                    class="card-body d-flex justify-content-between align-items-center"
                >

                    <div>

                        <div
                            class="stat-title"
                            style="color:#42a85f;"
                        >
                            المواطنون
                        </div>

                        <div class="stat-number">
                            {{ $citizenCount }}
                        </div>

                        <p class="stat-desc">
                            مرسلو البلاغات
                        </p>

                    </div>


                    <div class="stat-icon stat-done">

                        <i data-feather="user"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Filters -->
    <div class="card filter-card mb-4">

        <div class="card-header">

            <h5 class="card-title">
                تصفية المستخدمين
            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route('users.index') }}"
                method="GET"
            >

                <div class="row g-3">


                    <!-- Search -->
                    <div class="col-md-4">

                        <label
                            for="userSearch"
                            class="form-label"
                        >
                            بحث
                        </label>

                        <input
                            type="text"
                            id="userSearch"
                            name="search"
                            class="form-control"
                            placeholder="ابحث بالاسم أو البريد الإلكتروني..."
                            value="{{ request('search') }}"
                        >

                    </div>


                    <!-- Role -->
                    <div class="col-md-3">

                        <label
                            for="userRoleFilter"
                            class="form-label"
                        >
                            الدور
                        </label>

                        <select
                            id="userRoleFilter"
                            name="role"
                            class="form-select"
                        >

                            <option value="">
                                كل الأدوار
                            </option>

                            <option
                                value="admin"
                                {{ request('role') === 'admin' ? 'selected' : '' }}
                            >
                                مشرف
                            </option>

                            <option
                                value="employee"
                                {{ request('role') === 'employee' ? 'selected' : '' }}
                            >
                                موظف بلدي
                            </option>

                            <option
                                value="citizen"
                                {{ request('role') === 'citizen' ? 'selected' : '' }}
                            >
                                مواطن
                            </option>

                        </select>

                    </div>


                    <!-- Status -->
                    <div class="col-md-3">

                        <label
                            for="userStatusFilter"
                            class="form-label"
                        >
                            الحالة
                        </label>

                        <select
                            id="userStatusFilter"
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                كل الحالات
                            </option>

                            <option
                                value="active"
                                {{ request('status') === 'active' ? 'selected' : '' }}
                            >
                                فعال
                            </option>

                            <option
                                value="inactive"
                                {{ request('status') === 'inactive' ? 'selected' : '' }}
                            >
                                غير فعال
                            </option>

                        </select>

                    </div>


                    <!-- Filter Button -->
                    <div class="col-md-2 d-flex align-items-end">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            تصفية
                        </button>

                    </div>

                </div>


                <!-- Reset Filters -->
                @if (
                    request()->filled('search') ||
                    request()->filled('role') ||
                    request()->filled('status')
                )

                    <div class="mt-3">

                        <a
                            href="{{ route('users.index') }}"
                            class="btn btn-sm btn-light"
                        >
                            مسح التصفية
                        </a>

                    </div>

                @endif

            </form>

        </div>

    </div>


    <!-- Roles Information -->
    <div class="row g-4 mb-4">


        <!-- Admin -->
        <div class="col-md-4">

            <div class="card role-card">

                <div class="card-body text-center">

                    <div
                        class="role-icon mx-auto"
                        style="
                            background:#dff3e6;
                            color:#2f7e77;
                        "
                    >

                        <i data-feather="shield"></i>

                    </div>

                    <h5 class="card-title">
                        المشرف / المدير
                    </h5>

                    <p class="text-muted mb-0">
                        إدارة المستخدمين، البلاغات، الإحصائيات، وأنواع البلاغات.
                    </p>

                </div>

            </div>

        </div>


        <!-- Employee -->
        <div class="col-md-4">

            <div class="card role-card">

                <div class="card-body text-center">

                    <div
                        class="role-icon mx-auto"
                        style="
                            background:#fff1d8;
                            color:#f2a72a;
                        "
                    >

                        <i data-feather="briefcase"></i>

                    </div>

                    <h5 class="card-title">
                        الموظف البلدي
                    </h5>

                    <p class="text-muted mb-0">
                        مراجعة البلاغات وتحديث الحالة وإضافة الملاحظات.
                    </p>

                </div>

            </div>

        </div>


        <!-- Citizen -->
        <div class="col-md-4">

            <div class="card role-card">

                <div class="card-body text-center">

                    <div
                        class="role-icon mx-auto"
                        style="
                            background:#d9f0ec;
                            color:#0b7d73;
                        "
                    >

                        <i data-feather="user"></i>

                    </div>

                    <h5 class="card-title">
                        المواطن
                    </h5>

                    <p class="text-muted mb-0">
                        إرسال البلاغات وتحديد الموقع ومتابعة حالة البلاغ.
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- Users Table -->
    <div class="card">

        <div
            class="card-header d-flex justify-content-between align-items-center"
        >

            <div>

                <h5 class="card-title">
                    قائمة المستخدمين
                </h5>

                <small class="text-muted">
                    عرض وإدارة جميع مستخدمي النظام
                </small>

            </div>

        </div>


        <div class="card-body pt-0">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle"
                >

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>
                                المستخدم
                            </th>

                            <th>
                                رقم الهاتف
                            </th>

                            <th>
                                الدور
                            </th>

                            <th>
                                الحالة
                            </th>

                            <th>
                                تاريخ الإنشاء
                            </th>

                            <th class="text-center">
                                الإجراءات
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @forelse ($users as $user)

                            <tr>

                                <!-- Number -->
                                <td>

                                    {{
                                        $users->firstItem()
                                        + $loop->index
                                    }}

                                </td>


                                <!-- User -->
                                <td>

                                    <div
                                        class="d-flex align-items-center gap-3"
                                    >

                                        <div class="user-avatar">

                                            {{
                                                mb_substr(
                                                    $user->name,
                                                    0,
                                                    1
                                                )
                                            }}

                                        </div>


                                        <div>

                                            <div class="user-name">

                                                {{ $user->name }}

                                            </div>


                                            <div class="user-email">

                                                {{ $user->email }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <!-- Phone -->
                                <td>

                                    {{ $user->phone ?: '—' }}

                                </td>


                                <!-- Role -->
                                <td>

                                    @switch($user->role)

                                        @case('admin')

                                            <span
                                                class="badge bg-primary"
                                            >
                                                مشرف
                                            </span>

                                            @break


                                        @case('employee')

                                            <span
                                                class="badge bg-warning"
                                            >
                                                موظف بلدي
                                            </span>

                                            @break


                                        @case('citizen')

                                            <span
                                                class="badge bg-secondary"
                                            >
                                                مواطن
                                            </span>

                                            @break


                                        @default

                                            <span
                                                class="badge bg-secondary"
                                            >
                                                غير محدد
                                            </span>

                                    @endswitch

                                </td>


                                <!-- Status -->
                                <td>

                                    @if ($user->status === 'active')

                                        <span
                                            class="badge bg-success"
                                        >
                                            فعال
                                        </span>

                                    @else

                                        <span
                                            class="badge bg-danger"
                                        >
                                            غير فعال
                                        </span>

                                    @endif

                                </td>


                                <!-- Created At -->
                                <td>

                                    {{
                                        $user->created_at
                                            ?->format('Y-m-d')
                                    }}

                                </td>


                                <!-- Actions -->
                                <td>

                                    <div class="table-actions">


                                        <!-- Show -->
                                        <a
                                            href="{{ route('users.show', $user) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            عرض
                                        </a>


                                        <!-- Edit -->
                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            تعديل
                                        </a>


                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="empty-users"
                                >

                                    <i data-feather="users"></i>

                                    <div>
                                        لا يوجد مستخدمون مطابقون لنتائج البحث.
                                    </div>

                                </td>

                            </tr>

                        @endforelse


                    </tbody>

                </table>

            </div>


            <!-- Pagination -->
            @if ($users->hasPages())

                <div
                    class="mt-4 d-flex justify-content-center"
                >

                    {{
                        $users
                            ->onEachSide(1)
                            ->links('pagination::bootstrap-5')
                    }}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection