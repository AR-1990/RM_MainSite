<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkloadTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'frequency',
        'start_date',
        'due_date',
        'reminder_time',
        'is_recurring',
        'recurring_interval',
        'next_reminder_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
        'reminder_time' => 'datetime',
        'next_reminder_date' => 'date',
        'is_recurring' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function assignments()
    {
        return $this->hasMany(TaskAssignment::class, 'task_id');
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class, 'task_assignments', 'task_id', 'user_id')
                    ->withPivot('role', 'status', 'accepted_at', 'started_at', 'completed_at', 'notes')
                    ->withTimestamps();
    }

    public function attachments()
    {
        return $this->hasMany(TaskAttachment::class, 'task_id');
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class, 'task_id');
    }

    public function reminders()
    {
        return $this->hasMany(TaskReminder::class, 'task_id');
    }

    public function auditLogs()
    {
        return $this->hasMany(\App\Models\TaskAuditLog::class, 'task_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeDueDate($query, $date)
    {
        return $query->where('due_date', $date);
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now()->toDateString())
                    ->whereNotIn('status', ['completed', 'cancelled']);
    }

    public function scopeUpcoming($query, $days = 7)
    {
        return $query->where('due_date', '<=', now()->addDays($days)->toDateString())
                    ->where('due_date', '>=', now()->toDateString())
                    ->whereNotIn('status', ['completed', 'cancelled']);
    }

    public function scopeDueToday($query)
    {
        return $query->where('due_date', now()->toDateString())
                    ->whereNotIn('status', ['completed', 'cancelled']);
    }

    public function scopeDueThisWeek($query)
    {
        return $query->whereBetween('due_date', [
                    now()->startOfWeek()->toDateString(),
                    now()->endOfWeek()->toDateString()
                ])
                ->whereNotIn('status', ['completed', 'cancelled']);
    }

    public function scopeDueThisMonth($query)
    {
        return $query->whereBetween('due_date', [
                    now()->startOfMonth()->toDateString(),
                    now()->endOfMonth()->toDateString()
                ])
                ->whereNotIn('status', ['completed', 'cancelled']);
    }

    // Accessors
    public function getPriorityBadgeAttribute()
    {
        $badges = [
            'low' => '<span class="badge badge-info">Low</span>',
            'medium' => '<span class="badge badge-warning">Medium</span>',
            'high' => '<span class="badge badge-danger">High</span>',
            'urgent' => '<span class="badge badge-danger">Urgent</span>',
        ];

        return $badges[$this->priority] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge badge-warning">Pending</span>',
            'in_progress' => '<span class="badge badge-primary">In Progress</span>',
            'completed' => '<span class="badge badge-success">Completed</span>',
            'cancelled' => '<span class="badge badge-danger">Cancelled</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getIsOverdueAttribute()
    {
        return $this->due_date < now()->toDateString() && 
               !in_array($this->status, ['completed', 'cancelled']);
    }

    public function getDaysRemainingAttribute()
    {
        if (in_array($this->status, ['completed', 'cancelled'])) {
            return 0;
        }
        
        $days = now()->diffInDays($this->due_date, false);
        return $days > 0 ? $days : 0;
    }

    // Methods
    public function assignToUser($userId, $role = 'assignee')
    {
        return $this->assignments()->create([
            'user_id' => $userId,
            'role' => $role,
            'status' => 'assigned'
        ]);
    }

    public function assignUser($user, $role = 'assignee')
    {
        return $this->assignments()->create([
            'user_id' => $user->id,
            'role' => $role,
            'status' => 'assigned'
        ]);
    }

    public function isAssignedToUser($userId)
    {
        return $this->assignments()->where('user_id', $userId)->exists();
    }

    public function getUserAssignment($userId)
    {
        return $this->assignments()->where('user_id', $userId)->first();
    }

    public function addAttachment($data, $user)
    {
        return $this->attachments()->create([
            'file_name' => $data['file_name'],
            'file_path' => $data['file_path'],
            'file_type' => $data['file_type'],
            'original_name' => $data['original_name'],
            'file_size' => $data['file_size'],
            'description' => $data['description'] ?? null,
            'uploaded_by' => $user->id,
        ]);
    }

    public function scheduleReminder($user, $reminderTime)
    {
        return $this->reminders()->create([
            'user_id' => $user->id,
            'reminder_time' => $reminderTime,
            'is_sent' => false,
        ]);
    }

    public function logStatusChange($oldStatus, $newStatus)
    {
        return $this->auditLogs()->create([
            'user_id' => auth()->id(),
            'action' => 'status_changed',
            'field_name' => 'status',
            'old_value' => $oldStatus,
            'new_value' => $newStatus,
            'description' => "Status changed from {$oldStatus} to {$newStatus}",
        ]);
    }

    public function markAsCompleted()
    {
        $this->update(['status' => 'completed']);
        return $this->logStatusChange($this->getOriginal('status'), 'completed');
    }

    public function addComment($content, $isInternal = false, $type = 'comment')
    {
        return $this->comments()->create([
            'comment' => $content,
            'user_id' => auth()->id(),
            'is_internal' => $isInternal,
            'type' => $type,
        ]);
    }

    public function logCommentAdded($comment, $isInternal = false)
    {
        return $this->auditLogs()->create([
            'user_id' => auth()->id(),
            'action' => 'comment_added',
            'field_name' => 'comment',
            'old_value' => null,
            'new_value' => $comment,
            'description' => ($isInternal ? 'Internal comment added' : 'Comment added') . ': ' . \Illuminate\Support\Str::limit($comment, 100),
        ]);
    }
}
