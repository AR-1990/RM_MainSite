<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'full_address',
        'city',
        'location',
        'price',
        'use_custom_price_label',
        'custom_price_label',
        'property_category_id',
        'property_status',
        'size_prefix',
        'size',
        'marla_value',
        'furnished_status',
        'rooms',
        'bedrooms',
        'bathrooms',
        'garages',
        'video_url',
        'primary_image',
        'is_active',
        'is_sold',
        'is_deactivated',
        'user_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'use_custom_price_label' => 'boolean',
        'marla_value' => 'decimal:2',
        'is_active' => 'boolean',
        'is_sold' => 'boolean',
        'is_deactivated' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(PropertyCategory::class, 'property_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function floors()
    {
        return $this->hasMany(PropertyFloor::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function amenities()
    {
        return $this->hasMany(PropertyAmenity::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->where('is_deactivated', false);
    }

    public function scopeForSale($query)
    {
        return $query->where('property_status', 'for_sale');
    }

    public function scopeForRent($query)
    {
        return $query->where('property_status', 'for_rent');
    }

    public function scopeNotSold($query)
    {
        return $query->where('is_sold', false);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'PKR ' . number_format((float) $this->price);
    }

    public function getDisplayPriceAttribute(): string
    {
        if ($this->use_custom_price_label && filled($this->custom_price_label)) {
            return $this->custom_price_label;
        }

        return $this->formatted_price;
    }

    public function getDisplaySizeAttribute(): string
    {
        $size = $this->getRawOriginal('size');

        if ($size === null || $size === '') {
            return '';
        }

        if (is_numeric($size)) {
            return rtrim(rtrim(number_format((float) $size, 2, '.', ''), '0'), '.');
        }

        return trim((string) $size);
    }
}
