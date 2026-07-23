@extends('layouts.admin')

@section('title', 'تعديل البلاغ')

@section('content')

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    crossorigin="">

<style>
    .edit-report-page .report-map-box {
        height: 330px;
        border-radius: 16px;
        border: 1px solid #edf0f2;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .edit-report-page .status-box {
        background: #f8fafb;
        border: 1px solid #edf0f2;
        border-radius: 16px;
        padding: 18px;
    }

    .edit-report-page .info-mini {
        padding: 12px 0;
        border-bottom: 1px solid #edf0f2;
    }

    .edit-report-page .info-mini:last-child {
        border-bottom: 0;
    }

    .edit-report-page .info-mini span {
        display: block;
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .edit-report-page .info-mini strong {
        color: #1f2937;
        font-size: 15px;
    }

    .edit-report-page .user-info-box {
        padding: 15px;
        border-radius: 14px;
        background: #f7faf9;
        border: 1px solid #edf0f2;
    }

    .edit-report-page .user-info-label {
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .edit-report-page .user-info-value {
        color: #1f2937;
        font-weight: 800;
    }

    .edit-report-page .current-image,
    .edit-report-page .new-image-preview {
        width: 100%;
        max-height: 280px;
        object-fit: cover;
        border-radius: 14px;
        border: 1px solid #edf0f2;
    }

    .edit-report-page .new-image-preview {
        display: none;
        margin-top: 14px;
    }

    .edit-report-page .location-help {
        padding: 12px;
        border-radius: 12px;
        background: #eef8f6;
        color: #2f7e77;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .edit-report-page .invalid-feedback {
        display: block;
    }

    .leaflet-container {
        font-family: inherit;
    }
</style>

@php
    $currentUser = auth()->user();

    $canManageStatus =
        $currentUser->isAdmin()
        || $currentUser->isEmployee();

    $statusClass = match ($report->status) {
        'new' => 'bg-primary',
        'in_progress' => 'bg-warning text-dark',
        'resolved' => 'bg-success',
        default => 'bg-secondary',
    };
@endphp

<div class="edit-report-page">

    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <h1 class="page-title">تعديل البلاغ</h1>

            <p class="page-subtitle">
                تعديل بيانات البلاغ وموقعه
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('reports.show', $report) }}"
                class="btn btn-primary">

                <i data-feather="eye"></i>
                عرض التفاصيل
            </a>

            <a
                href="{{ route('reports.index') }}"
                class="btn btn-outline-primary">

                رجوع إلى البلاغات
            </a>

        </div>

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

    <form
        action="{{ route('reports.update', $report) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card mb-4">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <div>
                            <h5 class="card-title">بيانات البلاغ</h5>

                            <small class="text-muted">
                                رقم البلاغ: #{{ $report->id }}
                            </small>
                        </div>

                        <span class="badge {{ $statusClass }}">
                            {{ $report->status_label }}
                        </span>

                    </div>

                    <div class="card-body">

                        <div class="row g-3">

                            {{-- عنوان البلاغ --}}
                            <div class="col-md-8">

                                <label
                                    for="title"
                                    class="form-label">

                                    عنوان البلاغ
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ old('title', $report->title) }}"
                                    class="form-control @error('title') is-invalid @enderror">

                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- نوع البلاغ --}}
                            <div class="col-md-4">

                                <label
                                    for="report_type_id"
                                    class="form-label">

                                    نوع البلاغ
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    id="report_type_id"
                                    name="report_type_id"
                                    class="form-select @error('report_type_id') is-invalid @enderror">

                                    @foreach ($reportTypes as $reportType)

                                        <option
                                            value="{{ $reportType->id }}"
                                            @selected(
                                                (string) old(
                                                    'report_type_id',
                                                    $report->report_type_id
                                                )
                                                === (string) $reportType->id
                                            )>

                                            {{ $reportType->name }}

                                            @if ($reportType->status === 'inactive')
                                                - غير فعال
                                            @endif
                                        </option>

                                    @endforeach

                                </select>

                                @error('report_type_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- وصف البلاغ --}}
                            <div class="col-md-12">

                                <label
                                    for="description"
                                    class="form-label">

                                    وصف البلاغ
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    rows="5"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $report->description) }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- اسم المواطن --}}
                            <div class="col-md-6">

                                <div class="user-info-box">

                                    <div class="user-info-label">
                                        اسم المواطن
                                    </div>

                                    <div class="user-info-value">
                                        {{ $report->user?->name ?? 'غير معروف' }}
                                    </div>

                                </div>

                            </div>

                            {{-- الهاتف --}}
                            <div class="col-md-6">

                                <div class="user-info-box">

                                    <div class="user-info-label">
                                        رقم الهاتف
                                    </div>

                                    <div class="user-info-value">
                                        {{ $report->user?->phone ?: 'غير مضاف' }}
                                    </div>

                                </div>

                            </div>

                            {{-- العنوان --}}
                            <div class="col-md-12">

                                <label
                                    for="address"
                                    class="form-label">

                                    العنوان التفصيلي
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="address"
                                    name="address"
                                    value="{{ old('address', $report->address) }}"
                                    class="form-control @error('address') is-invalid @enderror">

                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- خط العرض --}}
                            <div class="col-md-6">

                                <label
                                    for="latitude"
                                    class="form-label">

                                    خط العرض Latitude
                                </label>

                                <input
                                    type="text"
                                    id="latitude"
                                    name="latitude"
                                    value="{{ old('latitude', $report->latitude) }}"
                                    class="form-control @error('latitude') is-invalid @enderror"
                                    readonly>

                                @error('latitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- خط الطول --}}
                            <div class="col-md-6">

                                <label
                                    for="longitude"
                                    class="form-label">

                                    خط الطول Longitude
                                </label>

                                <input
                                    type="text"
                                    id="longitude"
                                    name="longitude"
                                    value="{{ old('longitude', $report->longitude) }}"
                                    class="form-control @error('longitude') is-invalid @enderror"
                                    readonly>

                                @error('longitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- الحالة للموظف والأدمن --}}
                            @if ($canManageStatus)

                                <div class="col-md-6">

                                    <label
                                        for="status"
                                        class="form-label">

                                        حالة البلاغ
                                    </label>

                                    <select
                                        id="status"
                                        name="status"
                                        class="form-select @error('status') is-invalid @enderror">

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
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <small class="text-muted">
                                        تغيير الحالة سيُضاف إلى سجل تحديثات البلاغ.
                                    </small>

                                </div>

                            @endif

                            {{-- تغيير الصورة --}}
                            <div class="{{ $canManageStatus ? 'col-md-6' : 'col-md-12' }}">

                                <label
                                    for="image"
                                    class="form-label">

                                    تغيير صورة البلاغ
                                </label>

                                <input
                                    type="file"
                                    id="image"
                                    name="image"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    class="form-control @error('image') is-invalid @enderror">

                                <small class="text-muted">
                                    اتركي الحقل فارغًا للاحتفاظ بالصورة الحالية.
                                </small>

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <img
                                    id="newImagePreview"
                                    class="new-image-preview"
                                    alt="معاينة الصورة الجديدة">

                            </div>

                            {{-- حذف الصورة --}}
                            @if ($report->image_path)

                                <div class="col-md-12">

                                    <div class="form-check">

                                        <input
                                            type="checkbox"
                                            id="remove_image"
                                            name="remove_image"
                                            value="1"
                                            class="form-check-input"
                                            @checked(old('remove_image'))>

                                        <label
                                            for="remove_image"
                                            class="form-check-label text-danger">

                                            حذف الصورة الحالية
                                        </label>

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('reports.show', $report) }}"
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

            </div>

            <div class="col-lg-4">

                {{-- ملخص البلاغ --}}
                <div class="card mb-4">

                    <div class="card-header">
                        <h5 class="card-title">ملخص البلاغ</h5>
                    </div>

                    <div class="card-body">

                        <div class="status-box mb-3">

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <span class="text-muted">
                                    الحالة الحالية
                                </span>

                                <span class="badge {{ $statusClass }}">
                                    {{ $report->status_label }}
                                </span>

                            </div>

                            <div class="d-flex justify-content-between align-items-center">

                                <span class="text-muted">
                                    نوع البلاغ
                                </span>

                                <strong>
                                    {{ $report->reportType?->name ?? 'غير مصنف' }}
                                </strong>

                            </div>

                        </div>

                        <div class="info-mini">

                            <span>تاريخ الإنشاء</span>

                            <strong>
                                {{ $report->created_at->format('Y-m-d') }}
                            </strong>

                        </div>

                        <div class="info-mini">

                            <span>آخر تحديث</span>

                            <strong>
                                {{ $report->updated_at->format('Y-m-d H:i') }}
                            </strong>

                        </div>

                        <div class="info-mini">

                            <span>مقدم البلاغ</span>

                            <strong>
                                {{ $report->user?->name ?? 'غير معروف' }}
                            </strong>

                        </div>

                    </div>
                </div>

                {{-- الصورة الحالية --}}
                @if ($report->image_path)

                    <div class="card mb-4">

                        <div class="card-header">
                            <h5 class="card-title">الصورة الحالية</h5>
                        </div>

                        <div class="card-body">

                            <img
                                src="{{ asset('storage/' . $report->image_path) }}"
                                class="current-image"
                                alt="صورة البلاغ الحالية">

                        </div>
                    </div>

                @endif

                {{-- موقع البلاغ --}}
                <div class="card mb-4">

                    <div class="card-header">

                        <h5 class="card-title">
                            موقع البلاغ
                        </h5>

                        <small class="text-muted">
                            اضغطي على الخريطة لتغيير الموقع
                        </small>

                    </div>

                    <div class="card-body">

                        <div class="location-help">
                            <i data-feather="map-pin"></i>
                            العلامة الحالية تمثل موقع البلاغ المسجل.
                        </div>

                        <div
                            id="editReportMap"
                            class="report-map-box">
                        </div>

                        <button
                            type="button"
                            id="useCurrentLocation"
                            class="btn btn-outline-primary w-100 mt-3">

                            <i data-feather="crosshair"></i>
                            استخدام موقعي الحالي
                        </button>

                    </div>
                </div>

                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title">تنبيه</h5>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-warning mb-0">

                            تأكدي من صحة البيانات والموقع قبل حفظ التعديلات.

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </form>

