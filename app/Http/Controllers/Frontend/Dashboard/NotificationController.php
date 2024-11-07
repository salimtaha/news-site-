<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->markAsRead();
         return view('frontend.dashboard.notification');
    }
    public function delete(Request $request)
    {
        $notification = auth()->user()->notifications()->where('id' , $request->notify_id)->first();
        if(!$notification){
            return redirect()->back()->with('error' , 'notification not found');
        }
        $notification->delete();
        return redirect()->back()->with('success' , 'notification  deleted Successfully!');;

    }

    public function deleteAll()
    {
        auth()->user()->notifications()->delete();
        Session::flash('success' , 'All Notification Deleted');
        return redirect()->back();

    }

    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success' , 'All notifications Mark As Read !');;

    }

}
