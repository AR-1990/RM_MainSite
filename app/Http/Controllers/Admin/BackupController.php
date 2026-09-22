<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backup;


class BackupController extends Controller
{
    // Show backups index page
    public function index()
    {
        $backups = Backup::orderByDesc('id')->get();
        return view('admin.backups.index', compact('backups'));
    }

    // Handle file upload (move) with title and description
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file', // any type allowed per requirement
        ]);

        // Ensure backups directory exists under public/uploads/backups
        $backupDir = public_path('uploads/backups');
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $mime = $file->getClientMimeType();
        $size = $file->getSize();
        $extension = $file->getClientOriginalExtension();

        // Generate a unique filename to avoid collisions
        $uniqueName = uniqid('backup_', true) . ($extension ? ('.' . $extension) : '');

        // Move file without using Storage facade
        $file->move($backupDir, $uniqueName);

        $relativePath = 'uploads/backups/' . $uniqueName;

        $backup = Backup::create([
            'title' => $request->title,
            'description' => $request->description,
            'filename' => $uniqueName,
            'original_name' => $originalName,
            'mime_type' => $mime,
            'size' => $size,
            'path' => $relativePath,
        ]);

        return redirect()->route('admin.backups.index')->with('success', 'File uploaded successfully.');
    }

    // Download a specific backup file by id
    public function download($id)
    {
        $backup = Backup::findOrFail($id);
        $path = public_path($backup->path);
        if (!file_exists($path)) {
            return redirect()->route('admin.backups.index')->with('error', 'File not found.');
        }
        return response()->download($path, $backup->original_name);
    }

    // Delete a backup file by id
    public function destroy($id)
    {
        $backup = Backup::findOrFail($id);
        $path = public_path($backup->path);
        if (file_exists($path)) {
            unlink($path);
        }
        $backup->delete();
        return redirect()->route('admin.backups.index')->with('success', 'Backup deleted successfully');
    }

    // Run only the backups migration without terminal
   
}