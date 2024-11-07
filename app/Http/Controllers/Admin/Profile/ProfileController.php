<?php

namespace App\Http\Controllers\Admin\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:profile');

    }
    public function index()
    {
        return view('admin.profile.index');
    }
    public function update(Request $request)
    {
         $request->validate($this->filterData());
         $admin = Admin::findOrFail(auth('admin')->user()->id);

         if(!Hash::check($request->password, $admin->password)){
            Session::flash('error' , 'Sorry Can not Update Profile data');
            return redirect()->back();
         }
         $admin->update($request->except(['password' , '_token']));
         Session::flash('success' , 'Profile Updated Successfully');
         return redirect()->back();

    }

    private function filterData():array
    {
        return [
            'name'=>['required' , 'min:2' , 'max:60'],
            'email'=>['required' , 'email' , 'unique:admins,email,'.Auth::guard('admin')->user()->id],
            'password'=>['required'],
        ];
    }
}
