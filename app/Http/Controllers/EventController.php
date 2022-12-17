<?php

namespace App\Http\Controllers;

use App\Models\EventList;
use App\Models\MEvents;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index($eventType) {
        return Inertia::render('EventCreate', [
            'eventType' => $eventType,
            'userId' => Auth::id()
        ]);
    }

    public function eventStore(Request $request) {
        $data = [
            "user_id"    => $request->user_id,
            "eventType"    => $request->eventType,
            "name"         => $request->name,
            "slug"         => str()->slug($request->name),
            "description"  => $request->description,
            "terms_and_conditions" => $request->terms_and_conditions,
            "audience"      => $request->audience,
            "attention"     => $request->attention,
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
            "settings"     => $request->settings,
            "map_link"     => $request->map_link,
            "publish"     => $request->publish ? 1 : 0,
        ];

        $eventId = EventList::create($data)->id;
        return response()->json(["id" => $eventId], 200);
    }

    public function update(){
        return Inertia::render('EventEdit', [
            'userId' => Auth::id()
        ]);
    }
    public function eventEdit(Request $request, $eventId) {
        $data = [
            "eventType"    => $request->eventType,
            "name"         => $request->name,
            "description"  => $request->description,
            "terms_and_conditions" => $request->terms_and_conditions,
            "audience"     => $request->audience,
            "attention"    => $request->attention,
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
            "map_link"     => $request->map_link,
            "publish"     => $request->publish ? 1 : 0,
        ];

        $res = EventList::where(['id' => $eventId])->update($data);
        if($res){
            return response()->json(['status' => true], 200);
        }
        return response()->json(['status' => false]);
    }
    public function editPublish(Request $request, $eventId) {
        $data = ["publish" => $request->publish ? 1 : 0];

        $res = EventList::where(['id' => $eventId])->update($data);
        if($res){
            return response()->json(['status' => true], 200);
        }
        return response()->json(['status' => false]);
    }

    public function getEvent(Request $request, EventList $eventList) {
        return response()->json($eventList, 200);
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