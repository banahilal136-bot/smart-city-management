@extends('layouts.admin')

@section('title', ($profileMode ?? false) ? 'الملف الشخصي' : 'تفاصيل المستخدم')

@section('content')

@php
    $profileMode = $profileMode ?? false;
@endphp


<style>
    .user-show-page .profile-card {
        border-radius: 20px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .user-show-page .user-avatar-xl {
        width: 105px;
        height: 105px;
        border-radius: 50%;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        font-weight: 900;
        margin: 0 auto 18px;
    }

    .user-show-page .info-item {
        padding: 14px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .user-show-page .info-item:last-child {
        border-bottom: 0;
    }

    .user-show-page .info-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .user-show-page .info-value {
        color: #1f2937;
        font-weight: 800;
    }

    .user-show-page .permission-box,
    .user-show-page .activity-box {
        padding: 15px;
        border: 1px solid #edf0f2;
        border-radius: 15px;
        background: #fff;
        margin-bottom: 12px;
    }

    .user-show-page .permission-title,
    .user-show-page .activity-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .user-show-page .permission-desc,
    .user-show-page .activity-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }

    .user-show-page .mini-stat {
        border-radius: 18px;
        min-height: 130px;
    }

    .user-show-page .mini-stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-show-page .mini-stat-icon svg {
        width: 26px;
        height: 26px;
    }

    .user-show-page .empty-state {
        padding: 35px 20px;
        text-align: center;
        color: #6b7280;
    }

    body.dark-mode .user-show-page .profile-card {
        background: #111827;
        border-color: #263244;
    }

    body.dark-mode .user-show-page .info-value,
    body.dark-mode .user-show-page .permission-title,
    body.dark-mode .user-show-page .activity-title {
        color: #e5e7eb;
    }

    body.dark-mode .user-show-page .permission-box,
    body.dark-mode .user-show-page .activity-box {
        background: #0b1220;
        border-color: #334155;
    }

    body.dark-mode .user-show-page .permission-desc,
    body.dark-mode .user-show-page .activity-desc,
    body.dark-mode .user-show-page .info-label {
        color: #9ca3af;
    }
</style>


<div class="user-show-page">

    <!-- Page Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">

        <div>

            <h1 class="page-title">
                {{ $profileMode ? 'الملف الشخصي' : 'تفاصيل المستخدم' }}
            </h1>

            <p class="page-subtitle">

                @if ($profileMode)

                    عرض معلومات حسابك وبياناتك ونشاطك داخل النظام

                @else

                    عرض معلومات الحساب والدور والنشاط داخل النظام

                @endif

            </p>

        </div>


        <div class="d-flex gap-2">

            <!-- Edit Button -->
            <a
                href="{{ $profileMode
                    ? route('profile.edit')
                    : route('users.edit', $user)
                }}"
                class="btn btn-primary"
            >
                {{ $profileMode ? 'تعديل بياناتي' : 'تعديل المستخدم' }}
            </a>


            <!-- Back Button -->
            <a
                href="{{ $profileMode
                    ? route('dashboard')
                    : route('users.index')
                }}"
                class="btn btn-outline-primary"
            >
                {{ $profileMode
                    ? 'رجوع إلى لوحة التحكم'
                    : 'رجوع إلى المستخدمين'
                }}
            </a>

        </div>

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


    <div class="row g-4">


        <!-- User Main Information -->
        <div class="col-lg-4">


            <!-- Profile Card -->
            <div class="card profile-card mb-4">

                <div class="card-body text-center">


                    <!-- Avatar -->
                    <div class="user-avatar-xl">

                        {{ mb_substr($user->name, 0, 1) }}

                    </div>


                    <!-- Name -->
                    <h4 class="mb-1">

                        {{ $user->name }}

                    </h4>


                    <!-- Email -->
                    <p class="text-muted mb-3">

                        {{ $user->email }}

                    </p>


                    <!-- Role Badge -->
                    @switch($user->role)

                        @case('admin')

                            <span class="badge bg-primary">
                                مشرف
                            </span>

                            @break


                        @case('employee')

                            <span class="badge bg-warning">
                                موظف بلدي
                            </span>

                            @break


                        @case('citizen')

                            <span class="badge bg-secondary">
                                مواطن
                            </span>

                            @break


                        @default

                            <span class="badge bg-secondary">
                                غير محدد
                            </span>

                    @endswitch


                    <!-- Status Badge -->
                    @if ($user->status === 'active')

                        <span class="badge bg-success">
                            فعال
                        </span>

                    @else

                        <span class="badge bg-danger">
                            غير فعال
                        </span>

                    @endif


                    <!-- Profile Actions -->
                    <div class="d-flex justify-content-center gap-2 mt-4">


                        <!-- Edit -->
                        <a
                            href="{{ $profileMode
                                ? route('profile.edit')
                                : route('users.edit', $user)
                            }}"
                            class="btn btn-sm btn-primary"
                        >
                            {{ $profileMode ? 'تعديل بياناتي' : 'تعديل' }}
                        </a>


                        <!--
                            Activate / Deactivate
                            يظهر فقط عندما يكون الأدمن
                            يعرض مستخدماً من إدارة المستخدمين
                        -->
                        @if (
                            !$profileMode &&
                            auth()->user()->isAdmin()
                        )

                            @if (auth()->id() !== $user->id)

                                <form
                                    action="{{ route('users.toggle-status', $user) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')


                                    @if ($user->status === 'active')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('هل أنت متأكد من تعطيل هذا الحساب؟')"
                                        >
                                            تعطيل الحساب
                                        </button>

                                    @else

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-success"
                                        >
                                            تفعيل الحساب
                                        </button>

                                    @endif

                                </form>

                            @else

                                <button
                                    type="button"
                                    class="btn btn-sm btn-light"
                                    disabled
                                >
                                    حسابك الحالي
                                </button>

                            @endif

                        @endif


                    </div>

                </div>

            </div>


            <!-- Account Information -->
            <div class="card">

                <div class="card-header">

                    <h5 class="card-title">
                        معلومات الحساب
                    </h5>

                </div>


                <div class="card-body">


                    <!-- User ID -->
                    <div class="info-item">

                        <div class="info-label">
                            رقم المستخدم
                        </div>

                        <div class="info-value">
                            #{{ $user->id }}
                        </div>

                    </div>


                    <!-- Name -->
                    <div class="info-item">

                        <div class="info-label">
                            الاسم الكامل
                        </div>

                        <div class="info-value">
                            {{ $user->name }}
                        </div>

                    </div>


                    <!-- Email -->
                    <div class="info-item">

                        <div class="info-label">
                            البريد الإلكتروني
                        </div>

                        <div class="info-value">
                            {{ $user->email }}
                        </div>

                    </div>


                    <!-- Phone -->
                    <div class="info-item">

                        <div class="info-label">
                            رقم الهاتف
                        </div>

                        <div class="info-value">
                            {{ $user->phone ?: '—' }}
                        </div>

                    </div>


                    <!-- Created At -->
                    <div class="info-item">

                        <div class="info-label">
                            تاريخ الإنشاء
                        </div>

                        <div class="info-value">

                            {{ $user->created_at?->format('Y-m-d') }}

                        </div>

                    </div>


                    <!-- Updated At -->
                    <div class="info-item">

                        <div class="info-label">
                            آخر تحديث
                        </div>

                        <div class="info-value">

                            {{ $user->updated_at?->format('Y-m-d') }}

                        </div>

                    </div>


                </div>

            </div>

        </div>


        <!-- User Details -->
        <div class="col-lg-8">


            <!-- Statistics -->
            <div class="row g-4 mb-4">


                <!-- Total Reports -->
                <div class="col-md-4">

                    <div class="card mini-stat">

                        <div
                            class="card-body d-flex justify-content-between align-items-center"
                        >

                            <div>

                                <div class="stat-title">
                                    البلاغات
                                </div>

                                <div class="stat-number">

                                    {{ $reportStats['total'] }}

                                </div>

                                <p class="stat-desc">
                                    بلاغات مرتبطة بالحساب
                                </p>

                            </div>


                            <div
                                class="mini-stat-icon"
                                style="
                                    background:#dff3e6;
                                    color:#2f7e77;
                                "
                            >

                                <i data-feather="file-text"></i>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- In Progress Reports -->
                <div class="col-md-4">

                    <div class="card mini-stat">

                        <div
                            class="card-body d-flex justify-content-between align-items-center"
                        >

                            <div>

                                <div class="stat-title">
                                    قيد المعالجة
                                </div>

                                <div class="stat-number">

                                    {{ $reportStats['in_progress'] }}

                                </div>

                                <p class="stat-desc">
                                    بلاغات لم تنته بعد
                                </p>

                            </div>


                            <div
                                class="mini-stat-icon"
                                style="
                                    background:#fff1d8;
                                    color:#f2a72a;
                                "
                            >

                                <i data-feather="clock"></i>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Resolved Reports -->
                <div class="col-md-4">

                    <div class="card mini-stat">

                        <div
                            class="card-body d-flex justify-content-between align-items-center"
                        >

                            <div>

                                <div class="stat-title">
                                    تم الحل
                                </div>

                                <div class="stat-number">

                                    {{ $reportStats['resolved'] }}

                                </div>

                                <p class="stat-desc">
                                    بلاغات مكتملة
                                </p>

                            </div>


                            <div
                                class="mini-stat-icon"
                                style="
                                    background:#d9f0ec;
                                    color:#0b7d73;
                                "
                            >

                                <i data-feather="check-circle"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Permissions -->
            <div class="card mb-4">

                <div class="card-header">

                    <h5 class="card-title">
                        صلاحيات المستخدم
                    </h5>

                    <small class="text-muted">
                        الصلاحيات الحالية حسب الدور المحدد
                    </small>

                </div>


                <div class="card-body">


                    <!-- Admin Permissions -->
                    @if ($user->role === 'admin')


                        <div class="permission-box">

                            <div class="permission-title">
                                إدارة المستخدمين
                            </div>

                            <p class="permission-desc">
                                يمكن للمشرف عرض وإضافة وتعديل المستخدمين داخل النظام.
                            </p>

                        </div>


                        <div class="permission-box">

                            <div class="permission-title">
                                إدارة البلاغات
                            </div>

                            <p class="permission-desc">
                                يمكنه متابعة البلاغات وتعديل حالتها والاطلاع على تفاصيلها.
                            </p>

                        </div>


                        <div class="permission-box mb-0">

                            <div class="permission-title">
                                إدارة أنواع البلاغات
                            </div>

                            <p class="permission-desc">
                                يمكنه إضافة وتعديل أنواع البلاغات المستخدمة في النظام.
                            </p>

                        </div>


                    <!-- Employee Permissions -->
                    @elseif ($user->role === 'employee')


                        <div class="permission-box">

                            <div class="permission-title">
                                متابعة البلاغات
                            </div>

                            <p class="permission-desc">
                                يمكنه مراجعة البلاغات ومتابعة تفاصيلها.
                            </p>

                        </div>


                        <div class="permission-box">

                            <div class="permission-title">
                                تحديث حالة البلاغ
                            </div>

                            <p class="permission-desc">
                                يمكنه تغيير حالة البلاغ وإضافة ملاحظات المعالجة.
                            </p>

                        </div>


                        <div class="permission-box mb-0">

                            <div class="permission-title">
                                عرض الخريطة
                            </div>

                            <p class="permission-desc">
                                يمكنه مشاهدة مواقع البلاغات على الخريطة.
                            </p>

                        </div>


                    <!-- Citizen Permissions -->
                    @else


                        <div class="permission-box">

                            <div class="permission-title">
                                إنشاء البلاغات
                            </div>

                            <p class="permission-desc">
                                يمكنه إرسال بلاغ جديد وتحديد موقعه.
                            </p>

                        </div>


                        <div class="permission-box">

                            <div class="permission-title">
                                متابعة الحالة
                            </div>

                            <p class="permission-desc">
                                يمكنه متابعة حالة البلاغات الخاصة به.
                            </p>

                        </div>


                        <div class="permission-box mb-0">

                            <div class="permission-title">
                                عرض التفاصيل
                            </div>

                            <p class="permission-desc">
                                يمكنه الاطلاع على تفاصيل بلاغاته.
                            </p>

                        </div>


                    @endif


                </div>

            </div>


            <!-- Recent Activities -->
            <div class="card mb-4">

                <div class="card-header">

                    <h5 class="card-title">
                        آخر النشاطات
                    </h5>

                    <small class="text-muted">
                        آخر العمليات المسجلة لهذا المستخدم
                    </small>

                </div>


                <div class="card-body">


                    @forelse ($user->reportUpdates as $update)

                        @php
                            $statusLabel = match ($update->new_status) {
                                'new' => 'جديد',
                                'in_progress' => 'قيد المعالجة',
                                'resolved' => 'تم الحل',
                                default => 'غير معروف',
                            };
                        @endphp


                        <div
                            class="activity-box {{ $loop->last ? 'mb-0' : '' }}"
                        >

                            <div class="activity-title">
                                تحديث حالة بلاغ
                            </div>


                            <p class="activity-desc">

                                تم تحديث

                                <strong>
                                    {{ $update->report?->title ?? 'بلاغ' }}
                                </strong>

                                إلى

                                <strong>
                                    {{ $statusLabel }}
                                </strong>

                                بتاريخ

                                {{ $update->created_at?->format('Y-m-d H:i') }}.

                            </p>

                        </div>


                    @empty


                        <div class="empty-state">

                            لا توجد نشاطات مسجلة لهذا المستخدم حتى الآن.

                        </div>


                    @endforelse


                </div>

            </div>


            <!-- Related Reports -->
            <div class="card">

                <div class="card-header">

                    <h5 class="card-title">
                        بلاغات مرتبطة بالمستخدم
                    </h5>

                    <small class="text-muted">
                        أحدث البلاغات المرتبطة بهذا الحساب
                    </small>

                </div>


                <div class="card-body pt-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>
                                        عنوان البلاغ
                                    </th>

                                    <th>
                                        النوع
                                    </th>

                                    <th>
                                        الحالة
                                    </th>

                                    <th>
                                        التاريخ
                                    </th>

                                    <th class="text-center">
                                        الإجراء
                                    </th>

                                </tr>

                            </thead>


                            <tbody>


                                @forelse ($user->reports as $report)

                                    <tr>


                                        <td>
                                            #{{ $report->id }}
                                        </td>


                                        <td>
                                            {{ $report->title }}
                                        </td>


                                        <td>

                                            {{ $report->reportType?->name ?? 'غير محدد' }}

                                        </td>


                                        <td>


                                            @switch($report->status)


                                                @case('new')

                                                    <span class="badge bg-primary">
                                                        جديد
                                                    </span>

                                                    @break


                                                @case('in_progress')

                                                    <span class="badge bg-warning">
                                                        قيد المعالجة
                                                    </span>

                                                    @break


                                                @case('resolved')

                                                    <span class="badge bg-success">
                                                        تم الحل
                                                    </span>

                                                    @break


                                                @default

                                                    <span class="badge bg-secondary">
                                                        غير معروف
                                                    </span>


                                            @endswitch


                                        </td>


                                        <td>

                                            {{ $report->created_at?->format('Y-m-d') }}

                                        </td>


                                        <td class="text-center">

                                            <a
                                                href="{{ route('reports.show', $report) }}"
                                                class="btn btn-sm btn-outline-primary"
                                            >
                                                عرض
                                            </a>

                                        </td>


                                    </tr>


                                @empty


                                    <tr>

                                        <td
                                            colspan="6"
                                            class="empty-state"
                                        >
                                            لا توجد بلاغات مرتبطة بهذا المستخدم حتى الآن.
                                        </td>

                                    </tr>


                                @endforelse


                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection