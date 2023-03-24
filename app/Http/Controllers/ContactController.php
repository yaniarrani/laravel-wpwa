<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePagination;

class ContactController extends Controller
{
    public function index()
    {
        $companies = $this->company-pluck();
        $contactCollection = Contact::latest()->get();
        $perPage = 10;
        $currentPage = request()->query('page', 1);
        $items = $contactCollection->slice(($currentPage * $perPage) - $perPage, $perPage);
        $total = $contactCollection->count();
        $contacts = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query()
        ]);
        return view('Contacts.index', compact('contacts', 'companies'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show')->with('contact', $contact);
    }
}
