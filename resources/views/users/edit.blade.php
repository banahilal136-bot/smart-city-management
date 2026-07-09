@extends('layouts.admin')

@section('title', 'تعديل مستخدم')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-1">تعديل بيانات المستخدم</h1>
        <p class="text-muted mb-0">تحديث بيانات المستخدم ودوره وحالته</p>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        رجوع إلى المستخدمين
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">بيانات المستخدم</h5>
    </div>

    <div class="card-body">
        <form action="#" method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">الاسم الكامل</label>
                    <input type="text" name="name" class="form-control" value="أحمد محمد">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" value="admin@example.com">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" value="0999999999">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">الدور</label>
                    <select name="role" class="form-select">
                        <option value="admin" selected>مشرف / مدير</option>
                        <option value="officer">موظف بلدي</option>
                        <option value="citizen">مواطن</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">كلمة مرور جديدة</label>
                    <input type="password" name="password" class="form-control" placeholder="اتركيه فارغاً إذا لا تريدين تغييره">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور الجديدة">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select">
                        <option value="active" selected>فعال</option>
                        <option value="inactive">غير فعال</option>
                    </select>
                </div>

            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
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