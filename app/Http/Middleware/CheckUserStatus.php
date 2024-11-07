<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('web')->check() && Auth::guard('web')->user()->status==0){
            // if user blocked
            return redirect()->route('frontend.wait');
        }
        if(Auth::guard('sanctum')->check() && Auth::guard('sanctum')->user()->status==0){

            Auth::guard('sanctum')->user()->currentAccessToken()->delete();
            return apiResponse(403 , 'You Are Bloked , Contact With Admin');
        }

        return $next($request);
    }
}
