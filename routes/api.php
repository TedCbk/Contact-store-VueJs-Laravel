<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Contact;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Fetch Contacts
Route::group(['middleware' => 'api'], function(){
    Route::get('contacts', function(){
        return Contact::latest()->orderBy('created_at', 'desc')->get();
    });
});

// Get a single contact by his id
Route::get('contact/{id}', function($id){
    return Contact::findOrFail($id);
});

// Add a contact
Route::post('contact/store', function(Request $request){
    return Contact::create([
        'name' => $request->input(['name']),
        'email' => $request->input(['email']),
        'phone' => $request->input(['phone'])]);
});

// Update a contact
Route::patch('contact/{id}', function(Request $request, $id){
    Contact::findOrFail($id)->update([
    'name' => $request->input(['name']),
    'email' => $request->input(['email']),
    'phone' => $request->input(['phone'])]);
});

// Delete a contact
Route::delete('contact/{id}', function($id){
    return Contact::destroy($id);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
