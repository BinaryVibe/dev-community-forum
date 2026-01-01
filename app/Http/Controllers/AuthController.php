<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ModelS\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the form for logging in user.
     * @return \Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('auth.form', ['mode' => 'login']);
    }

    /**
     * Show the form for registering user.
     * @return \Illuminate\Contracts\View\View
     */
    public function signup()
    {
        return view('auth.form', ['mode' => 'signup']);
    }

    public function verify(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'string'],
        ]);

        $validated_data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Always hash passwords!
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Account created successfully!');

    }
}
