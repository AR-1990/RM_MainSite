<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmission;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'source' => 'nullable|string|in:contact_page,property_inquiry,agent_inquiry,general',
            'property_id' => 'nullable|exists:properties,id',
            'agent_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'source' => $request->source ?? 'contact_page',
                'property_id' => $request->property_id,
                'agent_id' => $request->agent_id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'new',
                'is_read' => false,
            ]);

            // Create a lead from this contact
            $lead = Lead::create([
                'title' => $request->subject,
                'description' => $request->message,
                'contact_name' => $request->name,
                'contact_email' => $request->email,
                'contact_phone' => $request->phone,
                'company' => null,
                'source' => Lead::SOURCE_CONTACT_FORM,
                'status' => Lead::STATUS_NEW,
                'priority' => Lead::PRIORITY_MEDIUM,
                'value' => null,
                'currency' => 'USD',
                'expected_close_date' => null,
                'assigned_to' => null,
                'created_by' => 1, // Default admin user
                'notes' => "Lead created from contact form. Source: {$request->source}",
                'tags' => ['contact_form', $request->source ?? 'general'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // Send email notification to admin (optional)
            // Mail::to(config('mail.admin_email'))->send(new ContactFormSubmission($contact));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you soon.',
                'contact_id' => $contact->id,
                'lead_id' => $lead->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function show($id)
    {
        $contact = Contact::with(['property', 'agent'])->findOrFail($id);
        
        // Mark as read
        if (!$contact->is_read) {
            $contact->update([
                'is_read' => true,
                'status' => 'read',
                'read_at' => now()
            ]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function updateStatus(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:new,read,replied,closed',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $contact->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'replied_at' => $request->status === 'replied' ? now() : null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contact status updated successfully'
        ]);
    }
}
