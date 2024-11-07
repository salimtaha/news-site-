<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function login(Request $request)
    {
       $request->validate([
        'email'=>['required' , 'email' , 'max:50'],
        'password'=>['required' , 'max:50'],
       ]);

       RateLimiter::clear($request->ip());

       if(RateLimiter::tooManyAttempts($request->ip() , 2)){
           $time = RateLimiter::availableIn($request->ip());
           return apiResponse(429 , 'Tow many attempts , try after : ' . $time . ' seconds');
       }
       RateLimiter::increment($request->ip());
       $remain  = RateLimiter::remaining($request->ip() , 2);

       $user = User::whereEmail($request->email)->first();
       if($user && Hash::check($request->password , $user->password)){
        //    $token = $user->createToken('user_token' , [] , now()->addMinutes(60))->plainTextToken;
        $token = $user->createToken('user_token')->plainTextToken;

           return apiResponse(200 , 'User Loged Successfully' , ['token'=>$token]);
       }
       return apiResponse(401 , 'Credensials dose not match', ['remeinig'=>$remain]);

    }


    public function logout()
    {
        $user = Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();
        return apiResponse(200 , 'Token Deleted Successfully!');
    }
}
