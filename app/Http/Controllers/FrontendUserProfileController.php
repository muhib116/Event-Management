<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FrontendUserProfileController extends Controller
{
    function userProfile() {
        return Inertia::render('Frontend/Profile');
    }
}
