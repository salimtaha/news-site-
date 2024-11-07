<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Frontend\SettingRequest;
use App\Utils\ImageManger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('frontend.dashboard.setting' , compact('user'));
    }
    public function update(SettingRequest $request)
    {
        $request->validated();
        $user = User::findOrFail(auth()->user()->id);
        $user->update($request->except(['_token' , 'image']));

        ImageManger::uploadImages($request , null, $user);

        return redirect()->back()->with('success' , 'Profile Data Updated Successfully!');

    }
    public function changePassword(Request $request)
    {
        $request->validate($this->filterPasswordRequest());

        if(!Hash::check($request->current_password , auth()->user()->password)){
            Session::flash('error' , 'Password dose not match !');
            return redirect()->back();
        }
        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            'password'=>Hash::make($request->password),
        ]);
        Session::flash('success' , 'Your Password Changed successfully!');
        return redirect()->back();


    }
    private function  filterPasswordRequest():array
    {
       return  [
            'current_password'=>['required'],
            'password'=>['required' , 'confirmed'],
            'password_confirmation'=>['required'],
       ];
    }

}
