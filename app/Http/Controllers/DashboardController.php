<?php

namespace App\Http\Controllers;

use App\Models\EventList;
use App\Models\EventTickets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        $events = EventList::with(['eventTickets'])
                    ->with(['images'])
                    ->limit(900)
                    ->orderBy('created_at', 'DESC')
                    ->get()
                    ->map(function($item) {
                        $item->start_date = Carbon::parse($item->start_date)->diffForHumans();
                        return $item;
                    });
        
        return Inertia::render('Dashboard', [
            'events' => $events,
        ]);
    }
}
