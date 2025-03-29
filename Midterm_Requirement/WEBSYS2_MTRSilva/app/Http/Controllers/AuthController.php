<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // USER SIGNUP
    public function showUserSignup()
    {
        return view('auth.signup');
    }

    public function userSignup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/login')->with('success', 'Signup successful!');
    }

    // USER LOGIN
    public function showUserLogin()
    {
        return view('auth.user-login');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = DB::table('users')->where('email', $request->email)->where('role', 'user')->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id, 'role' => $user->role, 'name' => $user->name]);
            $request->session()->regenerate();
            return redirect()->intended('/user/dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->with('error', 'Invalid user credentials')->withInput();
    }

    // ADMIN LOGIN
    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $admin = DB::table('users')->where('username', $request->username)->where('role', 'admin')->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['user_id' => $admin->id, 'role' => $admin->role, 'name' => $admin->name]);
            $request->session()->regenerate();
            return redirect('/admin/dashboard')->with('success', 'Admin logged in successfully!');
        }

        return back()->with('error', 'Invalid admin credentials')->withInput();
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }

    // DASHBOARDS
    public function adminDashboard()
    {
        if (!session('user_id') || session('role') !== 'admin') {
            return redirect('/admin/login')->with('error', 'Please log in as an admin.');
        }
        return view('/admin/dashboard', ['name' => session('name')]);
    }

    public function userDashboard()
    {
        if (!session('user_id') || session('role') !== 'user') {
            return redirect()->route('login')->with('error', 'Please log in as a user.');
        }
        return view('user.dashboard', ['name' => session('name')]);
    }
}
