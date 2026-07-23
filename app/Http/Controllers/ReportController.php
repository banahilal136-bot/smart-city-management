<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reports\StoreReportRequest;
use App\Http\Requests\Reports\UpdateReportRequest;
use App\Models\Report;
use App\Models\ReportType;
use App\Models\ReportUpdate;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class ReportController extends Controller
{
    /**
     * عرض البلاغات.
     * المواطن يشاهد بلاغاته فقط.
     * الموظف والأدمن يشاهدان جميع البلاغات.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $query = Report::query()
            ->with([
                'user:id,name,email,role',
                'reportType:id,name,icon,priority,status',
            ]);

        if ($user->isCitizen()) {
            $query->where('user_id', $user->id);
        }

        $search = trim((string) $request->input('search', ''));

        if ($search !== '') {
            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        );
                    })
                    ->orWhereHas('reportType', function ($typeQuery) use ($search) {
                        $typeQuery->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        );
                    });
            });
        }

        $status = $request->input('status');

        if (in_array($status, [
            Report::STATUS_NEW,
            Report::STATUS_IN_PROGRESS,
            Report::STATUS_RESOLVED,
        ], true)) {
            $query->where('status', $status);
        }

        $reportTypeId = $request->input('report_type_id');

        if (is_numeric($reportTypeId)) {
            $query->where(
                'report_type_id',
                (int) $reportTypeId
            );
        }

        $reports = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $statisticsQuery = Report::query();

        if ($user->isCitizen()) {
            $statisticsQuery->where('user_id', $user->id);
        }

        $statistics = [
            'total' => (clone $statisticsQuery)->count(),

            'new' => (clone $statisticsQuery)
                ->where('status', Report::STATUS_NEW)
                ->count(),

            'in_progress' => (clone $statisticsQuery)
                ->where('status', Report::STATUS_IN_PROGRESS)
                ->count(),

            'resolved' => (clone $statisticsQuery)
                ->where('status', Report::STATUS_RESOLVED)
                ->count(),
        ];

        $reportTypes = ReportType::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('reports.index', compact(
            'reports',
            'statistics',
            'reportTypes'
        ));
    }

    /**
     * صفحة إنشاء بلاغ.
     */
    public function create(Request $request): View
    {
        $this->ensureCanCreate($request->user());

        $reportTypes = ReportType::query()
            ->where('status', ReportType::STATUS_ACTIVE)
            ->orderBy('name')
            ->get();

        return view('reports.create', compact('reportTypes'));
    }

    /**
     * حفظ بلاغ جديد.
     */
    public function store(
        StoreReportRequest $request
    ): RedirectResponse {
        $user = $request->user();

        $this->ensureCanCreate($user);

        $data = $request->validated();

        $activeReportType = ReportType::query()
            ->whereKey($data['report_type_id'])
            ->where('status', ReportType::STATUS_ACTIVE)
            ->first();

        if (!$activeReportType) {
            throw ValidationException::withMessages([
                'report_type_id' => 'نوع البلاغ المحدد غير فعال.',
            ]);
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request
                ->file('image')
                ->store('reports', 'public');
        }

        unset($data['image']);

        $data['user_id'] = $user->id;
        $data['status'] = Report::STATUS_NEW;
        $data['image_path'] = $imagePath;

        try {
            $report = DB::transaction(function () use ($data, $user) {
                $report = Report::create($data);

                ReportUpdate::create([
                    'report_id' => $report->id,
                    'user_id' => $user->id,
                    'old_status' => null,
                    'new_status' => Report::STATUS_NEW,
                    'note' => 'تم إنشاء البلاغ.',
                ]);

                return $report;
            });
        } catch (Throwable $exception) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            throw $exception;
        }

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'تم إرسال البلاغ بنجاح.');
    }

    /**
     * عرض تفاصيل البلاغ.
     */
    public function show(
        Request $request,
        Report $report
    ): View {
        $this->ensureCanView($request->user(), $report);

        $report->load([
            'user',
            'reportType',
            'updates.user',
        ]);

        return view('reports.show', compact('report'));
    }

    /**
     * صفحة تعديل البلاغ.
     */
    public function edit(
        Request $request,
        Report $report
    ): View {
        $this->ensureCanEdit($request->user(), $report);

        $reportTypes = ReportType::query()
            ->where(function ($query) use ($report) {
                $query
                    ->where('status', ReportType::STATUS_ACTIVE)
                    ->orWhere('id', $report->report_type_id);
            })
            ->orderBy('name')
            ->get();

        return view('reports.edit', compact(
            'report',
            'reportTypes'
        ));
    }

    /**
     * حفظ تعديلات البلاغ.
     */
    public function update(
        UpdateReportRequest $request,
        Report $report
    ): RedirectResponse {
        $user = $request->user();

        $this->ensureCanEdit($user, $report);

        $data = $request->validated();

        $oldStatus = $report->status;
        $oldImagePath = $report->image_path;
        $newImagePath = null;
        $deleteOldImage = false;

        // المواطن لا يستطيع تغيير حالة البلاغ.
        if ($user->isCitizen()) {
            unset($data['status']);
        }

        if ($request->hasFile('image')) {
            $newImagePath = $request
                ->file('image')
                ->store('reports', 'public');

            $data['image_path'] = $newImagePath;
            $deleteOldImage = true;
        } elseif ($request->boolean('remove_image')) {
            $data['image_path'] = null;
            $deleteOldImage = true;
        }

        unset(
            $data['image'],
            $data['remove_image']
        );

        try {
            DB::transaction(function () use (
                $report,
                $data,
                $oldStatus,
                $user
            ) {
                $report->update($data);
                $report->refresh();

                if ($report->status !== $oldStatus) {
                    ReportUpdate::create([
                        'report_id' => $report->id,
                        'user_id' => $user->id,
                        'old_status' => $oldStatus,
                        'new_status' => $report->status,
                        'note' => 'تم تغيير حالة البلاغ.',
                    ]);
                }
            });
        } catch (Throwable $exception) {
            if ($newImagePath) {
                Storage::disk('public')->delete($newImagePath);
            }

            throw $exception;
        }

        if ($deleteOldImage && $oldImagePath) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'تم تعديل البلاغ بنجاح.');
    }

    /**
     * تغيير حالة البلاغ بواسطة الموظف أو الأدمن.
     */
    public function updateStatus(
        Request $request,
        Report $report
    ): RedirectResponse {
        $user = $request->user();

        $this->ensureCanManageStatus($user);

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    Report::STATUS_NEW,
                    Report::STATUS_IN_PROGRESS,
                    Report::STATUS_RESOLVED,
                ]),
            ],

            'note' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ], [
            'status.required' => 'يرجى اختيار حالة البلاغ.',
            'status.in' => 'حالة البلاغ المحددة غير صحيحة.',
            'note.string' => 'الملاحظة يجب أن تكون نصًا.',
            'note.max' => 'الملاحظة يجب ألا تتجاوز 2000 حرف.',
        ]);

        $oldStatus = $report->status;
        $newStatus = $validated['status'];

        if ($oldStatus === $newStatus) {
            return back()->with(
                'error',
                'حالة البلاغ الجديدة مطابقة للحالة الحالية.'
            );
        }

        DB::transaction(function () use (
            $report,
            $user,
            $oldStatus,
            $newStatus,
            $validated
        ) {
            $report->update([
                'status' => $newStatus,
            ]);

            ReportUpdate::create([
                'report_id' => $report->id,
                'user_id' => $user->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'note' => $validated['note']
                    ?? 'تم تغيير حالة البلاغ.',
            ]);
        });

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'تم تحديث حالة البلاغ بنجاح.');
    }

    /**
     * حذف البلاغ.
     */
    public function destroy(
        Request $request,
        Report $report
    ): RedirectResponse {
        $this->ensureCanDelete($request->user(), $report);

        $imagePath = $report->image_path;

        $report->delete();

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()
            ->route('reports.index')
            ->with('success', 'تم حذف البلاغ بنجاح.');
    }

    /**
     * صلاحية إنشاء بلاغ.
     */
    private function ensureCanCreate(User $user): void
    {
        if (!$user->isCitizen() && !$user->isAdmin()) {
            abort(
                403,
                'المواطن أو مدير النظام فقط يستطيع إنشاء بلاغ.'
            );
        }
    }

    /**
     * صلاحية مشاهدة البلاغ.
     */
    private function ensureCanView(
        User $user,
        Report $report
    ): void {
        if (
            $user->isCitizen()
            && $report->user_id !== $user->id
        ) {
            abort(
                403,
                'لا يمكنك مشاهدة بلاغات مستخدم آخر.'
            );
        }
    }

    /**
     * صلاحية تعديل البلاغ.
     */
    private function ensureCanEdit(
        User $user,
        Report $report
    ): void {
        if ($user->isAdmin() || $user->isEmployee()) {
            return;
        }

        $citizenCanEdit =
            $user->isCitizen()
            && $report->user_id === $user->id
            && $report->status === Report::STATUS_NEW;

        if (!$citizenCanEdit) {
            abort(
                403,
                'لا يمكنك تعديل هذا البلاغ.'
            );
        }
    }

    /**
     * صلاحية تغيير حالة البلاغ.
     */
    private function ensureCanManageStatus(User $user): void
    {
        if (!$user->isAdmin() && !$user->isEmployee()) {
            abort(
                403,
                'الموظف أو مدير النظام فقط يستطيع تغيير حالة البلاغ.'
            );
        }
    }

    /**
     * صلاحية حذف البلاغ.
     */
    private function ensureCanDelete(
        User $user,
        Report $report
    ): void {
        if ($user->isAdmin()) {
            return;
        }

        $citizenCanDelete =
            $user->isCitizen()
            && $report->user_id === $user->id
            && $report->status === Report::STATUS_NEW;

        if (!$citizenCanDelete) {
            abort(
                403,
                'لا يمكنك حذف هذا البلاغ.'
            );
        }
    }
}