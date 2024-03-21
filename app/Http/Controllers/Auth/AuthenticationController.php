<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $this->validate($request, ['email' => ['unique:users'], 'password' => ['confirmed']]);

        $user = User::castAndCreate([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user instanceof User) {
            Auth::login($user);
        }

        return $request->expectsJson() ? [
            'success' => true,
            'message' => 'Berhasil mendaftar',
            'redirect' => route('home')
        ] : to_route('home');
    }
    public function authenticate(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = $request->user();
        $route = $user->admin ? 'dashboard' : 'home';

        return $request->expectsJson() ? [
            'success' => true,
            'message' => 'Berhasil masuk',
            'redirect' => route($route)
        ] : to_route($route);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home')->with('success', '');
    }
}
