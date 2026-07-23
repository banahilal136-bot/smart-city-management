@extends('layouts.admin')

@section('title', 'تفاصيل البلاغ')

@section('content')

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    crossorigin=""
>

<style>
    .report-show-page .info-item {
        padding: 14px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .report-show-page .info-item:last-child {
        border-bottom: 0;
    }

    .report-show-page .info-label {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .report-show-page .info-value {
        font-weight: 800;
        color: #1f2937;
        font-size: 16px;
        word-break: break-word;
    }

    .report-show-page .description-value {
        line-height: 1.9;
        font-weight: 600;
    }

    .report-show-page .map-box {
        height: 320px;
        border-radius: 16px;
        border: 1px solid #edf0f2;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .report-show-page .report-image {
        width: 100%;
        max-height: 340px;
        object-fit: cover;
        border-radius: 16px;
        border: 1px solid #edf0f2;
    }

    .report-show-page .image-placeholder {
        min-height: 220px;
        border-radius: 16px;
        background: #f5f7f8;
        border: 1px dashed #cfd8dc;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #6b7280;
        font-weight: 700;
        text-align: center;
        padding: 20px;
    }

    .report-show-page .image-placeholder svg {
        width: 42px;
        height: 42px;
        margin-bottom: 10px;
        color: #4b8e88;
    }

    .report-show-page .timeline-item {
        position: relative;
        padding-right: 30px;
        margin-bottom: 25px;
    }

    .report-show-page .timeline-item::before {
        content: "";
        position: absolute;
        right: 7px;
        top: 6px;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #4b8e88;
        box-shadow: 0 0 0 5px #e9f5f0;
    }

    .report-show-page .timeline-item::after {
        content: "";
        position: absolute;
        right: 12px;
        top: 24px;
        width: 2px;
        height: calc(100% + 5px);
        background: #dfe7e4;
    }

    .report-show-page .timeline-item:last-child {
        margin-bottom: 0;
    }

    .report-show-page .timeline-item:last-child::after {
        display: none;
    }

    .report-show-page .timeline-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .report-show-page .timeline-note {
        color: #4b5563;
        font-size: 14px;
        margin-bottom: 5px;
        line-height: 1.7;
    }

    .report-show-page .timeline-date {
        color: #6b7280;
        font-size: 12px;
    }

    .report-show-page .coordinates-box {
        padding: 12px 15px;
        background: #f7faf9;
        border-radius: 12px;
        margin-top: 14px;
        color: #4b5563;
        font-size: 13px;
    }

    .report-show-page .status-form-card {
        border-radius: 18px;
        background: linear-gradient(135deg, #eef8f6, #ffffff);
    }

    .report-show-page .action-buttons form {
        margin: 0;
    }
</style>

@php
    $statusClass = match ($report->status) {
        'new' => 'bg-primary',
        'in_progress' => 'bg-warning text-dark',
        'resolved' => 'bg-success',
        default => 'bg-secondary',
    };

    $currentUser = auth()->user();

    $canEdit =
        $currentUser->isAdmin()
        || $currentUser->isEmployee()
        || (
            $currentUser->isCitizen()
            && $report->user_id === $currentUser->id
            && $report->status === 'new'
        );

    $canDelete =
        $currentUser->isAdmin()
        || (
            $currentUser->isCitizen()
            && $report->user_id === $currentUser->id
            && $report->status === 'new'
        );

    $canManageStatus =
        $currentUser->isAdmin()
        || $currentUser->isEmployee();

    $statusLabels = [
        'new' => 'جديد',
        'in_progress' => 'قيد المعالجة',
        'resolved' => 'تم الحل',
    ];
@endphp

<div class="report-show-page">

    {{-- عنوان الصفحة --}}
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <h1 class="page-title">تفاصيل البلاغ</h1>

            <p class="page-subtitle">
                عرض معلومات البلاغ ومتابعة حالة المعالجة
            </p>
        </div>

        <div class="d-flex gap-2 flex-wrap action-buttons">

            @if ($canEdit)
                <a
                    href="{{ route('reports.edit', $report) }}"
                    class="btn btn-primary">

                    <i data-feather="edit-2"></i>
                    تعديل البلاغ
                </a>
            @endif

            @if ($canDelete)
                <form
                    action="{{ route('reports.destroy', $report) }}"
                    method="POST"
                    onsubmit="return confirm('هل أنت متأكد من حذف هذا البلاغ؟');">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger">

                        <i data-feather="trash-2"></i>
                        حذف
                    </button>
                </form>
            @endif

            <a
                href="{{ route('reports.index') }}"
                class="btn btn-outline-primary">

                <i data-feather="arrow-right"></i>
                رجوع إلى البلاغات
            </a>

        </div>

    </div>

    {{-- رسائل النجاح والخطأ --}}
    @if (session('success'))
        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert">

            <i data-feather="check-circle"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    @if (session('error'))
        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert">

            <i data-feather="alert-circle"></i>
            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif

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

        {{-- القسم الرئيسي --}}
        <div class="col-lg-8">

            {{-- معلومات البلاغ --}}
            <div class="card mb-4">

                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div>
                        <h5 class="card-title">
                            {{ $report->title }}
                        </h5>

                        <small class="text-muted">
                            رقم البلاغ: #{{ $report->id }}
                        </small>
                    </div>

                    <span class="badge {{ $statusClass }}">
                        {{ $report->status_label }}
                    </span>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="info-item">

                                <div class="info-label">
                                    نوع البلاغ
                                </div>

                                <div class="info-value">
                                    {{ $report->reportType?->name ?? 'غير مصنف' }}
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">

                                <div class="info-label">
                                    تاريخ الإضافة
                                </div>

                                <div class="info-value">
                                    {{ $report->created_at->format('Y-m-d h:i A') }}
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">

                                <div class="info-label">
                                    اسم المواطن
                                </div>

                                <div class="info-value">
                                    {{ $report->user?->name ?? 'غير معروف' }}
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">

                                <div class="info-label">
                                    رقم الهاتف
                                </div>

                                <div class="info-value">
                                    {{ $report->user?->phone ?: 'غير مضاف' }}
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="info-item">

                                <div class="info-label">
                                    العنوان التفصيلي
                                </div>

                                <div class="info-value">
                                    {{ $report->address }}
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="info-item">

                                <div class="info-label">
                                    وصف البلاغ
                                </div>

                                <div class="info-value description-value">
                                    {{ $report->description }}
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- موقع البلاغ --}}
            <div class="card mb-4">

                <div class="card-header">
                    <h5 class="card-title">موقع البلاغ</h5>
                </div>

                <div class="card-body">

                    <div
                        id="reportDetailsMap"
                        class="map-box">
                    </div>

                    <div class="coordinates-box">

                        <div>
                            <strong>العنوان:</strong>
                            {{ $report->address }}
                        </div>

                        <div class="mt-1">
                            <strong>الإحداثيات:</strong>

                            {{ $report->latitude }},
                            {{ $report->longitude }}
                        </div>

                    </div>

                </div>
            </div>

        </div>

        {{-- الشريط الجانبي --}}
        <div class="col-lg-4">

            {{-- صورة البلاغ --}}
            <div class="card mb-4">

                <div class="card-header">
                    <h5 class="card-title">صورة البلاغ</h5>
                </div>

                <div class="card-body">

                    @if ($report->image_path)

                        <a
                            href="{{ asset('storage/' . $report->image_path) }}"
                            target="_blank">

                            <img
                                src="{{ asset('storage/' . $report->image_path) }}"
                                class="report-image"
                                alt="صورة البلاغ">
                        </a>

                        <small class="text-muted d-block mt-2 text-center">
                            اضغطي على الصورة لعرضها بالحجم الكامل
                        </small>

                    @else

                        <div class="image-placeholder">

                            <i data-feather="image"></i>

                            <div>لا توجد صورة لهذا البلاغ</div>

                        </div>

                    @endif

                </div>
            </div>

            {{-- تغيير الحالة --}}
            @if ($canManageStatus)

                <div class="card mb-4 status-form-card">

                    <div class="card-header">
                        <h5 class="card-title">
                            تحديث حالة البلاغ
                        </h5>
                    </div>

                    <div class="card-body">

                        <form
                            action="{{ route('reports.update-status', $report) }}"
                            method="POST">

                            @csrf
                            @method('PATCH')

                            <label
                                for="status"
                                class="form-label">

                                الحالة الجديدة
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="form-select mb-3 @error('status') is-invalid @enderror">

                                <option
                                    value="new"
                                    @selected(old('status', $report->status) === 'new')>

                                    جديد
                                </option>

                                <option
                                    value="in_progress"
                                    @selected(old('status', $report->status) === 'in_progress')>

                                    قيد المعالجة
                                </option>

                                <option
                                    value="resolved"
                                    @selected(old('status', $report->status) === 'resolved')>

                                    تم الحل
                                </option>

                            </select>

                            @error('status')
                                <div class="invalid-feedback mb-3">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label
                                for="note"
                                class="form-label">

                                ملاحظة التحديث
                            </label>

                            <textarea
                                id="note"
                                name="note"
                                class="form-control mb-3 @error('note') is-invalid @enderror"
                                rows="4"
                                placeholder="اكتبي ملاحظة عن الإجراء المتخذ...">{{ old('note') }}</textarea>

                            @error('note')
                                <div class="invalid-feedback mb-3">
                                    {{ $message }}
                                </div>
                            @enderror

                            <button
                                type="submit"
                                class="btn btn-primary w-100">

                                <i data-feather="refresh-cw"></i>
                                حفظ التحديث
                            </button>

                        </form>

                    </div>
                </div>

            @else

                <div class="alert alert-info mb-4">

                    <i data-feather="info"></i>

                    يمكنك متابعة حالة البلاغ من سجل التحديثات.
                    تغيير الحالة متاح للموظف ومدير النظام فقط.

                </div>

            @endif

            {{-- سجل التحديثات --}}
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="card-title">
                        سجل التحديثات
                    </h5>

                    <span class="badge bg-light text-dark">
                        {{ $report->updates->count() }}
                    </span>

                </div>

                <div class="card-body">

                    @forelse ($report->updates as $update)

                        @php
                            $oldStatusLabel =
                                $statusLabels[$update->old_status]
                                ?? 'غير محدد';

                            $newStatusLabel =
                                $statusLabels[$update->new_status]
                                ?? 'غير محدد';

                            $updateTitle = $update->old_status === null
                                ? 'تم إنشاء البلاغ'
                                : 'تغيير الحالة من '
                                    . $oldStatusLabel
                                    . ' إلى '
                                    . $newStatusLabel;
                        @endphp

                        <div class="timeline-item">

                            <div class="timeline-title">
                                {{ $updateTitle }}
                            </div>

                            @if ($update->note)
                                <div class="timeline-note">
                                    {{ $update->note }}
                                </div>
                            @endif

                            <div class="timeline-date">

                                {{ $update->created_at->format('Y-m-d h:i A') }}

                                <br>

                                بواسطة:
                                {{ $update->user?->name ?? 'النظام' }}

                            </div>

                        </div>

                    @empty

                        <div class="text-center text-muted py-4">

                            <i data-feather="clock"></i>

                            <div class="mt-2">
                                لا توجد تحديثات لهذا البلاغ
                            </div>

                        </div>

                    @endforelse

                </div>
            </div>

        </div>

    </div>

</div>

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    crossorigin="">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const latitude = Number('{{ $report->latitude }}');
        const longitude = Number('{{ $report->longitude }}');
        const reportAddress = @json($report->address);

        const map = L.map('reportDetailsMap', {
            scrollWheelZoom: false
        }).setView(
            [latitude, longitude],
            16
        );

        L.tileLayer(
            'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);

        L.marker([latitude, longitude])
            .addTo(map)
            .bindPopup(reportAddress)
            .openPopup();

        setTimeout(function () {
            map.invalidateSize();
        }, 300);
    });
</script>

@endsection