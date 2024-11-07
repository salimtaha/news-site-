<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewContactNotify;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Frontend\ContactRequest;

class ContactController extends Controller
{
    //
    public function index()
    {
        return view('frontend.contact');
    }
    public function store(Request $request)
    {
        $request->validated();
        $request->merge([
            'ip_address'=>$request->ip(),
        ]);
        $contact = Contact::create($request->except(['_token']));

        $admins = Admin::get();
        Notification::send($admins , new NewContactNotify($contact));


        if(!$contact){
            Session::flash('error' , 'Contact us failed');
            return redirect()->back();
        }
        Session::flash('success' , 'Your Msg Created Successfuly!');
        return redirect()->back();
    }
}
