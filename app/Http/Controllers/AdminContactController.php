<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::when(request('search'), function ($q, $search) {
            $q->where('message', "LIKE", "%" . $search . "%")
                ->orWhere('name', "LIKE", "%" . $search . "%")
                ->orWhere('email', "LIKE", "%" . $search . "%");
        })->latest()
            ->paginate(6)
            ->withQueryString();

        return view('Admin.ContactMessage.index', ['contacts' => $contacts]);
    }

    public function markAsRead(Contact $contact)
    {
        $contact->is_read = "1";
        $contact->update();
        return back()->with("success", "Successfully marked as read");
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        return back()->with("success", "Successfully deleted contact message");
    }
}
