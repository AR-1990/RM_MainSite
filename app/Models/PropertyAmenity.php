<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAmenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'amenity_name',
        'amenity_type',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
