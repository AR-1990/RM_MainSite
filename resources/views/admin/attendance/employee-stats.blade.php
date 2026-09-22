@extends('admin.layout.app')

@section('title', 'Employee Attendance Statistics')

@section('content')
<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Employee Attendance Statistics</h3>
				<p class="text-subtitle text-muted">View employee profiles and detailed attendance with filters and export</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}">Attendance</a></li>
						<li class="breadcrumb-item active" aria-current="page">Employee Statistics</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Filters & Actions</h4>
				</div>
				<div class="card-body">
					<form id="filterForm" class="row g-3">
						<div class="col-md-3">
							<label for="start_date" class="form-label">Start Date</label>
							<input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}">
						</div>
						<div class="col-md-3">
							<label for="end_date" class="form-label">End Date</label>
							<input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date', now()->endOfMonth()->format('Y-m-d')) }}">
						</div>
						<div class="col-md-3">
							<label class="form-label">&nbsp;</label>
							<div class="d-grid">
								<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Apply</button>
							</div>
						</div>
						<div class="col-md-3 text-end">
							<label class="form-label d-block">Export</label>
							<div class="btn-group" role="group">
								<a id="exportBasicBtn" href="#" class="btn btn-info disabled" aria-disabled="true"><i class="fas fa-download"></i> Export Basic</a>
								<a id="exportEnhancedBtn" href="#" class="btn btn-success disabled" aria-disabled="true"><i class="fas fa-file-csv"></i> Export Enhanced</a>
							</div>
							<small class="text-muted d-block mt-1">Select an employee to enable export</small>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Employees</h4>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover mb-0" id="employeesTable">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
								</tr>
							</thead>
							<tbody>
								@foreach($employees as $emp)
									<tr class="employee-row" data-user-id="{{ $emp->id }}">
										<td>
											<strong>{{ $emp->name }}</strong>
											<br><small class="text-muted">ID: {{ $emp->id }}</small>
										</td>
										<td>{{ $emp->email }}</td>
										<td><span class="badge bg-light text-dark">{{ ucfirst($emp->role ?? 'employee') }}</span></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="row" id="summaryCards" style="display:none;">
				<div class="col-sm-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div><small class="text-muted">Total Records</small><h4 id="sumTotal">0</h4></div>
								<i class="fas fa-database text-primary"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div><small class="text-muted">Present</small><h4 id="sumPresent">0</h4></div>
								<i class="fas fa-check-circle text-success"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div><small class="text-muted">Absent</small><h4 id="sumAbsent">0</h4></div>
								<i class="fas fa-times-circle text-danger"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div><small class="text-muted">Late Days</small><h4 id="sumLate">0</h4></div>
								<i class="fas fa-clock text-warning"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div><small class="text-muted">Leave</small><h4 id="sumLeave">0</h4></div>
								<i class="fas fa-calendar-times text-secondary"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div><small class="text-muted">Pending Approval</small><h4 id="sumPending">0</h4></div>
								<i class="fas fa-hourglass-half text-info"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div><small class="text-muted">Avg Late (min)</small><h4 id="sumAvgLate">0</h4></div>
								<i class="fas fa-stopwatch text-warning"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">
								<div><small class="text-muted">Total Overtime (hrs)</small><h4 id="sumTotalOT">0</h4></div>
								<i class="fas fa-business-time text-success"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card mt-3" id="detailsCard" style="display:none;">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h4 class="card-title">Attendance Details</h4>
					<div>
						<a id="profileLink" href="#" class="btn btn-outline-secondary btn-sm" target="_blank">
							<i class="fas fa-user"></i> Open Profile
						</a>
						<button id="exportCsvBtn" type="button" class="btn btn-outline-primary btn-sm ms-2">
							<i class="fas fa-file-csv"></i> Export CSV (Last 10 days)
						</button>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped" id="detailsTable">
							<thead>
								<tr>
									<th>Date</th>
									<th>Status</th>
									<th>Work Type</th>
									<th>Check In</th>
									<th>Check Out</th>
									<th>Late (min)</th>
									<th>Total Hours</th>
									<th>Overtime</th>
									<th>Approved</th>
									<th>Comments</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
<script>
let selectedUserId = null;
let last10Start = null;
let last10End = null;

function qs(obj) {
	return Object.keys(obj)
		.filter(k => obj[k] !== undefined && obj[k] !== null && obj[k] !== '')
		.map(k => encodeURIComponent(k) + '=' + encodeURIComponent(obj[k]))
		.join('&');
}

function computeLast10Days() {
    const end = new Date();
    const start = new Date();
    start.setDate(end.getDate() - 9); // include today => total 10 days
    const toYMD = d => d.toISOString().slice(0,10);
    last10Start = toYMD(start);
    last10End = toYMD(end);
}

