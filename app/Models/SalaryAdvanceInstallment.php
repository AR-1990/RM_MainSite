<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryAdvanceInstallment extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_advance_id',
        'amount',
        'pay_date',
        'method',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'pay_date' => 'date:Y-m-d',
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function salaryAdvance()
    {
        return $this->belongsTo(SalaryAdvance::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeMethod($query, $method)
    {
        return $query->where('method', $method);
    }

    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('pay_date', [$startDate, $endDate]);
    }

    // Accessors
    public function getPayDateAttribute($value)
    {
        if (is_string($value)) {
            return Carbon::parse($value);
        }
        return $value;
    }

    public function getAmountFormattedAttribute()
    {
        return '₹' . number_format($this->amount, 2);
    }

    public function getMethodBadgeAttribute()
    {
        $badges = [
            'salary_deduction' => '<span class="badge badge-info">Salary Deduction</span>',
            'manual' => '<span class="badge badge-primary">Manual Payment</span>',
        ];

        return $badges[$this->method] ?? '<span class="badge badge-secondary">Unknown</span>';
    }
}


