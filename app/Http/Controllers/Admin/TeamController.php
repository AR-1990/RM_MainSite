<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::ordered()->paginate(15);
        $stats = [
            'total' => TeamMember::count(),
            'active' => TeamMember::where('is_active', true)->count(),
            'inactive' => TeamMember::where('is_active', false)->count(),
        ];
        
        return view('admin.team.index', compact('teamMembers', 'stats'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable',
            'sort_order' => 'nullable|integer|min:0',
            'expertise' => 'nullable|array',
            'expertise.*' => 'string|max:100',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'education' => 'nullable|string|max:500',
            'certifications' => 'nullable|array',
            'certifications.*' => 'string|max:200',
            'achievements' => 'nullable|array',
            'achievements.*' => 'string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->all();
            
            // Handle boolean fields
            $data['is_active'] = $request->has('is_active');
            
            // Handle arrays
            $data['expertise'] = $request->input('expertise') ?: [];
            $data['certifications'] = $request->input('certifications') ?: [];
            $data['achievements'] = $request->input('achievements') ?: [];
            
            // Handle image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'team_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Create directory if it doesn't exist
                $uploadDir = public_path('uploads/team');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                // Move file to uploads directory
                $image->move($uploadDir, $imageName);
                $data['image'] = 'uploads/team/' . $imageName;
            }
            
            $teamMember = TeamMember::create($data);
            
            Log::info('Team member created successfully', ['id' => $teamMember->id, 'name' => $teamMember->name]);
            
            return response()->json([
                'success' => true,
                'message' => 'Team member created successfully!',
                'redirect' => route('admin.team.index')
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error creating team member', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function show(TeamMember $teamMember)
    {
        return view('admin.team.show', compact('teamMember'));
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable',
            'sort_order' => 'nullable|integer|min:0',
            'expertise' => 'nullable|array',
            'expertise.*' => 'string|max:100',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'education' => 'nullable|string|max:500',
            'certifications' => 'nullable|array',
            'certifications.*' => 'string|max:200',
            'achievements' => 'nullable|array',
            'achievements.*' => 'string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->all();
            
            // Handle boolean fields
            $data['is_active'] = $request->has('is_active');
            
            // Handle arrays
            $data['expertise'] = $request->input('expertise') ?: [];
            $data['certifications'] = $request->input('certifications') ?: [];
            $data['achievements'] = $request->input('achievements') ?: [];
            
            // Handle image
            if ($request->hasFile('image')) {
                // Delete old image
                if ($teamMember->image) {
                    $oldImagePath = public_path('uploads/' . $teamMember->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                
                $image = $request->file('image');
                $imageName = 'team_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                
                // Create directory if it doesn't exist
                $uploadDir = public_path('uploads/team');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                // Move file to uploads directory
                $image->move($uploadDir, $imageName);
                $data['image'] = 'uploads/team/' . $imageName;
            }
            
            $teamMember->update($data);
            
            Log::info('Team member updated successfully', ['id' => $teamMember->id, 'name' => $teamMember->name]);
            
            return response()->json([
                'success' => true,
                'message' => 'Team member updated successfully!',
                'redirect' => route('admin.team.index')
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error updating team member', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function destroy(TeamMember $teamMember)
    {
        try {
            // Delete image
            if ($teamMember->image) {
                $imagePath = public_path($teamMember->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            $teamMember->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Team member deleted successfully!'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error deleting team member', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function toggleStatus(TeamMember $teamMember)
    {
        try {
            $teamMember->update(['is_active' => !$teamMember->is_active]);
            
            $status = $teamMember->is_active ? 'activated' : 'deactivated';
            
            return response()->json([
                'success' => true,
                'message' => "Team member {$status} successfully!",
                'new_status' => $teamMember->is_active ? 'active' : 'inactive'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function updateOrder(Request $request)
    {
        try {
            $orderData = $request->input('order', []);
            
            foreach ($orderData as $item) {
                if (isset($item['id']) && isset($item['sort_order'])) {
                    TeamMember::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
                }
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Team member order updated successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update team member order.'
            ], 500);
        }
    }

    public function getStats()
    {
        $stats = [
            'total' => TeamMember::count(),
            'active' => TeamMember::where('is_active', true)->count(),
            'inactive' => TeamMember::where('is_active', false)->count(),
        ];
        
        return response()->json($stats);
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid image file.'
            ], 400);
        }

        try {
            $image = $request->file('image');
            $imageName = 'temp_team_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadDir = public_path('uploads/team/temp');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Move file to uploads directory
            $image->move($uploadDir, $imageName);
            $imagePath = 'uploads/team/temp/' . $imageName;
            
            return response()->json([
                'success' => true,
                'url' => url($imagePath),
                'path' => $imagePath
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image.'
            ], 500);
        }
    }
}
