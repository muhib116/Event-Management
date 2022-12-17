<?php

namespace App\Http\Controllers;

use App\Models\EventList;
use App\Models\MEvents;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
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

    public function checkout(EventList $eventList) {
        $this->data['events'] = EventList::with(['eventTickets', 'images'])->where('id', $eventList->id)->first();
        return Inertia::render('Frontend/Checkout', $this->data);
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
