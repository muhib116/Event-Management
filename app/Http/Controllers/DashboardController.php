<?php

namespace App\Http\Controllers;

use App\Models\EventList;
use App\Models\EventTickets;
use App\Models\TicketSales;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        $sales = collect([]);
        $query = EventList::query();
        $query->withSum('eventTickets', 'sold')->with(['images']);
        if (auth()->user()->type == 'organizer' || auth()->user()->type == 'clients') {
            $query->where('user_id', auth()->id());
        }

        $total_ticket = 0;
        $total_event = 0;
        $total_sales_quantity = 0;

        if (auth()->user()->type == 'organizer') {
            $sales = TicketSales::where('organizer_id', auth()->id())->get();
            $total_ticket = EventList::where('user_id', auth()->id())->withCount('eventTickets')->get()->sum('event_tickets_count');
            $total_event = EventList::where('user_id', auth()->id())->count();
            $total_sales_quantity = TicketSales::where('organizer_id', auth()->id())->sum('quantity');
        } 

        if (auth()->user()->type == 'admin') {
            $sales = TicketSales::all();
            $total_ticket = EventList::withCount('eventTickets')->get()->sum('event_tickets_count');
            $total_event = EventList::count();
            $total_sales_quantity = TicketSales::sum('quantity');
        }

        $events = $query->limit(900)
                ->orderBy('created_at', 'DESC')
                ->get()
                ->map(function($item) {
                    $item->start_date = Carbon::parse($item->start_date)->diffForHumans();
                    return $item;
                });
        $commission = 0; // (($sales->sum('price') / 100) * $sales->sum('commission'))
        $total_sales_amount =  0; //$sales->sum('price') - $commission;
        foreach ($sales as $key => $v) {
            $t_com = (($v->price * $v->quantity) / 100) * $v->commission;
            $commission += $t_com;
            $total_sales_amount += ($v->price * $v->quantity) - $t_com;
        }
        // dd($events);

        return Inertia::render('Dashboard', [
            'events' => $events,
            'user' => auth()->user(),
            'total_sales_quantity' => $total_sales_quantity,
            'total_sales_amount' => round($total_sales_amount, 2),
            'total_commission' => round($commission, 2),
            'total_event' => $total_event,
            'total_ticket' => $total_ticket,
        ]);
    }
}
