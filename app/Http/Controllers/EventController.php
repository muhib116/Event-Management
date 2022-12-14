<?php

namespace App\Http\Controllers;

use App\Models\EventList;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index($eventType) {
        return Inertia::render('EventCreate', [
            'eventType' => $eventType
        ]);
    }

    public function eventStore(Request $request) {
        $request->settings = json_encode($request->settings);
        $data = [
            "eventType"    => $request->eventType,
            "name"         => $request->name,
            "description"  => $request->description,
            "location"     => $request->location,
            "url"          => $request->url,
            "locationTips" => $request->locationTips,
            "video_link"   => $request->video_link,
            "eventCategory" => $request->eventCategory,
            "timezone"     => $request->timezone,
            "start_date"   => $request->start_date,
            "start_time"   => $request->start_time,
            "end_date"     => $request->end_date,
            "end_time"     => $request->end_time,
            "website"      => $request->website,
            "instagram"    => $request->instagram,
            "twitter"      => $request->twitter,
            "facebook"     => $request->facebook,
            "settings"     => json_encode($request->settings),
            "map_link"     => $request->map_link
        ];

        $eventId = EventList::create($data)->id;
        return response()->json(["id" => $eventId], 200);
    }

    public function eventImageUpload(Request $request, $event_id) {
        if($request->file('banner')){
            return 'banner image';
        }

        if($request->file('gallery')){
            return 'gallery image';
        }
    }



    public function manage($url) {
        $event = MEvents::with(['tickets'])->where('name', $url)->orWhere('custom_url', $url)->first();
        if ($event) {
            $startDate = strtotime($event->start_date);
            $startTime = strtotime($event->start_time);
            $endDate = strtotime($event->end_date);
            $endTime = strtotime($event->end_time);

            $event->start_date = date('D, M d Y', $startDate);
            $event->start_time = date('H:s A', $startTime);
            $event->end_date = date('D, M d Y', $endDate);
            $event->end_time = date('H:s A', $endTime);
        }
        // return $event;
        $this->data['event'] = $event;
        
        return Inertia::render('EventManage', $this->data);
        // return $event;
    }

    public function create_discount(Request $request ,MEvents $mEvents) {
        $request->validate([
            'discount_code' => 'required',
            'discount_code_type' => 'required',
            'discount_value' => 'required|numeric',
            'applied_type' => 'required',
            'tickets' => 'nullable|array',
            'use_limit' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
        ]);
        $mEvents->discounts()->create([
            'discount_code' => $request->discount_code,
            'discount_code_type' => $request->discount_code_type, // percent / fixed
            'discount_value' => $request->discount_value, // discount amount
            'applied_type' => $request->applied_type, // for specific ticket or all ticket
            'use_limit' => $request->use_limit, // unlimited/ one  use only / limited amount 
            'limit_amount' => $request->limit_amount, // how many time can use this discount code
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'tickets' => $request->tickets, // ticket ids, if it is apply for specific tickets.
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
        ]);
        return back();
    }
}