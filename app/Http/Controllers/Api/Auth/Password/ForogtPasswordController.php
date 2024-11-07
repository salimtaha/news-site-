<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendOtpResetPassword;
use Illuminate\Http\Request;

class ForogtPasswordController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email'=>['required' , 'email' , 'exists:users,email' , 'max:70']]);
        $user = User::whereEmail($request->email)->first();

        if(!$user){
            return apiResponse(404 , 'User Not Found');
        }

        $user->notify(new SendOtpResetPassword());
        return apiResponse(200 , 'Otp Send , Check Your Email');

    }
}
