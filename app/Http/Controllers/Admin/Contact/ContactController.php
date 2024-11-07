<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        $order_by = request()->order_by ?? 'desc';
        $sort_by = request()->sort_by ?? 'id';
        $limit_by = request()->limit_by ?? 5;

        $contacts = Contact::when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                 ->where('title', 'LIKE', '%' . request()->keyword . '%');

        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        });

        $contacts = $contacts->orderBy($sort_by, $order_by)->paginate($limit_by);
        return view('admin.contacts.index' , compact('contacts'));
    }
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status'=>1]);
        return view('admin.contacts.show' , compact('contact'));

    }
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact = $contact->delete();

        Session::flash('success' , 'Conact Deleted Successfully!');
        return redirect()->route('admin.contacts.index');
    }
}
