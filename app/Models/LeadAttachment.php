<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'user_id',
        'filename',
        'original_filename',
        'file_path',
        'file_size',
        'mime_type',
        'description'
    ];

    protected $casts = [
        'file_size' => 'integer'
    ];

    // Relationships
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFileIconAttribute()
    {
        $mimeType = $this->mime_type;
        
        if (str_starts_with($mimeType, 'image/')) {
            return 'fas fa-image';
        } elseif (str_starts_with($mimeType, 'video/')) {
            return 'fas fa-video';
        } elseif (str_starts_with($mimeType, 'audio/')) {
            return 'fas fa-music';
        } elseif (str_starts_with($mimeType, 'application/pdf')) {
            return 'fas fa-file-pdf';
        } elseif (str_starts_with($mimeType, 'application/msword') || str_starts_with($mimeType, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
            return 'fas fa-file-word';
        } elseif (str_starts_with($mimeType, 'application/vnd.ms-excel') || str_starts_with($mimeType, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')) {
            return 'fas fa-file-excel';
        } elseif (str_starts_with($mimeType, 'application/vnd.ms-powerpoint') || str_starts_with($mimeType, 'application/vnd.openxmlformats-officedocument.presentationml.presentation')) {
            return 'fas fa-file-powerpoint';
        } elseif (str_starts_with($mimeType, 'text/')) {
            return 'fas fa-file-alt';
        } else {
            return 'fas fa-file';
        }
    }

    public function getDownloadUrlAttribute()
    {
        return route('admin.leads.attachments.download', $this->id);
    }

    public function getPreviewUrlAttribute()
    {
        if (str_starts_with($this->mime_type, 'image/')) {
            return url($this->file_path);
        }
        
        return null;
    }

    public function isImage()
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    public function isDocument()
    {
        return str_starts_with($this->mime_type, 'application/') || str_starts_with($this->mime_type, 'text/');
    }

    public function isVideo()
    {
        return str_starts_with($this->mime_type, 'video/');
    }

    public function isAudio()
    {
        return str_starts_with($this->mime_type, 'audio/');
    }
}
