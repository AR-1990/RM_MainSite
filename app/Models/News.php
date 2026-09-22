<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'youtube_link',
        'posted_date',
        'is_active',
        'featured',
        'slug',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'posted_date' => 'date',
        'is_active' => 'boolean',
        'featured' => 'boolean',
    ];

    /**
     * Scope to get only active news
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get only featured news
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope to get news by date range
     */
    public function scopeFromDateRange($query, $fromDate, $toDate)
    {
        return $query->whereBetween('posted_date', [$fromDate, $toDate]);
    }

    /**
     * Get the news status as a readable string
     */
    public function getStatusAttribute()
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    /**
     * Get the news status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return $this->is_active ? 'badge-success' : 'badge-secondary';
    }

    /**
     * Get the featured badge class
     */
    public function getFeaturedBadgeClassAttribute()
    {
        return $this->featured ? 'badge-warning' : 'badge-secondary';
    }

    /**
     * Extract YouTube video ID from link
     */
    public function getYoutubeVideoIdAttribute()
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        if (preg_match($pattern, $this->youtube_link, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Get YouTube embed URL
     */
    public function getYoutubeEmbedUrlAttribute()
    {
        $videoId = $this->youtube_video_id;
        if ($videoId) {
            return "https://www.youtube.com/embed/{$videoId}";
        }
        return null;
    }

    /**
     * Get YouTube thumbnail URL
     */
    public function getYoutubeThumbnailAttribute()
    {
        $videoId = $this->youtube_video_id;
        if ($videoId) {
            return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
        }
        return null;
    }

    /**
     * Get formatted posted date
     */
    public function getFormattedPostedDateAttribute()
    {
        return $this->posted_date->format('F j, Y');
    }

    /**
     * Get short content (first 150 characters)
     */
    public function getShortContentAttribute()
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Generate slug from title
     */
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
        
        static::updating(function ($news) {
            if ($news->isDirty('title') && empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }
}
