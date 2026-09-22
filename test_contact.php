<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Contact;
use App\Models\Lead;

echo "Testing Contact Form Submission...\n";

try {
    // Test data
    $testData = [
        'name' => 'Test User',
        'email' => 'test@test.com',
        'phone' => '1234567890',
        'subject' => 'Test Subject',
        'message' => 'This is a test message',
        'source' => 'contact_page',
        'property_id' => null,
        'agent_id' => null,
    ];

    echo "Creating contact...\n";
    
    // Create contact
    $contact = Contact::create([
        'name' => $testData['name'],
        'email' => $testData['email'],
        'phone' => $testData['phone'],
        'subject' => $testData['subject'],
        'message' => $testData['message'],
        'source' => $testData['source'],
        'property_id' => $testData['property_id'],
        'agent_id' => $testData['agent_id'],
        'ip_address' => '127.0.0.1',
        'user_agent' => 'Test Script',
        'status' => 'new',
        'is_read' => false,
    ]);

    echo "Contact created with ID: " . $contact->id . "\n";

    // Create lead
    echo "Creating lead...\n";
    
    $lead = Lead::create([
        'title' => $testData['subject'],
        'description' => $testData['message'],
        'contact_name' => $testData['name'],
        'contact_email' => $testData['email'],
        'contact_phone' => $testData['phone'],
        'company' => null,
        'source' => 'contact_form',
        'status' => 'new',
        'priority' => 'medium',
        'value' => null,
        'currency' => 'USD',
        'expected_close_date' => null,
        'assigned_to' => null,
        'created_by' => 1,
        'notes' => "Lead created from contact form. Source: {$testData['source']}",
        'tags' => ['contact_form', $testData['source'] ?? 'general'],
        'ip_address' => '127.0.0.1',
        'user_agent' => 'Test Script'
    ]);

    echo "Lead created with ID: " . $lead->id . "\n";
    
    echo "Test completed successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
