<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'source', // 'contact_page', 'property_inquiry', 'agent_inquiry', etc.
        'property_id', // if related to a property
        'agent_id', // if related to an agent
        'status', // 'new', 'read', 'replied', 'closed'
        'ip_address',
        'user_agent',
        'is_read',
        'read_at',
        'replied_at',
        'notes',
        // Lead management fields
        'lead_status',
        'lead_value',
        'lead_currency',
        'expected_close_date',
        'lead_tags',
        'lead_notes',
        'assigned_to',
        'created_by',
        'lead_created_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'replied_at' => 'datetime',
        'lead_created_at' => 'datetime',
        'lead_tags' => 'array',
        'expected_close_date' => 'date',
    ];

    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

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
        return $this->hasMany(ContactComment::class)->orderBy('created_at', 'desc');
    }

    // Scopes
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Lead management scopes
    public function scopeLeadStatus($query, $status)
    {
        return $query->where('lead_status', $status);
    }

    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    public function scopeUnassigned($query)
    {
        return $query->whereNull('assigned_to');
    }

    public function scopeMyLeads($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'new' => '<span class="badge badge-primary">New</span>',
            'read' => '<span class="badge badge-info">Read</span>',
            'replied' => '<span class="badge badge-success">Replied</span>',
            'closed' => '<span class="badge badge-secondary">Closed</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getLeadStatusBadgeAttribute()
    {
        $badges = [
            'new' => '<span class="badge badge-info">New</span>',
            'open' => '<span class="badge badge-primary">Open</span>',
            'in_progress' => '<span class="badge badge-warning">In Progress</span>',
            'closed' => '<span class="badge badge-success">Closed</span>',
            'lost' => '<span class="badge badge-danger">Lost</span>',
            'cancel' => '<span class="badge badge-dark">Cancelled</span>',
        ];

        return $badges[$this->lead_status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getSourceLabelAttribute()
    {
        $labels = [
            'contact_page' => 'Contact Page',
            'property_inquiry' => 'Property Inquiry',
            'agent_inquiry' => 'Agent Inquiry',
            'general' => 'General Inquiry',
        ];

        return $labels[$this->source] ?? 'Unknown';
    }

    public function getFormattedValueAttribute()
    {
        if (!$this->lead_value) {
            return 'Not specified';
        }
        return $this->lead_currency . ' ' . number_format($this->lead_value, 2);
    }

    public function getTagsDisplayAttribute()
    {
        if (!$this->lead_tags || empty($this->lead_tags)) {
            return 'No tags';
        }
        
        $tags = collect($this->lead_tags)->map(function($tag) {
            return '<span class="badge badge-light mr-1">' . htmlspecialchars($tag) . '</span>';
        })->join('');
        
        return $tags;
    }

    // Methods
    public function isAssigned()
    {
        return !is_null($this->assigned_to);
    }

    public function canBeAssigned()
    {
        return $this->lead_status !== 'closed' && $this->lead_status !== 'lost' && $this->lead_status !== 'cancel';
    }

    public function markAsLead()
    {
        if (!$this->lead_created_at) {
            $this->update([
                'lead_created_at' => now(),
                'lead_status' => 'new'
            ]);
        }
    }

    public function updateLeadStatus($status)
    {
        $this->update(['lead_status' => $status]);
    }

    public function assignTo($userId)
    {
        $this->update(['assigned_to' => $userId]);
    }

    public function addComment($comment, $userId)
    {
        return $this->comments()->create([
            'user_id' => $userId,
            'comment' => $comment
        ]);
    }
}
