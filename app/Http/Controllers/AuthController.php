<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginView()
    {
        return view('auth.login');
    }

    public function showRegisterView()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return redirect('/login')->withErrors([
            'bad_credentials' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create($validatedData);

        return redirect('/login')->with([
            'status' => 'Account created successfully! Sign in below.'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }
}
