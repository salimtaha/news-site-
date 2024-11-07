<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    private $otp2;
    public function __construct()
    {
        $this->otp2 = new Otp();
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
       $otp = $this->otp2->validate($request->email , $request->code);
       if($otp->status == false){
           return apiResponse(401 , 'Code Is Invalid');
       }

      // reset Password
      $user = User::whereEmail($request->email)->first();
      if(!$user){
        apiResponse(404 , 'User Not Found');
      }

      $user->update([
        'password'=>Hash::make($request->password),
      ]);
      return  apiResponse(200 , 'Password Updated Successfully');

    }

}
