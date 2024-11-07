<?php

namespace App\Http\Controllers\Api\Account;

use App\Models\User;
use App\Utils\ImageManger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Frontend\SettingRequest;

class SettingController extends Controller
{
    public function updateSetting(SettingRequest $request , $user_id)
    {
        $request->validated();

        $user = User::find(request()->user()->id);

        if(!$user){
            return apiResponse(404 , 'Opps Something was wrong!');
        }

        $user->update($request->except(['_method' , 'image']));

        ImageManger::uploadImages($request , null, $user);
        return apiResponse(200 , 'Profile Data Updated Successfully');

    }

    public function updatePassword(Request $request , $user_id)
    {
        $request->validate($this->filterPasswordRequest());

        $user = User::find($user_id);
        if(!$user){
            return apiResponse(404 , 'Opps Something was wrong!');
        }

        if(!Hash::check($request->current_password , $user->password)){
            return apiResponse(400, 'Password dose not match');
        }

        $user->update([
            'password'=>bcrypt($request->password),
        ]);
        return apiResponse(200, 'Password  Pssword Update Successfully');


    }
    private function  filterPasswordRequest():array
    {
       return  [
            'current_password'=>['required' , 'max:20'],
            'password'=>['required' , 'confirmed' , 'min:8' , 'max:20'],
            'password_confirmation'=>['required'],
       ];
    }
}
