<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with(['property', 'agent', 'assignedUser', 'createdByUser'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by lead status
        if ($request->filled('lead_status')) {
            $query->where('lead_status', $request->lead_status);
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
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->paginate(20);

        // Statistics
        $stats = [
            'total' => Contact::count(),
            'new' => Contact::where('status', 'new')->count(),
            'unread' => Contact::where('is_read', false)->count(),
            'today' => Contact::whereDate('created_at', today())->count(),
            'this_week' => Contact::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Contact::whereMonth('created_at', now()->month)->count(),
        ];

        // Lead statistics
        $leadStats = [
            'total_leads' => Contact::whereNotNull('lead_created_at')->count(),
            'new_leads' => Contact::where('lead_status', 'new')->count(),
            'open_leads' => Contact::where('lead_status', 'open')->count(),
            'in_progress_leads' => Contact::where('lead_status', 'in_progress')->count(),
            'closed_leads' => Contact::where('lead_status', 'closed')->count(),
            'unassigned_leads' => Contact::whereNotNull('lead_created_at')->whereNull('assigned_to')->count(),
        ];

        // Sources breakdown
        $sources = Contact::select('source', DB::raw('count(*) as count'))
            ->groupBy('source')
            ->get();

        // Status breakdown
        $statuses = Contact::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Lead status breakdown
        $leadStatuses = Contact::whereNotNull('lead_created_at')
            ->select('lead_status', DB::raw('count(*) as count'))
            ->groupBy('lead_status')
            ->get();

        // Available users for assignment
        $users = User::active()->get();

        return view('admin.contacts.index', compact(
            'contacts', 'stats', 'leadStats', 'sources', 'statuses', 'leadStatuses', 'users'
        ));
    }

    public function show($id)
    {
        $contact = Contact::with(['property', 'agent', 'assignedUser', 'createdByUser', 'comments.user'])
            ->findOrFail($id);
        
        // Mark as read
        if (!$contact->is_read) {
            $contact->update([
                'is_read' => true,
                'status' => 'read',
                'read_at' => now()
            ]);
        }

        // Mark as lead if not already
        if (!$contact->lead_created_at) {
            $contact->markAsLead();
        }

        // Available users for assignment
        $users = User::active()->get();

        return view('admin.contacts.show', compact('contact', 'users'));
    }

    public function updateStatus(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:new,read,replied,closed',
            'notes' => 'nullable|string'
        ]);

        $contact->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'replied_at' => $request->status === 'replied' ? now() : null
        ]);

        return redirect()->back()->with('success', 'Contact status updated successfully');
    }

    public function updateLeadStatus(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        
        $request->validate([
            'lead_status' => 'required|in:new,open,in_progress,closed,lost,cancel',
            'lead_notes' => 'nullable|string',
            'lead_value' => 'nullable|numeric|min:0',
            'lead_currency' => 'nullable|string|size:3',
            'expected_close_date' => 'nullable|date',
            'lead_tags' => 'nullable|string'
        ]);

        $data = [
            'lead_status' => $request->lead_status,
            'lead_notes' => $request->lead_notes,
            'lead_value' => $request->lead_value,
            'lead_currency' => $request->lead_currency,
            'expected_close_date' => $request->expected_close_date,
        ];

        // Parse tags if provided
        if ($request->filled('lead_tags')) {
            $tags = array_filter(array_map('trim', explode(',', $request->lead_tags)));
            $data['lead_tags'] = $tags;
        }

        $contact->update($data);

        return redirect()->back()->with('success', 'Lead status updated successfully');
    }

    public function assignLead(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        
        $request->validate([
            'assigned_to' => 'required|exists:users,id'
        ]);

        $contact->assignTo($request->assigned_to);

        return redirect()->back()->with('success', 'Lead assigned successfully');
    }

    public function addComment(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        
        $request->validate([
            'comment' => 'required|string|min:1'
        ]);

        $contact->addComment($request->comment, Auth::id());

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function deleteComment($contactId, $commentId)
    {
        $comment = ContactComment::where('contact_id', $contactId)
            ->where('id', $commentId)
            ->firstOrFail();

        // Only allow deletion by comment author or admin
        if ($comment->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:mark_read,mark_replied,delete,assign,update_lead_status',
            'contacts' => 'required|array',
            'contacts.*' => 'exists:contacts,id'
        ]);

        $contacts = Contact::whereIn('id', $request->contacts);

        switch ($request->action) {
            case 'mark_read':
                $contacts->update([
                    'is_read' => true,
                    'status' => 'read',
                    'read_at' => now()
                ]);
                $message = 'Selected contacts marked as read';
                break;

            case 'mark_replied':
                $contacts->update([
                    'status' => 'replied',
                    'replied_at' => now()
                ]);
                $message = 'Selected contacts marked as replied';
                break;

            case 'assign':
                $request->validate(['assigned_to' => 'required|exists:users,id']);
                $contacts->update(['assigned_to' => $request->assigned_to]);
                $message = 'Selected contacts assigned successfully';
                break;

            case 'update_lead_status':
                $request->validate(['lead_status' => 'required|in:new,open,in_progress,closed,lost,cancel']);
                $contacts->update(['lead_status' => $request->lead_status]);
                $message = 'Selected contacts lead status updated successfully';
                break;

            case 'delete':
                $contacts->delete();
                $message = 'Selected contacts deleted successfully';
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    public function export(Request $request)
    {
        $contacts = Contact::with(['property', 'agent', 'assignedUser', 'createdByUser'])
            ->when($request->filled('status'), function($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('lead_status'), function($query) use ($request) {
                $query->where('lead_status', $request->lead_status);
            })
            ->when($request->filled('source'), function($query) use ($request) {
                $query->where('source', $request->source);
            })
            ->when($request->filled('assigned_to'), function($query) use ($request) {
                $query->where('assigned_to', $request->assigned_to);
            })
            ->when($request->filled('date_from'), function($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->filled('date_to'), function($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->date_to);
            })
            ->get();

        $filename = 'contacts_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Phone', 'Subject', 'Message', 
                'Source', 'Status', 'Lead Status', 'Lead Value', 'Assigned To',
                'Property', 'Agent', 'Created At', 'Lead Created At'
            ]);

            // Data
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->subject,
                    $contact->message,
                    $contact->source_label,
                    $contact->status,
                    $contact->lead_status,
                    $contact->formatted_value,
                    $contact->assignedUser ? $contact->assignedUser->name : 'Unassigned',
                    $contact->property ? $contact->property->title : '',
                    $contact->agent ? $contact->agent->name : '',
                    $contact->created_at->format('Y-m-d H:i:s'),
                    $contact->lead_created_at ? $contact->lead_created_at->format('Y-m-d H:i:s') : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
