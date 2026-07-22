@extends('layouts.admin')

@section('title', 'إضافة مستخدم جديد')

@section('content')

<style>
    .user-form-page .form-help-card {
        border-radius: 18px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .user-form-page .role-info-item {
        padding: 14px;
        border: 1px solid #edf0f2;
        border-radius: 14px;
        margin-bottom: 12px;
        background: #fff;
    }

    .user-form-page .role-info-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .user-form-page .role-info-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }

    .user-form-page .form-icon-box {
        width: 70px;
        height: 70px;
        border-radius: 22px;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .user-form-page .form-icon-box svg {
        width: 34px;
        height: 34px;
    }

    .user-form-page .field-error {
        margin-top: 6px;
        color: #dc2626;
        font-size: 11px;
        font-weight: 700;
    }

    .user-form-page .is-invalid {
        border-color: #dc2626 !important;
    }

    body.dark-mode .user-form-page .form-help-card {
        background: #111827;
        border-color: #263244;
    }

    body.dark-mode .user-form-page .role-info-item {
        background: #0b1220;
        border-color: #334155;
    }

    body.dark-mode .user-form-page .role-info-title {
        color: #e5e7eb;
    }

    body.dark-mode .user-form-page .role-info-desc {
        color: #9ca3af;
    }
</style>


<div class="user-form-page">

    <div class="mb-4 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="page-title">
                إضافة مستخدم جديد
            </h1>

            <p class="page-subtitle">
                إنشاء حساب مستخدم وتحديد دوره داخل النظام
            </p>
        </div>


        <a
            href="{{ route('users.index') }}"
            class="btn btn-outline-primary"
        >
            رجوع إلى المستخدمين
        </a>

    </div>


    <div class="row g-4">

        <!-- User Form -->
        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">

                    <h5 class="card-title">
                        بيانات المستخدم
                    </h5>

                    <small class="text-muted">
                        أدخلي معلومات المستخدم الأساسية
                    </small>

                </div>


                <div class="card-body">


                    <!-- General Validation Errors -->
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
                        action="{{ route('users.store') }}"
                        method="POST"
                    >

                        @csrf


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
                                    placeholder="مثال: أحمد محمد"
                                    value="{{ old('name') }}"
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
                                    placeholder="example@email.com"
                                    value="{{ old('email') }}"
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
                                    placeholder="09xxxxxxxx"
                                    value="{{ old('phone') }}"
                                    autocomplete="tel"
                                    required
                                >

                                @error('phone')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


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
                                        value=""
                                        disabled
                                        {{ old('role') ? '' : 'selected' }}
                                    >
                                        اختاري الدور
                                    </option>

                                    <option
                                        value="admin"
                                        {{ old('role') === 'admin' ? 'selected' : '' }}
                                    >
                                        مشرف
                                    </option>

                                    <option
                                        value="employee"
                                        {{ old('role') === 'employee' ? 'selected' : '' }}
                                    >
                                        موظف بلدي
                                    </option>

                                    <option
                                        value="citizen"
                                        {{ old('role') === 'citizen' ? 'selected' : '' }}
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


                            <!-- Password -->
                            <div class="col-md-6">

                                <label
                                    for="password"
                                    class="form-label"
                                >
                                    كلمة المرور
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="********"
                                    autocomplete="new-password"
                                    required
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
                                    placeholder="********"
                                    autocomplete="new-password"
                                    required
                                >

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
                                        {{ old('status', 'active') === 'active' ? 'selected' : '' }}
                                    >
                                        فعال
                                    </option>

                                    <option
                                        value="inactive"
                                        {{ old('status') === 'inactive' ? 'selected' : '' }}
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


                            <!-- Creation Date -->
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
                                    value="{{ now()->format('Y-m-d') }}"
                                    readonly
                                >

                            </div>

                        </div>


                        <!-- Actions -->
                        <div class="d-flex justify-content-end gap-2 mt-4">

                            <a
                                href="{{ route('users.index') }}"
                                class="btn btn-light"
                            >
                                إلغاء
                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                حفظ المستخدم
                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>


        <!-- Help Section -->
        <div class="col-lg-4">

            <div class="card form-help-card mb-4">

                <div class="card-body text-center">

                    <div class="form-icon-box mx-auto">
                        <i data-feather="user-plus"></i>
                    </div>


                    <h5 class="card-title">
                        مستخدم جديد
                    </h5>


                    <p class="text-muted mb-0">
                        سيتم حفظ بيانات المستخدم في قاعدة البيانات وربطه بالدور المحدد.
                    </p>

                </div>

            </div>


            <div class="card">

                <div class="card-header">

                    <h5 class="card-title">
                        شرح الأدوار
                    </h5>

                </div>


                <div class="card-body">


                    <div class="role-info-item">

                        <div class="role-info-title">
                            مشرف
                        </div>

                        <p class="role-info-desc">
                            يمتلك صلاحية إدارة المستخدمين والبلاغات والإحصائيات.
                        </p>

                    </div>


                    <div class="role-info-item">

                        <div class="role-info-title">
                            موظف بلدي
                        </div>

                        <p class="role-info-desc">
                            يتابع البلاغات ويعدل حالتها ويضيف ملاحظات المعالجة.
                        </p>

                    </div>


                    <div class="role-info-item mb-0">

                        <div class="role-info-title">
                            مواطن
                        </div>

                        <p class="role-info-desc">
                            يرسل البلاغات ويتابع حالتها من خلال النظام.
                        </p>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>

@endsection