<?php

namespace App\Http\Controllers;

use App\Models\MEvents;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EventController extends Controller
{
    use Utils;

    public function index($eventType) {
        return Inertia::render('EventCreate', [
            'eventType' => $eventType
        ]);
    }

    public function eventStore(Request $request) {
        // return $request->all();
        $request->validate([
            'name' => 'required|unique:m_events,slug',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg',
            'description' => 'required|string',
            'end_date' => 'required',
            'end_time' => 'required',
            'eventCategory' => 'required',
            'eventType' => 'required',
            'location' => 'required',
        ]);
        
        try {
            DB::beginTransaction();
            $image = null;
            if (isset($request->image)) {
                $image = asset($this->imageUpload($request, 'image', 'upload/events'));
            }
            $event = MEvents::create([
                'name' => $request->name,
                'slug' => str()->slug($request->name),
                'description' => $request->description,
                'location' => $request->location,
                'location_tips' => $request->location_tips,
                'custom_url' => $request->custom_url,
                'eventType' => $request->eventType,
                'eventCategory' => $request->eventCategory,
                'time_zone' => $request->time_zone,
                'start_date' => $request->start_date,
                'start_time' => $request->start_time,
                'end_date' => $request->end_date,
                'end_time' => $request->end_time,
                'event_date_type' => $request->event_date_type,
                'image' => $image,
                'video_link' => $request->video_link ?? null,
                'map_link' => $request->map_link ?? null,
                'website' => $request->website,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'facebook' => $request->facebook,
                'status' => $request->status ? 1 : 0,
            ]);
            
            $ticket = $event->tickets()->create([
                'ticket_name' => $request->ticket_name,
                'ticket_description' => $request->ticket_description,
                'ticket_type' => $request->ticketType,
                'ticket_stock' => $request->ticket_stock,
                'stock_limit' => $request->stock_limit ?? 0,
                'price' => $request->price ?? 0,
                'perks' => $request->perks,
                'isTransferFeesToGuest' => $request->isTransferFeesToGuest ? 1 : 0,
                'questions' => $request->question,
                'settings' => $request->settings,
            ]);
            
            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Event create successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            return response([
                'data' => [],
                // 'message' => 'Opps! Something wrong.',
                'message' => $th->getMessage(),
                'status' => 'error'
            ], 200);
            // return redirect()->back()->with('error', 'Opps something wrong');
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

    public function createTicket(Request $request, MEvents $mEvents) {
        $request->validate([
            'ticket_name' => 'required|unique:tickets,ticket_name',
            'ticket_description' => 'required',
            'ticket_type' => 'required',
            'ticket_stock' => 'required',
            // 'stock_limit' => $request->stock_limit ?? 0,
            // 'price' => $request->price ?? 0,
            // 'perks' => $request->perks,
            // 'isTransferFeesToGuest' => $request->isTransferFeesToGuest ? 1 : 0,
            // 'questions' => $request->question,
            // 'settings' => $request->settings,
        ]);

        $request->validate([
            'm_events_id' => $mEvents->id,
            'ticket_name' => $request->ticket_name,
            'ticket_description' => $request->ticket_description,
            'ticket_type' => $request->ticketType,
            'ticket_stock' => $request->ticket_stock,
            'stock_limit' => $request->stock_limit ?? 0,
            'price' => $request->price ?? 0, 
            'isTransferFeesToGuest' => $request->isTransferFeesToGuest ? 1 : 0,
            'questions' => $request->question,
            'settings' => $request->settings,
        ]);
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

/*
name
description
location
location_tips
custom_url
eventType
eventCategory
time_zone
start_date
start_time
end_date
end_time
event_date_type
website
instagram
twitter
facebook
status
settings

*/