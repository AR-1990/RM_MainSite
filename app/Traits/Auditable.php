<?php

namespace App\Traits;

use App\Models\TaskAuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait Auditable
{
    /**
     * Log an audit entry for this model.
     */
    protected function logAudit($action, $description, $fieldName = null, $oldValue = null, $newValue = null, $metadata = [])
    {
        if (!Auth::check()) {
            return;
        }

        try {
            $metadata = array_merge($metadata, [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'url' => request()->fullUrl(),
                'method' => request()->method(),
            ]);

            TaskAuditLog::create([
                'task_id' => $this->id,
                'user_id' => Auth::id(),
                'action' => $action,
                'field_name' => $fieldName,
                'old_value' => $oldValue,
                'new_value' => $newValue,
                'description' => $description,
                'metadata' => $metadata,
            ]);
        } catch (\Exception $e) {
            // Log the error but don't break the main functionality
            Log::error('Audit logging failed: ' . $e->getMessage(), [
                'action' => $action,
                'description' => $description,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Log when a task is created.
     */
    protected function logTaskCreated()
    {
        $taskData = $this->toArray();
        
        // Convert Carbon objects to strings for audit logging
        foreach ($taskData as $key => $value) {
            if ($value instanceof \Carbon\Carbon) {
                $taskData[$key] = $value->format('Y-m-d H:i:s');
            }
        }
        
        $this->logAudit(
            'created',
            "Task '{$this->title}' was created",
            null,
            null,
            null,
            ['task_data' => $taskData]
        );
    }

    /**
     * Log when a task is updated.
     */
    protected function logTaskUpdated($changes)
    {
        foreach ($changes as $field => $values) {
            if (in_array($field, ['updated_at', 'created_at'])) {
                continue;
            }

            $oldValue = $values[0] ?? null;
            $newValue = $values[1] ?? null;

            // Convert Carbon objects to strings for audit logging
            if ($oldValue instanceof \Carbon\Carbon) {
                $oldValue = $oldValue->format('Y-m-d H:i:s');
            }
            if ($newValue instanceof \Carbon\Carbon) {
                $newValue = $newValue->format('Y-m-d H:i:s');
            }

            if ($oldValue !== $newValue) {
                $this->logAudit(
                    'updated',
                    "Updated {$field}",
                    $field,
                    $oldValue,
                    $newValue
                );
            }
        }
    }

    /**
     * Log when a task is deleted.
     */
    protected function logTaskDeleted()
    {
        $taskData = $this->toArray();
        
        // Convert Carbon objects to strings for audit logging
        foreach ($taskData as $key => $value) {
            if ($value instanceof \Carbon\Carbon) {
                $taskData[$key] = $value->format('Y-m-d H:i:s');
            }
        }
        
        $this->logAudit(
            'deleted',
            "Task '{$this->title}' was deleted",
            null,
            null,
            null,
            ['deleted_task_data' => $taskData]
        );
    }

    /**
     * Log when task status changes.
     */
    public function logStatusChange($oldStatus, $newStatus)
    {
        $this->logAudit(
            'status_changed',
            "Task status changed from '{$oldStatus}' to '{$newStatus}'",
            'status',
            $oldStatus,
            $newStatus
        );
    }

    /**
     * Log when task priority changes.
     */
    protected function logPriorityChange($oldPriority, $newPriority)
    {
        $this->logAudit(
            'priority_changed',
            "Task priority changed from '{$oldPriority}' to '{$newPriority}'",
            'priority',
            $oldPriority,
            $newPriority
        );
    }

    /**
     * Log when task timeline changes.
     */
    protected function logTimelineChange($field, $oldValue, $newValue)
    {
        // Convert Carbon objects to strings for audit logging
        if ($oldValue instanceof \Carbon\Carbon) {
            $oldValue = $oldValue->format('Y-m-d H:i:s');
        }
        if ($newValue instanceof \Carbon\Carbon) {
            $newValue = $newValue->format('Y-m-d H:i:s');
        }
        
        $this->logAudit(
            'timeline_changed',
            "Task {$field} changed from '{$oldValue}' to '{$newValue}'",
            $field,
            $oldValue,
            $newValue
        );
    }

    /**
     * Log when users are assigned to task.
     */
    protected function logUserAssignment($userId, $role, $action = 'assigned')
    {
        $user = \App\Models\User::find($userId);
        $userName = $user ? $user->name : "User ID: {$userId}";
        
        $this->logAudit(
            'user_assignment',
            "User '{$userName}' was {$action} as {$role}",
            'user_assignment',
            null,
            "User: {$userName}, Role: {$role}, Action: {$action}"
        );
    }

    /**
     * Log when comments are added.
     */
    public function logCommentAdded($comment, $isInternal = false)
    {
        $type = $isInternal ? 'internal note' : 'comment';
        $this->logAudit(
            'comment_added',
            "Added {$type}: " . substr($comment, 0, 100) . (strlen($comment) > 100 ? '...' : ''),
            'comment',
            null,
            $comment,
            ['is_internal' => $isInternal]
        );
    }

    /**
     * Log when attachments are added.
     */
    protected function logAttachmentAdded($fileName, $fileSize)
    {
        $this->logAudit(
            'attachment_added',
            "Added attachment: {$fileName} ({$fileSize} bytes)",
            'attachment',
            null,
            $fileName,
            ['file_size' => $fileSize]
        );
    }

    /**
     * Log when attachments are removed.
     */
    protected function logAttachmentRemoved($fileName)
    {
        $this->logAudit(
            'attachment_removed',
            "Removed attachment: {$fileName}",
            'attachment',
            $fileName,
            null
        );
    }
}
