<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', function () {
    $companies = [
        1 => ['name' => 'Company One', 'contacts' => 3],
        2 => ['name' => 'Company Two', 'contacts' => 5],
    ];
    $contacts = getContacts();
    //return view('contacts.index');
    //return view('contacts.index', ['contacts'=>$contacts]);
    //return view('contacts.index', compact('contacts'));
    return view('contacts.index', compact('contacts', 'companies'));
})->name('contacts.index');

function getContacts()
{
    return [
        1 => ['id' => 1, 'name' => 'Name 1', 'phone' => '1234567890'],
        2 => ['id' => 2, 'name' => 'Name 2', 'phone' => '2345678901'],
        3 => ['id' => 3, 'name' => 'Name 3', 'phone' => '3456789012'],
    ];
}


Route::get('/contacts/create', function () {
    //return "<h1>Add new contact</h1>";
    return view('contacts.create');
})->name('contacts.create');

Route::get('/contacts/{id}', function ($id) {
    //return "Contact " . $id;
    $contacts = getContacts();
    abort_unless(isset($contacts[$id]), 404);
    $contact = $contacts[$id];
    return view('contacts.show')->with('contact', $contact);
})->name('contacts.show');
