<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// TODO: Finish up controller

class AuthenticatedController extends Controller
{
    public function profile(Request $request)
    {
        return view("profile");
    }
    public function edit(Request $request)
    {
        return view("profile.edit");
    }
    public function update(Request $request)
    {
        $request->user()->castAndFill($request->all());
        $request->user()->save();

        return to_route('profile')->with('status', 'profile-updated');
    }
    public function destroy(Request $request)
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home')->with('success', '');
    }

    public function cart()
    {
        return view('cart');
    }

    public function transaksi()
    {
        return view('transaction-list');
    }

    public function detailTransaksi()
    {
        return view('transaction');
    }

    public function editPassword()
    {
        return view('profile.partials.update-password-form');
    }

    public function updatePassword(Request $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }
}
