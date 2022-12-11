<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function update_personal_info(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
        ]);
        User::find(Auth::id())->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
        ]);
        return back();
    }

    public function update_password(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return back()->with('success', 'Password updated successfully!');
        } else {
            return back()->with('error', 'Opps Something wrong!');
        }
    }

    public function update_interest(Request $request) {
        $request->validate([
            'interests' => 'required|array',
        ]);

        if (count($request->interests) > 3) {
            return back()->with('error', 'Select a maximum of 3 interests');
        }

        Auth::user()->update([
            'interests' => $request->interests,
        ]);
        return back()->with('success', 'Interest updated successfully!');
    }
}
