<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'check_in_time',
        'check_out_time',
        'break_start_time',
        'break_end_time',
        'expected_check_in',
        'expected_check_out',
        'status',
        'work_type',
        'location',
        'work_description',
        'comments',
        'total_hours',
        'break_hours',
        'late_minutes',
        'is_late',
        'overtime_hours',
        'attendance_note',
        'is_approved',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'date' => 'date',
        'check_in_time' => 'datetime:H:i',
        'check_out_time' => 'datetime:H:i',
        'break_start_time' => 'datetime:H:i',
        'break_end_time' => 'datetime:H:i',
        'expected_check_in' => 'datetime:H:i',
        'expected_check_out' => 'datetime:H:i',
        'total_hours' => 'decimal:2',
        'break_hours' => 'decimal:2',
        'late_minutes' => 'integer',
        'is_late' => 'boolean',
        'overtime_hours' => 'decimal:2',
        'is_approved' => 'boolean',
        'approved_at' => 'datetime'
    ];

    protected $attributes = [
        'break_hours' => 0,
        'late_minutes' => 0,
        'is_late' => false,
        'overtime_hours' => 0,
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Scopes
    public function scopeToday($query)
    {
        return $query->where('date', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('date', now()->month)->whereYear('date', now()->year);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByWorkType($query, $workType)
    {
        return $query->where('work_type', $workType);
    }

    public function scopePendingApproval($query)
    {
        return $query->where('is_approved', false);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    // Accessors
    public function getFormattedDateAttribute()
    {
        return $this->date->format('d M Y');
    }

    public function getFormattedCheckInTimeAttribute()
    {
        return $this->check_in_time ? $this->check_in_time->format('H:i') : '--';
    }

    public function getFormattedCheckOutTimeAttribute()
    {
        return $this->check_out_time ? $this->check_out_time->format('H:i') : '--';
    }

    public function getFormattedTotalHoursAttribute()
    {
        return $this->total_hours ? number_format($this->total_hours, 2) . ' hrs' : '--';
    }

    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'present' => 'badge bg-success',
            'absent' => 'badge bg-danger',
            'late' => 'badge bg-warning',
            'half_day' => 'badge bg-info',
            'outdoor' => 'badge bg-primary',
            'leave' => 'badge bg-secondary',
            default => 'badge bg-secondary'
        };
    }

    public function getWorkTypeBadgeClassAttribute()
    {
        return match($this->work_type) {
            'office' => 'badge bg-success',
            'outdoor' => 'badge bg-primary',
            'remote' => 'badge bg-info',
            'meeting' => 'badge bg-warning',
            default => 'badge bg-secondary'
        };
    }

    public function getIsLateAttribute()
    {
        if (!$this->check_in_time) return false;
        
        $expectedTime = $this->expected_check_in ? Carbon::parse($this->expected_check_in) : Carbon::parse('09:00:00');
        $checkInTime = Carbon::parse($this->check_in_time);
        
        return $checkInTime->gt($expectedTime);
    }

    public function getIsEarlyAttribute()
    {
        if (!$this->check_in_time) return false;
        
        $expectedTime = $this->expected_check_in ? Carbon::parse($this->expected_check_in) : Carbon::parse('09:00:00');
        $checkInTime = Carbon::parse($this->check_in_time);
        
        return $checkInTime->lt($expectedTime);
    }

    // Methods
    public function calculateTotalHours()
    {
        if (!$this->check_in_time || !$this->check_out_time) {
            return null;
        }

        $checkIn = Carbon::parse($this->check_in_time);
        $checkOut = Carbon::parse($this->check_out_time);
        
        $totalMinutes = $checkOut->diffInMinutes($checkIn);
        $breakMinutes = $this->break_hours * 60;
        
        $netMinutes = $totalMinutes - $breakMinutes;
        
        return round($netMinutes / 60, 2);
    }

    public function markAsApproved($approvedBy)
    {
        $this->update([
            'is_approved' => true,
            'approved_by' => $approvedBy,
            'approved_at' => now()
        ]);
    }

    public function isOutdoorWork()
    {
        return $this->work_type === 'outdoor';
    }

    public function hasLocation()
    {
        return !empty($this->location);
    }

    public function hasWorkDescription()
    {
        return !empty($this->work_description);
    }

    public function hasComments()
    {
        return !empty($this->comments);
    }

    // Enhanced late calculation methods
    public function calculateLateMinutes()
    {
        if (!$this->check_in_time) return 0;
        
        $expectedTime = $this->expected_check_in ? Carbon::parse($this->expected_check_in) : Carbon::parse('09:00:00');
        $checkInTime = Carbon::parse($this->check_in_time);
        
        if ($checkInTime->gt($expectedTime)) {
            return $checkInTime->diffInMinutes($expectedTime);
        }
        
        return 0;
    }

    public function calculateOvertimeHours()
    {
        if (!$this->check_out_time) return 0;
        
        $expectedTime = $this->expected_check_out ? Carbon::parse($this->expected_check_out) : Carbon::parse('18:00:00');
        $checkOutTime = Carbon::parse($this->check_out_time);
        
        if ($checkOutTime->gt($expectedTime)) {
            return round($checkOutTime->diffInMinutes($expectedTime) / 60, 2);
        }
        
        return 0;
    }

    public function getLateStatusAttribute()
    {
        if ($this->status === 'absent' || $this->status === 'leave') {
            return 'N/A';
        }
        
        if ($this->is_late) {
            $minutes = $this->late_minutes ?: $this->calculateLateMinutes();
            if ($minutes <= 15) return 'Slightly Late';
            if ($minutes <= 30) return 'Late';
            if ($minutes <= 60) return 'Very Late';
            return 'Extremely Late';
        }
        
        return 'On Time';
    }

    public function getLateStatusBadgeClassAttribute()
    {
        if ($this->status === 'absent' || $this->status === 'leave') {
            return 'badge bg-secondary';
        }
        
        if ($this->is_late) {
            $minutes = $this->late_minutes ?: $this->calculateLateMinutes();
            if ($minutes <= 15) return 'badge bg-warning';
            if ($minutes <= 30) return 'badge bg-orange';
            if ($minutes <= 60) return 'badge bg-danger';
            return 'badge bg-dark';
        }
        
        return 'badge bg-success';
    }

    // New scopes for enhanced filtering
    public function scopeLate($query)
    {
        return $query->where('is_late', true);
    }

    public function scopeOnTime($query)
    {
        return $query->where('is_late', false);
    }

    public function scopeByLateMinutes($query, $minutes)
    {
        return $query->where('late_minutes', '>=', $minutes);
    }

    public function scopeHasOvertime($query)
    {
        return $query->where('overtime_hours', '>', 0);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    public function scopeByMonth($query, $month, $year = null)
    {
        $year = $year ?: now()->year;
        return $query->whereMonth('date', $month)->whereYear('date', $year);
    }

    public function scopeByYear($query, $year)
    {
        return $query->whereYear('date', $year);
    }
}
