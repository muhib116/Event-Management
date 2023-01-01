<?php

namespace App\Http\Controllers;

use App\Models\Guests;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FrontendUserProfileController extends Controller
{
    public function userProfile() {
        return Inertia::render('Frontend/Profile');
    }
    public function editUserProfile() {
        return Inertia::render('Frontend/ProfileEdit');
    }

    public function updateUserProfile(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $guest = Guests::where('email', $request->email)->first();
        if ($guest) {
            $guest->update([
                'firstName' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'settings' => $request->settings,
            ]);
            return back()->with('success', 'Profile update successfully');
        } else {
            Guests::create([
                'firstName' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'settings' => $request->settings,
            ]);
            return back()->with('success', 'Profile update successfully');
        }
    }
    public function get_profile($email) {
        $guest = Guests::where('email', $email)->first();
        if ($guest) {
            return $guest;
        } else {
            return 'not_found';
        }
    }
}
