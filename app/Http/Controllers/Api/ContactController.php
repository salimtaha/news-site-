<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewContactNotify;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Frontend\ContactRequest;

class ContactController extends Controller
{
    public function storeContact(ContactRequest $request)
    {
        $request->merge([
            'ip_address'=>$request->ip(),
        ]);

        $contact = Contact::create($request->all());

        if(!$contact){
            return apiResponse(400 , 'Try Again Latter!');
        }
        $admins = Admin::get();
        Notification::send($admins , new NewContactNotify($contact));
       return apiResponse(201 , 'Contact Created Successfully');
    }
}
