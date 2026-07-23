@extends('layouts.admin')

@section('title', 'أنواع البلاغات')

@section('content')

<style>
    .report-types-page .type-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 16px;
        background: #dff3e6;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .report-types-page .type-icon svg {
        width: 24px;
        height: 24px;
    }

    .report-types-page .type-name {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 3px;
    }

    .report-types-page .type-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
        max-width: 330px;
    }

    .report-types-page .type-department {
        color: #2f7e77;
        font-size: 12px;
        margin-top: 4px;
    }

    .report-types-page .table-actions {
        display: flex;
        gap: 7px;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .report-types-page .table-actions form {
        margin: 0;
    }

    .report-types-page .filter-card {
        border-radius: 18px;
    }

    .report-types-page .guide-box {
        padding: 16px;
        border-radius: 16px;
        border: 1px solid #edf0f2;
        background: #fff;
        height: 100%;
    }

    .report-types-page .guide-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 6px;
    }

    .report-types-page .guide-desc {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 0;
    }

    .report-types-page .empty-box {
        padding: 50px 20px;
        text-align: center;
        color: #6b7280;
    }

    .report-types-page .empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 22px;
        background: #eef8f2;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .report-types-page .empty-icon svg {
        width: 32px;
        height: 32px;
    }

    .report-types-page .pagination {
        margin-bottom: 0;
    }

    .report-types-page .page-link {
        color: #2f7e77;
    }

    .report-types-page .page-item.active .page-link {
        background-color: #2f7e77;
        border-color: #2f7e77;
        color: #fff;
    }
</style>

<div class="report-types-page">

    {{-- عنوان الصفحة --}}
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="page-title">أنواع البلاغات</h1>
            <p class="page-subtitle">
                إدارة التصنيفات التي يختارها المواطن عند إرسال البلاغ
            </p>
        </div>

        <a href="{{ route('report-types.create') }}" class="btn btn-primary">
            <i data-feather="plus-circle"></i>
            نوع بلاغ جديد
        </a>
    </div>

    {{-- رسائل النجاح والخطأ --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i data-feather="check-circle"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="إغلاق">
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i data-feather="alert-circle"></i>
            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="إغلاق">
            </button>
        </div>
    @endif

    {{-- بطاقات الإحصائيات --}}
    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">إجمالي الأنواع</div>

                        <div class="stat-number">
                            {{ $statistics['total'] }}
                        </div>

                        <p class="stat-desc">كل أنواع البلاغات</p>
                    </div>

                    <div class="stat-icon stat-total">
                        <i data-feather="tag"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#11857a;">
                            أنواع فعالة
                        </div>

                        <div class="stat-number">
                            {{ $statistics['active'] }}
                        </div>

                        <p class="stat-desc">ظاهرة للمواطنين</p>
                    </div>

                    <div class="stat-icon stat-new">
                        <i data-feather="check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#f2a72a;">
                            الأكثر استخدامًا
                        </div>

                        <div
                            class="stat-number"
                            style="font-size: 22px;">
                            {{ $statistics['most_used'] }}
                        </div>

                        <p class="stat-desc">حسب البلاغات الحالية</p>
                    </div>

                    <div class="stat-icon stat-progress">
                        <i data-feather="trending-up"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title" style="color:#42a85f;">
                            بلاغات مصنفة
                        </div>

                        <div class="stat-number">
                            {{ $statistics['classified_reports'] }}
                        </div>

                        <p class="stat-desc">مرتبطة بأنواع البلاغات</p>
                    </div>

                    <div class="stat-icon stat-done">
                        <i data-feather="file-text"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- البحث والتصفية --}}
    <div class="card filter-card mb-4">

        <div class="card-header">
            <h5 class="card-title">تصفية أنواع البلاغات</h5>
        </div>

        <div class="card-body">

            <form
                action="{{ route('report-types.index') }}"
                method="GET">

                <div class="row g-3">

                    <div class="col-md-4">
                        <label for="search" class="form-label">
                            بحث
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="ابحث باسم النوع أو القسم أو الوصف...">
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">
                            الحالة
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select">

                            <option value="">كل الحالات</option>

                            <option
                                value="active"
                                @selected(request('status') === 'active')>
                                فعال
                            </option>

                            <option
                                value="inactive"
                                @selected(request('status') === 'inactive')>
                                غير فعال
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="priority" class="form-label">
                            الأولوية
                        </label>

                        <select
                            id="priority"
                            name="priority"
                            class="form-select">

                            <option value="">الكل</option>

                            <option
                                value="high"
                                @selected(request('priority') === 'high')>
                                عالية
                            </option>

                            <option
                                value="medium"
                                @selected(request('priority') === 'medium')>
                                متوسطة
                            </option>

                            <option
                                value="low"
                                @selected(request('priority') === 'low')>
                                منخفضة
                            </option>
                        </select>
                    </div>

              <div class="col-md-3 d-flex align-items-end gap-2">

    <button
        type="submit"
        class="btn btn-primary flex-grow-1">

        <i data-feather="filter"></i>
        تصفية
    </button>

    <a
        href="{{ route('report-types.index') }}"
        class="btn btn-outline-secondary">

        <i data-feather="rotate-ccw"></i>
    </a>

