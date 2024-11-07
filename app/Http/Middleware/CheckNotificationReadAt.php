<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNotificationReadAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->query('notify')){
            $notification = auth()->user()->unreadNotifications()->where('id' ,$request->query('notify'))->first();
            if($notification){
                $notification->markAsRead();
            }
        }
        if($request->query('notify_admin')){
            $notification = auth('admin')->user()->unreadNotifications()->where('id' ,$request->query('notify_admin'))->first();
            if($notification){
                $notification->markAsRead();
            }
        }
        return $next($request);
    }
}
