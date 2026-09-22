<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Store a new subscription
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscriptions,email',
            'source' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid email address.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Subscription::create([
                'email' => $request->email,
                'source' => $request->source ?? 'newsletter',
                'is_active' => true,
                'subscribed_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    /**
     * Unsubscribe from newsletter
     */
    public function unsubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid email address.'
            ], 422);
        }

        $subscription = Subscription::where('email', $request->email)->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found in our subscription list.'
            ], 404);
        }

        $subscription->deactivate();

        return response()->json([
            'success' => true,
            'message' => 'You have been successfully unsubscribed from our newsletter.'
        ]);
    }

    /**
     * Resubscribe to newsletter
     */
    public function resubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid email address.'
            ], 422);
        }

        $subscription = Subscription::where('email', $request->email)->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found in our subscription list.'
            ], 404);
        }

        $subscription->activate();

        return response()->json([
            'success' => true,
            'message' => 'You have been successfully resubscribed to our newsletter.'
        ]);
    }

    /**
     * Check subscription status
     */
    public function checkStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid email address.'
            ], 422);
        }

        $subscription = Subscription::where('email', $request->email)->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found in our subscription list.',
                'subscribed' => false
            ]);
        }

        return response()->json([
            'success' => true,
            'subscribed' => $subscription->is_active,
            'status' => $subscription->status,
            'subscribed_at' => $subscription->subscribed_at->format('M d, Y')
        ]);
    }
}
