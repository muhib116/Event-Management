<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index() {
        $settings = SiteSetting::first();
        return Inertia::render('Settings', [
            'settings' => $settings
        ]);
    }
}
