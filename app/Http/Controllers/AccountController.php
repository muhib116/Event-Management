<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index() {
        $user = Auth::user();
        $payment_details = PaymentDetail::with('organizer')->where('user_id', auth()->id())->get();
        return Inertia::render('Account', [
            'user' => $user,
            'payment_details' => $payment_details
        ]);
    }
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
            'password' => 'required|confirmed'
        ]);

        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->withErrors([
                'success' => 'Password update successfully'
            ]);
        } else {
            return back()->withErrors([
                'password' => 'Opps something wrong'
            ]);
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
