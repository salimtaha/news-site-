<?php

namespace App\Http\Controllers\Admin\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:notifications');
    }

    public function index()
    {
        Auth::guard('admin')->user()->unreadNotifications->markAsRead();
        $notifications = Auth::guard('admin')->user()->notifications()->get();
        return view('admin.notifications.index' , compact('notifications'));
    }
    public function destroy($id)
    {
        $notification = Auth::guard('admin')->user()->notifications()->where('id' , $id)->first();
        if(!$notification){
            Session::flash('error' , 'Try  Again Latter!');
            return redirect()->back();
        }

        $notification->delete();
        Session::flash('success' , 'Notification Deleted Successfully!');
        return redirect()->back();

    }

    public function deleteAll()
    {
        auth('admin')->user()->notifications()->delete();
        Session::flash('success' , 'All Notification Deleted');
        return redirect()->back();

    }

}
