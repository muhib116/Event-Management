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
    protected $eventsCategory = [
        "Arts Culture",
        "Business",
        "Concerts",
        "Career",
        'Charity & Aid',
        "Children & Youth",
        "Community",
        "Fashion & Design",
        "Food & Drink",
        "Government",
        "Investments",
        "Media & Film",
        "Music & Performances",
        "Schools & Education",
        "Spirituality & Religion",
        "Sports & Fitness",
        "Startups & Small Business",
        "Technology & Science",
    ];

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
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d'))
                                ->orderBy('start_date', 'ASC')
                                ->limit(10)->get();
        $this->data['arts_events'] = EventList::with(['images'])
                                ->withMin('eventTickets', 'price')
                                ->where('publish', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d'))
                                ->where('eventCategory', 'arts-culture')
                                ->orderBy('start_date', 'ASC') 
                                ->limit(10)->get();
        // $this->data['category_events'] = EventList::with(['images'])
        //                         // ->withMin('eventTickets', 'price')
        //                         ->where('publish', 1)
        //                         ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d'))
        //                         // ->where('eventCategory', 'arts-culture')
        //                         ->orderBy('start_date', 'ASC') 
        //                         ->select(DB::raw('eventCategory'))
        //                         // ->groupBy('eventCategory')
        //                         ->get();
        // $this->data['category_events'] = EventList::with(['images'])
        //                         // ->withMin('eventTickets', 'price')
        //                         ->where('publish', 1)
        //                         ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d'))
        //                         // ->where('eventCategory', 'arts-culture')
        //                         ->orderBy('start_date', 'ASC') 
        //                         // ->selectRaw('*')
        //                         // ->select(DB::raw('eventCategory'))
        //                         // ->groupBy('eventCategory')
        //                         ->get();
        
                                
        $this->data['concerts_events'] = EventList::with(['images'])
                                ->withMin('eventTickets', 'price')
                                ->where('publish', 1)
                                ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d'))
                                ->where('eventCategory', 'concerts')
                                ->orderBy('start_date', 'ASC')
                                ->with(['eventTickets', 'images'])
                                ->limit(10)->get();

        $this->data['top_selling_events'] = EventList::with(['images'])
                                ->where('publish', 1)
                                ->withSum('eventTickets as ticket_sold', 'sold')
                                ->withSum('eventTickets as tickets_stock_limit', 'stock_limit')
                                // ->with(['eventTickets' => function($q) {
                                //     return $q->select('stock_limit,sold');
                                // }])
                                ->orderBy('ticket_sold', 'DESC')
                                ->get()->filter(function($item) {
                                    $stock_limit = $item->eventTickets->sum('stock_limit');
                                    $sold = $item->eventTickets->sum('sold');
                                    if ($stock_limit > $sold) {
                                        return true;
                                    }
                                    return false;
                                })->take(3);
        // return $this->data['category_events'];
        // return $this->data['top_selling_events'];
        $this->data['featured_advertise'] = Advertise::where('featured', 1)
                                            ->orderBy('position', 'ASC')
                                            ->where('end_at', '>', Carbon::now())
                                            ->get()
                                            ->map(function ($item) {
                                                $item['start_at'] = Carbon::parse($item->start_at)->format('Y-m-d H:i:s A');
                                                $item['end_at'] = Carbon::parse($item->end_at)->format('Y-m-d H:i:s A');
                                                return $item;
                                            });
        // return $this->data;
        $cevnt = [];
        foreach ($this->eventsCategory as $nm) {
            $evnt = EventList::with(['images'])
                    ->withMin('eventTickets', 'price')
                    ->where('publish', 1)
                    ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d'))
                    ->where('eventCategory', $nm)
                    ->orderBy('start_date', 'ASC')
                    ->with(['eventTickets', 'images'])
                    ->limit(10)->get();
            if (count($evnt) > 3) {
                $cevnt[$nm] = $evnt;
            }
        }
        $this->data['category_events'] = collect($cevnt);
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
