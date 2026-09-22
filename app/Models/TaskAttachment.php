<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TaskAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'file_name',
        'file_path',
        'file_type',
        'original_name',
        'file_size',
        'description',
        'uploaded_by'
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    // Relationships
    public function task(): BelongsTo
    {
        return $this->belongsTo(WorkloadTask::class, 'task_id');
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Accessors
    public function getFileUrlAttribute(): string
    {
        // Use url() helper for public uploads
        return url('uploads/' . $this->file_path);
    }

    public function getFileSizeFormattedAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFileIconAttribute(): string
    {
        return match($this->file_type) {
            'pdf' => 'fas fa-file-pdf text-danger',
            'doc', 'docx' => 'fas fa-file-word text-primary',
            'xls', 'xlsx' => 'fas fa-file-excel text-success',
            'ppt', 'pptx' => 'fas fa-file-powerpoint text-warning',
            'jpg', 'jpeg', 'png', 'gif' => 'fas fa-file-image text-info',
            'zip', 'rar' => 'fas fa-file-archive text-secondary',
            default => 'fas fa-file text-muted'
        };
    }

    public function getIsImageAttribute(): bool
    {
        return in_array($this->file_type, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
    }

    public function getIsDocumentAttribute(): bool
    {
        return in_array($this->file_type, ['pdf', 'doc', 'docx', 'txt', 'rtf']);
    }

    public function getIsSpreadsheetAttribute(): bool
    {
        return in_array($this->file_type, ['xls', 'xlsx', 'csv']);
    }

    // Methods
    public function deleteFile(): bool
    {
        $filePath = public_path('uploads/' . $this->file_path);
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($attachment) {
            $attachment->deleteFile();
        });
    }
}
