<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::latest()->get();

        return response()->json([
            'contacts' => $contacts
        ]);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return response()->json([
            'contact' => $contact
        ]);
    }
}
