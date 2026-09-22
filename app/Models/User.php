<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }

    public function assignedContacts()
    {
        return $this->hasMany(Contact::class, 'assigned_to');
    }

    public function createdContacts()
    {
        return $this->hasMany(Contact::class, 'created_by');
    }

    public function contactComments()
    {
        return $this->hasMany(ContactComment::class);
    }

    public function assignedLeads()
    {
        return $this->hasMany(Lead::class, 'assigned_to');
    }

    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class);
    }

    public function workloadTasks()
    {
        return $this->belongsToMany(WorkloadTask::class, 'task_assignments', 'user_id', 'task_id')
                    ->withPivot('role', 'status', 'accepted_at', 'started_at', 'completed_at', 'notes')
                    ->withTimestamps();
    }

    public function taskAssignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }

    public function salaryAdvances()
    {
        return $this->hasMany(SalaryAdvance::class);
    }

    public function createdSalaryAdvances()
    {
        return $this->hasMany(SalaryAdvance::class, 'created_by');
    }

    public function salaryPayments()
    {
        return $this->hasMany(SalaryPayment::class);
    }

    public function createdLeads()
    {
        return $this->hasMany(Lead::class, 'created_by');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAgents($query)
    {
        return $query->where('role', 'agent');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    // Accessors
    public function getRoleBadgeAttribute()
    {
        $badges = [
            'admin' => '<span class="badge badge-danger">Admin</span>',
            'agent' => '<span class="badge badge-warning">Agent</span>',
            'user' => '<span class="badge badge-info">User</span>',
        ];

        return $badges[$this->role] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active 
            ? '<span class="badge badge-success">Active</span>'
            : '<span class="badge badge-danger">Inactive</span>';
    }

    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile && $this->profile->profile_picture) {
            return $this->profile->profile_picture_url;
        }
        return url('assets-admin/img/avatar/avatar-1.png');
    }

    public function getFullNameAttribute()
    {
        return $this->name;
    }

    public function getDepartmentAttribute()
    {
        return $this->profile?->department ?? 'Not Assigned';
    }

    public function getDesignationAttribute()
    {
        return $this->profile?->designation ?? 'Not Assigned';
    }

    public function getDateOfJoiningAttribute()
    {
        return $this->profile?->date_of_joining?->format('d M Y') ?? 'Not Set';
    }

    public function getSalaryAttribute()
    {
        return $this->profile?->total_salary ?? 0;
    }

    public function getSalaryFormattedAttribute()
    {
        return $this->profile?->salary_formatted ?? '₹0.00';
    }
}
