@extends('layouts.admin')

@section('title', auth()->user()->isCitizen() ? 'بلاغاتي' : 'جميع البلاغات')

@section('content')

<style>
    .reports-page .report-title {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .reports-page .report-owner {
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 0;
    }

    .reports-page .report-type {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-weight: 700;
        color: #374151;
    }

    .reports-page .report-type-icon {
        width: 34px;
        height: 34px;
        border-radius: 11px;
        background: #e4f3eb;
        color: #2f7e77;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .reports-page .report-type-icon svg {
        width: 17px;
        height: 17px;
    }

    .reports-page .table-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
    }

    .reports-page .table-actions form {
        margin: 0;
    }

    .reports-page .empty-box {
        text-align: center;
        padding: 55px 20px;
        color: #6b7280;
    }

    .reports-page .empty-icon {
        width: 72px;
        height: 72px;
        margin: 0 auto 16px;
        border-radius: 22px;
        background: #eaf6ef;
        color: #2f7e77;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .reports-page .empty-icon svg {
        width: 34px;
        height: 34px;
    }

    .reports-page .page-link {
        color: #2f7e77;
    }

    .reports-page .page-item.active .page-link {
        color: #fff;
        background-color: #2f7e77;
        border-color: #2f7e77;
    }
</style>

<div class="reports-page">

    {{-- عنوان الصفحة --}}
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <h1 class="page-title">
                {{ auth()->user()->isCitizen() ? 'بلاغاتي' : 'جميع البلاغات' }}
            </h1>

            <p class="page-subtitle">
                @if (auth()->user()->isCitizen())
                    متابعة البلاغات التي قمت بإرسالها
                @else
                    إدارة ومتابعة البلاغات الواردة من المواطنين
                @endif
            </p>
        </div>

        @if (auth()->user()->isCitizen() || auth()->user()->isAdmin())
            <a
                href="{{ route('reports.create') }}"
                class="btn btn-primary">

                <i data-feather="plus-circle"></i>
                بلاغ جديد
            </a>
        @endif

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
                data-bs-dismiss="alert"
                aria-label="إغلاق">
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
                        <div class="stat-title">
                            إجمالي البلاغات
                        </div>

                        <div class="stat-number">
                            {{ $statistics['total'] }}
                        </div>

                        <p class="stat-desc">
                            كل البلاغات المسجلة
                        </p>
                    </div>

                    <div class="stat-icon stat-total">
                        <i data-feather="file-text"></i>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <div
                            class="stat-title"
                            style="color:#11857a;">

                            بلاغات جديدة
                        </div>

                        <div class="stat-number">
                            {{ $statistics['new'] }}
                        </div>

                        <p class="stat-desc">
                            بانتظار المعالجة
                        </p>
                    </div>

                    <div class="stat-icon stat-new">
                        <i data-feather="alert-circle"></i>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <div
                            class="stat-title"
                            style="color:#f2a72a;">

                            قيد المعالجة
                        </div>

                        <div class="stat-number">
                            {{ $statistics['in_progress'] }}
                        </div>

                        <p class="stat-desc">
                            يتم العمل عليها
                        </p>
                    </div>

                    <div class="stat-icon stat-progress">
                        <i data-feather="clock"></i>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <div
                            class="stat-title"
                            style="color:#42a85f;">

                            تم الحل
                        </div>

                        <div class="stat-number">
                            {{ $statistics['resolved'] }}
                        </div>

                        <p class="stat-desc">
                            بلاغات منتهية
                        </p>
                    </div>

                    <div class="stat-icon stat-done">
                        <i data-feather="check-circle"></i>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- البحث والتصفية --}}
    <div class="card mb-4">

        <div class="card-header">
            <h5 class="card-title">تصفية البلاغات</h5>
        </div>

        <div class="card-body">

            <form
                action="{{ route('reports.index') }}"
                method="GET">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label
                            for="search"
                            class="form-label">

                            بحث
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="ابحث بالعنوان أو الموقع أو المواطن...">

                    </div>

                    <div class="col-md-3">

                        <label
                            for="report_type_id"
                            class="form-label">

                            نوع البلاغ
                        </label>

                        <select
                            id="report_type_id"
                            name="report_type_id"
                            class="form-select">

                            <option value="">
                                كل الأنواع
                            </option>

                            @foreach ($reportTypes as $reportType)

                                <option
                                    value="{{ $reportType->id }}"
                                    @selected(
                                        (string) request('report_type_id')
                                        === (string) $reportType->id
                                    )>

                                    {{ $reportType->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <label
                            for="status"
                            class="form-label">

                            الحالة
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select">

                            <option value="">
                                كل الحالات
                            </option>

                            <option
                                value="new"
                                @selected(request('status') === 'new')>

                                جديد
                            </option>

                            <option
                                value="in_progress"
                                @selected(request('status') === 'in_progress')>

                                قيد المعالجة
                            </option>

                            <option
                                value="resolved"
                                @selected(request('status') === 'resolved')>

                                تم الحل
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2 d-flex align-items-end gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary flex-grow-1">

                            <i data-feather="filter"></i>
                            تصفية
                        </button>

                        <a
                            href="{{ route('reports.index') }}"
                            class="btn btn-outline-secondary"
                            title="إلغاء التصفية">

                            <i data-feather="rotate-ccw"></i>
                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- جدول البلاغات --}}
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h5 class="card-title">
                    قائمة البلاغات
                </h5>

                <small class="text-muted">
                    عرض البلاغات مع الحالة والموقع
                </small>
            </div>

            <small class="text-muted">
                عدد النتائج: {{ $reports->total() }}
            </small>

        </div>

        <div class="card-body pt-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان البلاغ</th>
                            <th>النوع</th>
                            <th>الحالة</th>
                            <th>الموقع</th>
                            <th>التاريخ</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($reports as $report)

                            @php
                                $statusClass = match ($report->status) {
                                    'new' => 'bg-primary',
                                    'in_progress' => 'bg-warning text-dark',
                                    'resolved' => 'bg-success',
                                    default => 'bg-secondary',
                                };

                                $canEdit =
                                    auth()->user()->isAdmin()
                                    || auth()->user()->isEmployee()
                                    || (
                                        auth()->user()->isCitizen()
                                        && $report->user_id === auth()->id()
                                        && $report->status === 'new'
                                    );

                                $canDelete =
                                    auth()->user()->isAdmin()
                                    || (
                                        auth()->user()->isCitizen()
                                        && $report->user_id === auth()->id()
                                        && $report->status === 'new'
                                    );
                            @endphp

                            <tr>

                                <td>
                                    {{ $reports->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="report-title">
                                        {{ $report->title }}
                                    </div>

                                    @if (!auth()->user()->isCitizen())
                                        <p class="report-owner">
                                            المواطن:
                                            {{ $report->user?->name ?? 'غير معروف' }}
                                        </p>
                                    @endif
                                </td>

                                <td>
                                    <div class="report-type">

                                        <span class="report-type-icon">
                                            <i
                                                data-feather="{{ $report->reportType?->icon ?: 'tag' }}">
                                            </i>
                                        </span>

                                        {{ $report->reportType?->name ?? 'غير مصنف' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge {{ $statusClass }}">
                                        {{ $report->status_label }}
                                    </span>
                                </td>

                                <td>
                                    {{ \Illuminate\Support\Str::limit($report->address, 45) }}
                                </td>

                                <td>
                                    {{ $report->created_at->format('Y-m-d') }}
                                </td>

                                <td>
                                    <div class="table-actions">

                                        <a
                                            href="{{ route('reports.show', $report) }}"
                                            class="btn btn-sm btn-outline-primary">

                                            <i data-feather="eye"></i>
                                            عرض
                                        </a>

                                        @if ($canEdit)
                                            <a
                                                href="{{ route('reports.edit', $report) }}"
                                                class="btn btn-sm btn-warning">

                                                <i data-feather="edit-2"></i>
                                                تعديل
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
                                                    class="btn btn-sm btn-danger">

                                                    <i data-feather="trash-2"></i>
                                                    حذف
                                                </button>

                                            </form>
                                        @endif

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7">

                                    <div class="empty-box">

                                        <div class="empty-icon">
                                            <i data-feather="file-text"></i>
                                        </div>

                                        <h5>
                                            لا توجد بلاغات
                                        </h5>

                                        <p>
                                            @if (
                                                request()->filled('search')
                                                || request()->filled('status')
                                                || request()->filled('report_type_id')
                                            )
                                                لا توجد نتائج مطابقة لخيارات البحث والتصفية.
                                            @else
                                                لم يتم تسجيل أي بلاغ حتى الآن.
                                            @endif
                                        </p>

                                        @if (
                                            auth()->user()->isCitizen()
                                            || auth()->user()->isAdmin()
                                        )
                                            <a
                                                href="{{ route('reports.create') }}"
                                                class="btn btn-primary">

                                                <i data-feather="plus-circle"></i>
                                                إنشاء بلاغ جديد
                                            </a>
                                        @endif

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- ترقيم الصفحات --}}
            @if ($reports->hasPages())

                <nav class="mt-4">

                    <ul class="pagination justify-content-center">

                        <li class="page-item {{ $reports->onFirstPage() ? 'disabled' : '' }}">
                            <a
                                class="page-link"
                                href="{{ $reports->previousPageUrl() ?? '#' }}">

                                السابق
                            </a>
                        </li>

                        @foreach (
                            $reports->getUrlRange(1, $reports->lastPage())
                            as $page => $url
                        )

                            <li class="page-item {{ $page === $reports->currentPage() ? 'active' : '' }}">

                                <a
                                    class="page-link"
                                    href="{{ $url }}">

                                    {{ $page }}
                                </a>

                            </li>

                        @endforeach

                        <li class="page-item {{ $reports->hasMorePages() ? '' : 'disabled' }}">
                            <a
                                class="page-link"
                                href="{{ $reports->nextPageUrl() ?? '#' }}">

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