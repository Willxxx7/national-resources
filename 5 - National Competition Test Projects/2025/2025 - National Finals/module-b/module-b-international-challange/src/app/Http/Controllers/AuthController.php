<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if user is suspended
            if ($user->isSuspended()) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account has been suspended. Please contact an administrator.']);
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'The provided email and password do not match our records']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('status', 'You have been logged out successfully.');
    }
}
