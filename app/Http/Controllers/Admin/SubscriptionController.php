<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of subscriptions
     */
    public function index(Request $request)
    {
        $query = Subscription::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('source', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->inactive();
            }
        }

        // Source filter
        if ($request->filled('source')) {
            $query->bySource($request->source);
        }

        // Date range filter
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->fromDateRange($request->date_from, $request->date_to);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'subscribed_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $subscriptions = $query->paginate(20);

        // Get statistics
        $stats = [
            'total' => Subscription::count(),
            'active' => Subscription::active()->count(),
            'inactive' => Subscription::inactive()->count(),
            'today' => Subscription::whereDate('subscribed_at', today())->count(),
            'this_week' => Subscription::whereBetween('subscribed_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Subscription::whereMonth('subscribed_at', now()->month)->count(),
        ];

        // Get sources for filter
        $sources = Subscription::distinct()->pluck('source')->filter();

        return view('admin.subscriptions.index', compact('subscriptions', 'stats', 'sources'));
    }

    /**
     * Show the form for creating a new subscription
     */
    public function create()
    {
        return view('admin.subscriptions.create');
    }

    /**
     * Store a newly created subscription
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email',
            'source' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Subscription::create([
            'email' => $request->email,
            'source' => $request->source ?? 'manual',
            'notes' => $request->notes,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified subscription
     */
    public function show(Subscription $subscription)
    {
        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified subscription
     */
    public function edit(Subscription $subscription)
    {
        return view('admin.subscriptions.edit', compact('subscription'));
    }

    /**
     * Update the specified subscription
     */
    public function update(Request $request, Subscription $subscription)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email,' . $subscription->id,
            'source' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subscription->update([
            'email' => $request->email,
            'source' => $request->source,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified subscription
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }

    /**
     * Toggle subscription status
     */
    public function toggleStatus(Subscription $subscription)
    {
        if ($subscription->is_active) {
            $subscription->deactivate();
            $message = 'Subscription deactivated successfully.';
        } else {
            $subscription->activate();
            $message = 'Subscription activated successfully.';
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete,export',
            'subscriptions' => 'required|array|min:1',
            'subscriptions.*' => 'exists:subscriptions,id'
        ]);

        $subscriptions = Subscription::whereIn('id', $request->subscriptions);

        switch ($request->action) {
            case 'activate':
                $subscriptions->update(['is_active' => true, 'unsubscribed_at' => null]);
                $message = 'Selected subscriptions activated successfully.';
                break;

            case 'deactivate':
                $subscriptions->update(['is_active' => false, 'unsubscribed_at' => now()]);
                $message = 'Selected subscriptions deactivated successfully.';
                break;

            case 'delete':
                $subscriptions->delete();
                $message = 'Selected subscriptions deleted successfully.';
                break;

            case 'export':
                return $this->export($request);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Export subscriptions
     */
    public function export(Request $request)
    {
        $query = Subscription::query();

        // Apply filters
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->inactive();
            }
        }

        if ($request->filled('source')) {
            $query->bySource($request->source);
        }

        $subscriptions = $query->get();

        $filename = 'subscriptions_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($subscriptions) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, ['ID', 'Email', 'Status', 'Source', 'Subscribed At', 'Notes']);
            
            // Add data
            foreach ($subscriptions as $subscription) {
                fputcsv($file, [
                    $subscription->id,
                    $subscription->email,
                    $subscription->status,
                    $subscription->source,
                    $subscription->subscribed_at->format('Y-m-d H:i:s'),
                    $subscription->notes
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get subscription statistics for dashboard
     */
    public function getStats()
    {
        $stats = [
            'total' => Subscription::count(),
            'active' => Subscription::active()->count(),
            'inactive' => Subscription::inactive()->count(),
            'today' => Subscription::whereDate('subscribed_at', today())->count(),
            'this_week' => Subscription::whereBetween('subscribed_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Subscription::whereMonth('subscribed_at', now()->month)->count(),
        ];

        return response()->json($stats);
    }
}
