<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\EventList;
use App\Models\EventView;
use App\Models\MEvents;
use App\Models\TicketView;
use App\Utils;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class FrontendController extends Controller
{
    use Utils; 
    protected $eventsCategory = [
        "arts-culture",
        "business",
        "career",
        "charity-and-aid",
        "children-and-youth",
        "community",
        "fashion-and-design",
        "food-and-drink",
        "government",
        "investments",
        "media-and-film",
        "concerts",
        "schools-and-education",
        "spirituality-and-religion",
        "sports-and-fitness",
        "startups-and-small-business",
        "technology-and-science"
    ];
    public $data;

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
        $json     = file_get_contents("http://ipinfo.io/119.30.32.76/geo");
        // return json_decode($json);
        $this->data['upcoming_events'] = EventList::with(['images'])
                                ->withMin('eventTickets as min_price', 'price')
                                ->withMax('eventTickets as max_price', 'price')
                                ->where('publish', 1)
                                // ->whereDate('start_date', '>', now())
                                ->orderBy('start_date', 'ASC')
                                ->get()->filter(function($event) {
                                    return $this->startExpired($event) == false;
                                });
        $this->data['top_selling_events'] = EventList::with(['images'])
                                ->where('publish', 1)
                                ->withMin('eventTickets', 'price')
                                ->withMax('eventTickets', 'price')
                                ->whereDate('start_date', '>', now())
                                ->withSum('eventTickets as ticket_sold', 'sold')
                                ->withSum('eventTickets as tickets_stock_limit', 'stock_limit') 
                                ->orderBy('ticket_sold', 'DESC')
                                ->get()->filter(function($item) {
                                    $stock_limit = $item->eventTickets->sum('stock_limit');
                                    $sold = $item->eventTickets->sum('sold');
                                    return $this->startExpired($item) == false;
                                    if ($sold == 0) {
                                        return false;
                                    }
                                    if ($stock_limit > $sold) {
                                        return true;
                                    }
                                    return false;
                                })->take(3);
        $this->data['featured_advertise'] = Advertise::where('featured', 1)
                                            ->orderBy('position', 'ASC')
                                            ->where('end_at', '>', Carbon::now())
                                            ->get()
                                            ->map(function ($item) {
                                                $item['start_at'] = Carbon::parse($item->start_at)->format('Y-m-d H:i:s A');
                                                $item['end_at'] = Carbon::parse($item->end_at)->format('Y-m-d H:i:s A');
                                                return $item;
                                            });

        $cevnt = [];
        foreach ($this->eventsCategory as $nm) { 
            $evnt = EventList::with(['images'])
                    ->withMin('eventTickets as min_price', 'price')
                    ->withMax('eventTickets as max_price', 'price')
                    ->where('publish', 1)
                    // ->whereDate('start_date', '>', Carbon::yesterday()->format('Y-m-d'))
                    ->where('eventCategory', 'LIKE', '%'.$nm.'%')
                    ->orderBy('created_at', 'DESC')
                    ->with(['eventTickets', 'images'])
                    ->limit(10)->get()->filter(function($event) {
                        return $this->startExpired($event) == false;
                    });
            if (count($evnt) > 3) { 
                $cevnt[$nm] = $evnt;
            }
        }
        $this->data['category_events'] = collect($cevnt);
        // return $this->data['category_events'];
        return Inertia::render('Frontend/Home', $this->data);
    }


    public function event_details($url) {
        $event = EventList::with(['images'])
                ->where('publish', 1)
                ->withMin('eventTickets as min_price', 'price')
                ->withMax('eventTickets as max_price', 'price')
                ->where('url', $url)
                ->orWhere('slug', $url)
                ->first();
                if(!$event) {
                    abort(404);
                }
        $event->end_expired = $this->startExpired($event);
        // return $event;
        // if (now()->gt(Carbon::parse($event->end_date))) {
        //     return redirect()->route('home');
        // }
        $dur = $this->getEventDuration($event);
        $event->duration = $this->getDurationFormate($dur);
        $this->data['event'] = $event;
        $views = $event->views()->first();
        // dd($views);
        if ($views) {
            $views->increment('count');
        } else {
            EventView::create([
                'event_list_id' => $event->id,
                'count' => 1
            ]);
        }
        // event_list_id
        // TicketView::event_ticket_id

        return Inertia::render('Frontend/EventDetails', $this->data);
    }


    public function category_wise_event($category) {
        $this->data['events'] = EventList::with(['images', 'user'])
                                ->where('publish', 1)
                                ->withMin('eventTickets as min_price', 'price')
                                ->withMax('eventTickets as max_price', 'price')
                                // ->whereDate('start_date','>', Carbon::yesterday()->format('Y-m-d'))
                                ->where('eventCategory', 'LIKE', '%'.$category.'%')
                                ->get()->map(function($event) {
                                    $event->images->map(function($image) {
                                        $image->path = asset($image->path);
                                        return $image;
                                    });
                                    return $event;
                                })->filter(function($event) {
                                    return $this->startExpired($event) == false;
                                });
        return Inertia::render('Frontend/CategoryWiseEvent', $this->data);
    }

    public function checkout($url) {
        // $json = file_get_contents("http://ipinfo.io/119.30.32.76/geo");
        $json = file_get_contents("https://ipinfo.io/json");
        $this->data['ip_info'] = json_decode($json);
        $event = EventList::with(['images', 'eventTickets'])
                                ->withMin('eventTickets as min_price', 'price')
                                ->withMax('eventTickets as max_price', 'price')
                                ->where('url', $url)
                                ->orWhere('slug', $url)
                                ->first();
        if (!$event) {
            abort(404);
        }

        if ($this->startExpired($event)) {
            abort(403);
        }

        $this->data['event'] = $event;
        return Inertia::render('Frontend/Checkout', $this->data);
    }

    public function payment($url) {
        $this->data['event'] = EventList::with(['images', 'eventTickets'])
                                ->withMin('eventTickets as min_price', 'price')
                                ->withMax('eventTickets as max_price', 'price')
                                ->where('url', $url)
                                ->orWhere('slug', $url)
                                ->first();
                                
        return Inertia::render('Frontend/PaymentMethod', $this->data);
    }

    public function ticket_info($url) {
        $event = EventList::with(['eventTickets', 'images'])
                        ->withMin('eventTickets as min_price', 'price')
                        ->withMax('eventTickets as max_price', 'price')
                        ->where('url', $url)
                        ->orWhere('slug', $url)
                        ->first();
        $this->data['event'] = $event;
        $event->end_expired = $this->startExpired($event);
        // dd($this->endExpired($event));
        // if ($event && $this->endExpired($event)) {
        //     return redirect()->route('home');
        // }
        return Inertia::render('Frontend/TicketInfo', $this->data);
    }

    public function process(Request $request ,EventList $eventList) {
        $this->data['events'] = EventList::withMin('eventTickets as min_price', 'price')
                            ->withMax('eventTickets as max_price', 'price')
                            ->find($eventList);
        return Inertia::render('Frontend/Checkout', $this->data);
    }

    public function filterPage(Request $request) {
        $query = EventList::query();
        if ($request->keyword) {
            $query->where('name', 'like', '%'.$request->keyword.'%');
            $query->orWhere('eventType', 'like', '%'.$request->keyword.'%');
            $query->orWhere('slug', 'like', '%'.$request->keyword.'%');
            $query->orWhere('location', 'like', '%'.$request->keyword.'%');
            $query->orWhere('attention', 'like', '%'.$request->keyword.'%');
            $query->orWhere('eventCategory', 'like', '%'.$request->keyword.'%');
        } 
        if (isset($request->date)) {
            $query->where('start_date', $request->date);
        } 

        if (isset($request->categories) && is_array($request->categories)) {
            $query->whereIn('eventCategory', $request->categories);
        }

        $this->data['events'] = $query->with(['eventTickets', 'images'])
                        ->withMin('eventTickets as min_price', 'price')
                        ->withMax('eventTickets as max_price', 'price')
                        ->limit(800)
                        ->get();
        return Inertia::render('Frontend/SearchResult', $this->data);
    }

}
