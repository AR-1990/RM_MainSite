<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'role',
        'status',
        'accepted_at',
        'started_at',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relationships
    public function task()
    {
        return $this->belongsTo(WorkloadTask::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeAssignee($query)
    {
        return $query->where('role', 'assignee');
    }

    public function scopeReviewer($query)
    {
        return $query->where('role', 'reviewer');
    }

    public function scopeSupervisor($query)
    {
        return $query->where('role', 'supervisor');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'assigned' => '<span class="badge badge-info">Assigned</span>',
            'accepted' => '<span class="badge badge-warning">Accepted</span>',
            'in_progress' => '<span class="badge badge-primary">In Progress</span>',
            'completed' => '<span class="badge badge-success">Completed</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getRoleBadgeAttribute()
    {
        $badges = [
            'assignee' => '<span class="badge badge-primary">Assignee</span>',
            'reviewer' => '<span class="badge badge-warning">Reviewer</span>',
            'supervisor' => '<span class="badge badge-danger">Supervisor</span>',
        ];

        return $badges[$this->role] ?? '<span class="badge badge-secondary">Unknown</span>';
    }
}
