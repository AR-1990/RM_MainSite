<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            if (blank($category->slug) && filled($category->name)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'project_type', 'name');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function renderOptions($categories, $selectedValue = null): string
    {
        return '<option value="">Select Type</option>' . $categories
            ->map(fn ($category) => '<option value="' . e($category->name) . '"' . ((string) $selectedValue === (string) $category->name ? ' selected' : '') . '>' . e($category->name) . '</option>')
            ->implode('');
    }
}
