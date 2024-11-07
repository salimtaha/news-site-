<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest:admin'])->only(['showLoginForm', 'checkAuth']);
        $this->middleware(['auth:admin'])->only(['logout']);
    }
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function checkAuth(Request $request)
    {
        $request->validate($this->filterData());

        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember)) {
            // if admin has permession home -> redirect to home , else redire the first page in his permessions
            $permessions = Auth::guard('admin')->user()->authorization->permessions;
            $first_permession = $permessions[0];

            if (!in_array('home', $permessions)) {
                return redirect()->intended('admin/' . $first_permession);
            }
            return redirect()->intended(RouteServiceProvider::AdminHome);
        }
        return redirect()->back()->withErrors(['email' => 'credentials dose not match!']);
    }

    private function filterData(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'remember' => ['in:on,off'],
        ];
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.show');
    }
}
