<?php

namespace App\Http\Controllers;

use App\Models\EventList;
use App\Models\EventTickets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        $query = EventList::query();
        $query->withSum('eventTickets', 'sold')->with(['images']);
        if (auth()->user()->type != 'admin') {
            $query->where('user_id', auth()->id());
        }
        $events = $query->limit(900)
                ->orderBy('created_at', 'DESC')
                ->get()
                ->map(function($item) {
                    $item->start_date = Carbon::parse($item->start_date)->diffForHumans();
                    return $item;
                });
        
        return Inertia::render('Dashboard', [
            'events' => $events,
            'total_event' => EventList::count(),
            'total_ticket' => EventList::withCount('eventTickets')->get()->sum('event_tickets_count'),
        ]);
    }
}
