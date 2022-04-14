<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {

        if (Auth::user()) {

            $user = User::find(Auth::user()->id);

            if ($user) {

                return view('Admin.Profile.update_profile', compact('user'));
            }
        }
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($user) {

            $user->name = $request->name;

            $user->email = $request->email;

            $user->save();

            return redirect()->back()->with('success', 'User Profile updated successfully');
        } else {

            return redirect()->back()->with('error', 'Error updating user profile');
        }
    }
}
