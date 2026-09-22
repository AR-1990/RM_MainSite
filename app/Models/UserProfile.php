<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_picture',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'date_of_birth',
        'date_of_joining',
        'employee_id',
        'department',
        'designation',
        'reporting_to',
        'basic_salary',
        'allowances',
        'total_salary',
        'bank_name',
        'bank_account_number',
        'ifsc_code',
        'pan_number',
        'aadhar_number',
        'emergency_contact',
        'skills',
        'experience_summary',
        'education',
        'certifications',
        'is_portal_active',
        'last_login_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_joining' => 'date',
        'basic_salary' => 'decimal:2',
        'allowances' => 'decimal:2',
        'total_salary' => 'decimal:2',
        'is_portal_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getFullAddressAttribute()
    {
        $parts = array_filter([$this->address, $this->city, $this->state, $this->country, $this->postal_code]);
        return implode(', ', $parts);
    }

    public function getSalaryFormattedAttribute()
    {
        return '₹' . number_format($this->total_salary ?? 0, 2);
    }

    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile_picture) {
            return asset($this->profile_picture);
        }
        return url('assets-admin/img/avatar/avatar-1.png');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_portal_active', true);
    }

    public function scopeByDepartment($query, $department)
    {
        return $query->where('department', $department);
    }

    public function scopeByDesignation($query, $designation)
    {
        return $query->where('designation', $designation);
    }
}
