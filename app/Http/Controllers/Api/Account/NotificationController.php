<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $user = Auth::guard('sanctum')->user();

        $ntofications = $user->notifications;
        $unreadNotifications = $user->unreadNotifications;

        return apiResponse(200 , 'User Notifications' , [
            'notifications'       =>NotificationResource::collection($ntofications),
            'unreadNotifications' =>NotificationResource::collection($unreadNotifications),
        ]);
    }

    public function readNotifications($id)
    {
        $notification = Auth::guard('sanctum')->user()->unreadNotifications()->where('id' ,$id)->first();
        if(!$notification){
            return apiResponse(404 , 'Notification not found');
        }
        $notification->markAsRead();
        return apiResponse(200 , 'Notification read');
    }
}
