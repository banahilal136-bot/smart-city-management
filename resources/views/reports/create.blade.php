@extends('layouts.admin')

@section('title', 'بلاغ جديد')

@section('content')

<div class="mb-4">
    <h1 class="h3 mb-1">إنشاء بلاغ جديد</h1>
    <p class="text-muted mb-0">إضافة بلاغ جديد مع تحديد النوع والموقع والصورة</p>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">بيانات البلاغ</h5>
    </div>

    <div class="card-body">
        <form action="#" method="POST" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">عنوان البلاغ</label>
                    <input type="text" name="title" class="form-control" placeholder="مثال: إنارة معطلة في الشارع الرئيسي">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">نوع البلاغ</label>
                    <select name="report_type_id" class="form-select">
                        <option value="">اختر نوع البلاغ</option>
                        <option value="1">إنارة</option>
                        <option value="2">طرق</option>
                        <option value="3">مياه</option>
                        <option value="4">نفايات</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">وصف المشكلة</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="اكتب وصفاً واضحاً للمشكلة..."></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">صورة البلاغ</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">العنوان التقريبي</label>
                    <input type="text" name="address" class="form-control" placeholder="مثال: شارع الجامعة">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Latitude</label>
                    <input type="text" name="latitude" class="form-control" placeholder="مثال: 33.5138">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Longitude</label>
                    <input type="text" name="longitude" class="form-control" placeholder="مثال: 36.2765">
                </div>

            </div>

            <div class="mb-4">
                <label class="form-label">تحديد الموقع على الخريطة</label>

                <div class="report-map">
                    <div class="map-pin pin-red"></div>
                </div>

                <small class="text-muted">
                    حالياً الخريطة شكلية، وبعدها سيتم ربطها مع Google Maps API.
                </small>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                    إلغاء
                </a>

                <button type="submit" class="btn btn-primary">
                    حفظ البلاغ
                </button>
            </div>

        </form>
    </div>
</div>

@endsection