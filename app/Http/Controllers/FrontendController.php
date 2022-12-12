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
        $this->data['upcoming_events'] = MEvents::where('status', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d').'00:00:00')
                                ->orderBy('start_date', 'ASC')
                                ->limit(10)->get();
        $this->data['arts_events'] = MEvents::where('status', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d').'00:00:00')
                                ->where('eventCategory', 'Arts Culture')
                                ->orderBy('start_date', 'ASC')
                                ->limit(10)->get();
        $this->data['concerts_events'] = MEvents::where('status', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d').'00:00:00')
                                ->where('eventCategory', 'Concerts')
                                ->orderBy('start_date', 'ASC')
                                ->limit(10)->get();
        // return $this->data;
        return Inertia::render('Frontend/Home', $this->data);
    }


    public function event_details($url) {
        $this->data['event'] = MEvents::where('custom_url', $url)
                        ->orWhere('slug', $url)
                        ->first();
                        
        return Inertia::render('Frontend/EventDetails', $this->data);
    }

    public function checkout(MEvents $mEvents) {
        $this->data['events'] = $mEvents;
        return Inertia::render('Frontend/Checkout', $this->data);
    }

}
