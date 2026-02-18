<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Carbon\Carbon;

class ContactController extends Controller
{
    //
    public function submitContact(Request $request)
{
    // 1. Honeypot check - if filled, it's a bot
    if (!empty($request->input('website'))) {
        // Silently reject - don't let bots know they were caught
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    // Validate the form input
    $validatedData = $request->validate([
        'email' => 'required|email',
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:15',
        'message' => 'required|string',
    ]);

    // 2. Duplicate detection - check if same email/IP submitted within last 15 minutes
    $ipAddress = $request->ip();
    $email = $validatedData['email'];
    $fifteenMinutesAgo = Carbon::now()->subMinutes(15);

    $recentSubmission = Contact::where(function($query) use ($email, $ipAddress, $fifteenMinutesAgo) {
        $query->where('email', $email)
              ->orWhere('ip_address', $ipAddress);
    })
    ->where('created_at', '>=', $fifteenMinutesAgo)
    ->first();

    if ($recentSubmission) {
        return redirect()->back()->with('error', 'Please wait before submitting another inquiry. You can only submit one inquiry every 15 minutes.');
    }

    // Save the data to the database
    $contact = new Contact();
    $contact->name = $validatedData['name'];
    $contact->email = $validatedData['email'];
    $contact->phone = $validatedData['phone'] ?? null; // Use null coalescing operator
    $contact->message = $validatedData['message'];
    $contact->ip_address = $ipAddress; // Store IP for duplicate detection
    $contact->save();

        // Mail::to('smtp@mtoag.co.uk')->send(new ContactMail($contact));

    return redirect()->back()->with('success', 'Your message has been sent successfully!');
}

}