</div>

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    crossorigin="">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const latitudeInput =
            document.getElementById('latitude');

        const longitudeInput =
            document.getElementById('longitude');

        const currentLocationButton =
            document.getElementById('useCurrentLocation');

        const initialLatitude =
            parseFloat(latitudeInput.value);

        const initialLongitude =
            parseFloat(longitudeInput.value);

        const map = L.map('editReportMap').setView(
            [initialLatitude, initialLongitude],
            16
        );

        L.tileLayer(
            'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);

        const marker = L.marker(
            [initialLatitude, initialLongitude]
        ).addTo(map);

        marker
            .bindPopup('موقع البلاغ الحالي')
            .openPopup();

        function setReportLocation(latitude, longitude) {

            latitudeInput.value =
                Number(latitude).toFixed(7);

            longitudeInput.value =
                Number(longitude).toFixed(7);

            marker.setLatLng([
                latitude,
                longitude
            ]);

            marker
                .bindPopup('موقع البلاغ المحدد')
                .openPopup();
        }

        map.on('click', function (event) {

            setReportLocation(
                event.latlng.lat,
                event.latlng.lng
            );

        });

        currentLocationButton.addEventListener(
            'click',
            function () {

                if (!navigator.geolocation) {
                    alert('المتصفح لا يدعم تحديد الموقع الحالي.');
                    return;
                }

                currentLocationButton.disabled = true;
                currentLocationButton.textContent =
                    'جاري تحديد الموقع...';

                navigator.geolocation.getCurrentPosition(

                    function (position) {

                        const latitude =
                            position.coords.latitude;

                        const longitude =
                            position.coords.longitude;

                        setReportLocation(
                            latitude,
                            longitude
                        );

                        map.setView(
                            [latitude, longitude],
                            16
                        );

                        currentLocationButton.disabled = false;

                        currentLocationButton.innerHTML =
                            '<i data-feather="crosshair"></i> استخدام موقعي الحالي';

                        if (window.feather) {
                            feather.replace();
                        }
                    },

                    function () {

                        alert(
                            'تعذر تحديد موقعك. اختاري الموقع يدويًا.'
                        );

                        currentLocationButton.disabled = false;

                        currentLocationButton.innerHTML =
                            '<i data-feather="crosshair"></i> استخدام موقعي الحالي';

                        if (window.feather) {
                            feather.replace();
                        }
                    }
                );
            }
        );

        const imageInput =
            document.getElementById('image');

        const newImagePreview =
            document.getElementById('newImagePreview');

        imageInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                newImagePreview.style.display = 'none';
                newImagePreview.removeAttribute('src');
                return;
            }

            newImagePreview.src =
                URL.createObjectURL(file);

            newImagePreview.style.display = 'block';
        });

        setTimeout(function () {
            map.invalidateSize();
        }, 300);

    });
</script>

@endsection