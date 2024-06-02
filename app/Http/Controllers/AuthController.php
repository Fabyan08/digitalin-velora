<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    // public function login(Request $request)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'name' => 'required|string',
    //         'password' => 'required|string|min:2',
    //     ]);

    //     // Get credentials from request
    //     $credentials = $request->only('name', 'password');

    //     // Attempt to log the user in using 'name' instead of 'email'
    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed, redirect to intended page
    //         return redirect('dashboard');
    //     }

    //     // Authentication failed, redirect back with input and error
    //     // return redirect()->back()->withInput($request->only('name', 'remember_me'))->withErrors([
    //     //     'name' => 'These credentials do not match our records.',
    //     // ]);
    // }
}
