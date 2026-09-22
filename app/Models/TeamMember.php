<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'bio',
        'email',
        'phone',
        'linkedin',
        'twitter',
        'facebook',
        'instagram',
        'image',
        'is_active',
        'sort_order',
        'expertise',
        'experience_years',
        'education',
        'certifications',
        'achievements'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'expertise' => 'array',
        'achievements' => 'array',
        'certifications' => 'array'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return url($this->image);
        }
        return url('images/default-team-member.jpg');
    }

    public function getFullBioAttribute()
    {
        return $this->bio ?: 'Experienced professional with expertise in ' . implode(', ', $this->expertise ?? ['real estate']);
    }
}
