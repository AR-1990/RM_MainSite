<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\LeadComment;
use App\Models\LeadActivity;
use App\Models\LeadAttachment;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->getDataTable($request);
        }

        // Statistics
        $stats = [
            'total' => Lead::count(),
            'open' => Lead::where('status', Lead::STATUS_OPEN)->count(),
            'in_progress' => Lead::where('status', Lead::STATUS_IN_PROGRESS)->count(),
            'closed' => Lead::where('status', Lead::STATUS_CLOSED)->count(),
            'lost' => Lead::where('status', Lead::STATUS_LOST)->count(),
            'high_priority' => Lead::highPriority()->count(),
            'unassigned' => Lead::whereNull('assigned_to')->count(),
            'today' => Lead::whereDate('created_at', today())->count(),
            'this_week' => Lead::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Lead::whereMonth('created_at', now()->month)->count(),
        ];

        // Sources breakdown
        $sources = Lead::select('source', DB::raw('count(*) as count'))
            ->groupBy('source')
            ->get();

        // Status breakdown
        $statuses = Lead::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Priority breakdown
        $priorities = Lead::select('priority', DB::raw('count(*) as count'))
            ->groupBy('priority')
            ->get();

        // Users for assignment filter
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.leads.index', compact(
            'stats', 
            'sources', 
            'statuses', 
            'priorities', 
            'users'
        ));
    }

    /**
     * Get DataTable data for leads
     */
    public function getDataTable(Request $request)
    {
        $query = Lead::query();
        $totalRecords = Lead::count();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by source
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        // Filter by assigned user
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search
        $search = $request->input('search.value');

        if (!is_string($search) || $search === '') {
            $search = $request->input('search');
        }

        if (is_string($search) && $search !== '') {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('contact_name', 'like', "%{$search}%")
                  ->orWhere('contact_email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $filteredRecords = (clone $query)->count();

        // Ordering
        if ($request->filled('order')) {
            $columns = ['id', 'title', 'contact_name', 'source', 'status', 'priority', 'value', 'assigned_to', 'created_at'];
            $columnIndex = $request->input('order.0.column');
            $columnName = $columns[$columnIndex] ?? 'created_at';
            $columnDirection = $request->input('order.0.dir', 'desc');
            
            if ($columnName === 'assigned_to') {
                $query->leftJoin('users', 'leads.assigned_to', '=', 'users.id')
                      ->select('leads.*')
                      ->orderBy('users.name', $columnDirection);
            } else {
                $query->orderBy($columnName, $columnDirection);
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $leads = $query->with(['assignedUser', 'createdByUser'])
            ->skip($start)
            ->take($length)
            ->get();

        $data = [];
       
        foreach ($leads as $lead) {
            $data[] = [
                'checkbox' => '<input type="checkbox" name="leads[]" value="' . $lead->id . '" class="lead-checkbox">',
                'lead' => '<div><strong>' . e($lead->title) . '</strong>' . 
                         ($lead->company ? '<br><small class="text-muted">' . e($lead->company) . '</small>' : '') . '</div>',
                'contact' => '<div><strong>' . e($lead->contact_name) . '</strong><br>' .
                            '<small class="text-muted">' . e($lead->contact_email) . '</small>' .
                            ($lead->contact_phone ? '<br><small class="text-muted">' . e($lead->contact_phone) . '</small>' : '') . '</div>',
                'source' => $lead->source_badge,
                'status' => '<span class="badge badge-' . ($lead->status == 'open' ? 'info' : ($lead->status == 'in_progress' ? 'warning' : ($lead->status == 'closed' ? 'success' : ($lead->status == 'lost' ? 'danger' : 'secondary')))) . '">' . 
                           ucfirst(str_replace('_', ' ', $lead->status)) . '</span>',
                'priority' => '<span class="badge badge-' . ($lead->priority == 'low' ? 'secondary' : ($lead->priority == 'medium' ? 'info' : ($lead->priority == 'high' ? 'warning' : 'danger'))) . '">' . 
                             ucfirst($lead->priority) . '</span>',
                'value' => $lead->value ? $lead->currency . ' ' . number_format($lead->value, 2) : '-',
                'assigned_to' => $lead->assignedUser ? '<span class="badge badge-info">' . e($lead->assignedUser->name) . '</span>' : '<span class="badge badge-secondary">Unassigned</span>',
                'created' => $lead->created_at->format('M d, Y H:i'),
                'actions' => '<div class="btn-group" role="group">
                                <a href="' . route('admin.leads.show', $lead->id) . '" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="' . route('admin.leads.edit', $lead->id) . '" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteLead(' . $lead->id . ')" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>'
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    }

    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.leads.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'source' => 'required|in:' . implode(',', array_values(Lead::getSourceConstants())),
            'priority' => 'required|in:' . implode(',', array_values(Lead::getPriorityConstants())),
            'value' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'expected_close_date' => 'nullable|date|after:today',
            'assigned_to' => 'nullable|exists:users,id',
            'notes' => 'nullable|string'
        ]);

        $lead = Lead::create([
            'title' => $request->title,
            'description' => $request->description,
            'contact_name' => $request->contact_name,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'company' => $request->company,
            'source' => $request->source,
            'priority' => $request->priority,
            'value' => $request->value,
            'currency' => $request->currency ?? 'USD',
            'expected_close_date' => $request->expected_close_date,
            'assigned_to' => $request->assigned_to,
            'created_by' => auth()->id(),
            'notes' => $request->notes,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        // Log activity
        LeadActivity::logCreated($lead, auth()->id());

        return redirect()->route('admin.leads.index')
            ->with('success', 'Lead created successfully');
    }

    public function show($id)
    {
        $lead = Lead::with([
            'assignedUser', 
            'createdByUser', 
            'comments.user', 
            'activities.user',
            'attachments.user'
        ])->findOrFail($id);

        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.leads.show', compact('lead', 'users'));
    }

    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.leads.edit', compact('lead', 'users'));
    }

    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'source' => 'required|in:' . implode(',', array_values(Lead::getSourceConstants())),
            'status' => 'required|in:' . implode(',', array_values(Lead::getStatusConstants())),
            'priority' => 'required|in:' . implode(',', array_values(Lead::getPriorityConstants())),
            'value' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'expected_close_date' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
            'notes' => 'nullable|string'
        ]);

        $oldValues = $lead->only(['status', 'priority', 'assigned_to']);
        
        $lead->update($request->all());

        // Log activities for changes
        if ($oldValues['status'] !== $lead->status) {
            LeadActivity::logStatusChange($lead, auth()->id(), $oldValues['status'], $lead->status);
        }

        if ($oldValues['assigned_to'] !== $lead->assigned_to) {
            LeadActivity::logAssignment($lead, auth()->id(), $lead->assigned_to);
        }

        return redirect()->route('admin.leads.show', $lead->id)
            ->with('success', 'Lead updated successfully');
    }

    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()->route('admin.leads.index')
            ->with('success', 'Lead deleted successfully');
    }

    public function addComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'is_internal' => 'boolean'
        ]);

        $lead = Lead::findOrFail($id);

        $comment = LeadComment::create([
            'lead_id' => $lead->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'is_internal' => $request->boolean('is_internal')
        ]);

        // Log activity
        LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => auth()->id(),
            'action' => LeadActivity::ACTION_COMMENT_ADDED,
            'description' => 'Comment added: ' . Str::limit($request->comment, 50),
            'ip_address' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_values(Lead::getStatusConstants()))
        ]);

        $lead = Lead::findOrFail($id);
        $oldStatus = $lead->status;
        
        $lead->update(['status' => $request->status]);

        // Log activity
        LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => auth()->id(),
            'action' => LeadActivity::ACTION_STATUS_CHANGED,
            'description' => "Status changed from {$oldStatus} to {$request->status}",
            'ip_address' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Lead status updated successfully');
    }

    public function assign(Request $request, $id)
    {
        $request->validate([
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        $lead = Lead::findOrFail($id);
        $oldAssignedTo = $lead->assigned_to;
        
        $lead->update(['assigned_to' => $request->assigned_to]);

        // Log activity
        LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => auth()->id(),
            'action' => LeadActivity::ACTION_ASSIGNED,
            'description' => $request->assigned_to ? "Lead assigned to user ID: {$request->assigned_to}" : "Lead unassigned",
            'ip_address' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Lead assignment updated successfully');
    }

    public function deleteComment($leadId, $commentId)
    {
        $comment = LeadComment::where('lead_id', $leadId)
            ->where('id', $commentId)
            ->firstOrFail();

        // Check if user can delete this comment
        if (auth()->id() != $comment->user_id && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        // Log activity
        LeadActivity::create([
            'lead_id' => $leadId,
            'user_id' => auth()->id(),
            'action' => LeadActivity::ACTION_COMMENT_DELETED,
            'description' => 'Comment deleted',
            'ip_address' => request()->ip()
        ]);

        return response()->json(['success' => true]);
    }

    public function uploadAttachment(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'description' => 'nullable|string|max:255'
        ]);

        $lead = Lead::findOrFail($id);
        $file = $request->file('file');

        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('leads/' . $lead->id, $filename, 'public');

        LeadAttachment::create([
            'lead_id' => $lead->id,
            'user_id' => auth()->id(),
            'filename' => $filename,
            'original_filename' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'description' => $request->description
        ]);

        // Log activity
        LeadActivity::create([
            'lead_id' => $lead->id,
            'user_id' => auth()->id(),
            'action' => LeadActivity::ACTION_ATTACHMENT_ADDED,
            'description' => 'Attachment added: ' . $file->getClientOriginalName(),
            'ip_address' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'Attachment uploaded successfully');
    }

    public function downloadAttachment($id)
    {
        $attachment = LeadAttachment::findOrFail($id);
        
        $filePath = public_path($attachment->file_path);
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, $attachment->original_filename);
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:assign,change_status,change_priority,delete',
            'leads' => 'required|array',
            'leads.*' => 'exists:leads,id'
        ]);

        $leads = Lead::whereIn('id', $request->leads);

        switch ($request->action) {
            case 'assign':
                $request->validate(['assigned_to' => 'required|exists:users,id']);
                $leads->update(['assigned_to' => $request->assigned_to]);
                $message = 'Selected leads assigned successfully';
                break;

            case 'change_status':
                $request->validate(['status' => 'required|in:' . implode(',', array_values(Lead::getStatusConstants()))]);
                $leads->update(['status' => $request->status]);
                $message = 'Selected leads status updated successfully';
                break;

            case 'change_priority':
                $request->validate(['priority' => 'required|in:' . implode(',', array_values(Lead::getPriorityConstants()))]);
                $leads->update(['priority' => $request->priority]);
                $message = 'Selected leads priority updated successfully';
                break;

            case 'delete':
                $leads->delete();
                $message = 'Selected leads deleted successfully';
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    public function export(Request $request)
    {
        $leads = Lead::with(['assignedUser', 'createdByUser'])
            ->when($request->filled('status'), function($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('priority'), function($query) use ($request) {
                $query->where('priority', $request->priority);
            })
            ->when($request->filled('source'), function($query) use ($request) {
                $query->where('source', $request->source);
            })
            ->when($request->filled('assigned_to'), function($query) use ($request) {
                $query->where('assigned_to', $request->assigned_to);
            })
            ->get();

        $filename = 'leads_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($leads) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'ID', 'Title', 'Contact Name', 'Contact Email', 'Contact Phone', 
                'Company', 'Source', 'Status', 'Priority', 'Value', 'Currency',
                'Expected Close Date', 'Assigned To', 'Created By', 'Created At'
            ]);

            // Data
            foreach ($leads as $lead) {
                fputcsv($file, [
                    $lead->id,
                    $lead->title,
                    $lead->contact_name,
                    $lead->contact_email,
                    $lead->contact_phone,
                    $lead->company,
                    $lead->source_label,
                    $lead->status,
                    $lead->priority,
                    $lead->value,
                    $lead->currency,
                    $lead->expected_close_date ? $lead->expected_close_date->format('Y-m-d') : '',
                    $lead->assignedUser ? $lead->assignedUser->name : '',
                    $lead->createdByUser ? $lead->createdByUser->name : '',
                    $lead->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
