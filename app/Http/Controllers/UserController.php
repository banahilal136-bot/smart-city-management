<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Report;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display all users.
     */
    public function index(): View
{
    $query = User::query();

    // البحث بالاسم أو البريد الإلكتروني أو رقم الهاتف
    if (request()->filled('search')) {
        $search = request('search');

        $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        });
    }

    // التصفية حسب الدور
    if (request()->filled('role')) {
        $query->where('role', request('role'));
    }

    // التصفية حسب الحالة
    if (request()->filled('status')) {
        $query->where('status', request('status'));
    }

    $users = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    // الإحصائيات العامة
    $totalUsers = User::count();

    $adminCount = User::where(
        'role',
        User::ROLE_ADMIN
    )->count();

    $employeeCount = User::where(
        'role',
        User::ROLE_EMPLOYEE
    )->count();

    $citizenCount = User::where(
        'role',
        User::ROLE_CITIZEN
    )->count();

    return view(
        'users.index',
        compact(
            'users',
            'totalUsers',
            'adminCount',
            'employeeCount',
            'citizenCount'
        )
    );
}

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', 'تم إنشاء المستخدم بنجاح.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): View
{
    $user->load([
        'reports' => function ($query) {
            $query
                ->with('reportType')
                ->latest()
                ->limit(5);
        },

        'reportUpdates' => function ($query) {
            $query
                ->with('report')
                ->latest()
                ->limit(5);
        },
    ]);

    $reportStats = [
        'total' => $user->reports()->count(),

        'in_progress' => $user
            ->reports()
            ->where(
                'status',
                Report::STATUS_IN_PROGRESS
            )
            ->count(),

        'resolved' => $user
            ->reports()
            ->where(
                'status',
                Report::STATUS_RESOLVED
            )
            ->count(),
    ];

    return view(
        'users.show',
        compact(
            'user',
            'reportStats'
        )
    );
}

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function update(
        UpdateUserRequest $request,
        User $user
    ): RedirectResponse {
        $validated = $request->validated();

        /*
         * إذا تُرك حقل كلمة المرور فارغاً،
         * نحافظ على كلمة المرور الحالية.
         */
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('users.show', $user)
            ->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
    }

    /**
 * Activate or deactivate a user account.
 */
public function toggleStatus(
    User $user
): RedirectResponse {

    /*
     * منع المشرف من تعطيل حسابه الحالي
     * حتى لا يقفل نفسه خارج النظام.
     */
    if (auth()->id() === $user->id) {
        return back()->with(
            'error',
            'لا يمكنك تغيير حالة حسابك الحالي.'
        );
    }

    $newStatus =
        $user->status === User::STATUS_ACTIVE
            ? User::STATUS_INACTIVE
            : User::STATUS_ACTIVE;

    $user->update([
        'status' => $newStatus,
    ]);

    $message =
        $newStatus === User::STATUS_ACTIVE
            ? 'تم تفعيل الحساب بنجاح.'
            : 'تم تعطيل الحساب بنجاح.';

    return back()->with(
        'success',
        $message
    );
}

/**
 * Display the authenticated user's own profile.
 */
public function profile(Request $request): View
{
    $user = $request->user();

    $user->load([
        'reports' => function ($query) {
            $query
                ->with('reportType')
                ->latest()
                ->limit(5);
        },

        'reportUpdates' => function ($query) {
            $query
                ->with('report')
                ->latest()
                ->limit(5);
        },
    ]);

    $reportStats = [
        'total' => $user->reports()->count(),

        'in_progress' => $user
            ->reports()
            ->where(
                'status',
                Report::STATUS_IN_PROGRESS
            )
            ->count(),

        'resolved' => $user
            ->reports()
            ->where(
                'status',
                Report::STATUS_RESOLVED
            )
            ->count(),
    ];

    return view('users.show', [
        'user' => $user,
        'reportStats' => $reportStats,
        'profileMode' => true,
    ]);
}


/**
 * Show the authenticated user's profile edit page.
 */
public function editProfile(Request $request): View
{
    return view('users.edit', [
        'user' => $request->user(),
        'profileMode' => true,
    ]);
}


/**
 * Update the authenticated user's own profile.
 */
public function updateProfile(
    UpdateProfileRequest $request
): RedirectResponse {

    $validated = $request->validated();

    if (empty($validated['password'])) {
        unset($validated['password']);
    }

    $request->user()->update($validated);

    return redirect()
        ->route('profile.show')
        ->with(
            'success',
            'تم تحديث بيانات حسابك بنجاح.'
        );
}

}