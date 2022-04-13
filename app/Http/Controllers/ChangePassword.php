<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{
    public function create()
    {
        return view('Admin.Password.change_password');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $vHashedPassword = Auth::user()->password;

        if (Hash::check($request->current_password,  $vHashedPassword)) {

            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();

            // Destroy session /logout
            Auth::logout();

            return redirect()->route('login')->with('success', 'Password changed successfully');
        } else {

            return redirect()->back()->with('error', 'Current Password is invalid');
        }
    }
}
