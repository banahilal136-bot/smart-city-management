@extends('layouts.admin')

@section('title', 'مستخدم جديد')

@section('content')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-1">إضافة مستخدم جديد</h1>
        <p class="text-muted mb-0">إضافة مستخدم للنظام وتحديد دوره وصلاحيته</p>
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
                    <input type="text" name="name" class="form-control" placeholder="مثال: أحمد محمد">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" placeholder="example@email.com">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" placeholder="09xxxxxxxx">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">الدور</label>
                    <select name="role" class="form-select">
                        <option value="">اختر الدور</option>
                        <option value="admin">مشرف / مدير</option>
                        <option value="officer">موظف بلدي</option>
                        <option value="citizen">مواطن</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">كلمة المرور</label>
                    <input type="password" name="password" class="form-control" placeholder="********">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="********">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select">
                        <option value="active">فعال</option>
                        <option value="inactive">غير فعال</option>
                    </select>
                </div>

            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    إلغاء
                </a>

                <button type="submit" class="btn btn-primary">
                    حفظ المستخدم
                </button>
            </div>

        </form>
    </div>
</div>

@endsection