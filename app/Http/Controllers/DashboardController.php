<?php

namespace App\Http\Controllers;

use App\Models\MEvents;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        $events = MEvents::with(['tickets'])->limit(900)->orderBy('created_at', 'DESC')->get()->map(function($item) {
            $item->start_date = Carbon::parse($item->start_date)->diffForHumans();
            return $item;
        });
        return Inertia::render('Dashboard', [
            'events' => $events,
        ]);
    }
}
