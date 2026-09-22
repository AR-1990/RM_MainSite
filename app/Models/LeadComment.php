<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'user_id',
        'comment',
        'is_internal'
    ];

    protected $casts = [
        'is_internal' => 'boolean',
    ];

    /**
     * Get the lead that owns the comment.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Get the user who made the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
