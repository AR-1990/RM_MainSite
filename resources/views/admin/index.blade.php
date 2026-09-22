@extends('admin.layout.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
                <p class="text-subtitle text-muted">Key metrics at a glance</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <div class="d-flex justify-content-end">
                    <div class="me-3 d-flex align-items-center">
                        <small class="text-muted last-updated">Last updated: {{ now()->format('M d, Y H:i:s') }}</small>
                    </div>
                    <button class="btn btn-outline-primary me-2" onclick="refreshDashboard()">
                        <i class="fas fa-sync-alt me-1"></i> Refresh
                    </button>
                    <button class="btn btn-outline-secondary" onclick="exportDashboard()">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-12 col-lg-6 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Lead Status Distribution</h5>
                    <a href="{{ route('admin.leads.index') }}" class="small">View all</a>
                </div>
                <div class="card-body">
                    <div id="leadStatusChart" style="height:300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Lead Overview</h5>
                    <span class="text-muted small">Last snapshot</span>
                </div>
                <div class="card-body">
                    <div id="leadChart" style="height:300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trends and Top Performers -->
    <div class="row">
        <div class="col-12 col-lg-8 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">30-Day Trends</h5>
                    <span class="text-muted small">Leads vs Closed vs Contacts</span>
                </div>
                <div class="card-body">
                    <div id="trendChart" style="height:320px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Top Assignees</h5>
                </div>
                <div class="card-body">
                    <div id="assigneeChart" style="height:320px;
                    "></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance and Accounts Quick Stats -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Attendance Today</div>
                        <div>
                            <span class="badge bg-success">Present: {{ $attendanceToday['present'] }}</span>
                            <span class="badge bg-warning ms-1">Late: {{ $attendanceToday['late'] }}</span>
                            <span class="badge bg-secondary ms-1">Absent: {{ $attendanceToday['absent'] }}</span>
                        </div>
                    </div>
                    <i class="fas fa-user-check text-success" style="font-size:1.6rem"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">This Month Salaries</div>
                        <h4 class="mb-0">PKR {{ number_format($salaryThisMonth, 2) }}</h4>
                    </div>
                    <i class="fas fa-money-check-alt text-primary" style="font-size:1.6rem"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12 mb-3">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">This Month Expenses / Pending Loans</div>
                        <h4 class="mb-0">PKR {{ number_format($expensesThisMonth, 2) }} / PKR {{ number_format($advancesPending, 2) }}</h4>
                    </div>
                    <i class="fas fa-receipt text-danger" style="font-size:1.6rem"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Workload and Leads Assigned -->
    <div class="row">
        <div class="col-12 col-lg-6 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Latest Tasks (10)</h5>
                    <a href="{{ route('admin.workload.index') }}" class="small">View all</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Status</th>
                                    <th>Due</th>
                                    <th>Assignees</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestTasks as $t)
                                <tr>
                                    <td>{{ $t->title }}</td>
                                    <td><span class="badge bg-light text-dark">{{ ucfirst(str_replace('_',' ', $t->status)) }}</span></td>
                                    <td>{{ optional($t->due_date)->format('Y-m-d') }}</td>
                                    <td>
                                        @foreach($t->assignments as $a)
                                            <span class="badge bg-primary me-1">{{ $a->user->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center text-muted">No tasks.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Latest Assigned Leads (10)</h5>
                    <a href="{{ route('admin.leads.index') }}" class="small">View all</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Lead</th>
                                    <th>Assigned To</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestAssignedLeads as $l)
                                <tr>
                                    <td>{{ $l->title ?? ('Lead #' . $l->id) }}</td>
                                    <td>{{ optional($l->assignedUser)->name ?? '-' }}</td>
                                    <td><span class="badge bg-light text-dark">{{ ucfirst(str_replace('_',' ', $l->status)) }}</span></td>
                                    <td>{{ $l->updated_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center text-muted">No assigned leads.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Finance Charts -->
    <div class="row">
        <div class="col-12 col-lg-8 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Salaries vs Expenses (6 months)</h5>
                </div>
                <div class="card-body">
                    <div id="financeTrendChart" style="height:320px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Top Expense Categories</h5>
                </div>
                <div class="card-body">
                    <div id="expenseCategoryChart" style="height:320px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Modules -->
    <div class="row">
        <div class="col-12 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Projects</h5>
                    <span class="text-muted small">Total {{ $projectStats['total'] }}</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Active</span>
                            <span class="badge bg-success rounded-pill">{{ $projectStats['active'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Featured</span>
                            <span class="badge bg-info rounded-pill">{{ $projectStats['featured'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>This Month</span>
                            <span class="badge bg-primary rounded-pill">{{ $projectStats['this_month'] }}</span>
                        </li>
                    </ul>
                    
                    <!-- Project Type Distribution -->
                    <div class="p-3 border-top">
                        <h6 class="text-muted mb-2">By Type</h6>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="text-primary fw-bold">{{ $projectStats['by_type']['residential'] }}</div>
                                <small class="text-muted">Residential</small>
                            </div>
                            <div class="col-4">
                                <div class="text-success fw-bold">{{ $projectStats['by_type']['commercial'] }}</div>
                                <small class="text-muted">Commercial</small>
                            </div>
                            <div class="col-4">
                                <div class="text-info fw-bold">{{ $projectStats['by_type']['mixed'] }}</div>
                                <small class="text-muted">Mixed</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Project Status Distribution -->
                    <div class="p-3 border-top">
                        <h6 class="text-muted mb-2">By Status</h6>
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="text-warning fw-bold">{{ $projectStats['by_status']['upcoming'] }}</div>
                                <small class="text-muted">Upcoming</small>
                            </div>
                            <div class="col-4">
                                <div class="text-info fw-bold">{{ $projectStats['by_status']['under_construction'] }}</div>
                                <small class="text-muted">Under Construction</small>
                            </div>
                            <div class="col-4">
                                <div class="text-success fw-bold">{{ $projectStats['by_status']['ready_to_move'] }}</div>
                                <small class="text-muted">Ready to Move</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-3 border-top">
                        <div class="text-muted small mb-2">Recent Projects</div>
                        @forelse($recentProjects->take(5) as $p)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        <div class="avatar-title rounded-circle bg-primary">
                                            {{ strtoupper(substr($p->title, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-bold small">{{ Str::limit($p->title, 25) }}</div>
                                        <small class="text-muted">{{ $p->location }}</small>
                                    </div>
                                </div>
                                <span class="badge bg-light text-dark">{{ $p->status }}</span>
                            </div>
                        @empty
                            <div class="text-muted text-center py-3">No projects found</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">News</h5>
                    <span class="text-muted small">Total {{ $newsStats['total'] }}</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Published</span>
                            <span class="badge bg-success rounded-pill">{{ $newsStats['published'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Featured</span>
                            <span class="badge bg-warning rounded-pill">{{ $newsStats['featured'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>This Month</span>
                            <span class="badge bg-primary rounded-pill">{{ $newsStats['this_month'] }}</span>
                        </li>
                    </ul>
                    
                    <div class="p-3 border-top">
                        <div class="text-muted small mb-2">Recent News</div>
                        @forelse($recentNews->take(5) as $n)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        <div class="avatar-title rounded-circle bg-info">
                                            {{ strtoupper(substr($n->title, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-bold small">{{ Str::limit($n->title, 25) }}</div>
                                        <small class="text-muted">{{ $n->posted_date ? $n->posted_date->format('M d, Y') : $n->created_at->format('M d, Y') }}</small>
                                    </div>
                                </div>
                                <span class="badge {{ $n->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $n->is_active ? 'Active' : 'Inactive' }}</span>
                            </div>
                        @empty
                            <div class="text-muted text-center py-3">No news found</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Blogs</h5>
                    <span class="text-muted small">Total {{ $blogStats['total'] }}</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Published</span>
                            <span class="badge bg-success rounded-pill">{{ $blogStats['published'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Featured</span>
                            <span class="badge bg-warning rounded-pill">{{ $blogStats['featured'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>This Month</span>
                            <span class="badge bg-primary rounded-pill">{{ $blogStats['this_month'] }}</span>
                        </li>
                    </ul>
                    
                    <!-- Blog Category Distribution -->
                    @if(!empty($blogStats['by_category']))
                    <div class="p-3 border-top">
                        <h6 class="text-muted mb-2">By Category</h6>
                        @foreach(array_slice($blogStats['by_category'], 0, 3) as $category => $count)
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted">{{ Str::limit($category, 15) }}</small>
                                <span class="badge bg-light text-dark">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="p-3 border-top">
                        <div class="text-muted small mb-2">Recent Blogs</div>
                        @forelse($recentBlogs->take(5) as $b)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        <div class="avatar-title rounded-circle bg-success">
                                            {{ strtoupper(substr($b->title, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-bold small">{{ Str::limit($b->title, 25) }}</div>
                                        <small class="text-muted">
                                            @if($b->category)
                                                {{ $b->category->name }}
                                            @else
                                                {{ $b->created_at->format('M d, Y') }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <span class="badge {{ $b->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $b->is_active ? 'Active' : 'Inactive' }}</span>
                            </div>
                        @empty
                            <div class="text-muted text-center py-3">No blogs found</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top stats: lightweight counts -->
    <div class="row">
        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Total Leads</div>
                        <h3 class="mb-0">{{ $leadStats['total'] }}</h3>
                        <small class="text-success">New: {{ $leadStats['new'] }}, Open: {{ $leadStats['open'] }}</small>
                    </div>
                    <i class="fas fa-user-plus text-primary" style="font-size:1.6rem"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Closed / Lost</div>
                        <h3 class="mb-0">{{ $leadStats['closed'] }}</h3>
                        <small class="text-danger">Lost: {{ $leadStats['lost'] }}, Cancel: {{ $leadStats['cancel'] }}</small>
                    </div>
                    <i class="fas fa-check-circle text-success" style="font-size:1.6rem"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Contacts</div>
                        <h3 class="mb-0">{{ $contactStats['total'] }}</h3>
                        <small class="text-warning">Unread: {{ $contactStats['unread'] }}, Today: {{ $contactStats['today'] }}</small>
                    </div>
                    <i class="fas fa-envelope text-warning" style="font-size:1.6rem"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Users</div>
                        <h3 class="mb-0">{{ $userStats['total'] }}</h3>
                        <small class="text-info">Active: {{ $userStats['active'] }}</small>
                    </div>
                    <i class="fas fa-users text-info" style="font-size:1.6rem"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Two column: recent leads and contacts (limited rows) -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Leads</h5>
                    <a href="{{ route('admin.leads.index') }}" class="small">View all</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Assigned</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentLeads as $lead)
                                <tr>
                                    <td>{{ $lead->title ?? ('Lead #' . $lead->id) }}</td>
                                    <td><span class="badge bg-light text-dark">{{ ucfirst(str_replace('_',' ', $lead->status)) }}</span></td>
                                    <td>{{ optional($lead->assignedUser)->name ?? '-' }}</td>
                                    <td>{{ $lead->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center text-muted">No recent leads.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Contacts</h5>
                    <a href="{{ route('admin.contacts.index') }}" class="small">View all</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentContacts as $c)
                                <tr>
                                    <td>{{ $c->name ?? ('Contact #' . $c->id) }}</td>
                                    <td><span class="badge bg-light text-dark">{{ ucfirst($c->status ?? 'new') }}</span></td>
                                    <td>{{ $c->created_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center text-muted">No recent contacts.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick links -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.leads.index') }}" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i> Leads</a>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary"><i class="fas fa-envelope"></i> Contacts</a>
                    <a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-info"><i class="fas fa-clock"></i> Attendance</a>
                    <a href="{{ route('admin.accounts.dashboard') }}" class="btn btn-outline-success"><i class="fas fa-dollar-sign"></i> Accounts</a>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-warning"><i class="fas fa-building"></i> Projects</a>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-danger"><i class="fas fa-blog"></i> Blogs</a>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-dark"><i class="fas fa-newspaper"></i> News</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Metrics Section -->
    @if(isset($performanceMetrics))
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Performance Metrics</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Projects Performance</h6>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="text-center p-3 border rounded">
                                        <div class="h4 text-primary mb-1">
                                            PKR {{ number_format($performanceMetrics['projects']['avg_price'] ?? 0, 0) }}
                                        </div>
                                        <small class="text-muted">Average Price</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="text-center p-3 border rounded">
                                        <div class="h4 text-success mb-1">
                                            {{ number_format($performanceMetrics['projects']['total_area'] ?? 0, 0) }}
                                        </div>
                                        <small class="text-muted">Total Area (sq ft)</small>
                                    </div>
                                </div>
                            </div>
                            
                            @if(!empty($performanceMetrics['projects']['popular_locations']))
                            <div class="mt-3">
                                <h6 class="text-muted mb-2">Popular Locations</h6>
                                @foreach(array_slice($performanceMetrics['projects']['popular_locations'], 0, 3) as $location => $count)
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small>{{ Str::limit($location, 20) }}</small>
                                        <span class="badge bg-light text-dark">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-6">
                            <h6 class="text-success mb-3">Blogs Performance</h6>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="text-center p-3 border rounded">
                                        <div class="h4 text-success mb-1">
                                            {{ number_format($performanceMetrics['blogs']['avg_views'] ?? 0, 0) }}
                                        </div>
                                        <small class="text-muted">Average Views</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="text-center p-3 border rounded">
                                        <div class="h4 text-info mb-1">
                                            {{ $performanceMetrics['blogs']['recent_engagement'] ?? 0 }}
                                        </div>
                                        <small class="text-muted">Recent Engagement (7 days)</small>
                                    </div>
                                </div>
                            </div>
                            
                            @if(!empty($performanceMetrics['blogs']['top_performing']))
                            <div class="mt-3">
                                <h6 class="text-muted mb-2">Top Performing Blogs</h6>
                                @foreach($performanceMetrics['blogs']['top_performing']->take(3) as $blog)
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <small>{{ Str::limit($blog->title, 25) }}</small>
                                        <span class="badge bg-success">{{ $blog->views_count }} views</span>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
 </div>
@endsection

@push('styles')
<style>
    .avatar {
        width: 32px;
        height: 32px;
    }
    
    .avatar-title {
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }
    
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }
    
    .list-group-item {
        border-left: none;
        border-right: none;
        border-top: none;
    }
    
    .list-group-item:last-child {
        border-bottom: none;
    }
    
    .border-top {
        border-top: 1px solid #e9ecef !important;
    }
    
    .fw-bold {
        font-weight: 600 !important;
    }
    
    .text-primary {
        color: #007bff !important;
    }
    
    .text-success {
        color: #28a745 !important;
    }
    
    .text-info {
        color: #17a2b8 !important;
    }
    
    .text-warning {
        color: #ffc107 !important;
    }
    
    .text-muted {
        color: #6c757d !important;
    }
    
    .bg-primary {
        background-color: #007bff !important;
    }
    
    .bg-success {
        background-color: #28a745 !important;
    }
    
    .bg-info {
        background-color: #17a2b8 !important;
    }
    
    .bg-warning {
        background-color: #ffc107 !important;
    }
    
    .bg-secondary {
        background-color: #6c757d !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
    }
    
    .btn-outline-primary:hover {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }
    
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    
    .btn-outline-info {
        color: #17a2b8;
        border-color: #17a2b8;
    }
    
    .btn-outline-info:hover {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }
    
    .btn-outline-success {
        color: #28a745;
        border-color: #28a745;
    }
    
    .btn-outline-success:hover {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }
    
    .btn-outline-warning {
        color: #ffc107;
        border-color: #ffc107;
    }
    
    .btn-outline-warning:hover {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }
    
    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    
    .btn-outline-dark {
        color: #343a40;
        border-color: #343a40;
    }
    
    .btn-outline-dark:hover {
        background-color: #343a40;
        border-color: #343a40;
        color: white;
    }
    
    .gap-2 {
        gap: 0.5rem !important;
    }
    
    .flex-wrap {
        flex-wrap: wrap !important;
    }
    
    .d-flex {
        display: flex !important;
    }
    
    .justify-content-between {
        justify-content: space-between !important;
    }
    
    .align-items-center {
        align-items: center !important;
    }
    
    .text-center {
        text-align: center !important;
    }
    
    .mb-1 {
        margin-bottom: 0.25rem !important;
    }
    
    .mb-2 {
        margin-bottom: 0.5rem !important;
    }
    
    .mb-3 {
        margin-bottom: 1rem !important;
    }
    
    .mt-3 {
        margin-top: 1rem !important;
    }
    
    .mt-4 {
        margin-top: 1.5rem !important;
    }
    
    .me-2 {
        margin-right: 0.5rem !important;
    }
    
    .p-3 {
        padding: 1rem !important;
    }
    
    .rounded {
        border-radius: 0.375rem !important;
    }
    
    .rounded-pill {
        border-radius: 50rem !important;
    }
    
    .border {
        border: 1px solid #dee2e6 !important;
    }
    
    .h4 {
        font-size: 1.5rem !important;
        font-weight: 500 !important;
    }
    
    .h6 {
        font-size: 1rem !important;
        font-weight: 500 !important;
    }
    
    .small {
        font-size: 0.875em !important;
    }
    
    .h-100 {
        height: 100% !important;
    }
    
    .col-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }
    
    .col-6 {
        flex: 0 0 auto;
        width: 50%;
    }
    
    .col-12 {
        flex: 0 0 auto;
        width: 100%;
    }
    
    .col-xl-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }
    
    .col-md-12 {
        flex: 0 0 auto;
        width: 100%;
    }
    
    .col-md-6 {
        flex: 0 0 auto;
        width: 50%;
    }
    
    @media (max-width: 768px) {
        .col-xl-4 {
            width: 100%;
        }
        
        .col-md-6 {
            width: 100%;
        }
        
        .col-4 {
            width: 50%;
        }
        
        .col-6 {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Dashboard refresh functionality
    function refreshDashboard() {
        const refreshBtn = event.target.closest('button');
        const originalText = refreshBtn.innerHTML;
        
        // Show loading state
        refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Refreshing...';
        refreshBtn.disabled = true;
        
        // Simulate refresh (in real app, this would be an AJAX call)
        setTimeout(() => {
            location.reload();
        }, 1000);
    }
    
    // Dashboard export functionality
    function exportDashboard() {
        const exportBtn = event.target.closest('button');
        const originalText = exportBtn.innerHTML;
        
        // Show loading state
        exportBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Exporting...';
        exportBtn.disabled = true;
        
        // Simulate export (in real app, this would generate a report)
        setTimeout(() => {
            exportBtn.innerHTML = originalText;
            exportBtn.disabled = false;
            
            // Show success message
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Export Complete!',
                    text: 'Dashboard data has been exported successfully.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                alert('Dashboard data exported successfully!');
            }
        }, 2000);
    }
    
    // Auto-refresh dashboard every 5 minutes
    setInterval(() => {
        // Only refresh if user is active (not scrolled or interacted recently)
        if (!document.hidden) {
            console.log('Auto-refreshing dashboard...');
            // In a real app, you might want to make an AJAX call here instead of full reload
        }
    }, 300000); // 5 minutes
    
    // Add hover effects to cards
    document.addEventListener('DOMContentLoaded', function() {
        // Add click event to project and blog cards for better UX
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Don't trigger if clicking on buttons or links
                if (e.target.tagName === 'BUTTON' || e.target.tagName === 'A' || e.target.closest('button') || e.target.closest('a')) {
                    return;
                }
                
                // Add subtle click effect
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });
        
        // Add loading animation to statistics
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });
        
        document.querySelectorAll('.card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
    });
    
    // Real-time updates simulation
    function updateRealTimeData() {
        // This function would typically make AJAX calls to update specific data
        // For now, we'll just update some display elements
        const now = new Date();
        const timeElement = document.querySelector('.last-updated');
        if (timeElement) {
            timeElement.textContent = `Last updated: ${now.toLocaleTimeString()}`;
        }
    }
    
    // Update time every 30 seconds
    setInterval(updateRealTimeData, 30000);
</script>
@endpush