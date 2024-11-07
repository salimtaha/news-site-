<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        try {
            $user_provider = Socialite::driver($provider)->user();
            $user_from_db = User::whereEmail($user_provider->getEmail())->first();

            if($user_from_db){
                Auth::login($user_from_db);
                return redirect()->route('frontend.dashboard.profile');
            }

            $username = $this->generateUniqueUsername($user_provider->name);

            $user = User::create([
                'name' => $user_provider->name,
                'email' => $user_provider->email,
                'username' => $username,
                'image' => $user_provider->avatar,
                'status' => 1,
                'country' => 'updated',
                'city' => 'updated',
                'street' => 'updated',
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(8)),
            ]);

            Auth::login($user);
            return redirect()->route('frontend.dashboard.profile');

        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }

    public function generateUniqueUsername($name)
    {
        $username = Str::slug($name);
        $count = 1 ;
        while(User::where('username' , $username)->exists()){
            $username = $username . $count++;
        }
        return $username;
    }
}
