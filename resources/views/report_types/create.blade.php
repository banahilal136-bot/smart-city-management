@extends('layouts.admin')

@section('title', 'نوع بلاغ جديد')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-1">إضافة نوع بلاغ جديد</h1>
        <p class="text-muted mb-0">إضافة تصنيف جديد للبلاغات داخل النظام</p>
    </div>

    <a href="{{ route('report-types.index') }}" class="btn btn-secondary">
        رجوع إلى أنواع البلاغات
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">بيانات نوع البلاغ</h5>
    </div>

    <div class="card-body">
        <form action="#" method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">اسم النوع</label>
                    <input type="text" name="name" class="form-control" placeholder="مثال: إنارة">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">الحالة</label>
                    <select name="is_active" class="form-select">
                        <option value="1">فعال</option>
                        <option value="0">غير فعال</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="اكتبي وصفاً مختصراً لهذا النوع..."></textarea>
                </div>

            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('report-types.index') }}" class="btn btn-secondary">
                    إلغاء
                </a>

                <button type="submit" class="btn btn-primary">
                    حفظ النوع
                </button>
            </div>

        </form>
    </div>
</div>

@endsection