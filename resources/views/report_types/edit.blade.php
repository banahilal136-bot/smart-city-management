@extends('layouts.admin')

@section('title', 'تعديل نوع بلاغ')

@section('content')

<style>
    .report-type-edit-page .form-help-card {
        border-radius: 18px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .report-type-edit-page .type-preview {
        text-align: center;
    }

    .report-type-edit-page .preview-icon {
        width: 86px;
        height: 86px;
        border-radius: 24px;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }

    .report-type-edit-page .preview-icon svg {
        width: 38px;
        height: 38px;
    }

    .report-type-edit-page .info-row {
        padding: 13px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .report-type-edit-page .info-row:last-child {
        border-bottom: 0;
    }

    .report-type-edit-page .info-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .report-type-edit-page .info-value {
        color: #1f2937;
        font-weight: 800;
    }

    .report-type-edit-page .guide-item {
        padding: 14px;
        border: 1px solid #edf0f2;
        border-radius: 14px;
        background: #fff;
        margin-bottom: 12px;
    }

    .report-type-edit-page .guide-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .report-type-edit-page .guide-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }

    .report-type-edit-page .invalid-feedback {
        display: block;
    }
</style>

<div class="report-type-edit-page">

    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <h1 class="page-title">تعديل نوع البلاغ</h1>

            <p class="page-subtitle">
                تحديث بيانات التصنيف المستخدم لتنظيم البلاغات
            </p>
        </div>

        <a
            href="{{ route('report-types.index') }}"
            class="btn btn-outline-primary">

            رجوع إلى أنواع البلاغات
        </a>
    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>يرجى تصحيح الأخطاء التالية:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">

                    <h5 class="card-title">
                        بيانات نوع البلاغ
                    </h5>

                    <small class="text-muted">
                        تعديل معلومات النوع الحالي
                    </small>

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('report-types.update', $reportType) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            {{-- اسم النوع --}}
                            <div class="col-md-6">

                                <label for="name" class="form-label">
                                    اسم النوع
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $reportType->name) }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="مثال: طرق">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- الأيقونة --}}
                            <div class="col-md-6">

                                <label for="icon" class="form-label">
                                    الأيقونة
                                </label>

                                <select
                                    id="icon"
                                    name="icon"
                                    class="form-select @error('icon') is-invalid @enderror">

                                    <option value="">
                                        اختاري أيقونة
                                    </option>

                                    <option
                                        value="map"
                                        @selected(old('icon', $reportType->icon) === 'map')>
                                        طرق
                                    </option>

                                    <option
                                        value="trash-2"
                                        @selected(old('icon', $reportType->icon) === 'trash-2')>
                                        نظافة
                                    </option>

                                    <option
                                        value="zap"
                                        @selected(old('icon', $reportType->icon) === 'zap')>
                                        إنارة
                                    </option>

                                    <option
                                        value="droplet"
                                        @selected(old('icon', $reportType->icon) === 'droplet')>
                                        مياه
                                    </option>

                                    <option
                                        value="sun"
                                        @selected(old('icon', $reportType->icon) === 'sun')>
                                        حدائق
                                    </option>

                                    <option
                                        value="alert-triangle"
                                        @selected(old('icon', $reportType->icon) === 'alert-triangle')>
                                        طارئ
                                    </option>

                                    <option
                                        value="tool"
                                        @selected(old('icon', $reportType->icon) === 'tool')>
                                        صيانة
                                    </option>

                                    <option
                                        value="tag"
                                        @selected(old('icon', $reportType->icon) === 'tag')>
                                        عام
                                    </option>

                                </select>

                                @error('icon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- الأولوية --}}
                            <div class="col-md-6">

                                <label for="priority" class="form-label">
                                    الأولوية
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    id="priority"
                                    name="priority"
                                    class="form-select @error('priority') is-invalid @enderror">

                                    <option
                                        value="high"
                                        @selected(old('priority', $reportType->priority) === 'high')>
                                        عالية
                                    </option>

                                    <option
                                        value="medium"
                                        @selected(old('priority', $reportType->priority) === 'medium')>
                                        متوسطة
                                    </option>

                                    <option
                                        value="low"
                                        @selected(old('priority', $reportType->priority) === 'low')>
                                        منخفضة
                                    </option>

                                </select>

                                @error('priority')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- الحالة --}}
                            <div class="col-md-6">

                                <label for="status" class="form-label">
                                    الحالة
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    class="form-select @error('status') is-invalid @enderror">

                                    <option
                                        value="active"
                                        @selected(old('status', $reportType->status) === 'active')>
                                        فعال
                                    </option>

                                    <option
                                        value="inactive"
                                        @selected(old('status', $reportType->status) === 'inactive')>
                                        غير فعال
                                    </option>

                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- القسم المسؤول --}}
                            <div class="col-md-12">

                                <label for="department" class="form-label">
                                    القسم المسؤول
                                </label>

                                <select
                                    id="department"
                                    name="department"
                                    class="form-select @error('department') is-invalid @enderror">

                                    <option value="">
                                        اختاري القسم
                                    </option>

                                    <option
                                        value="قسم الطرق"
                                        @selected(old('department', $reportType->department) === 'قسم الطرق')>
                                        قسم الطرق
                                    </option>

                                    <option
                                        value="قسم النظافة"
                                        @selected(old('department', $reportType->department) === 'قسم النظافة')>
                                        قسم النظافة
                                    </option>

                                    <option
                                        value="قسم الإنارة"
                                        @selected(old('department', $reportType->department) === 'قسم الإنارة')>
                                        قسم الإنارة
                                    </option>

                                    <option
                                        value="قسم المياه"
                                        @selected(old('department', $reportType->department) === 'قسم المياه')>
                                        قسم المياه
                                    </option>

                                    <option
                                        value="قسم الحدائق"
                                        @selected(old('department', $reportType->department) === 'قسم الحدائق')>
                                        قسم الحدائق
                                    </option>

                                    <option
                                        value="قسم الصيانة"
                                        @selected(old('department', $reportType->department) === 'قسم الصيانة')>
                                        قسم الصيانة
                                    </option>

                                </select>

                                @error('department')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- الوصف --}}
                            <div class="col-md-12">

                                <label for="description" class="form-label">
                                    وصف النوع
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    rows="4"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="اكتبي وصفًا مختصرًا لنوع البلاغ...">{{ old('description', $reportType->description) }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- الملاحظات الداخلية --}}
                            <div class="col-md-12">

                                <label for="internal_notes" class="form-label">
                                    ملاحظات داخلية
                                </label>

                                <textarea
                                    id="internal_notes"
                                    name="internal_notes"
                                    rows="3"
                                    class="form-control @error('internal_notes') is-invalid @enderror"
                                    placeholder="ملاحظات إدارية لا تظهر للمواطنين...">{{ old('internal_notes', $reportType->internal_notes) }}</textarea>

                                @error('internal_notes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">

                            <a
                                href="{{ route('report-types.index') }}"
                                class="btn btn-light">

                                إلغاء
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i data-feather="save"></i>
                                حفظ التعديلات
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-lg-4">

            {{-- المعاينة --}}
            <div class="card form-help-card mb-4">

                <div class="card-body type-preview">

                    <div
                        id="previewIconContainer"
                        class="preview-icon">

                        <i
                            data-feather="{{ old('icon', $reportType->icon) ?: 'tag' }}">
                        </i>

                    </div>

                    <h5
                        id="previewName"
                        class="card-title">

                        {{ old('name', $reportType->name) }}
                    </h5>

                    <p
                        id="previewDescription"
                        class="text-muted mb-3">

                        {{ old('description', $reportType->description) ?: 'لا يوجد وصف لهذا النوع.' }}
                    </p>

                    <span
                        id="previewPriority"
                        class="badge
                        {{ old('priority', $reportType->priority) === 'high'
                            ? 'bg-danger'
                            : (old('priority', $reportType->priority) === 'medium'
                                ? 'bg-warning text-dark'
                                : 'bg-secondary') }}">

                        {{ old('priority', $reportType->priority) === 'high'
                            ? 'عالية'
                            : (old('priority', $reportType->priority) === 'medium'
                                ? 'متوسطة'
                                : 'منخفضة') }}
                    </span>

                    <span
                        id="previewStatus"
                        class="badge
                        {{ old('status', $reportType->status) === 'active'
                            ? 'bg-success'
                            : 'bg-danger' }}">

                        {{ old('status', $reportType->status) === 'active'
                            ? 'فعال'
                            : 'غير فعال' }}
                    </span>

                </div>
            </div>

            {{-- معلومات النوع --}}
            <div class="card mb-4">

                <div class="card-header">
                    <h5 class="card-title">معلومات النوع</h5>
                </div>

                <div class="card-body">

                    <div class="info-row">

                        <div class="info-label">
                            رقم النوع
                        </div>

                        <div class="info-value">
                            #{{ $reportType->id }}
                        </div>

                    </div>

                    <div class="info-row">

                        <div class="info-label">
                            عدد البلاغات المرتبطة
                        </div>

                        <div class="info-value">
                            {{ $reportType->reports_count }} بلاغ
                        </div>

                    </div>

                    <div class="info-row">

                        <div class="info-label">
                            تاريخ الإضافة
                        </div>

                        <div class="info-value">
                            {{ $reportType->created_at->format('Y-m-d') }}
                        </div>

                    </div>

                    <div class="info-row">

                        <div class="info-label">
                            آخر تحديث
                        </div>

                        <div class="info-value">
                            {{ $reportType->updated_at->format('Y-m-d') }}
                        </div>

                    </div>

                </div>
            </div>

            {{-- التنبيهات --}}
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">تنبيهات مهمة</h5>
                </div>

                <div class="card-body">

                    <div class="guide-item">

                        <div class="guide-title">
                            تغيير الحالة
                        </div>

                        <p class="guide-desc">
                            عند جعل النوع غير فعال لن يظهر للمواطن عند إنشاء بلاغ جديد.
                        </p>

                    </div>

                    <div class="guide-item">

                        <div class="guide-title">
                            تغيير الاسم
                        </div>

                        <p class="guide-desc">
                            يفضّل اختيار اسم واضح حتى يفهم المواطن نوع البلاغ بسهولة.
                        </p>

                    </div>

                    <div class="guide-item mb-0">

                        <div class="guide-title">
                            البلاغات المرتبطة
                        </div>

                        <p class="guide-desc">
                            لا يمكن حذف النوع إذا كان مرتبطًا ببلاغات موجودة.
                        </p>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const nameInput = document.getElementById('name');
        const descriptionInput = document.getElementById('description');
        const iconSelect = document.getElementById('icon');
        const prioritySelect = document.getElementById('priority');
        const statusSelect = document.getElementById('status');

        const previewName = document.getElementById('previewName');
        const previewDescription = document.getElementById('previewDescription');
        const previewIconContainer = document.getElementById('previewIconContainer');
        const previewPriority = document.getElementById('previewPriority');
        const previewStatus = document.getElementById('previewStatus');

        nameInput.addEventListener('input', function () {
            previewName.textContent =
                this.value.trim() || 'نوع البلاغ';
        });

        descriptionInput.addEventListener('input', function () {
            previewDescription.textContent =
                this.value.trim() || 'لا يوجد وصف لهذا النوع.';
        });

        iconSelect.addEventListener('change', function () {

            const iconName = this.value || 'tag';

            previewIconContainer.innerHTML =
                `<i data-feather="${iconName}"></i>`;

            if (window.feather) {
                feather.replace();
            }
        });

        prioritySelect.addEventListener('change', function () {

            previewPriority.className = 'badge';

            if (this.value === 'high') {
                previewPriority.textContent = 'عالية';
                previewPriority.classList.add('bg-danger');
            } else if (this.value === 'medium') {
                previewPriority.textContent = 'متوسطة';
                previewPriority.classList.add('bg-warning', 'text-dark');
            } else {
                previewPriority.textContent = 'منخفضة';
                previewPriority.classList.add('bg-secondary');
            }
        });

        statusSelect.addEventListener('change', function () {

            previewStatus.className = 'badge';

            if (this.value === 'active') {
                previewStatus.textContent = 'فعال';
                previewStatus.classList.add('bg-success');
            } else {
                previewStatus.textContent = 'غير فعال';
                previewStatus.classList.add('bg-danger');
            }
        });

    });
</script>

@endsection