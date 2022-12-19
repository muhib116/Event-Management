<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\EventList;
use App\Models\MEvents;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->data = [
            'canLogin' => Route::has('login') && !auth()->check(),
            'canRegister' => Route::has('register') && !auth()->check(),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ];
    }
    public function index() {
        $this->data['upcoming_events'] = EventList::with(['images'])
                                ->withMin('eventTickets', 'price')
                                ->where('publish', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d').'00:00:00')
                                ->orderBy('start_date', 'ASC')
                                ->limit(10)->get();
        $this->data['arts_events'] = EventList::with(['images'])
                                ->withMin('eventTickets', 'price')
                                ->where('publish', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d').'00:00:00')
                                ->where('eventCategory', 'arts-culture')
                                ->orderBy('start_date', 'ASC') 
                                ->limit(10)->get();
        $this->data['concerts_events'] = EventList::with(['images'])
                                ->withMin('eventTickets', 'price')
                                ->where('publish', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d').'00:00:00')
                                ->where('eventCategory', 'concerts')
                                ->orderBy('start_date', 'ASC')
                                ->with(['eventTickets', 'images'])
                                ->limit(10)->get();

        $this->data['top_selling_events'] = EventList::with(['images'])
                                ->where('publish', 1)
                                ->withSum('eventTickets as ticket_sold', 'sold')
                                ->withSum('eventTickets as tickets_stock_limit', 'stock_limit')
                                // ->with(['eventTickets' => function($q) {
                                //     return $q->where('');
                                // }])
                                // ->with(DB::raw('SUM(event_tickets.sold > 0'))
                                // ->where('ticket_sold', '<', 'tickets_stock_limit')
                                // ->with('eventTickets')
                                ->orderBy('ticket_sold', 'DESC')
                                ->limit(3)->get();
// return $this->data['top_selling_events'];
        $this->data['featured_advertise'] = Advertise::where('featured', 1)->get();
        // return $this->data;
        return Inertia::render('Frontend/Home', $this->data);
    }


    public function event_details($url) {
        $this->data['event'] = EventList::with(['images'])
                        ->withMin('eventTickets', 'price')
                        ->where('url', $url)
                        ->orWhere('slug', $url)
                        ->first();
                        
        return Inertia::render('Frontend/EventDetails', $this->data);
    }


    public function category_wise_event($category) {
        $this->data['events'] = EventList::with(['images'])
                                ->withMin('eventTickets', 'price')
                                ->where('eventCategory', 'LIKE', '%'.$category.'%')
                                ->limit(500)->get();
                        
        return Inertia::render('Frontend/CategoryWiseEvent', $this->data);
    }

    public function checkout($url) {
        $this->data['event'] = EventList::with(['images', 'eventTickets'])
                                ->where('url', $url)
                                ->orWhere('slug', $url)
                                ->first();
                                
        return Inertia::render('Frontend/Checkout', $this->data);
    }

    public function payment($url) {
        $this->data['event'] = EventList::with(['images', 'eventTickets'])
                                ->where('url', $url)
                                ->orWhere('slug', $url)
                                ->first();
                                
        return Inertia::render('Frontend/PaymentMethod', $this->data);
    }

    public function ticket_info($url) {
        $this->data['event'] = EventList::with(['eventTickets', 'images'])
                        ->where('url', $url)
                        ->orWhere('slug', $url)
                        ->first();

        return Inertia::render('Frontend/TicketInfo', $this->data);
    }

    public function process(Request $request ,EventList $eventList) {
        $this->data['events'] = $eventList;
        return Inertia::render('Frontend/Checkout', $this->data);
    }

}
