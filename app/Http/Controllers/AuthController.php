<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    /**
     * Show the Login View.
     */
    public function showLogin()
    {
        // We pass 'mode' => 'login' so the Blade file hides the extra fields
        return view('auth.form', ['mode' => 'login']);
    }

    /**
     * Show the Registration View.
     */
    public function showRegister()
    {
        // We pass 'mode' => 'register' so the Blade file shows all fields
        return view('auth.form', ['mode' => 'register']);
    }

    /**
     * Handle Login Request.
     */
    public function login(Request $request)
    {
        // 1. Validate
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        // 3. Failed Login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle Registration Request.
     */
    public function register(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm-password' => ['required', 'same:password'] // Checks if it matches the password field
        ]);

        try {
            $user = User::create($attributes);

            // Login and Redirect
            Auth::login($user);
            return redirect('/')->with('success', 'Account created!');

        } catch (QueryException $e) {
            // Redirect back with a generic error message for the user
            return back()->withInput()->with('error', 'Database error: Could not save account. Please try again later.');
        }
    }

    /**
     * Handle Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}