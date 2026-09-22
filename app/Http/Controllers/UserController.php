<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserActivity;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show user profile page.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'skills' => 'nullable|string|max:1000',
            'experience_summary' => 'nullable|string|max:1000',
        ]);

        try {
            // Update or create user profile
            if ($user->profile) {
                $user->profile->update($request->only([
                    'phone', 'address', 'city', 'state', 'country', 'postal_code',
                    'skills', 'experience_summary'
                ]));
            } else {
                $user->profile()->create([
                    'user_id' => $user->id,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                    'postal_code' => $request->postal_code,
                    'skills' => $request->skills,
                    'experience_summary' => $request->experience_summary,
                ]);
            }

            // Log activity
            UserActivity::log(
                $user->id,
                'profile_updated',
                'Profile Updated',
                'User updated their profile information'
            );

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating profile: ' . $e->getMessage()
            ], 500);
        }
    }
}
