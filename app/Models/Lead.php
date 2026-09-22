<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'contact_name',
        'contact_email',
        'contact_phone',
        'company',
        'source',
        'status',
        'priority',
        'value',
        'currency',
        'expected_close_date',
        'assigned_to',
        'created_by',
        'notes',
        'attachments',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'expected_close_date' => 'date',
        'attachments' => 'array',
        'value' => 'decimal:2'
    ];

    // Status constants
    const STATUS_OPEN = 'open';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_CLOSED = 'closed';
    const STATUS_LOST = 'lost';
    const STATUS_CANCEL = 'cancel';
    const STATUS_NEW = 'new';

    // Priority constants
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';

    // Source constants
    const SOURCE_CONTACT_FORM = 'contact_form';
    const SOURCE_WEBSITE = 'website';
    const SOURCE_REFERRAL = 'referral';
    const SOURCE_SOCIAL_MEDIA = 'social_media';
    const SOURCE_COLD_CALL = 'cold_call';
    const SOURCE_OTHER = 'other';

    // Static methods to get constants
    public static function getStatusConstants()
    {
        return [
            self::STATUS_NEW,
            self::STATUS_OPEN,
            self::STATUS_IN_PROGRESS,
            self::STATUS_CLOSED,
            self::STATUS_LOST,
            self::STATUS_CANCEL
        ];
    }

    public static function getPriorityConstants()
    {
        return [
            self::PRIORITY_LOW,
            self::PRIORITY_MEDIUM,
            self::PRIORITY_HIGH,
            self::PRIORITY_URGENT
        ];
    }

    public static function getSourceConstants()
    {
        return [
            self::SOURCE_CONTACT_FORM,
            self::SOURCE_WEBSITE,
            self::SOURCE_REFERRAL,
            self::SOURCE_SOCIAL_MEDIA,
            self::SOURCE_COLD_CALL,
            self::SOURCE_OTHER
        ];
    }

    // Relationships
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(LeadComment::class)->orderBy('created_at', 'desc');
    }

    public function activities()
    {
        return $this->hasMany(LeadActivity::class)->orderBy('created_at', 'desc');
    }

    public function attachments()
    {
        return $this->hasMany(LeadAttachment::class);
    }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->where('status', self::STATUS_OPEN);
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    public function scopeClosed($query)
    {
        return $query->where('status', self::STATUS_CLOSED);
    }

    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }

    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    public function scopeCreatedBy($query, $userId)
    {
        return $query->where('created_by', $userId);
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', [self::PRIORITY_HIGH, self::PRIORITY_URGENT]);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_NEW => '<span class="badge badge-info">New</span>',
            self::STATUS_OPEN => '<span class="badge badge-primary">Open</span>',
            self::STATUS_IN_PROGRESS => '<span class="badge badge-warning">In Progress</span>',
            self::STATUS_CLOSED => '<span class="badge badge-success">Closed</span>',
            self::STATUS_LOST => '<span class="badge badge-danger">Lost</span>',
            self::STATUS_CANCEL => '<span class="badge badge-dark">Cancelled</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getPriorityBadgeAttribute()
    {
        $badges = [
            self::PRIORITY_LOW => '<span class="badge badge-info">Low</span>',
            self::PRIORITY_MEDIUM => '<span class="badge badge-warning">Medium</span>',
            self::PRIORITY_HIGH => '<span class="badge badge-danger">High</span>',
            self::PRIORITY_URGENT => '<span class="badge badge-dark">Urgent</span>',
        ];

        return $badges[$this->priority] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getSourceBadgeAttribute()
    {
        $badges = [
            self::SOURCE_CONTACT_FORM => '<span class="badge badge-info">Contact Form</span>',
            self::SOURCE_WEBSITE => '<span class="badge badge-primary">Website</span>',
            self::SOURCE_REFERRAL => '<span class="badge badge-success">Referral</span>',
            self::SOURCE_SOCIAL_MEDIA => '<span class="badge badge-warning">Social Media</span>',
            self::SOURCE_COLD_CALL => '<span class="badge badge-secondary">Cold Call</span>',
            self::SOURCE_OTHER => '<span class="badge badge-dark">Other</span>',
        ];

        return $badges[$this->source] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getSourceLabelAttribute()
    {
        $labels = [
            self::SOURCE_CONTACT_FORM => 'Contact Form',
            self::SOURCE_WEBSITE => 'Website',
            self::SOURCE_REFERRAL => 'Referral',
            self::SOURCE_SOCIAL_MEDIA => 'Social Media',
            self::SOURCE_COLD_CALL => 'Cold Call',
            self::SOURCE_OTHER => 'Other',
        ];

        return $labels[$this->source] ?? 'Unknown';
    }

    public function getFormattedValueAttribute()
    {
        if (!$this->value) return 'N/A';
        return $this->currency . ' ' . number_format($this->value, 2);
    }

    public function getDaysOpenAttribute()
    {
        return $this->created_at->diffInDays(now());
    }

    // Methods
    public function isAssigned()
    {
        return !is_null($this->assigned_to);
    }

    public function canBeAssigned()
    {
        return $this->status !== self::STATUS_CLOSED && $this->status !== self::STATUS_LOST;
    }

    public function markAsInProgress()
    {
        $this->update(['status' => self::STATUS_IN_PROGRESS]);
    }

    public function markAsClosed()
    {
        $this->update(['status' => self::STATUS_CLOSED]);
    }

    public function assignTo($userId)
    {
        $this->update(['assigned_to' => $userId]);
    }
}
