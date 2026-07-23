@extends('layouts.admin')

@section('title', 'إضافة بلاغ جديد')

@section('content')

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""
>

<style>
    .create-report-page .form-section-title {
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 18px;
        color: #1f2937;
    }

    .create-report-page .report-map-box {
        height: 350px;
        border-radius: 16px;
        border: 1px solid #edf0f2;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .create-report-page .user-info-box {
        padding: 15px;
        border-radius: 14px;
        background: #f7faf9;
        border: 1px solid #edf0f2;
    }

    .create-report-page .user-info-label {
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .create-report-page .user-info-value {
        color: #1f2937;
        font-weight: 800;
    }

    .create-report-page .invalid-feedback {
        display: block;
    }

    .create-report-page .location-help {
        padding: 12px;
        border-radius: 12px;
        background: #eef8f6;
        color: #2f7e77;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .create-report-page .image-preview {
        width: 100%;
        max-height: 260px;
        object-fit: cover;
        border-radius: 14px;
        border: 1px solid #edf0f2;
        margin-top: 14px;
        display: none;
    }

    .leaflet-container {
        font-family: inherit;
    }
</style>

<div class="create-report-page">

    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <h1 class="page-title">إضافة بلاغ جديد</h1>

            <p class="page-subtitle">
                إدخال بيانات بلاغ جديد وتحديد موقعه على الخريطة
            </p>
        </div>

        <a
            href="{{ route('reports.index') }}"
            class="btn btn-outline-primary">

            رجوع إلى البلاغات
        </a>

    </div>

    {{-- أخطاء الإدخال --}}
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
        action="{{ route('reports.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <div class="row g-4">

            <div class="col-lg-8">

                {{-- بيانات البلاغ --}}
                <div class="card mb-4">

                    <div class="card-header">
                        <h5 class="card-title">بيانات البلاغ</h5>

                        <small class="text-muted">
                            أدخلي تفاصيل المشكلة بشكل واضح
                        </small>
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
                                    value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="مثال: إنارة معطلة في الشارع الرئيسي">

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

                                    <option value="">
                                        اختاري النوع
                                    </option>

                                    @foreach ($reportTypes as $reportType)

                                        <option
                                            value="{{ $reportType->id }}"
                                            @selected(
                                                (string) old('report_type_id')
                                                === (string) $reportType->id
                                            )>

                                            {{ $reportType->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('report_type_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- الوصف --}}
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
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="5"
                                    placeholder="اكتبي تفاصيل المشكلة بشكل واضح...">{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- مقدم البلاغ --}}
                            <div class="col-md-6">

                                <div class="user-info-box">

                                    <div class="user-info-label">
                                        مقدم البلاغ
                                    </div>

                                    <div class="user-info-value">
                                        {{ auth()->user()->name }}
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
                                        {{ auth()->user()->phone ?: 'غير مضاف' }}
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
                                    value="{{ old('address') }}"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="مثال: شارع الجامعة - جانب الحديقة العامة">

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
                                    value="{{ old('latitude') }}"
                                    class="form-control @error('latitude') is-invalid @enderror"
                                    placeholder="حددي الموقع من الخريطة"
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
                                    value="{{ old('longitude') }}"
                                    class="form-control @error('longitude') is-invalid @enderror"
                                    placeholder="حددي الموقع من الخريطة"
                                    readonly>

                                @error('longitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- الصورة --}}
                            <div class="col-md-12">

                                <label
                                    for="image"
                                    class="form-label">

                                    صورة البلاغ
                                </label>

                                <input
                                    type="file"
                                    id="image"
                                    name="image"
                                    accept=".jpg,.jpeg,.png,.webp"
                                    class="form-control @error('image') is-invalid @enderror">

                                <small class="text-muted">
                                    JPG أو PNG أو WEBP، بحد أقصى 5 ميغابايت
                                </small>

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <img
                                    id="imagePreview"
                                    class="image-preview"
                                    alt="معاينة صورة البلاغ">

                            </div>

                        </div>

                    </div>
                </div>

                {{-- أزرار الحفظ --}}
                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('reports.index') }}"
                        class="btn btn-light">

                        إلغاء
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i data-feather="send"></i>
                        إرسال البلاغ
                    </button>

                </div>

            </div>

            <div class="col-lg-4">

                {{-- الخريطة --}}
                <div class="card mb-4">

                    <div class="card-header">
                        <h5 class="card-title">تحديد الموقع</h5>

                        <small class="text-muted">
                            اضغطي على مكان المشكلة
                        </small>
                    </div>

                    <div class="card-body">

                        <div class="location-help">
                            <i data-feather="map-pin"></i>
                            اضغطي على الخريطة لتثبيت موقع البلاغ.
                        </div>

                        <div
                            id="reportMap"
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

                {{-- معلومات --}}
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title">ملاحظات</h5>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-success mb-3">
                            الحالة الافتراضية للبلاغ الجديد ستكون:
                            <strong>جديد</strong>
                        </div>

                        <div class="alert alert-warning mb-0">
                            تأكدي من تحديد الموقع وكتابة العنوان
                            التفصيلي قبل إرسال البلاغ.
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </form>

</div>

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin="">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const currentLocationButton =
            document.getElementById('useCurrentLocation');

        const defaultLatitude = 35.9306;
        const defaultLongitude = 36.6339;

        const oldLatitude = parseFloat(latitudeInput.value);
        const oldLongitude = parseFloat(longitudeInput.value);

        const hasOldLocation =
            !Number.isNaN(oldLatitude)
            && !Number.isNaN(oldLongitude);

        const initialLatitude = hasOldLocation
            ? oldLatitude
            : defaultLatitude;

        const initialLongitude = hasOldLocation
            ? oldLongitude
            : defaultLongitude;

        const map = L.map('reportMap').setView(
            [initialLatitude, initialLongitude],
            13
        );

        L.tileLayer(
            'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                maxZoom: 19,
                attribution:
                    '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);

        let marker = null;

        function setReportLocation(latitude, longitude) {

            latitudeInput.value = Number(latitude).toFixed(7);
            longitudeInput.value = Number(longitude).toFixed(7);

            if (marker) {
                marker.setLatLng([latitude, longitude]);
            } else {
                marker = L.marker([latitude, longitude])
                    .addTo(map);
            }

            marker
                .bindPopup('موقع البلاغ المحدد')
                .openPopup();
        }

        if (hasOldLocation) {
            setReportLocation(oldLatitude, oldLongitude);
        }

        map.on('click', function (event) {
            setReportLocation(
                event.latlng.lat,
                event.latlng.lng
            );
        });

        currentLocationButton.addEventListener('click', function () {

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

                    setReportLocation(latitude, longitude);

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
                        'تعذر تحديد موقعك. اختاري الموقع يدويًا من الخريطة.'
                    );

                    currentLocationButton.disabled = false;
                    currentLocationButton.innerHTML =
                        '<i data-feather="crosshair"></i> استخدام موقعي الحالي';

                    if (window.feather) {
                        feather.replace();
                    }
                }
            );
        });

        const imageInput =
            document.getElementById('image');

        const imagePreview =
            document.getElementById('imagePreview');

        imageInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                imagePreview.style.display = 'none';
                imagePreview.removeAttribute('src');
                return;
            }

            imagePreview.src = URL.createObjectURL(file);
            imagePreview.style.display = 'block';
        });

        setTimeout(function () {
            map.invalidateSize();
        }, 300);
    });
</script>

@endsection