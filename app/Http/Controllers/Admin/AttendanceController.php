<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttendanceRecord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = AttendanceRecord::with(['user', 'approver']);

        // Apply filters
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        } else {
            // Default: show last 10 days on main page for better performance and usability
            $query->where('date', '>=', now()->subDays(10)->toDateString());
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('work_type')) {
            $query->where('work_type', $request->work_type);
        }

        if ($request->filled('is_approved')) {
            $query->where('is_approved', $request->boolean('is_approved'));
        }

        // Apply date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $attendanceRecords = $query->orderBy('date', 'desc')->orderBy('user_id')->paginate(20);
        $users = User::where('is_active', true)->orderBy('name')->get();

        // Get statistics
        $stats = $this->getStats($request);

        return view('admin.attendance.index', compact('attendanceRecords', 'users', 'stats'));
    }

    public function create()
    {
        $users = User::where('is_active', true)->orderBy('name')->get();
        return view('admin.attendance.create', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'date' => 'required|date|before_or_equal:today',
                'check_in_time' => 'nullable|date_format:H:i',
                'check_out_time' => 'nullable|date_format:H:i|after:check_in_time',
                'break_start_time' => 'nullable|date_format:H:i',
                'break_end_time' => 'nullable|date_format:H:i|after:break_start_time',
                'status' => 'required|in:present,absent,late,half_day,outdoor,leave',
                'work_type' => 'required|in:office,outdoor,remote,meeting',
                'location' => 'nullable|string|max:255',
                'work_description' => 'nullable|string|max:1000',
                'comments' => 'nullable|string|max:1000',
                'break_hours' => 'nullable|numeric|min:0|max:24',
                'is_approved' => 'nullable|boolean',
                'expected_check_in' => 'nullable|date_format:H:i',
                'expected_check_out' => 'nullable|date_format:H:i',
                'attendance_note' => 'nullable|string|max:1000'
            ]);

            // Check if attendance record already exists for this user and date
            $existingRecord = AttendanceRecord::where('user_id', $request->user_id)
                ->where('date', $request->date)
                ->first();

            if ($existingRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Attendance record already exists for this user and date.'
                ], 422);
            }

            $data = $request->all();
            
            // Handle empty values for numeric fields
            if (empty($data['break_hours'])) {
                $data['break_hours'] = 0;
            }
            
            // Handle empty string values for numeric fields
            if ($data['break_hours'] === '') {
                $data['break_hours'] = 0;
            }
            
            // Ensure break_hours is numeric
            $data['break_hours'] = floatval($data['break_hours'] ?? 0);
            
            // Calculate total hours if both check-in and check-out times are provided
            if ($request->check_in_time && $request->check_out_time) {
                $checkIn = Carbon::parse($request->check_in_time);
                $checkOut = Carbon::parse($request->check_out_time);
                $totalMinutes = $checkOut->diffInMinutes($checkIn);
                $breakMinutes = $data['break_hours'] * 60;
                $data['total_hours'] = round(($totalMinutes - $breakMinutes) / 60, 2);
            }

            // Calculate late minutes and overtime if expected times are provided
            if ($request->expected_check_in && $request->check_in_time) {
                $expectedCheckIn = Carbon::parse($request->expected_check_in);
                $actualCheckIn = Carbon::parse($request->check_in_time);
                
                if ($actualCheckIn->gt($expectedCheckIn)) {
                    $data['late_minutes'] = $actualCheckIn->diffInMinutes($expectedCheckIn);
                    $data['is_late'] = true;
                } else {
                    $data['late_minutes'] = 0;
                    $data['is_late'] = false;
                }
            }

            if ($request->expected_check_out && $request->check_out_time) {
                $expectedCheckOut = Carbon::parse($request->expected_check_out);
                $actualCheckOut = Carbon::parse($request->check_out_time);
                
                if ($actualCheckOut->gt($expectedCheckOut)) {
                    $data['overtime_hours'] = round($actualCheckOut->diffInMinutes($expectedCheckOut) / 60, 2);
                } else {
                    $data['overtime_hours'] = 0;
                }
            }

            $attendanceRecord = AttendanceRecord::create($data);

            Log::info('Attendance record created', [
                'id' => $attendanceRecord->id,
                'user_id' => $attendanceRecord->user_id,
                'date' => $attendanceRecord->date,
                'status' => $attendanceRecord->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Attendance record created successfully.',
                'data' => $attendanceRecord->load('user')
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating attendance record: ' . $e->getMessage(), [
                'request' => $request->all(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error creating attendance record: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(AttendanceRecord $attendanceRecord)
    {
        $attendanceRecord->load(['user', 'approver']);
        return view('admin.attendance.show', compact('attendanceRecord'));
    }

    public function edit(AttendanceRecord $attendanceRecord)
    {
        $users = User::where('is_active', true)->orderBy('name')->get();
        return view('admin.attendance.edit', compact('attendanceRecord', 'users'));
    }

    public function update(Request $request, AttendanceRecord $attendanceRecord)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'date' => 'required|date|before_or_equal:today',
                'check_in_time' => 'nullable|date_format:H:i',
                'check_out_time' => 'nullable|date_format:H:i|after:check_in_time',
                'break_start_time' => 'nullable|date_format:H:i',
                'break_end_time' => 'nullable|date_format:H:i|after:break_start_time',
                'status' => 'required|in:present,absent,late,half_day,outdoor,leave',
                'work_type' => 'required|in:office,outdoor,remote,meeting',
                'location' => 'nullable|string|max:255',
                'work_description' => 'nullable|string|max:1000',
                'comments' => 'nullable|string|max:1000',
                'break_hours' => 'nullable|numeric|min:0|max:24',
                'is_approved' => 'nullable|boolean',
                'expected_check_in' => 'nullable|date_format:H:i',
                'expected_check_out' => 'nullable|date_format:H:i',
                'attendance_note' => 'nullable|string|max:1000'
            ]);

            // Check if attendance record already exists for this user and date (excluding current record)
            $existingRecord = AttendanceRecord::where('user_id', $request->user_id)
                ->where('date', $request->date)
                ->where('id', '!=', $attendanceRecord->id)
                ->first();

            if ($existingRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Attendance record already exists for this user and date.'
                ], 422);
            }

            $data = $request->all();
            
            // Handle empty values for numeric fields
            if (empty($data['break_hours'])) {
                $data['break_hours'] = 0;
            }
            
            // Handle empty string values for numeric fields
            if ($data['break_hours'] === '') {
                $data['break_hours'] = 0;
            }
            
            // Ensure break_hours is numeric
            $data['break_hours'] = floatval($data['break_hours'] ?? 0);
            
            // Calculate total hours if both check-in and check-out times are provided
            if ($request->check_in_time && $request->check_out_time) {
                $checkIn = Carbon::parse($request->check_in_time);
                $checkOut = Carbon::parse($request->check_out_time);
                $totalMinutes = $checkOut->diffInMinutes($checkIn);
                $breakMinutes = $data['break_hours'] * 60;
                $data['total_hours'] = round(($totalMinutes - $breakMinutes) / 60, 2);
            }

            // Calculate late minutes and overtime if expected times are provided
            if ($request->expected_check_in && $request->check_in_time) {
                $expectedCheckIn = Carbon::parse($request->expected_check_in);
                $actualCheckIn = Carbon::parse($request->check_in_time);
                
                if ($actualCheckIn->gt($expectedCheckIn)) {
                    $data['late_minutes'] = $actualCheckIn->diffInMinutes($expectedCheckIn);
                    $data['is_late'] = true;
                } else {
                    $data['late_minutes'] = 0;
                    $data['is_late'] = false;
                }
            }

            if ($request->expected_check_out && $request->check_out_time) {
                $expectedCheckOut = Carbon::parse($request->expected_check_out);
                $actualCheckOut = Carbon::parse($request->check_out_time);
                
                if ($actualCheckOut->gt($expectedCheckOut)) {
                    $data['overtime_hours'] = round($actualCheckOut->diffInMinutes($expectedCheckOut) / 60, 2);
                } else {
                    $data['overtime_hours'] = 0;
                }
            }

            $attendanceRecord->update($data);

            Log::info('Attendance record updated', [
                'id' => $attendanceRecord->id,
                'user_id' => $attendanceRecord->user_id,
                'date' => $attendanceRecord->date,
                'status' => $attendanceRecord->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Attendance record updated successfully.',
                'data' => $attendanceRecord->load('user')
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating attendance record: ' . $e->getMessage(), [
                'id' => $attendanceRecord->id,
                'request' => $request->all(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error updating attendance record: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(AttendanceRecord $attendanceRecord)
    {
        try {
            $id = $attendanceRecord->id;
            $attendanceRecord->delete();

            Log::info('Attendance record deleted', ['id' => $id]);

            return response()->json([
                'success' => true,
                'message' => 'Attendance record deleted successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting attendance record: ' . $e->getMessage(), [
                'id' => $attendanceRecord->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error deleting attendance record: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleApproval(AttendanceRecord $attendanceRecord)
    {
        try {
            if ($attendanceRecord->is_approved) {
                $attendanceRecord->update([
                    'is_approved' => false,
                    'approved_by' => null,
                    'approved_at' => null
                ]);
                $message = 'Attendance record approval removed.';
            } else {
                $attendanceRecord->markAsApproved(auth()->id());
                $message = 'Attendance record approved successfully.';
            }

            Log::info('Attendance record approval toggled', [
                'id' => $attendanceRecord->id,
                'is_approved' => $attendanceRecord->is_approved,
                'approved_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => $message,
                'is_approved' => $attendanceRecord->is_approved
            ]);

        } catch (\Exception $e) {
            Log::error('Error toggling attendance approval: ' . $e->getMessage(), [
                'id' => $attendanceRecord->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error toggling attendance approval: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkAction(Request $request)
    {
        try {
            $request->validate([
                'action' => 'required|in:approve,delete,status_change',
                'record_ids' => 'required|array|min:1',
                'record_ids.*' => 'exists:attendance_records,id'
            ]);

            $recordIds = $request->record_ids;
            $action = $request->action;

            DB::beginTransaction();

            switch ($action) {
                case 'approve':
                    AttendanceRecord::whereIn('id', $recordIds)->update([
                        'is_approved' => true,
                        'approved_by' => auth()->id(),
                        'approved_at' => now()
                    ]);
                    $message = count($recordIds) . ' attendance records approved successfully.';
                    break;

                case 'delete':
                    AttendanceRecord::whereIn('id', $recordIds)->delete();
                    $message = count($recordIds) . ' attendance records deleted successfully.';
                    break;

                case 'status_change':
                    $request->validate(['new_status' => 'required|in:present,absent,late,half_day,outdoor,leave']);
                    AttendanceRecord::whereIn('id', $recordIds)->update(['status' => $request->new_status]);
                    $message = count($recordIds) . ' attendance records status updated successfully.';
                    break;
            }

            DB::commit();

            Log::info('Bulk action performed on attendance records', [
                'action' => $action,
                'record_ids' => $recordIds,
                'performed_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Error performing bulk action on attendance records: ' . $e->getMessage(), [
                'action' => $request->action ?? 'unknown',
                'record_ids' => $request->record_ids ?? [],
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error performing bulk action: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getStats(Request $request)
    {
        try {
            $query = AttendanceRecord::query();

            // Apply date filter
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('date', [$request->start_date, $request->end_date]);
            } else {
                $query->where('date', '>=', now()->subDays(30));
            }

            $stats = [
                'total_records' => $query->count(),
                'present' => $query->where('status', 'present')->count(),
                'absent' => $query->where('status', 'absent')->count(),
                'late' => $query->where('status', 'late')->count(),
                'outdoor' => $query->where('status', 'outdoor')->count(),
                'leave' => $query->where('status', 'leave')->count(),
                'half_day' => $query->where('status', 'half_day')->count(),
                'pending_approval' => $query->where('is_approved', false)->count(),
                'approved' => $query->where('is_approved', true)->count(),
                'office_work' => $query->where('work_type', 'office')->count(),
                'outdoor_work' => $query->where('work_type', 'outdoor')->count(),
                'remote_work' => $query->where('work_type', 'remote')->count(),
                'meetings' => $query->where('work_type', 'meeting')->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting attendance stats: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error getting attendance statistics: ' . $e->getMessage()
            ], 500);
        }
    }

    public function export(Request $request)
    {
        try {
            $query = AttendanceRecord::with(['user', 'approver']);

            // Apply filters
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('date', [$request->start_date, $request->end_date]);
            }

            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('work_type')) {
                $query->where('work_type', $request->work_type);
            }

            $records = $query->orderBy('date', 'desc')->orderBy('user_id')->get();

            $filename = 'attendance_export_' . now()->format('Y-m-d_H-i-s') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($records) {
                $file = fopen('php://output', 'w');
                
                // CSV Headers
                fputcsv($file, [
                    'Date', 'Employee Name', 'Status', 'Work Type', 'Check In', 'Check Out',
                    'Total Hours', 'Break Hours', 'Location', 'Work Description', 'Comments',
                    'Approved', 'Approved By', 'Approved At'
                ]);

                // CSV Data
                foreach ($records as $record) {
                    fputcsv($file, [
                        $record->formatted_date,
                        $record->user->name ?? 'N/A',
                        ucfirst($record->status),
                        ucfirst($record->work_type),
                        $record->formatted_check_in_time,
                        $record->formatted_check_out_time,
                        $record->formatted_total_hours,
                        $record->break_hours . ' hrs',
                        $record->location ?? 'N/A',
                        $record->work_description ?? 'N/A',
                        $record->comments ?? 'N/A',
                        $record->is_approved ? 'Yes' : 'No',
                        $record->approver->name ?? 'N/A',
                        $record->approved_at ? $record->approved_at->format('d M Y H:i') : 'N/A'
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error('Error exporting attendance records: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error exporting attendance records: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show individual user attendance profile
     */
    public function userProfile(Request $request, $userId)
    {
        try {
            $user = User::findOrFail($userId);
            
            $query = AttendanceRecord::where('user_id', $userId);

            // Apply date range filter
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('date', [$request->start_date, $request->end_date]);
            } else {
                // Default to current month
                $query->whereMonth('date', now()->month)->whereYear('date', now()->year);
            }

            $attendanceRecords = $query->orderBy('date', 'desc')->paginate(30);
            
            // Get user statistics
            $stats = $this->getUserAttendanceStats($userId, $request);
            
            // Get monthly trends
            $monthlyTrends = $this->getMonthlyTrends($userId);
            
            // Get late patterns
            $latePatterns = $this->getLatePatterns($userId);

            return view('admin.attendance.user-profile', compact(
                'user', 
                'attendanceRecords', 
                'stats', 
                'monthlyTrends', 
                'latePatterns'
            ));

        } catch (\Exception $e) {
            Log::error('Error showing user attendance profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading user attendance profile.');
        }
    }

    /**
     * Get enhanced statistics with late calculation
     */
    public function getEnhancedStats(Request $request)
    {
        // If it's an AJAX request, return JSON data for individual employee stats
        if ($request->ajax()) {
            try {
                $userId = $request->user_id;
                $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
                $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

                $query = AttendanceRecord::where('user_id', $userId)
                    ->whereBetween('date', [$startDate, $endDate]);

                $totalRecords = $query->count();
                
                // Status counts
                $statusCounts = $query->clone()
                    ->selectRaw('status, COUNT(*) as count')
                    ->groupBy('status')
                    ->pluck('count', 'status')
                    ->toArray();

                // Late statistics
                $lateStats = $query->clone()
                    ->where('is_late', true)
                    ->selectRaw('
                        COUNT(*) as total_late,
                        AVG(late_minutes) as avg_late_minutes,
                        MAX(late_minutes) as max_late_minutes,
                        SUM(late_minutes) as total_late_minutes
                    ')
                    ->first();

                // Work type distribution
                $workTypeStats = $query->clone()
                    ->selectRaw('work_type, COUNT(*) as count')
                    ->groupBy('work_type')
                    ->pluck('count', 'work_type')
                    ->toArray();

                // Approval status
                $approvalStats = $query->clone()
                    ->selectRaw('is_approved, COUNT(*) as count')
                    ->groupBy('is_approved')
                    ->pluck('count', 'is_approved')
                    ->toArray();

                // Overtime statistics
                $overtimeStats = $query->clone()
                    ->where('overtime_hours', '>', 0)
                    ->selectRaw('
                        COUNT(*) as total_overtime,
                        AVG(overtime_hours) as avg_overtime,
                        SUM(overtime_hours) as total_overtime_hours
                    ')
                    ->first();

                // Get detailed attendance records
                $attendanceRecords = $query->clone()
                    ->orderBy('date', 'desc')
                    ->get();

                $stats = [
                    'total_records' => $totalRecords,
                    'status_counts' => $statusCounts,
                    'late_stats' => $lateStats,
                    'work_type_stats' => $workTypeStats,
                    'approval_stats' => $approvalStats,
                    'overtime_stats' => $overtimeStats,
                    'attendance_records' => $attendanceRecords,
                    'date_range' => [
                        'start' => $startDate,
                        'end' => $endDate
                    ]
                ];

                return response()->json([
                    'success' => true,
                    'data' => $stats
                ]);

            } catch (\Exception $e) {
                Log::error('Error getting employee attendance stats: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error getting employee statistics: ' . $e->getMessage()
                ], 500);
            }
        }

        // If it's a regular browser request, return the view with employees list
        try {
            $employees = \App\Models\User::where('role', '!=', 'admin')->orderBy('name')->get();
            \Log::info('Employees fetched successfully', ['count' => $employees->count()]);
            return view('admin.attendance.employee-stats', compact('employees'));
        } catch (\Exception $e) {
            \Log::error('Error fetching employees: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Export enhanced CSV with late calculation
     */
    public function exportEnhanced(Request $request)
    {
        try {
            $query = AttendanceRecord::with(['user', 'approver']);

            // Apply filters
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('date', [$request->start_date, $request->end_date]);
            }

            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('work_type')) {
                $query->where('work_type', $request->work_type);
            }

            if ($request->filled('late_filter')) {
                if ($request->late_filter === 'late') {
                    $query->where('is_late', true);
                } elseif ($request->late_filter === 'on_time') {
                    $query->where('is_late', false);
                }
            }

            $records = $query->orderBy('date', 'desc')->orderBy('user_id')->get();

            $filename = 'enhanced_attendance_export_' . now()->format('Y-m-d_H-i-s') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($records) {
                $file = fopen('php://output', 'w');
                
                // Enhanced CSV Headers
                fputcsv($file, [
                    'Date', 'Employee Name', 'Status', 'Work Type', 'Check In', 'Check Out',
                    'Expected Check In', 'Expected Check Out', 'Late Minutes', 'Is Late',
                    'Late Status', 'Total Hours', 'Break Hours', 'Overtime Hours',
                    'Location', 'Work Description', 'Comments', 'Attendance Note',
                    'Approved', 'Approved By', 'Approved At'
                ]);

                // Enhanced CSV Data
                foreach ($records as $record) {
                    // Calculate late minutes if not set
                    if (!$record->late_minutes && $record->check_in_time) {
                        $record->late_minutes = $record->calculateLateMinutes();
                    }

                    fputcsv($file, [
                        $record->formatted_date,
                        $record->user->name ?? 'N/A',
                        ucfirst($record->status),
                        ucfirst($record->work_type),
                        $record->formatted_check_in_time,
                        $record->formatted_check_out_time,
                        $record->expected_check_in ? Carbon::parse($record->expected_check_in)->format('H:i') : '09:00',
                        $record->expected_check_out ? Carbon::parse($record->expected_check_out)->format('H:i') : '18:00',
                        $record->late_minutes ?? 0,
                        $record->is_late ? 'Yes' : 'No',
                        $record->late_status,
                        $record->formatted_total_hours,
                        $record->break_hours . ' hrs',
                        $record->overtime_hours . ' hrs',
                        $record->location ?? 'N/A',
                        $record->work_description ?? 'N/A',
                        $record->comments ?? 'N/A',
                        $record->attendance_note ?? 'N/A',
                        $record->is_approved ? 'Yes' : 'No',
                        $record->approver->name ?? 'N/A',
                        $record->approved_at ? $record->approved_at->format('d M Y H:i') : 'N/A'
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error('Error exporting enhanced attendance records: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error exporting enhanced attendance records: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user-specific attendance statistics
     */
    private function getUserAttendanceStats($userId, $request)
    {
        $query = AttendanceRecord::where('user_id', $userId);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $totalDays = $query->count();
        $presentDays = $query->where('status', 'present')->count();
        $lateDays = $query->where('is_late', true)->count();
        $absentDays = $query->where('status', 'absent')->count();
        $leaveDays = $query->where('status', 'leave')->count();
        $outdoorDays = $query->where('status', 'outdoor')->count();

        $totalLateMinutes = $query->where('is_late', true)->sum('late_minutes');
        $avgLateMinutes = $lateDays > 0 ? round($totalLateMinutes / $lateDays, 1) : 0;

        $totalOvertime = $query->where('overtime_hours', '>', 0)->sum('overtime_hours');
        $avgOvertime = $query->where('overtime_hours', '>', 0)->avg('overtime_hours');

        return [
            'total_days' => $totalDays,
            'present_days' => $presentDays,
            'late_days' => $lateDays,
            'absent_days' => $absentDays,
            'leave_days' => $leaveDays,
            'outdoor_days' => $outdoorDays,
            'attendance_rate' => $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 0,
            'late_rate' => $totalDays > 0 ? round(($lateDays / $totalDays) * 100, 1) : 0,
            'total_late_minutes' => $totalLateMinutes,
            'avg_late_minutes' => $avgLateMinutes,
            'total_overtime_hours' => round($totalOvertime, 2),
            'avg_overtime_hours' => round($avgOvertime, 2)
        ];
    }

    /**
     * Get monthly attendance trends for a user
     */
    private function getMonthlyTrends($userId)
    {
        $raw = AttendanceRecord::where('user_id', $userId)
            ->whereYear('date', now()->year)
            ->selectRaw('
                MONTH(date) as month,
                COUNT(*) as total_days,
                SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) as present_days,
                SUM(CASE WHEN is_late = 1 THEN 1 ELSE 0 END) as late_days,
                AVG(late_minutes) as avg_late_minutes
            ')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $byMonth = [];
        foreach ($raw as $row) {
            $byMonth[(int) $row->month] = $row;
        }

        $result = collect();
        for ($m = 1; $m <= 12; $m++) {
            if (isset($byMonth[$m])) {
                $src = $byMonth[$m];
                $totalDays = (int) $src->total_days;
                $presentDays = (int) $src->present_days;
                $lateDays = (int) $src->late_days;
                $avgLateMinutes = (float) ($src->avg_late_minutes ?? 0);
            } else {
                $totalDays = 0;
                $presentDays = 0;
                $lateDays = 0;
                $avgLateMinutes = 0;
            }

            $obj = (object) [
                'month' => $m,
                'total_days' => $totalDays,
                'present_days' => $presentDays,
                'late_days' => $lateDays,
                'avg_late_minutes' => $avgLateMinutes,
            ];

            $result->push($obj);
        }

        return $result->map(function ($item) {
            $item->month_name = Carbon::create()->month($item->month)->format('M');
            $item->attendance_rate = $item->total_days > 0 ? round(($item->present_days / $item->total_days) * 100, 1) : 0;
            return $item;
        });
    }

    /**
     * Get late patterns for a user
     */
    private function getLatePatterns($userId)
    {
        $raw = AttendanceRecord::where('user_id', $userId)
            ->where('is_late', true)
            ->selectRaw('
                HOUR(check_in_time) as hour,
                COUNT(*) as count,
                AVG(late_minutes) as avg_late_minutes
            ')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $byHour = [];
        foreach ($raw as $row) {
            $byHour[(int) $row->hour] = $row;
        }

        $result = collect();
        for ($h = 0; $h <= 23; $h++) {
            if (isset($byHour[$h])) {
                $src = $byHour[$h];
                $count = (int) $src->count;
                $avg = (float) ($src->avg_late_minutes ?? 0);
            } else {
                $count = 0;
                $avg = 0;
            }
            $obj = (object) [
                'hour' => $h,
                'count' => $count,
                'avg_late_minutes' => $avg,
            ];
            $result->push($obj);
        }

        return $result;
    }

    /**
     * Process late calculation for existing records
     */
    public function processLateCalculation()
    {
        try {
            $records = AttendanceRecord::whereNotNull('check_in_time')
                ->whereNull('late_minutes')
                ->get();

            $processed = 0;
            foreach ($records as $record) {
                $lateMinutes = $record->calculateLateMinutes();
                $overtimeHours = $record->calculateOvertimeHours();
                
                $record->update([
                    'late_minutes' => $lateMinutes,
                    'is_late' => $lateMinutes > 0,
                    'overtime_hours' => $overtimeHours
                ]);
                
                $processed++;
            }

            return response()->json([
                'success' => true,
                'message' => "Processed {$processed} attendance records for late calculation."
            ]);

        } catch (\Exception $e) {
            Log::error('Error processing late calculation: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error processing late calculation: ' . $e->getMessage()
            ], 500);
        }
    }
}