function buildExportLinks() {
	const params = {
        start_date: last10Start,
        end_date: last10End,
		user_id: selectedUserId
	};
	const basicUrl = `{{ route('admin.attendance.export') }}?${qs(params)}`;
	const enhancedUrl = `{{ route('admin.attendance.export-enhanced') }}?${qs(params)}`;
	$('#exportBasicBtn').attr('href', basicUrl).removeClass('disabled').removeAttr('aria-disabled');
	$('#exportEnhancedBtn').attr('href', enhancedUrl).removeClass('disabled').removeAttr('aria-disabled');
}

function loadEmployeeStats(userId) {
	if (!userId) return;
    selectedUserId = userId;
    computeLast10Days();
    // Reflect the enforced 10-day window in the UI filters for clarity
    $('#start_date').val(last10Start);
    $('#end_date').val(last10End);
    buildExportLinks();

	const data = {
		user_id: userId,
        start_date: last10Start,
        end_date: last10End
	};

	$.ajax({
		url: '{{ route('admin.attendance.enhanced-stats') }}',
		type: 'GET',
		data: data,
		success: function(response) {
			if (!response || !response.success) return;
			const stats = response.data || {};

			$('#summaryCards').show();
			$('#detailsCard').show();

			const statusCounts = stats.status_counts || {};
			const approval = stats.approval_stats || {};
			const lateStats = stats.late_stats || {};
			const overtimeStats = stats.overtime_stats || {};

			$('#sumTotal').text(stats.total_records || 0);
			$('#sumPresent').text(statusCounts.present || 0);
			$('#sumAbsent').text(statusCounts.absent || 0);
			$('#sumLate').text((lateStats.total_late || 0));
			$('#sumLeave').text(statusCounts.leave || 0);
			$('#sumPending').text(approval[0] || approval['0'] || 0);
			$('#sumAvgLate').text(Math.round((lateStats.avg_late_minutes || 0) * 10) / 10);
			$('#sumTotalOT').text(Math.round((overtimeStats.total_overtime_hours || 0) * 100) / 100);

            // profile link
			$('#profileLink').attr('href', `{{ url('/admin/attendance/user') }}/${userId}/profile`);

			// fill details table
			const tbody = $('#detailsTable tbody');
			tbody.empty();
			(stats.attendance_records || []).forEach(r => {
				const approved = r.is_approved ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-warning">No</span>';
				const comments = r.comments ? $('<div>').text(r.comments).html() : '-';
				const tr = `
					<tr>
						<td>${r.formatted_date || r.date || ''}</td>
						<td>${(r.status || '').replace('_',' ')}</td>
						<td>${r.work_type || ''}</td>
						<td>${r.formatted_check_in_time || r.check_in_time || '-'}</td>
						<td>${r.formatted_check_out_time || r.check_out_time || '-'}</td>
						<td>${r.late_minutes != null ? r.late_minutes : 0}</td>
						<td>${r.formatted_total_hours || r.total_hours || '-'}</td>
						<td>${r.overtime_hours ? (r.overtime_hours + ' h') : '-'}</td>
						<td>${approved}</td>
						<td>${comments}</td>
					</tr>`;
				tbody.append(tr);
            });

			// setup CSV export data snapshot
			$('#exportCsvBtn').off('click').on('click', function() {
				const rows = [];
				// header
				rows.push(['Date','Status','Work Type','Check In','Check Out','Late Minutes','Total Hours','Overtime Hours','Approved','Comments']);
				(stats.attendance_records || []).forEach(r => {
					rows.push([
						(r.formatted_date || r.date || ''),
						(r.status || ''),
						(r.work_type || ''),
						(r.formatted_check_in_time || r.check_in_time || ''),
						(r.formatted_check_out_time || r.check_out_time || ''),
						(r.late_minutes != null ? r.late_minutes : 0),
						(r.formatted_total_hours || r.total_hours || ''),
						(r.overtime_hours || 0),
						(r.is_approved ? 'Yes' : 'No'),
						(r.comments ? String(r.comments).replaceAll('\n',' ').replaceAll('\r',' ') : '')
					]);
				});
				const csv = rows.map(r => r.map(field => {
					const s = String(field ?? '');
					if (s.includes(',') || s.includes('"') || s.includes('\n')) {
						return '"' + s.replaceAll('"','""') + '"';
					}
					return s;
				}).join(',')).join('\n');
				const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
				const url = URL.createObjectURL(blob);
				const a = document.createElement('a');
				a.href = url;
				a.download = `attendance_${selectedUserId}_${last10Start}_${last10End}.csv`;
				document.body.appendChild(a);
				a.click();
				document.body.removeChild(a);
				URL.revokeObjectURL(url);
			});
		}
	});
}

$(document).on('click', '.employee-row', function() {
	$('.employee-row').removeClass('table-active');
	$(this).addClass('table-active');
	const userId = $(this).data('user-id');
	loadEmployeeStats(userId);
});

$('#filterForm').on('submit', function(e) {
	e.preventDefault();
	if (selectedUserId) {
        // Even if user changes filters, we keep details constrained to last 10 days as per requirement
        computeLast10Days();
        $('#start_date').val(last10Start);
        $('#end_date').val(last10End);
        loadEmployeeStats(selectedUserId);
	}
});

</script>
@endpush

