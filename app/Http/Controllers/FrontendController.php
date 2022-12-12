<?php

namespace App\Http\Controllers;

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
        $this->data['upcoming_events'] = MEvents::with(['tickets'])
                                ->where('status', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d').'00:00:00')
                                ->orderBy('start_date', 'ASC')
                                ->limit(10)->get();
        $this->data['arts_events'] = MEvents::with(['tickets'])
                                ->where('status', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d').'00:00:00')
                                ->where('eventCategory', 'Arts Culture')
                                ->orderBy('start_date', 'ASC') 
                                ->limit(10)->get();
        $this->data['concerts_events'] = MEvents::with(['tickets'])
                                ->where('status', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d').'00:00:00')
                                ->where('eventCategory', 'Concerts')
                                ->orderBy('start_date', 'ASC')
                                ->with(['tickets'])
                                ->limit(10)->get();
        // return $this->data;
        return Inertia::render('Frontend/Home', $this->data);
    }


    public function event_details($url) {
        $this->data['event'] = MEvents::with(['tickets'])
                        ->where('custom_url', $url)
                        ->orWhere('slug', $url)
                        ->first();
                        
        return Inertia::render('Frontend/EventDetails', $this->data);
    }

    public function checkout(MEvents $mEvents) {
        $this->data['events'] = MEvents::with(['tickets'])->where('id', $mEvents->id)->first();
        return Inertia::render('Frontend/Checkout', $this->data);
    }
    public function ticket_info($url) {
        $this->data['event'] = MEvents::with(['tickets'])
                        ->where('custom_url', $url)
                        ->orWhere('slug', $url)
                        ->first();
        return Inertia::render('Frontend/TicketInfo', $this->data);
        // $this->data['events'] = MEvents::with(['tickets'])->where('id', $mEvents->id)->first();
    }

    public function process(Request $request ,MEvents $mEvents) {
        // $request->validate([
        //     ''
        // ]);
        $this->data['events'] = $mEvents;
        return Inertia::render('Frontend/Checkout', $this->data);
    }

}
