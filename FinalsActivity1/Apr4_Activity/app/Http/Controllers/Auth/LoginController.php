<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::loginUsingId($user->id);
            return redirect()->route('dashboard')->with('success','Successfully Logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('login')->with('success','Successfully logged out!');
    }

    public function dashboard()
    {
        return view('auth.dashboard');
    }

}
