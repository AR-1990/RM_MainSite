<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'comment',
        'type',
        'is_internal'
    ];

    protected $casts = [
        'is_internal' => 'boolean',
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
            'reminder' => 'badge-warning',
            'update' => 'badge-info',
            'note' => 'badge-secondary',
            'comment' => 'badge-primary',
            default => 'badge-secondary'
        };
    }

    public function getTypeTextAttribute(): string
    {
        return match($this->type) {
            'reminder' => 'Reminder',
            'update' => 'Update',
            'note' => 'Note',
            'comment' => 'Comment',
            default => 'Comment'
        };
    }

    public function getFormattedCommentAttribute(): string
    {
        // Convert line breaks to HTML
        return nl2br(e($this->comment));
    }

    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_internal', false);
    }

    public function scopeInternal($query)
    {
        return $query->where('is_internal', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
