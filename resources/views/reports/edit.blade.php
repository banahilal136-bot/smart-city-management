@extends('layouts.admin')

@section('title', 'تعديل البلاغ')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-1">تعديل البلاغ</h1>
        <p class="text-muted mb-0">تعديل بيانات البلاغ وموقعه وحالته</p>
    </div>

    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
        رجوع إلى البلاغات
    </a>
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
                    <input type="text" name="title" class="form-control" value="إنارة معطلة في الشارع الرئيسي">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">نوع البلاغ</label>
                    <select name="report_type_id" class="form-select">
                        <option value="1" selected>إنارة</option>
                        <option value="2">طرق</option>
                        <option value="3">مياه</option>
                        <option value="4">نفايات</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">وصف المشكلة</label>
                    <textarea name="description" class="form-control" rows="4">يوجد عطل في الإنارة في الشارع الرئيسي بالقرب من الجامعة، مما يسبب ضعفاً في الرؤية ليلاً.</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">صورة جديدة للبلاغ</label>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">اتركي الحقل فارغاً إذا لا تريدين تغيير الصورة.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">العنوان التقريبي</label>
                    <input type="text" name="address" class="form-control" value="شارع الجامعة">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select">
                        <option value="new" selected>جديد</option>
                        <option value="in_progress">قيد المعالجة</option>
                        <option value="resolved">تم الحل</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Latitude</label>
                    <input type="text" name="latitude" class="form-control" value="33.5138">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Longitude</label>
                    <input type="text" name="longitude" class="form-control" value="36.2765">
                </div>

            </div>

            <div class="mb-4">
                <label class="form-label">تعديل موقع البلاغ على الخريطة</label>

                <div class="report-map">
                    <div class="map-pin pin-blue"></div>
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
                    حفظ التعديلات
                </button>
            </div>

        </form>
    </div>
</div>

@endsection