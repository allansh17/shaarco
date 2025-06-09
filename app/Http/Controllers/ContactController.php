<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    //
    public function submitContact(Request $request)
{
    // Validate the form input
    $validatedData = $request->validate([
        'email' => 'required|email',
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:15',
        'message' => 'required|string',
    ]);

    // Save the data to the database
    $contact = new Contact();
    $contact->name = $validatedData['name'];
    $contact->email = $validatedData['email'];
    $contact->phone = $validatedData['phone'] ?? null; // Use null coalescing operator
    $contact->message = $validatedData['message'];
    $contact->save();

        // Mail::to('smtp@mtoag.co.uk')->send(new ContactMail($contact));

    return redirect()->back()->with('success', 'Your message has been sent successfully!');
}

}
