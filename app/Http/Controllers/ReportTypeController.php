<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportTypes\StoreReportTypeRequest;
use App\Http\Requests\ReportTypes\UpdateReportTypeRequest;
use App\Models\ReportType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportTypeController extends Controller
{
    /**
     * عرض جميع أنواع البلاغات مع البحث والتصفية.
     */
  public function index(Request $request): View
{
    $search = trim((string) $request->input('search', ''));
    $status = $request->input('status');
    $priority = $request->input('priority');

    $query = ReportType::query()
        ->withCount('reports');

    if ($search !== '') {
        $query->where(function ($subQuery) use ($search) {
            $subQuery
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('department', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    if (in_array($status, ['active', 'inactive'], true)) {
        $query->where('status', $status);
    }

    if (in_array($priority, ['low', 'medium', 'high'], true)) {
        $query->where('priority', $priority);
    }

    $reportTypes = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $mostUsedType = ReportType::query()
        ->withCount('reports')
        ->orderByDesc('reports_count')
        ->first();

    $classifiedReports = ReportType::query()
        ->withCount('reports')
        ->get()
        ->sum('reports_count');

    $statistics = [
        'total' => ReportType::count(),

        'active' => ReportType::where(
            'status',
            ReportType::STATUS_ACTIVE
        )->count(),

        'most_used' => $mostUsedType && $mostUsedType->reports_count > 0
            ? $mostUsedType->name
            : 'لا يوجد',

        'classified_reports' => $classifiedReports,
    ];

    return view('report_types.index', compact(
        'reportTypes',
        'statistics'
    ));
}

    /**
     * صفحة إنشاء نوع بلاغ جديد.
     */
    public function create(): View
    {
return view('report_types.create');   
 }

    /**
     * حفظ نوع البلاغ الجديد.
     */
    public function store(
        StoreReportTypeRequest $request
    ): RedirectResponse {
        ReportType::create($request->validated());

        return redirect()
            ->route('report-types.index')
            ->with('success', 'تمت إضافة نوع البلاغ بنجاح.');
    }

    /**
     * تحويل صفحة العرض إلى صفحة التعديل.
     */
    public function show(
        ReportType $reportType
    ): RedirectResponse {
        return redirect()->route(
            'report-types.edit',
            $reportType
        );
    }

    /**
     * صفحة تعديل نوع البلاغ.
     */
 public function edit(ReportType $reportType): View
{
    $reportType->loadCount('reports');

    return view('report_types.edit', compact('reportType'));
}

    /**
     * حفظ تعديلات نوع البلاغ.
     */
    public function update(
        UpdateReportTypeRequest $request,
        ReportType $reportType
    ): RedirectResponse {
        $reportType->update($request->validated());

        return redirect()
            ->route('report-types.index')
            ->with('success', 'تم تعديل نوع البلاغ بنجاح.');
    }

    /**
     * تفعيل أو تعطيل نوع البلاغ.
     */
    public function toggleStatus(
        ReportType $reportType
    ): RedirectResponse {
        $reportType->status =
            $reportType->status === ReportType::STATUS_ACTIVE
                ? ReportType::STATUS_INACTIVE
                : ReportType::STATUS_ACTIVE;

        $reportType->save();

        $message = $reportType->status === ReportType::STATUS_ACTIVE
            ? 'تم تفعيل نوع البلاغ بنجاح.'
            : 'تم تعطيل نوع البلاغ بنجاح.';

        return back()->with('success', $message);
    }

    /**
     * حذف نوع البلاغ بشرط ألا يكون مرتبطًا ببلاغات.
     */
    public function destroy(
        ReportType $reportType
    ): RedirectResponse {
        if ($reportType->reports()->exists()) {
            return back()->with(
                'error',
                'لا يمكن حذف هذا النوع لأنه مرتبط ببلاغات موجودة.'
            );
        }

        $reportType->delete();

        return redirect()
            ->route('report-types.index')
            ->with('success', 'تم حذف نوع البلاغ بنجاح.');
    }
}