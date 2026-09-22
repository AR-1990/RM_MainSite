<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Lead;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\AttendanceRecord;
use App\Models\SalaryPayment;
use App\Models\Expense;
use App\Models\SalaryAdvance;
use App\Models\WorkloadTask;
use App\Models\Project;
use App\Models\News;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function advanceTable() { return view('admin.advance-table'); }
    public function alert() { return view('admin.alert'); }
    public function authForgotPassword() { return view('admin.auth-forgot-password'); }
    public function authLogin() { return view('admin.auth-login'); }
    public function authRegister() { return view('admin.auth-register'); }
    public function authResetPassword() { return view('admin.auth-reset-password'); }
    public function avatar() { return view('admin.avatar'); }
    public function badge() { return view('admin.badge'); }
    public function basicForm() { return view('admin.basic-form'); }
    public function basicTable() { return view('admin.basic-table'); }
    public function blank() { return view('admin.blank'); }
    public function blog() { return view('admin.blog'); }
    public function breadcrumb() { return view('admin.breadcrumb'); }
    public function buttons() { return view('admin.buttons'); }
    public function calendar() { return view('admin.calendar'); }
    public function card() { return view('admin.card'); }
    public function carousel() { return view('admin.carousel'); }
    public function chartAmchart() { return view('admin.chart-amchart'); }
    public function chartApex() { return view('admin.chart-apex'); }
    public function chartChartjs() { return view('admin.chart-chartjs'); }
    public function chartEchart() { return view('admin.chart-echart'); }
    public function chartMorris() { return view('admin.chart-morris'); }
    public function chartSparkline() { return view('admin.chart-sparkline'); }
    public function checkboxRadio() { return view('admin.checkbox-radio'); }
    public function collapse() { return view('admin.collapse'); }
    public function contact() { return view('admin.contact'); }
    public function createPost() { return view('admin.create-post'); }
    public function datatables() { return view('admin.datatables'); }
    public function dropdown() { return view('admin.dropdown'); }
    public function editableTable() { return view('admin.editable-table'); }
    public function emailCompose() { return view('admin.email-compose'); }
    public function emailInbox() { return view('admin.email-inbox'); }
    public function emailRead() { return view('admin.email-read'); }
    public function emptyState() { return view('admin.empty-state'); }
    public function errors403() { return view('admin.errors-403'); }
    public function errors404() { return view('admin.errors-404'); }
    public function errors500() { return view('admin.errors-500'); }
    public function errors503() { return view('admin.errors-503'); }
    public function exportTable() { return view('admin.export-table'); }
    public function flags() { return view('admin.flags'); }
    public function formsAdvanced() { return view('admin.forms-advanced-form'); }
    public function formsEditor() { return view('admin.forms-editor'); }
    public function formsValidation() { return view('admin.forms-validation'); }
    public function formWizard() { return view('admin.form-wizard'); }
    public function gallery1() { return view('admin.gallery1'); }
    public function gmapsAdvanced() { return view('admin.gmaps-advanced'); }
    public function gmapsDraggable() { return view('admin.gmaps-draggable'); }
    public function gmapsGeocoding() { return view('admin.gmaps-geocoding'); }
    public function gmapsGeolocation() { return view('admin.gmaps-geolocation'); }
    public function gmapsMarker() { return view('admin.gmaps-marker'); }
    public function gmapsMultipleMarker() { return view('admin.gmaps-multiple-marker'); }
    public function gmapsRoute() { return view('admin.gmaps-route'); }
    public function gmapsSimple() { return view('admin.gmaps-simple'); }
    public function iconFeather() { return view('admin.icon-feather'); }
    public function iconFontAwesome() { return view('admin.icon-font-awesome'); }
    public function iconIonicons() { return view('admin.icon-ionicons'); }
    public function iconMaterial() { return view('admin.icon-material'); }
    public function iconWeather() { return view('admin.icon-weather'); }
    public function index() { 
        // Get lead statistics
        $leadStats = [
            'total' => Lead::count(),
            'new' => Lead::where('status', Lead::STATUS_NEW)->count(),
            'open' => Lead::where('status', Lead::STATUS_OPEN)->count(),
            'in_progress' => Lead::where('status', Lead::STATUS_IN_PROGRESS)->count(),
            'closed' => Lead::where('status', Lead::STATUS_CLOSED)->count(),
            'lost' => Lead::where('status', Lead::STATUS_LOST)->count(),
            'cancel' => Lead::where('status', Lead::STATUS_CANCEL)->count(),
        ];

        // Get contact statistics
        $contactStats = [
            'total' => Contact::count(),
            'new' => Contact::where('status', 'new')->count(),
            'unread' => Contact::where('is_read', false)->count(),
            'today' => Contact::whereDate('created_at', today())->count(),
        ];

        // Get user statistics
        $userStats = [
            'total' => User::count(),
            'active' => User::where('is_active', true)->count(),
        ];

        // Get recent leads
        $recentLeads = Lead::with(['assignedUser', 'createdByUser'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get recent contacts
        $recentContacts = Contact::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Trends (last 30 days)
        $days = 30;
        $dateFrom = now()->subDays($days - 1)->startOfDay();
        $labels = collect(range(0, $days - 1))->map(fn ($i) => now()->subDays($days - 1 - $i)->format('Y-m-d'));

        $leadByDay = Lead::where('created_at', '>=', $dateFrom)
            ->select(DB::raw('DATE(created_at) as d'), DB::raw('COUNT(*) as c'))
            ->groupBy('d')->orderBy('d')->get();

        $leadClosedByDay = Lead::where('created_at', '>=', $dateFrom)
            ->where('status', Lead::STATUS_CLOSED)
            ->select(DB::raw('DATE(created_at) as d'), DB::raw('COUNT(*) as c'))
            ->groupBy('d')->orderBy('d')->get();

        $contactByDay = Contact::where('created_at', '>=', $dateFrom)
            ->select(DB::raw('DATE(created_at) as d'), DB::raw('COUNT(*) as c'))
            ->groupBy('d')->orderBy('d')->get();

        $leadTrend = [
            'labels' => $labels,
            'data' => $labels->map(fn ($d) => (int) optional($leadByDay->firstWhere('d', $d))->c)->values(),
        ];
        $closedTrend = [
            'labels' => $labels,
            'data' => $labels->map(fn ($d) => (int) optional($leadClosedByDay->firstWhere('d', $d))->c)->values(),
        ];
        $contactTrend = [
            'labels' => $labels,
            'data' => $labels->map(fn ($d) => (int) optional($contactByDay->firstWhere('d', $d))->c)->values(),
        ];

        // Top assignees (by lead count)
        $topAssigneesRaw = Lead::select('assigned_to', DB::raw('COUNT(*) as c'))
            ->whereNotNull('assigned_to')
            ->groupBy('assigned_to')
            ->orderByDesc('c')
            ->limit(5)
            ->get();
        $assigneeUsers = User::whereIn('id', $topAssigneesRaw->pluck('assigned_to'))
            ->pluck('name', 'id');
        $topAssignees = [
            'labels' => $topAssigneesRaw->map(fn ($r) => $assigneeUsers[$r->assigned_to] ?? ('User ' . $r->assigned_to)),
            'data' => $topAssigneesRaw->pluck('c'),
        ];

        // Attendance today
        $attendanceToday = [
            'present' => AttendanceRecord::whereDate('date', today())->where('status', 'present')->count(),
            'late' => AttendanceRecord::whereDate('date', today())->where('is_late', true)->count(),
            'absent' => AttendanceRecord::whereDate('date', today())->where('status', 'absent')->count(),
        ];

        // Accounts quick stats
        $salaryThisMonth = SalaryPayment::where('month', now()->format('Y-m'))->sum('net_salary');
        $expensesThisMonth = Expense::whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->sum('amount');
        $advancesPending = SalaryAdvance::where('status', 'pending')->sum('amount');

        // Workload latest 10
        $latestTasks = WorkloadTask::with(['assignments.user'])
            ->orderByDesc('created_at')->limit(10)->get();

        // Leads latest 10 assigned
        $latestAssignedLeads = Lead::with(['assignedUser'])
            ->whereNotNull('assigned_to')
            ->orderByDesc('updated_at')->limit(10)->get();

        // Finance breakdown (last 6 months)
        $months = collect(range(0,5))->map(fn($i)=> now()->subMonths(5-$i)->format('Y-m'));
        $salaryByMonthRaw = SalaryPayment::select('month', DB::raw('SUM(net_salary) as total'))
            ->whereIn('month', $months)->groupBy('month')->get();
        $expenseByMonthRaw = Expense::select(DB::raw("DATE_FORMAT(expense_date,'%Y-%m') as month"), DB::raw('SUM(amount) as total'))
            ->whereBetween('expense_date', [now()->subMonths(5)->startOfMonth(), now()->endOfMonth()])
            ->groupBy('month')->get();
        $financeTrend = [
            'labels' => $months,
            'salaries' => $months->map(fn($m)=> (float) optional($salaryByMonthRaw->firstWhere('month',$m))->total)->values(),
            'expenses' => $months->map(fn($m)=> (float) optional($expenseByMonthRaw->firstWhere('month',$m))->total)->values(),
        ];

        // Expense category share (this month)
        $expenseCatRaw = Expense::join('expense_categories as c','c.id','=','expenses.category_id')
            ->whereMonth('expense_date', now()->month)->whereYear('expense_date', now()->year)
            ->select('c.name', DB::raw('SUM(expenses.amount) as total'))
            ->groupBy('c.name')->orderByDesc('total')->limit(5)->get();
        $expenseCategoryShare = [
            'labels' => $expenseCatRaw->pluck('name'),
            'data' => $expenseCatRaw->pluck('total'),
        ];

        // Enhanced Content modules with performance metrics
        $projectStats = [
            'total' => Project::count(),
            'active' => Project::where('is_active', true)->count(),
            'featured' => Project::where('is_featured', true)->count(),
            'this_month' => Project::whereMonth('created_at', now()->month)->count(),
            'by_type' => [
                'residential' => Project::where('project_type', 'residential')->count(),
                'commercial' => Project::where('project_type', 'commercial')->count(),
                'mixed' => Project::where('project_type', 'mixed')->count(),
            ],
            'by_status' => [
                'upcoming' => Project::where('status', 'upcoming')->count(),
                'under_construction' => Project::where('status', 'under_construction')->count(),
                'ready_to_move' => Project::where('status', 'ready_to_move')->count(),
            ]
        ];
        
        $recentProjects = Project::orderByDesc('created_at')
            ->limit(8)
            ->get();

        $newsStats = [
            'total' => News::count(),
            'published' => News::where('is_active', true)->count(),
            'this_month' => News::whereMonth('created_at', now()->month)->count(),
            'featured' => News::where('featured', true)->count(),
        ];
        $recentNews = News::orderByDesc('created_at')->limit(8)->get();

        $blogStats = [
            'total' => Blog::count(),
            'published' => Blog::where('is_active', true)->count(),
            'this_month' => Blog::whereMonth('created_at', now()->month)->count(),
            'featured' => Blog::where('is_featured', true)->count(),
            'by_category' => Blog::join('blog_categories', 'blogs.blog_category_id', '=', 'blog_categories.id')
                ->select('blog_categories.name', DB::raw('COUNT(*) as count'))
                ->groupBy('blog_categories.name')
                ->orderByDesc('count')
                ->limit(5)
                ->pluck('count', 'name')
                ->toArray() ?? [],
        ];
        $recentBlogs = Blog::with(['category', 'user'])
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        // Performance metrics for projects and blogs with error handling
        $performanceMetrics = [
            'projects' => [
                'avg_price' => Project::where('price', '>', 0)->avg('price') ?? 0,
                'total_area' => Project::sum('area') ?? 0,
                'popular_locations' => Project::select('location', DB::raw('COUNT(*) as count'))
                    ->whereNotNull('location')
                    ->where('location', '!=', '')
                    ->groupBy('location')
                    ->orderByDesc('count')
                    ->limit(5)
                    ->pluck('count', 'location')
                    ->toArray(),
            ],
            'blogs' => [
                'avg_views' => Blog::avg('views_count') ?? 0,
                'top_performing' => Blog::where('views_count', '>', 0)
                    ->orderByDesc('views_count')
                    ->limit(5)
                    ->get(['id', 'title', 'views_count']),
                'recent_engagement' => Blog::where('created_at', '>=', now()->subDays(7))->count(),
            ]
        ];

        return view('admin.index', compact(
            'leadStats',
            'contactStats',
            'userStats',
            'recentLeads',
            'recentContacts',
            'leadTrend',
            'contactTrend',
            'closedTrend',
            'topAssignees',
            'attendanceToday',
            'salaryThisMonth',
            'expensesThisMonth',
            'advancesPending',
            'latestTasks',
            'latestAssignedLeads',
            'financeTrend',
            'expenseCategoryShare',
            'projectStats',
            'recentProjects',
            'newsStats',
            'recentNews',
            'blogStats',
            'recentBlogs',
            'performanceMetrics'
        )); 
    }
    public function invoice() { return view('admin.invoice'); }
    public function lightGallery() { return view('admin.light-gallery'); }
    public function listGroup() { return view('admin.list-group'); }
    public function mailInbox() { return view('admin.mail-inbox'); }
    public function mediaObject() { return view('admin.media-object'); }
    public function modal() { return view('admin.modal'); }
    public function multipleUpload() { return view('admin.multiple-upload'); }
    public function navbar() { return view('admin.navbar'); }
    public function owlCarousel() { return view('admin.owl-carousel'); }
    public function pagination() { return view('admin.pagination'); }
    public function popover() { return view('admin.popover'); }
    public function portfolio() { return view('admin.portfolio'); }
    public function posts() { return view('admin.posts'); }
    public function pricing() { return view('admin.pricing'); }
    public function profile() { 
        $user = Auth::user();
        return view('admin.profile', compact('user')); 
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        
        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update password using DB facade
        \DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.change-password')
            ->with('success', 'Password updated successfully!');
    }

    // Property functions
    public function addProperty() { 
        $categories = \App\Models\PropertyCategory::where('is_active', true)->get();
        return view('admin.property.add-property', compact('categories')); 
    }
    
    public function editProperty() { 
        $property = Property::with(['category', 'images', 'floors', 'amenities', 'user.profile'])->find(request('id'));
        $categories = \App\Models\PropertyCategory::where('is_active', true)->get();
        return view('admin.property.edit-property', compact('property', 'categories')); 
    }
    
    public function propertyTable() { 
        $properties = Property::with(['category', 'primaryImage', 'user.profile'])->latest()->get();
        return view('admin.property.property-table', compact('properties')); 
    }
}
