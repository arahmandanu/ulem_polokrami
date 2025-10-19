<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validate the incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Regeneration of the session prevents session fixation attacks.
            $request->session()->regenerate();

            // Redirect the user to their intended destination (e.g., the dashboard)
            return redirect()->route('admin.dashboard');;
        }

        $message = 'Password atau email anda salah!';
        flash($message)->error();
        return back();
    }
}
