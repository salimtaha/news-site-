<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public $otp2;
    public function __construct()
    {
         $this->otp2  = new Otp;
    }
    public function showEmailForm()
    {
        return view('admin.auth.passwords.email');
    }
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return redirect()->back()->withErrors(['email' => 'Try again latter!']);
        }

        $admin->notify(new SendOtpNotify());
        return redirect()->route('admin.password.showOtpForm' , ['email'=>$admin->email]);

    }
    public function showOtpForm($email)
    {
        return view('admin.auth.passwords.confirm' , ['email'=>$email]);
    }
    public function verifyOtp(Request $request)
    {

        $request->validate([
            'email'=>['required' , 'email'],
            'token'=>['required' , 'min:5'],
        ]);

        $otp = $this->otp2->validate($request->email , $request->token);
        if($otp->status == false){
            return redirect()->back()->withErrors(['token'=>'Code is invalid!']);
        }
        return redirect()->route('admin.password.resetform' , ['email'=>$request->email]);

    }
}
