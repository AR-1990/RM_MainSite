<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkloadTask;
use App\Models\TaskAssignment;
use App\Models\TaskAttachment;
use App\Models\TaskComment;
use App\Models\TaskReminder;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WorkloadController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tasks' => WorkloadTask::count(),
            'pending_tasks' => WorkloadTask::pending()->count(),
            'in_progress_tasks' => WorkloadTask::inProgress()->count(),
            'completed_tasks' => WorkloadTask::completed()->count(),
            'overdue_tasks' => WorkloadTask::overdue()->count(),
            'due_today' => WorkloadTask::dueToday()->count(),
            'due_this_week' => WorkloadTask::dueThisWeek()->count(),
            'due_this_month' => WorkloadTask::dueThisMonth()->count(),
        ];

        $tasks = WorkloadTask::with(['assignments.user', 'attachments', 'comments'])
                    ->orderBy('due_date', 'asc')
                    ->paginate(15);

        return view('admin.workload.index', compact('tasks', 'stats'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.workload.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|string|in:low,medium,high,urgent',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'frequency' => 'required|in:daily,weekly,monthly,one_time',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:start_date',
            'reminder_time' => 'nullable|date_format:H:i',
            'is_recurring' => 'nullable',
            'recurring_interval' => 'nullable|integer|min:1',
            'assigned_users' => 'required|array|min:1',
            'assigned_users.*.user_id' => 'required|exists:users,id',
            'assigned_users.*.role' => 'required|in:assignee,reviewer,supervisor',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,txt,zip,rar|max:10240',
        ]);

        DB::beginTransaction();
        try {
            $task = WorkloadTask::create([
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => $request->status,
                'frequency' => $request->frequency,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'reminder_time' => $request->reminder_time,
                'is_recurring' => $request->has('is_recurring'),
                'recurring_interval' => $request->recurring_interval,
                'next_reminder_date' => $request->has('is_recurring') && $request->recurring_interval 
                    ? Carbon::parse($request->due_date)->addDays($request->recurring_interval) 
                    : $request->due_date,
            ]);

            // Assign users
            foreach ($request->assigned_users as $assignment) {
                $task->assignUser(
                    User::find($assignment['user_id']),
                    $assignment['role']
                );
            }

            // Handle file uploads
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    // Create directory if it doesn't exist
                    $uploadDir = public_path('uploads/workload/attachments');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    
                    // Generate unique filename
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $filePath = 'uploads/workload/attachments/' . $filename;
                    
                    // Move file to uploads directory
                    $file->move($uploadDir, $filename);
                    
                    $task->addAttachment([
                        'file_name' => $filename,
                        'file_path' => $filePath,
                        'file_type' => $file->getClientOriginalExtension(),
                        'original_name' => $file->getClientOriginalName(),
                        'file_size' => $file->getSize(),
                        'description' => null,
                    ], auth()->user());
                }
            }

            // Create reminders for assigned users
            if ($request->reminder_time) {
                foreach ($request->assigned_users as $assignment) {
                    $reminderTime = Carbon::parse($request->due_date)->setTimeFromTimeString($request->reminder_time);
                    $task->scheduleReminder(
                        User::find($assignment['user_id']),
                        $reminderTime
                    );
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Task created successfully!',
                'redirect' => route('admin.workload.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error creating task: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(WorkloadTask $task)
    {
        $task->load(['assignments.user', 'attachments', 'comments.user', 'reminders.user']);
        return view('admin.workload.show', compact('task'));
    }

    public function edit(WorkloadTask $task)
    {
        $users = User::all();
        $task->load(['assignments.user']);
        return view('admin.workload.edit', compact('task', 'users'));
    }

    public function update(Request $request, WorkloadTask $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'frequency' => 'required|in:daily,weekly,monthly,one_time',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:start_date',
            'reminder_time' => 'nullable|date_format:H:i',
            'is_recurring' => 'nullable',
            'recurring_interval' => 'nullable|integer|min:1',
            'assigned_users' => 'required|array|min:1',
            'assigned_users.*.user_id' => 'required|exists:users,id',
            'assigned_users.*.role' => 'required|in:assignee,reviewer,supervisor',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif,txt,zip,rar|max:10240',
        ]);

        DB::beginTransaction();
        try {
            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => $request->status,
                'frequency' => $request->frequency,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'reminder_time' => $request->reminder_time,
                'is_recurring' => $request->has('is_recurring'),
                'recurring_interval' => $request->recurring_interval,
            ]);

            // Update assignments
            $task->assignments()->delete();
            foreach ($request->assigned_users as $assignment) {
                $task->assignUser(
                    User::find($assignment['user_id']),
                    $assignment['role']
                );
            }

            // Handle new file uploads
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    // Create directory if it doesn't exist
                    $uploadDir = public_path('uploads/workload/attachments');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    
                    // Generate unique filename
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $filePath = 'uploads/workload/attachments/' . $filename;
                    
                    // Move file to uploads directory
                    $file->move($uploadDir, $filename);
                    
                    $task->addAttachment([
                        'file_name' => $filename,
                        'file_path' => $filePath,
                        'file_type' => $file->getClientOriginalExtension(),
                        'original_name' => $file->getClientOriginalName(),
                        'file_size' => $file->getSize(),
                        'description' => null,
                    ], auth()->user());
                }
            }

            // Update reminders
            $task->reminders()->delete();
            if ($request->reminder_time) {
                foreach ($request->assigned_users as $assignment) {
                    $reminderTime = Carbon::parse($request->due_date)->setTimeFromTimeString($request->reminder_time);
                    $task->scheduleReminder(
                        User::find($assignment['user_id']),
                        $reminderTime
                    );
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Task updated successfully!',
                'redirect' => route('admin.workload.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating task: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(WorkloadTask $task)
    {
        try {
            $task->delete();
            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting task: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(WorkloadTask $task)
    {
        try {
            $oldStatus = $task->status;
            $newStatus = $task->status === 'completed' ? 'pending' : 'completed';
            
            $task->update(['status' => $newStatus]);

            // Log the status change
            $task->logStatusChange($oldStatus, $newStatus);

            if ($newStatus === 'completed') {
                $task->markAsCompleted();
            }

            return response()->json([
                'success' => true,
                'message' => 'Task status updated successfully!',
                'new_status' => $newStatus
            ]);
        } catch (\Exception $e) {
            Log::error('Task status toggle failed: ' . $e->getMessage(), [
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error updating task status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function addComment(Request $request, WorkloadTask $task)
    {
        try {
            $request->validate([
                'comment' => 'required|string',
                'type' => 'required|in:comment,update,reminder,note',
                'is_internal' => 'nullable'
            ]);

            // Handle the is_internal field explicitly
            $isInternal = false;
            if ($request->has('is_internal') && $request->input('is_internal') !== null) {
                $isInternal = (bool) $request->input('is_internal');
            }

            $comment = $task->addComment(
                $request->comment,
                $isInternal,
                $request->type
            );

            // Log the comment addition
            $task->logCommentAdded($request->comment, $isInternal);

            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully!',
                'comment' => $comment->load('user')
            ]);
        } catch (\Exception $e) {
            Log::error('Comment addition failed: ' . $e->getMessage(), [
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error adding comment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function downloadAttachment(TaskAttachment $attachment)
    {
        try {
            // Build the correct file path
            $filePath = public_path($attachment->file_path);
            
            // Check if file exists
            if (!file_exists($filePath)) {
                Log::error('File not found for download', [
                    'attachment_id' => $attachment->id,
                    'file_path' => $attachment->file_path,
                    'full_path' => $filePath
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'File not found: ' . $attachment->original_name
                ], 404);
            }
            
            // Return file download response
            return response()->download($filePath, $attachment->original_name);
            
        } catch (\Exception $e) {
            Log::error('Attachment download failed: ' . $e->getMessage(), [
                'attachment_id' => $attachment->id,
                'file_path' => $attachment->file_path,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error downloading attachment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteAttachment(TaskAttachment $attachment)
    {
        try {
            $attachment->delete();
            return response()->json([
                'success' => true,
                'message' => 'Attachment deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting attachment: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getStats()
    {
        $stats = [
            'total_tasks' => WorkloadTask::count(),
            'pending_tasks' => WorkloadTask::pending()->count(),
            'in_progress_tasks' => WorkloadTask::inProgress()->count(),
            'completed_tasks' => WorkloadTask::completed()->count(),
            'overdue_tasks' => WorkloadTask::overdue()->count(),
            'due_today' => WorkloadTask::dueToday()->count(),
            'due_this_week' => WorkloadTask::dueThisWeek()->count(),
            'due_this_month' => WorkloadTask::dueThisMonth()->count(),
        ];

        return response()->json($stats);
    }

    public function export(Request $request)
    {
        $tasks = WorkloadTask::with(['assignments.user', 'attachments', 'comments'])
                    ->when($request->status, function($query, $status) {
                        return $query->where('status', $status);
                    })
                    ->when($request->priority, function($query, $priority) {
                        return $query->where('priority', $priority);
                    })
                    ->when($request->frequency, function($query, $frequency) {
                        return $query->where('frequency', $frequency);
                    })
                    ->get();

        $filename = 'workload_tasks_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($tasks) {
            $file = fopen('php://output', 'w');
            
            // CSV Headers
            fputcsv($file, [
                'ID', 'Title', 'Description', 'Priority', 'Status', 'Frequency',
                'Start Date', 'Due Date', 'Assigned Users', 'Attachments',
                'Comments', 'Created At'
            ]);

            // CSV Data
            foreach ($tasks as $task) {
                $assignedUsers = $task->assignments->map(function($assignment) {
                    return $assignment->user->name . ' (' . $assignment->role . ')';
                })->implode(', ');

                fputcsv($file, [
                    $task->id,
                    $task->title,
                    strip_tags($task->description),
                    ucfirst($task->priority),
                    ucfirst($task->status),
                    $task->frequency_text,
                    $task->start_date->format('Y-m-d'),
                    $task->due_date->format('Y-m-d'),
                    $assignedUsers,
                    $task->attachments->count(),
                    $task->comments->count(),
                    $task->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display audit logs for all tasks.
     */
    public function auditLogs(Request $request)
    {
        $query = \App\Models\TaskAuditLog::with(['task', 'user'])
                    ->orderBy('created_at', 'desc');

        // Filter by action
        if ($request->action) {
            $query->byAction($request->action);
        }

        // Filter by user
        if ($request->user_id) {
            $query->byUser($request->user_id);
        }

        // Filter by date range
        if ($request->date_from) {
            $query->where('created_at', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }

        // Filter by task
        if ($request->task_id) {
            $query->forTask($request->task_id);
        }

        $auditLogs = $query->paginate(50);
        $users = User::all();
        $tasks = WorkloadTask::all();
        $actions = \App\Models\TaskAuditLog::distinct('action')->pluck('action');

        return view('admin.workload.audit-logs', compact('auditLogs', 'users', 'tasks', 'actions'));
    }
}
