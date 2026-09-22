<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryAdvance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'advance_date',
        'description',
        'status',
        'settled_on',
        'settled_via',
        'created_by',
    ];

    protected $casts = [
        'advance_date' => 'date:Y-m-d',
        'settled_on' => 'date:Y-m-d',
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function installments()
    {
        return $this->hasMany(SalaryAdvanceInstallment::class, 'salary_advance_id');
    }

    // Scopes
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeSettled($query)
    {
        return $query->where('status', 'settled');
    }

    public function scopeUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('advance_date', [$startDate, $endDate]);
    }

    // Accessors
    public function getAdvanceDateAttribute($value)
    {
        if (is_string($value)) {
            return Carbon::parse($value);
        }
        return $value;
    }

    public function getSettledOnAttribute($value)
    {
        if (is_string($value)) {
            return $value ? Carbon::parse($value) : null;
        }
        return $value;
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge badge-warning">Pending</span>',
            'settled' => '<span class="badge badge-success">Settled</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getSettledViaBadgeAttribute()
    {
        if (!$this->settled_via) {
            return '<span class="badge badge-secondary">Not Settled</span>';
        }

        $badges = [
            'salary_deduction' => '<span class="badge badge-info">Salary Deduction</span>',
            'manual' => '<span class="badge badge-primary">Manual Payment</span>',
        ];

        return $badges[$this->settled_via] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getAmountFormattedAttribute()
    {
        return '₹' . number_format($this->amount, 2);
    }

    public function getIsOverdueAttribute()
    {
        // Consider overdue if not settled within 30 days
        return $this->status === 'pending' && 
               $this->advance_date->addDays(30) < now();
    }

    public function getDaysOverdueAttribute()
    {
        if (!$this->is_overdue) {
            return 0;
        }
        
        return $this->advance_date->addDays(30)->diffInDays(now());
    }

    // Methods
    public function settle($settledVia = 'manual', $settledOn = null)
    {
        $this->update([
            'status' => 'settled',
            'settled_via' => $settledVia,
            'settled_on' => $settledOn ?? now(),
        ]);
    }

    public function isSettled()
    {
        return $this->status === 'settled';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function getRemainingAmount()
    {
        if ($this->isSettled()) {
            return 0;
        }

        $paidAmount = $this->installments()->sum('amount');
        return max(0, $this->amount - $paidAmount);
    }

    public function getPaidAmount()
    {
        return $this->installments()->sum('amount');
    }

    public function getProgressPercentage()
    {
        if ($this->amount == 0) {
            return 0;
        }

        $paidAmount = $this->getPaidAmount();
        return min(100, round(($paidAmount / $this->amount) * 100));
    }
}


