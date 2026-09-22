<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'is_active',
        'subscribed_at',
        'unsubscribed_at',
        'source',
        'notes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * Scope to get only active subscriptions
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get only inactive subscriptions
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope to filter by source
     */
    public function scopeBySource($query, $source)
    {
        return $query->where('source', $source);
    }

    /**
     * Scope to get subscriptions from date range
     */
    public function scopeFromDateRange($query, $fromDate, $toDate)
    {
        return $query->whereBetween('subscribed_at', [$fromDate, $toDate]);
    }

    /**
     * Get the subscription status as a readable string
     */
    public function getStatusAttribute()
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    /**
     * Get the subscription status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return $this->is_active ? 'badge-success' : 'badge-secondary';
    }

    /**
     * Activate subscription
     */
    public function activate()
    {
        $this->update([
            'is_active' => true,
            'unsubscribed_at' => null
        ]);
    }

    /**
     * Deactivate subscription
     */
    public function deactivate()
    {
        $this->update([
            'is_active' => false,
            'unsubscribed_at' => now()
        ]);
    }

    /**
     * Check if subscription is active
     */
    public function isActive()
    {
        return $this->is_active;
    }

    /**
     * Get subscription duration in days
     */
    public function getDurationInDaysAttribute()
    {
        $endDate = $this->unsubscribed_at ?? now();
        return $this->subscribed_at->diffInDays($endDate);
    }
}
