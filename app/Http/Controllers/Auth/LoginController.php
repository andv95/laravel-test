<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            //$request->session()->regenerate();

            return redirect(route("welcome"));
        }

        return back()->withErrors([
            'email' => 'Username or password not found. Please try again!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

//        $request->session()->invalidate();
//
//        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
