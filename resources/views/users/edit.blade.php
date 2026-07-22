@extends('layouts.admin')

@section('title', ($profileMode ?? false) ? 'إعدادات الحساب' : 'تعديل مستخدم')

@section('content')

@php
    $profileMode = $profileMode ?? false;
@endphp


<style>
    .user-edit-page .form-help-card {
        border-radius: 18px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .user-edit-page .user-profile-mini {
        text-align: center;
    }

    .user-edit-page .user-avatar-large {
        width: 86px;
        height: 86px;
        border-radius: 50%;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        font-weight: 900;
        margin: 0 auto 16px;
    }

    .user-edit-page .info-row {
        padding: 13px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .user-edit-page .info-row:last-child {
        border-bottom: 0;
    }

    .user-edit-page .info-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .user-edit-page .info-value {
        color: #1f2937;
        font-weight: 800;
    }

    .user-edit-page .permission-item {
        padding: 14px;
        border: 1px solid #edf0f2;
        border-radius: 14px;
        margin-bottom: 12px;
        background: #ffffff;
    }

    .user-edit-page .permission-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .user-edit-page .permission-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }

    .user-edit-page .field-error {
        margin-top: 6px;
        color: #dc2626;
        font-size: 11px;
        font-weight: 700;
    }

    .user-edit-page .is-invalid {
        border-color: #dc2626 !important;
    }

    body.dark-mode .user-edit-page .form-help-card {
        background: #111827;
        border-color: #263244;
    }

    body.dark-mode .user-edit-page .info-value,
    body.dark-mode .user-edit-page .permission-title {
        color: #e5e7eb;
    }

    body.dark-mode .user-edit-page .permission-item {
        background: #0b1220;
        border-color: #334155;
    }

    body.dark-mode .user-edit-page .permission-desc,
    body.dark-mode .user-edit-page .info-label {
        color: #9ca3af;
    }
</style>


<div class="user-edit-page">

    <!-- Page Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">

        <div>

            <h1 class="page-title">
                {{ $profileMode ? 'تعديل بياناتي' : 'تعديل بيانات المستخدم' }}
            </h1>

            <p class="page-subtitle">
                @if ($profileMode)
                    تحديث معلومات حسابك الشخصية وكلمة المرور
                @else
                    تحديث معلومات المستخدم ودوره وحالته داخل النظام
                @endif
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ $profileMode ? route('profile.show') : route('users.show', $user) }}"
                class="btn btn-primary"
            >
                {{ $profileMode ? 'عرض الملف الشخصي' : 'عرض المستخدم' }}
            </a>

            <a
                href="{{ $profileMode ? route('dashboard') : route('users.index') }}"
                class="btn btn-outline-primary"
            >
                {{ $profileMode ? 'رجوع إلى لوحة التحكم' : 'رجوع إلى المستخدمين' }}
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


    <div class="row g-4">


        <!-- Edit Form -->
        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">

                    <h5 class="card-title">
                        {{ $profileMode ? 'بيانات حسابي' : 'بيانات المستخدم' }}
                    </h5>

                    <small class="text-muted">
                        {{ $profileMode
                            ? 'يمكنك تعديل بيانات حسابك الشخصية'
                            : 'تعديل البيانات الأساسية للمستخدم'
                        }}
                    </small>

                </div>


                <div class="card-body">


                    @if ($errors->any())

                        <div class="alert alert-danger mb-4">

                            <strong>
                                يوجد خطأ في البيانات المدخلة.
                            </strong>

                            <div class="mt-1">
                                يرجى مراجعة الحقول الموضحة أدناه.
                            </div>

                        </div>

                    @endif


                    <form
                        action="{{ $profileMode
                            ? route('profile.update')
                            : route('users.update', $user)
                        }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="row g-3">


                            <!-- Full Name -->
                            <div class="col-md-6">

                                <label
                                    for="name"
                                    class="form-label"
                                >
                                    الاسم الكامل
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}"
                                    autocomplete="name"
                                    required
                                >

                                @error('name')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <!-- Email -->
                            <div class="col-md-6">

                                <label
                                    for="email"
                                    class="form-label"
                                >
                                    البريد الإلكتروني
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}"
                                    autocomplete="email"
                                    required
                                >

                                @error('email')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <!-- Phone -->
                            <div class="col-md-6">

                                <label
                                    for="phone"
                                    class="form-label"
                                >
                                    رقم الهاتف
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $user->phone) }}"
                                    autocomplete="tel"
                                    required
                                >

                                @error('phone')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <!-- Admin Only Fields -->
                            @if (!$profileMode)


                                <!-- Role -->
                                <div class="col-md-6">

                                    <label
                                        for="role"
                                        class="form-label"
                                    >
                                        الدور
                                    </label>

                                    <select
                                        id="role"
                                        name="role"
                                        class="form-select @error('role') is-invalid @enderror"
                                        required
                                    >

                                        <option
                                            value="admin"
                                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}
                                        >
                                            مشرف
                                        </option>

                                        <option
                                            value="employee"
                                            {{ old('role', $user->role) === 'employee' ? 'selected' : '' }}
                                        >
                                            موظف بلدي
                                        </option>

                                        <option
                                            value="citizen"
                                            {{ old('role', $user->role) === 'citizen' ? 'selected' : '' }}
                                        >
                                            مواطن
                                        </option>

                                    </select>

                                    @error('role')
                                        <div class="field-error">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                <!-- Status -->
                                <div class="col-md-6">

                                    <label
                                        for="status"
                                        class="form-label"
                                    >
                                        الحالة
                                    </label>

                                    <select
                                        id="status"
                                        name="status"
                                        class="form-select @error('status') is-invalid @enderror"
                                        required
                                    >

                                        <option
                                            value="active"
                                            {{ old('status', $user->status) === 'active' ? 'selected' : '' }}
                                        >
                                            فعال
                                        </option>

                                        <option
                                            value="inactive"
                                            {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}
                                        >
                                            غير فعال
                                        </option>

                                    </select>

                                    @error('status')
                                        <div class="field-error">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                <!-- Created At -->
                                <div class="col-md-6">

                                    <label
                                        for="created_at_preview"
                                        class="form-label"
                                    >
                                        تاريخ الإنشاء
                                    </label>

                                    <input
                                        type="date"
                                        id="created_at_preview"
                                        class="form-control"
                                        value="{{ $user->created_at?->format('Y-m-d') }}"
                                        readonly
                                    >

                                </div>


                            @endif


                            <!-- New Password -->
                            <div class="col-md-6">

                                <label
                                    for="password"
                                    class="form-label"
                                >
                                    كلمة مرور جديدة
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="اتركيها فارغة إذا لا تريدين تغييرها"
                                    autocomplete="new-password"
                                >

                                @error('password')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <!-- Password Confirmation -->
                            <div class="col-md-6">

                                <label
                                    for="password_confirmation"
                                    class="form-label"
                                >
                                    تأكيد كلمة المرور
                                </label>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="تأكيد كلمة المرور الجديدة"
                                    autocomplete="new-password"
                                >

                            </div>


                        </div>


                        <!-- Actions -->
                        <div class="d-flex justify-content-end gap-2 mt-4">

                            <a
                                href="{{ $profileMode
                                    ? route('profile.show')
                                    : route('users.show', $user)
                                }}"
                                class="btn btn-light"
                            >
                                إلغاء
                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                حفظ التعديلات
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        <!-- Sidebar Information -->
        <div class="col-lg-4">


            <!-- User Profile -->
            <div class="card form-help-card mb-4">

                <div class="card-body user-profile-mini">


                    <div class="user-avatar-large">

                        {{ mb_substr($user->name, 0, 1) }}

                    </div>


                    <h5 class="card-title mb-1">

                        {{ $user->name }}

                    </h5>


                    <p class="text-muted mb-2">

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


                </div>

            </div>


            <!-- Account Information -->
            <div class="card mb-4">

                <div class="card-header">

                    <h5 class="card-title">
                        معلومات الحساب
                    </h5>

                </div>


                <div class="card-body">


                    <div class="info-row">

                        <div class="info-label">
                            رقم المستخدم
                        </div>

                        <div class="info-value">
                            #{{ $user->id }}
                        </div>

                    </div>


                    <div class="info-row">

                        <div class="info-label">
                            تاريخ الإنشاء
                        </div>

                        <div class="info-value">
                            {{ $user->created_at?->format('Y-m-d') }}
                        </div>

                    </div>


                    <div class="info-row">

                        <div class="info-label">
                            آخر تحديث
                        </div>

                        <div class="info-value">
                            {{ $user->updated_at?->format('Y-m-d') }}
                        </div>

                    </div>


                    <div class="info-row">

                        <div class="info-label">
                            حالة الحساب
                        </div>

                        <div class="info-value">
                            {{ $user->status === 'active' ? 'فعال' : 'غير فعال' }}
                        </div>

                    </div>


                </div>

            </div>


            <!-- Role Permissions -->
            <div class="card">

                <div class="card-header">

                    <h5 class="card-title">
                        صلاحيات الدور
                    </h5>

                </div>


                <div class="card-body">


                    @if ($user->role === 'admin')


                        <div class="permission-item">

                            <div class="permission-title">
                                إدارة المستخدمين
                            </div>

                            <p class="permission-desc">
                                يمكنه عرض وإضافة وتعديل المستخدمين.
                            </p>

                        </div>


                        <div class="permission-item">

                            <div class="permission-title">
                                إدارة البلاغات
                            </div>

                            <p class="permission-desc">
                                يمكنه عرض البلاغات وتعديل حالتها ومتابعة التفاصيل.
                            </p>

                        </div>


                        <div class="permission-item mb-0">

                            <div class="permission-title">
                                لوحة التحكم
                            </div>

                            <p class="permission-desc">
                                يمكنه متابعة الإحصائيات العامة داخل النظام.
                            </p>

                        </div>


                    @elseif ($user->role === 'employee')


                        <div class="permission-item">

                            <div class="permission-title">
                                متابعة البلاغات
                            </div>

                            <p class="permission-desc">
                                يمكنه مراجعة البلاغات ومتابعة تفاصيلها.
                            </p>

                        </div>


                        <div class="permission-item">

                            <div class="permission-title">
                                تحديث الحالة
                            </div>

                            <p class="permission-desc">
                                يمكنه تغيير حالة البلاغ وإضافة تحديثات المعالجة.
                            </p>

                        </div>


                        <div class="permission-item mb-0">

                            <div class="permission-title">
                                الخريطة
                            </div>

                            <p class="permission-desc">
                                يمكنه مشاهدة مواقع البلاغات على الخريطة.
                            </p>

                        </div>


                    @else


                        <div class="permission-item">

                            <div class="permission-title">
                                إرسال البلاغات
                            </div>

                            <p class="permission-desc">
                                يمكنه إنشاء بلاغ جديد وتحديد موقعه.
                            </p>

                        </div>


                        <div class="permission-item">

                            <div class="permission-title">
                                متابعة البلاغات
                            </div>

                            <p class="permission-desc">
                                يمكنه متابعة حالة البلاغات الخاصة به.
                            </p>

                        </div>


                        <div class="permission-item mb-0">

                            <div class="permission-title">
                                عرض التفاصيل
                            </div>

                            <p class="permission-desc">
                                يمكنه الاطلاع على تفاصيل البلاغات الخاصة به.
                            </p>

                        </div>


                    @endif


                </div>

            </div>

        </div>

    </div>

</div>

@endsection