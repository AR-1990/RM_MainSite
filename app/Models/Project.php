<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'location',
        'price',
        'price_type', // per_sqft, total, negotiable
        'area',
        'area_unit', // sqft, sqm, acres
        'bedrooms',
        'bathrooms',
        'floors',
        'project_type', // residential, commercial, mixed
        'status', // planning, under_construction, ready_to_move, completed
        'completion_date',
        'developer',
        'amenities',
        'features',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
        'is_featured',
        'main_image',
        'gallery_images',
        'video_url'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'amenities' => 'array',
        'features' => 'array',
        'gallery_images' => 'array',
        'completion_date' => 'date',
        'price' => 'decimal:2',
        'area' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('project_type', $type);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'like', '%' . $location . '%');
    }

    public function scopeByPriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    // Accessors
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'upcoming' => 'bg-info',
            'under_construction' => 'bg-warning',
            'ready_to_move' => 'bg-success',
            default => 'bg-secondary'
        };
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'upcoming' => 'Upcoming',
            'under_construction' => 'Under Construction',
            'ready_to_move' => 'Ready to Move',
            default => 'Unknown'
        };
    }

    public function getProjectTypeBadgeClassAttribute()
    {
        $type = Str::slug($this->project_type_text);

        return match($type) {
            'residential' => 'bg-primary',
            'commercial' => 'bg-success',
            'mixed' => 'bg-info',
            default => 'bg-secondary'
        };
    }

    public function getProjectTypeTextAttribute()
    {
        if (!$this->project_type) {
            return 'Unknown';
        }

        return $this->project_type;
    }

    public function getFormattedPriceAttribute()
    {
        if ($this->price_type === 'per_sqft') {
            return 'PKR ' . number_format($this->price) . '/sq ft';
        } elseif ($this->price_type === 'negotiable') {
            return 'PKR ' . number_format($this->price) . ' (Negotiable)';
        } else {
            return 'PKR ' . number_format($this->price);
        }
    }

    public function getFormattedAreaAttribute()
    {
        return number_format($this->area) . ' ' . strtoupper($this->area_unit);
    }

    public function getMainImageAttribute()
    {
        // Handle both old and new field names during transition
        if (isset($this->attributes['main_image']) && $this->attributes['main_image']) {
            return $this->attributes['main_image'];
        }
        
        // Fallback to old field name if it exists
        if (isset($this->attributes['featured_image']) && $this->attributes['featured_image']) {
            return $this->attributes['featured_image'];
        }
        
        // Fallback to gallery images
        $galleryImages = $this->normalizeArrayValue($this->attributes['gallery_images'] ?? $this->gallery_images ?? []);

        return $galleryImages[0] ?? null;
    }

    public function getRawMainImageAttribute()
    {
        // Return the actual database value for main_image
        return $this->attributes['main_image'] ?? null;
    }

    public function getRawFeaturedImageAttribute()
    {
        // Return the actual database value for featured_image (for backward compatibility)
        return $this->attributes['featured_image'] ?? null;
    }

    public function getMainImageUrlAttribute()
    {
        $imagePath = $this->main_image;
        if ($imagePath) {
            return url($imagePath);
        }
        return null;
    }

    public function getGalleryImagesUrlsAttribute()
    {
        $galleryImages = $this->normalizeArrayValue($this->attributes['gallery_images'] ?? $this->gallery_images ?? []);

        if (!empty($galleryImages)) {
            return array_map(function($image) {
                return url($image);
            }, $galleryImages);
        }
        return [];
    }

    public function getGalleryCountAttribute()
    {
        return count($this->normalizeArrayValue($this->attributes['gallery_images'] ?? $this->gallery_images ?? []));
    }

    protected function normalizeArrayValue($value): array
    {
        if ($value instanceof \Illuminate\Support\Collection) {
            $value = $value->all();
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $value = is_array($decoded) ? $decoded : [];
        }

        if (!is_array($value)) {
            return [];
        }

        return array_values(array_filter($value, static fn ($item) => filled($item)));
    }

    // Video helpers
    public function getYoutubeVideoIdAttribute()
    {
        $url = $this->video_url;
        if (!$url) return null;
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }

    public function getYoutubeEmbedUrlAttribute()
    {
        $videoId = $this->youtube_video_id;
        if ($videoId) {
            // Disable autoplay by not including autoplay params
            return "https://www.youtube.com/embed/{$videoId}";
        }
        return null;
    }

    // Relationships - Commented out until models are created
    /*
    public function inquiries()
    {
        return $this->hasMany(ProjectInquiry::class);
    }

    public function favorites()
    {
        return $this->hasMany(ProjectFavorite::class);
    }
    */
}
