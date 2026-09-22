<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_type',
        'activity_title',
        'description',
        'related_model',
        'related_id',
        'metadata',
        'ip_address',
        'user_agent',
        'performed_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'performed_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeByType($query, $type)
    {
        return $query->where('activity_type', $type);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('performed_at', '>=', now()->subDays($days));
    }

    // Static methods for logging activities
    public static function log($userId, $type, $title, $description = null, $relatedModel = null, $relatedId = null, $metadata = [])
    {
        return self::create([
            'user_id' => $userId,
            'activity_type' => $type,
            'activity_title' => $title,
            'description' => $description,
            'related_model' => $relatedModel,
            'related_id' => $relatedId,
            'metadata' => $metadata,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'performed_at' => now(),
        ]);
    }

    public static function logLeadAssigned($userId, $leadId, $leadTitle)
    {
        return self::log(
            $userId,
            'lead_assigned',
            'Lead Assigned',
            "Lead '{$leadTitle}' was assigned to you",
            'Lead',
            $leadId
        );
    }

    public static function logAttendance($userId, $action, $date)
    {
        return self::log(
            $userId,
            'attendance',
            'Attendance Recorded',
            "Attendance {$action} for {$date}",
            'AttendanceRecord',
            null,
            ['action' => $action, 'date' => $date]
        );
    }

    public static function logTaskCreated($userId, $taskId, $taskTitle)
    {
        return self::log(
            $userId,
            'task_created',
            'Task Created',
            "Task '{$taskTitle}' was created",
            'WorkloadTask',
            $taskId
        );
    }

    public static function logProfileUpdated($userId)
    {
        return self::log(
            $userId,
            'profile_updated',
            'Profile Updated',
            'User profile information was updated'
        );
    }
}
