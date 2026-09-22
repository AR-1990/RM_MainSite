<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\UserActivity;
use App\Models\Lead;
use App\Models\AttendanceRecord;
use App\Models\WorkloadTask;
use App\Models\SalaryAdvance;
use App\Models\SalaryPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected function getUserFormOptions(): array
    {
        return [
            'departments' => ['Sales', 'Marketing', 'HR', 'Finance', 'IT', 'Operations', 'Customer Service'],
            'designations' => ['Manager', 'Senior Executive', 'Executive', 'Assistant', 'Intern'],
            'roles' => ['user', 'agent', 'admin'],
        ];
    }

    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::with('profile');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('profile', function($profile) use ($search) {
                      $profile->where('employee_id', 'like', "%{$search}%")
                             ->orWhere('department', 'like', "%{$search}%")
                             ->orWhere('designation', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Filter by department
        if ($request->filled('department')) {
            $query->whereHas('profile', function($profile) use ($request) {
                $profile->where('department', $request->department);
            });
        }

        $users = $query->latest()->paginate(15);

        // Get unique departments for filter
        $departments = UserProfile::distinct()->pluck('department')->filter()->sort()->values();

        return view('admin.users.index', compact('users', 'departments'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $formOptions = $this->getUserFormOptions();

        return view('admin.users.create', $formOptions);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,agent,admin',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'date_of_joining' => 'nullable|date',
            'basic_salary' => 'nullable|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'employee_id' => 'nullable|string|max:50|unique:user_profiles',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'is_active' => true,
            ]);

            // Handle profile picture upload
            $profilePicture = null;
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $uploadPath = public_path('uploads/user-profiles');
                
                // Create directory if it doesn't exist
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }
                
                // Move file to uploads directory
                $file->move($uploadPath, $fileName);
                $profilePicture = 'uploads/user-profiles/' . $fileName;
            }

            // Calculate total salary
            $basicSalary = $request->basic_salary ?? 0;
            $allowances = $request->allowances ?? 0;
            $totalSalary = $basicSalary + $allowances;

            // Create user profile
            $user->profile()->create([
                'phone' => $request->phone,
                'department' => $request->department,
                'designation' => $request->designation,
                'date_of_joining' => $request->date_of_joining,
                'basic_salary' => $basicSalary,
                'allowances' => $allowances,
                'total_salary' => $totalSalary,
                'employee_id' => $request->employee_id,
                'profile_picture' => $profilePicture,
                'is_portal_active' => true,
            ]);

            // Log activity
            UserActivity::log(
                auth()->id(),
                'user_created',
                'User Created',
                "New user '{$user->name}' was created",
                'User',
                $user->id
            );

            return redirect()->route('admin.users.index')
                ->with('success', 'User created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating user: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load([
            'profile', 
            'activities' => function($query) {
                $query->latest()->limit(20);
            },
            'assignedLeads' => function($query) {
                $query->latest()->limit(5);
            },
            'workloadTasks' => function($query) {
                $query->latest()->limit(5);
            },
            'attendanceRecords' => function($query) {
                $query->latest()->limit(10);
            },
            'salaryAdvances' => function($query) {
                $query->latest()->limit(10);
            },
            'salaryPayments' => function($query) {
                $query->latest()->limit(10);
            }
        ]);

        // Get user statistics
        $stats = [
            'total_leads' => $user->assignedLeads()->count(),
            'total_attendance' => $user->attendanceRecords()->count(),
            'total_tasks' => $user->workloadTasks()->count(),
            'total_loans' => $user->salaryAdvances()->count(),
            'pending_loans' => $user->salaryAdvances()->where('status', 'pending')->count(),
            'total_salary_payments' => $user->salaryPayments()->count(),
            'recent_activities' => $user->activities()->latest()->limit(10)->get(),
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $user->load('profile');
        $formOptions = $this->getUserFormOptions();

        return view('admin.users.edit', array_merge(['user' => $user], $formOptions));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:user,agent,admin',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'date_of_joining' => 'nullable|date',
            'basic_salary' => 'nullable|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'employee_id' => ['nullable', 'string', 'max:50', Rule::unique('user_profiles')->ignore($user->profile?->id)],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:100',
            'bank_account_number' => 'nullable|string|max:50',
            'ifsc_code' => 'nullable|string|max:20',
            'pan_number' => 'nullable|string|max:20',
            'aadhar_number' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Update user basic info
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);

            // Handle profile picture upload
            $profilePicture = $user->profile?->profile_picture;
            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture
                if ($profilePicture && File::exists(public_path($profilePicture))) {
                    File::delete(public_path($profilePicture));
                }
                
                $file = $request->file('profile_picture');
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $uploadPath = public_path('uploads/user-profiles');
                
                // Create directory if it doesn't exist
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }
                
                // Move file to uploads directory
                $file->move($uploadPath, $fileName);
                $profilePicture = 'uploads/user-profiles/' . $fileName;
            }

            // Calculate total salary
            $basicSalary = $request->basic_salary ?? 0;
            $allowances = $request->allowances ?? 0;
            $totalSalary = $basicSalary + $allowances;

            // Update or create user profile
            $profileData = [
                'phone' => $request->phone,
                'department' => $request->department,
                'designation' => $request->designation,
                'date_of_joining' => $request->date_of_joining,
                'basic_salary' => $basicSalary,
                'allowances' => $allowances,
                'total_salary' => $totalSalary,
                'employee_id' => $request->employee_id,
                'profile_picture' => $profilePicture,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
                'bank_name' => $request->bank_name,
                'bank_account_number' => $request->bank_account_number,
                'ifsc_code' => $request->ifsc_code,
                'pan_number' => $request->pan_number,
                'aadhar_number' => $request->aadhar_number,
            ];

            if ($user->profile) {
                $user->profile->update($profileData);
            } else {
                $user->profile()->create($profileData);
            }

            // Log activity
            UserActivity::log(
                auth()->id(),
                'user_updated',
                'User Updated',
                "User '{$user->name}' profile was updated",
                'User',
                $user->id
            );

            return redirect()->route('admin.users.index')
                ->with('success', 'User updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating user: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Delete profile picture
            if ($user->profile?->profile_picture && File::exists(public_path($user->profile->profile_picture))) {
                File::delete(public_path($user->profile->profile_picture));
            }

            // Log activity before deletion
            UserActivity::log(
                auth()->id(),
                'user_deleted',
                'User Deleted',
                "User '{$user->name}' was deleted",
                'User',
                $user->id
            );

            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    /**
     * Toggle user active status.
     */
    public function toggleStatus(User $user)
    {
        try {
            $user->update(['is_active' => !$user->is_active]);
            
            $status = $user->is_active ? 'activated' : 'deactivated';
            
            // Log activity
            UserActivity::log(
                auth()->id(),
                'user_status_changed',
                'User Status Changed',
                "User '{$user->name}' was {$status}",
                'User',
                $user->id
            );

            return response()->json([
                'success' => true,
                'message' => "User {$status} successfully!",
                'is_active' => $user->is_active
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating user status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle portal access.
     */
    public function togglePortalAccess(User $user)
    {
        try {
            if (!$user->profile) {
                $user->profile()->create(['user_id' => $user->id]);
            }

            $user->profile->update([
                'is_portal_active' => !$user->profile->is_portal_active
            ]);

            $status = $user->profile->is_portal_active ? 'enabled' : 'disabled';
            
            // Log activity
            UserActivity::log(
                auth()->id(),
                'portal_access_changed',
                'Portal Access Changed',
                "Portal access for user '{$user->name}' was {$status}",
                'User',
                $user->id
            );

            return response()->json([
                'success' => true,
                'message' => "Portal access {$status} successfully!",
                'is_portal_active' => $user->profile->is_portal_active
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating portal access: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user activities.
     */
    public function activities(User $user)
    {
        $activities = $user->activities()
            ->with('user')
            ->latest()
            ->paginate(20);

        return view('admin.users.activities', compact('user', 'activities'));
    }

    /**
     * Export users data.
     */
    public function export(Request $request)
    {
        $users = User::with('profile')->get();
        
        $filename = 'users_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Role', 'Status', 'Employee ID', 'Department', 
                'Designation', 'Date of Joining', 'Basic Salary', 'Allowances', 'Total Salary',
                'Phone', 'Address', 'City', 'State', 'Country'
            ]);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->role,
                    $user->is_active ? 'Active' : 'Inactive',
                    $user->profile?->employee_id ?? '',
                    $user->profile?->department ?? '',
                    $user->profile?->designation ?? '',
                    $user->profile?->date_of_joining?->format('Y-m-d') ?? '',
                    $user->profile?->basic_salary ?? '',
                    $user->profile?->allowances ?? '',
                    $user->profile?->total_salary ?? '',
                    $user->profile?->phone ?? '',
                    $user->profile?->address ?? '',
                    $user->profile?->city ?? '',
                    $user->profile?->state ?? '',
                    $user->profile?->country ?? '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Assign loan to user.
     */
    public function assignLoan(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
            'advance_date' => 'required|date',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $loan = $user->salaryAdvances()->create([
                'amount' => $request->amount,
                'advance_date' => $request->advance_date,
                'description' => $request->description,
                'status' => 'pending',
                'created_by' => auth()->id(),
            ]);

            // Log activity
            UserActivity::log(
                auth()->id(),
                'loan_assigned',
                'Loan Assigned',
                "Loan of ₹{$request->amount} assigned to user '{$user->name}'",
                'SalaryAdvance',
                $loan->id
            );

            return response()->json([
                'success' => true,
                'message' => 'Loan assigned successfully!',
                'loan' => $loan
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error assigning loan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Settle loan for user.
     */
    public function settleLoan(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'loan_id' => 'required|exists:salary_advances,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $loan = SalaryAdvance::findOrFail($request->loan_id);
            
            // Verify the loan belongs to the user
            if ($loan->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Loan does not belong to this user'
                ], 403);
            }

            $loan->settle('manual');

            // Log activity
            UserActivity::log(
                auth()->id(),
                'loan_settled',
                'Loan Settled',
                "Loan of ₹{$loan->amount} for user '{$user->name}' was settled",
                'SalaryAdvance',
                $loan->id
            );

            return response()->json([
                'success' => true,
                'message' => 'Loan settled successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error settling loan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get loan details for modal.
     */
    public function loanDetails(Request $request, User $user)
    {
        $loan = SalaryAdvance::findOrFail($request->loan_id);
        
        // Verify the loan belongs to the user
        if ($loan->user_id !== $user->id) {
            abort(403);
        }

        $installments = $loan->installments()->latest()->get();
        
        return view('admin.users.partials.loan-details', compact('loan', 'installments'));
    }

    /**
     * Bulk actions on users.
     */
    public function bulkAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required|in:activate,deactivate,delete,export',
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $users = User::whereIn('id', $request->user_ids)->get();
            $count = 0;

            switch ($request->action) {
                case 'activate':
                    foreach ($users as $user) {
                        $user->update(['is_active' => true]);
                        $count++;
                    }
                    $message = "{$count} users activated successfully!";
                    break;

                case 'deactivate':
                    foreach ($users as $user) {
                        $user->update(['is_active' => false]);
                        $count++;
                    }
                    $message = "{$count} users deactivated successfully!";
                    break;

                case 'delete':
                    foreach ($users as $user) {
                        if ($user->profile?->profile_picture && File::exists(public_path($user->profile->profile_picture))) {
                            File::delete(public_path($user->profile->profile_picture));
                        }
                        $user->delete();
                        $count++;
                    }
                    $message = "{$count} users deleted successfully!";
                    break;

                case 'export':
                    // Handle export logic
                    $message = "Export completed for {$count} users!";
                    break;
            }

            // Log bulk action
            UserActivity::log(
                auth()->id(),
                'bulk_action',
                'Bulk Action Performed',
                "Bulk action '{$request->action}' performed on {$count} users"
            );

            return response()->json([
                'success' => true,
                'message' => $message,
                'count' => $count
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error performing bulk action: ' . $e->getMessage()
            ], 500);
        }
    }
}