</div>

                </div>
            </form>

        </div>
    </div>

    {{-- البطاقات التعريفية --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="guide-box">
                <div class="guide-title">تنظيم البلاغات</div>

                <p class="guide-desc">
                    تساعد الأنواع على تصنيف البلاغات مثل الطرق،
                    النظافة، الإنارة، والمياه.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="guide-box">
                <div class="guide-title">تسهيل المتابعة</div>

                <p class="guide-desc">
                    يمكن للموظف معرفة القسم المناسب لمعالجة البلاغ
                    حسب نوع المشكلة.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="guide-box">
                <div class="guide-title">تحسين الإحصائيات</div>

                <p class="guide-desc">
                    تظهر لوحة التحكم عدد البلاغات حسب التصنيف
                    وتساعد الإدارة في اتخاذ القرار.
                </p>
            </div>
        </div>

    </div>

    {{-- جدول أنواع البلاغات --}}
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title">قائمة أنواع البلاغات</h5>

                <small class="text-muted">
                    عرض وتعديل الأنواع المستخدمة في النظام
                </small>
            </div>

            <small class="text-muted">
                عدد النتائج: {{ $reportTypes->total() }}
            </small>
        </div>

        <div class="card-body pt-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نوع البلاغ</th>
                            <th>عدد البلاغات</th>
                            <th>الأولوية</th>
                            <th>الحالة</th>
                            <th>تاريخ الإضافة</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($reportTypes as $reportType)

                            @php
                                $priorityLabels = [
                                    'high' => 'عالية',
                                    'medium' => 'متوسطة',
                                    'low' => 'منخفضة',
                                ];

                                $priorityClasses = [
                                    'high' => 'bg-danger',
                                    'medium' => 'bg-warning text-dark',
                                    'low' => 'bg-secondary',
                                ];

                                $priorityLabel =
                                    $priorityLabels[$reportType->priority]
                                    ?? $reportType->priority;

                                $priorityClass =
                                    $priorityClasses[$reportType->priority]
                                    ?? 'bg-secondary';

                                $isActive =
                                    $reportType->status === 'active';
                            @endphp

                            <tr>

                                <td>
                                    {{ $reportTypes->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-3">

                                        <div class="type-icon">
                                            <i
                                                data-feather="{{ $reportType->icon ?: 'tag' }}">
                                            </i>
                                        </div>

                                        <div>
                                            <div class="type-name">
                                                {{ $reportType->name }}
                                            </div>

                                            <p class="type-desc">
                                                {{ $reportType->description ?: 'لا يوجد وصف لهذا النوع.' }}
                                            </p>

                                            @if ($reportType->department)
                                                <div class="type-department">
                                                    القسم:
                                                    {{ $reportType->department }}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $reportType->reports_count }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge {{ $priorityClass }}">
                                        {{ $priorityLabel }}
                                    </span>
                                </td>

                                <td>
                                    <span
                                        class="badge {{ $isActive ? 'bg-success' : 'bg-danger' }}">

                                        {{ $isActive ? 'فعال' : 'غير فعال' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $reportType->created_at->format('Y-m-d') }}
                                </td>

                                <td>
                                    <div class="table-actions">

                                        {{-- تعديل --}}
                                        <a
                                            href="{{ route('report-types.edit', $reportType) }}"
                                            class="btn btn-sm btn-warning">

                                            <i data-feather="edit-2"></i>
                                            تعديل
                                        </a>

                                        {{-- تفعيل أو تعطيل --}}
                                        <form
                                            action="{{ route('report-types.toggle-status', $reportType) }}"
                                            method="POST">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="btn btn-sm {{ $isActive ? 'btn-outline-secondary' : 'btn-success' }}">

                                                <i
                                                    data-feather="{{ $isActive ? 'pause-circle' : 'check-circle' }}">
                                                </i>

                                                {{ $isActive ? 'تعطيل' : 'تفعيل' }}
                                            </button>
                                        </form>

                                        {{-- حذف --}}
                                        <form
                                            action="{{ route('report-types.destroy', $reportType) }}"
                                            method="POST"
                                            onsubmit="return confirm('هل أنت متأكد من حذف نوع البلاغ؟');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger">

                                                <i data-feather="trash-2"></i>
                                                حذف
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7">

                                    <div class="empty-box">

                                        <div class="empty-icon">
                                            <i data-feather="tag"></i>
                                        </div>

                                        <h5>لا توجد أنواع بلاغات</h5>

                                        <p>
                                            لم تتم إضافة أي نوع بلاغ حتى الآن.
                                        </p>

                                        <a
                                            href="{{ route('report-types.create') }}"
                                            class="btn btn-primary">

                                            <i data-feather="plus-circle"></i>
                                            إضافة أول نوع بلاغ
                                        </a>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>

            {{-- ترقيم الصفحات --}}
            @if ($reportTypes->hasPages())

                <nav class="mt-4">

                    <ul class="pagination justify-content-center">

                        <li class="page-item {{ $reportTypes->onFirstPage() ? 'disabled' : '' }}">
                            <a
                                class="page-link"
                                href="{{ $reportTypes->previousPageUrl() ?? '#' }}">

                                السابق
                            </a>
                        </li>

                        @foreach ($reportTypes->getUrlRange(1, $reportTypes->lastPage()) as $page => $url)

                            <li class="page-item {{ $page === $reportTypes->currentPage() ? 'active' : '' }}">
                                <a
                                    class="page-link"
                                    href="{{ $url }}">

                                    {{ $page }}
                                </a>
                            </li>

                        @endforeach

                        <li class="page-item {{ $reportTypes->hasMorePages() ? '' : 'disabled' }}">
                            <a
                                class="page-link"
                                href="{{ $reportTypes->nextPageUrl() ?? '#' }}">

                                التالي
                            </a>
                        </li>

                    </ul>

                </nav>

            @endif

        </div>
    </div>

</div>

@endsection