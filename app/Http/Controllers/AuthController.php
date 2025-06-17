<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function dologin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'please enter email',
            'password.required' => 'please enter password',

        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect based on role
            if ($user->hasRole('super-admin')) {
                return redirect()->route('superadmin.dashboard');
            } elseif ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('user')) {
                return redirect()->route('user.dashboard');
            } else {
                Auth::logout();
                return back()->with('error', 'Unauthorized role.');
            }
        } else {
            return back()->with('error', 'Invalid credentials.');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
