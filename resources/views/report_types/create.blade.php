@extends('layouts.admin')

@section('title', 'إضافة نوع بلاغ جديد')

@section('content')

<style>
    .report-type-form-page .form-help-card {
        border-radius: 18px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
        border: 1px solid #edf0f2;
    }

    .report-type-form-page .type-preview {
        text-align: center;
    }

    .report-type-form-page .preview-icon {
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

    .report-type-form-page .preview-icon svg {
        width: 38px;
        height: 38px;
    }

    .report-type-form-page .guide-item {
        padding: 14px;
        border: 1px solid #edf0f2;
        border-radius: 14px;
        background: #fff;
        margin-bottom: 12px;
    }

    .report-type-form-page .guide-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .report-type-form-page .guide-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }

    .report-type-form-page .invalid-feedback {
        display: block;
    }
</style>

<div class="report-type-form-page">

    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="page-title">إضافة نوع بلاغ جديد</h1>

            <p class="page-subtitle">
                إنشاء تصنيف جديد ليتم استخدامه عند إرسال البلاغات
            </p>
        </div>

        <a
            href="{{ route('report-types.index') }}"
            class="btn btn-outline-primary">

            رجوع إلى أنواع البلاغات
        </a>
    </div>

    {{-- عرض جميع أخطاء الإدخال --}}
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
                    <h5 class="card-title">بيانات نوع البلاغ</h5>

                    <small class="text-muted">
                        أدخلي معلومات النوع الذي سيظهر للمواطنين
                    </small>
                </div>

                <div class="card-body">

                    <form
                        action="{{ route('report-types.store') }}"
                        method="POST">

                        @csrf

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
                                    value="{{ old('name') }}"
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
                                        @selected(old('icon') === 'map')>
                                        طرق
                                    </option>

                                    <option
                                        value="trash-2"
                                        @selected(old('icon') === 'trash-2')>
                                        نظافة
                                    </option>

                                    <option
                                        value="zap"
                                        @selected(old('icon') === 'zap')>
                                        إنارة
                                    </option>

                                    <option
                                        value="droplet"
                                        @selected(old('icon') === 'droplet')>
                                        مياه
                                    </option>

                                    <option
                                        value="sun"
                                        @selected(old('icon') === 'sun')>
                                        حدائق
                                    </option>

                                    <option
                                        value="alert-triangle"
                                        @selected(old('icon') === 'alert-triangle')>
                                        طارئ
                                    </option>

                                    <option
                                        value="tool"
                                        @selected(old('icon') === 'tool')>
                                        صيانة
                                    </option>

                                    <option
                                        value="tag"
                                        @selected(old('icon') === 'tag')>
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
                                        @selected(old('priority') === 'high')>
                                        عالية
                                    </option>

                                    <option
                                        value="medium"
                                        @selected(old('priority', 'medium') === 'medium')>
                                        متوسطة
                                    </option>

                                    <option
                                        value="low"
                                        @selected(old('priority') === 'low')>
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
                                        @selected(old('status', 'active') === 'active')>
                                        فعال
                                    </option>

                                    <option
                                        value="inactive"
                                        @selected(old('status') === 'inactive')>
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
                                        @selected(old('department') === 'قسم الطرق')>
                                        قسم الطرق
                                    </option>

                                    <option
                                        value="قسم النظافة"
                                        @selected(old('department') === 'قسم النظافة')>
                                        قسم النظافة
                                    </option>

                                    <option
                                        value="قسم الإنارة"
                                        @selected(old('department') === 'قسم الإنارة')>
                                        قسم الإنارة
                                    </option>

                                    <option
                                        value="قسم المياه"
                                        @selected(old('department') === 'قسم المياه')>
                                        قسم المياه
                                    </option>

                                    <option
                                        value="قسم الحدائق"
                                        @selected(old('department') === 'قسم الحدائق')>
                                        قسم الحدائق
                                    </option>

                                    <option
                                        value="قسم الصيانة"
                                        @selected(old('department') === 'قسم الصيانة')>
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
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="4"
                                    placeholder="اكتبي وصفًا مختصرًا لنوع البلاغ...">{{ old('description') }}</textarea>

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
                                    class="form-control @error('internal_notes') is-invalid @enderror"
                                    rows="3"
                                    placeholder="ملاحظات إدارية لا تظهر للمواطنين...">{{ old('internal_notes') }}</textarea>

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
                                حفظ نوع البلاغ
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card form-help-card mb-4">

                <div class="card-body type-preview">

                    <div class="preview-icon">
                        <i id="previewIcon" data-feather="tag"></i>
                    </div>

                    <h5 id="previewName" class="card-title">
                        نوع بلاغ جديد
                    </h5>

                    <p id="previewDescription" class="text-muted mb-0">
                        سيتم استخدام هذا النوع لتصنيف البلاغات وتوجيهها للقسم المناسب.
                    </p>

                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">إرشادات الإدخال</h5>
                </div>

                <div class="card-body">

                    <div class="guide-item">

                        <div class="guide-title">
                            اسم واضح
                        </div>

                        <p class="guide-desc">
                            اختاري اسمًا قصيرًا ومفهومًا مثل طرق، نظافة، إنارة.
                        </p>
                    </div>

                    <div class="guide-item">

                        <div class="guide-title">
                            أولوية مناسبة
                        </div>

                        <p class="guide-desc">
                            الأولوية تساعد الموظفين على معرفة البلاغات الأكثر أهمية.
                        </p>
                    </div>

                    <div class="guide-item mb-0">

                        <div class="guide-title">
                            وصف مختصر
                        </div>

                        <p class="guide-desc">
                            الوصف يوضح للمواطن متى يجب اختيار هذا النوع عند إرسال البلاغ.
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

        const previewName = document.getElementById('previewName');
        const previewDescription = document.getElementById('previewDescription');
        const previewIcon = document.getElementById('previewIcon');

        nameInput.addEventListener('input', function () {
            previewName.textContent =
                this.value.trim() || 'نوع بلاغ جديد';
        });

        descriptionInput.addEventListener('input', function () {
            previewDescription.textContent =
                this.value.trim()
                || 'سيتم استخدام هذا النوع لتصنيف البلاغات وتوجيهها للقسم المناسب.';
        });

        iconSelect.addEventListener('change', function () {
            const selectedIcon = this.value || 'tag';

            previewIcon.setAttribute('data-feather', selectedIcon);

            if (window.feather) {
                feather.replace();
            }
        });
    });
</script>

@endsection