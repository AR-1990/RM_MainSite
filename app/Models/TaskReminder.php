<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class TaskReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'type',
        'reminder_time',
        'is_sent',
        'sent_at',
        'message'
    ];

    protected $casts = [
        'reminder_time' => 'datetime',
        'sent_at' => 'datetime',
        'is_sent' => 'boolean',
    ];

    // Relationships
    public function task(): BelongsTo
    {
        return $this->belongsTo(WorkloadTask::class, 'task_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getTypeBadgeClassAttribute(): string
    {
        return match($this->type) {
            'email' => 'badge-info',
            'notification' => 'badge-primary',
            'sms' => 'badge-success',
            default => 'badge-secondary'
        };
    }

    public function getTypeTextAttribute(): string
    {
        return match($this->type) {
            'email' => 'Email',
            'notification' => 'Notification',
            'sms' => 'SMS',
            default => 'Unknown'
        };
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->reminder_time < now() && !$this->is_sent;
    }

    public function getTimeUntilReminderAttribute(): string
    {
        if ($this->is_sent) {
            return 'Sent';
        }
        
        $diff = now()->diff($this->reminder_time);
        
        if ($diff->invert) {
            return 'Overdue by ' . $diff->days . ' days';
        }
        
        if ($diff->days > 0) {
            return $diff->days . ' days';
        } elseif ($diff->h > 0) {
            return $diff->h . ' hours';
        } else {
            return $diff->i . ' minutes';
        }
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('is_sent', false);
    }

    public function scopeSent($query)
    {
        return $query->where('is_sent', true);
    }

    public function scopeOverdue($query)
    {
        return $query->where('reminder_time', '<', now())
                    ->where('is_sent', false);
    }

    public function scopeDueToday($query)
    {
        return $query->whereDate('reminder_time', now()->toDateString())
                    ->where('is_sent', false);
    }

    // Methods
    public function markAsSent(): void
    {
        $this->update([
            'is_sent' => true,
            'sent_at' => now()
        ]);
    }

    public function reschedule(Carbon $newTime): void
    {
        $this->update([
            'reminder_time' => $newTime,
            'is_sent' => false,
            'sent_at' => null
        ]);
    }
}
