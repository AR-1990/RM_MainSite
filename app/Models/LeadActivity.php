<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'user_id',
        'action',
        'description',
        'old_values',
        'new_values',
        'ip_address'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array'
    ];

    // Activity types
    const ACTION_CREATED = 'created';
    const ACTION_UPDATED = 'updated';
    const ACTION_STATUS_CHANGED = 'status_changed';
    const ACTION_ASSIGNED = 'assigned';
    const ACTION_COMMENT_ADDED = 'comment_added';
    const ACTION_ATTACHMENT_ADDED = 'attachment_added';
    const ACTION_PRIORITY_CHANGED = 'priority_changed';
    const ACTION_VALUE_CHANGED = 'value_changed';

    // Relationships
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Accessors
    public function getActionLabelAttribute()
    {
        $labels = [
            self::ACTION_CREATED => 'Lead Created',
            self::ACTION_UPDATED => 'Lead Updated',
            self::ACTION_STATUS_CHANGED => 'Status Changed',
            self::ACTION_ASSIGNED => 'Lead Assigned',
            self::ACTION_COMMENT_ADDED => 'Comment Added',
            self::ACTION_ATTACHMENT_ADDED => 'Attachment Added',
            self::ACTION_PRIORITY_CHANGED => 'Priority Changed',
            self::ACTION_VALUE_CHANGED => 'Value Changed',
        ];

        return $labels[$this->action] ?? 'Unknown Action';
    }

    public function getFormattedDescriptionAttribute()
    {
        $description = $this->description;
        
        // Format old and new values if they exist
        if ($this->old_values && $this->new_values) {
            foreach ($this->old_values as $field => $oldValue) {
                if (isset($this->new_values[$field])) {
                    $newValue = $this->new_values[$field];
                    $description = str_replace(
                        "{$oldValue} → {$newValue}",
                        "<span class='text-danger'>{$oldValue}</span> → <span class='text-success'>{$newValue}</span>",
                        $description
                    );
                }
            }
        }
        
        return $description;
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // Static methods for creating activities
    public static function logCreated($lead, $userId)
    {
        return self::create([
            'lead_id' => $lead->id,
            'user_id' => $userId,
            'action' => self::ACTION_CREATED,
            'description' => 'Lead created successfully',
            'ip_address' => request()->ip()
        ]);
    }

    public static function logStatusChange($lead, $userId, $oldStatus, $newStatus)
    {
        return self::create([
            'lead_id' => $lead->id,
            'user_id' => $userId,
            'action' => self::ACTION_STATUS_CHANGED,
            'description' => "Status changed from {$oldStatus} to {$newStatus}",
            'old_values' => ['status' => $oldStatus],
            'new_values' => ['status' => $newStatus],
            'ip_address' => request()->ip()
        ]);
    }

    public static function logAssignment($lead, $userId, $assignedToUserId)
    {
        $assignedUser = User::find($assignedToUserId);
        $assignedName = $assignedUser ? $assignedUser->name : 'Unknown User';
        
        return self::create([
            'lead_id' => $lead->id,
            'user_id' => $userId,
            'action' => self::ACTION_ASSIGNED,
            'description' => "Lead assigned to {$assignedName}",
            'old_values' => ['assigned_to' => $lead->getOriginal('assigned_to')],
            'new_values' => ['assigned_to' => $assignedToUserId],
            'ip_address' => request()->ip()
        ]);
    }
}
