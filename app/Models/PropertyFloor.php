<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFloor extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'floor_name',
        'floor_price',
        'price_prefix',
        'floor_size',
        'size_postfix',
        'bedrooms',
        'bathrooms',
        'floor_image',
        'description'
    ];

    protected $casts = [
        'floor_price' => 'decimal:2',
        'floor_size' => 'decimal:2',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
