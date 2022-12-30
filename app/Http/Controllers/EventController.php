<?php

namespace App\Http\Controllers;

use App\Models\EventList;
use App\Models\EventTickets;
use App\Models\Guests;
use App\Models\MEvents;
use App\Models\PaymentDetail;
use App\Models\TicketNumber;
use App\Models\TicketSales;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    use Utils;
    public function index($eventType) {
        return Inertia::render('EventCreate', [
            'eventType' => $eventType,
            'userId' => Auth::id()
        ]);
    }

    public function eventStore(Request $request) {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $start_at = Carbon::parse(date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time")));
        $end_at = Carbon::parse(date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time")));
        if ($start_at->isAfter($end_at) && $start_at->isAfter(Carbon::now())) {
            return response()->json([
                'start_date' => 'Invalid Date time'
            ]);
        }
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

    public function update($edit){
        $event = EventList::findOrFail($edit);
        $end_at = Carbon::parse(date('Y-m-d H:i:s', strtotime("$event->end_date $event->end_time")));
        $next_payout_date = $end_at->addWeek(1)->format('d-M-Y');
        $has_payment_details = PaymentDetail::where('user_id', auth()->id())->get();
        return Inertia::render('EventEdit', [
            'userId' => Auth::id(),
            'has_payment_details' => count($has_payment_details) ? 1 : 0,
            'next_payout_date' => $next_payout_date,
        ]);
    }
    public function eventEdit(Request $request, $eventId) {
        $start_at = Carbon::parse(date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time")));
        $end_at = Carbon::parse(date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time")));
        if ($start_at->isAfter($end_at)) {
            return response([
                'start_date' => 'Invalid Date time'
            ], 500);
        }
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
        $eventList = EventList::withCount('eventTickets as ticket_count')->find($eventList->id);
        $start = Carbon::parse(date('Y-m-d H:i:s', strtotime("$eventList->start_date $eventList->start_time")));
        $end = Carbon::parse(date('Y-m-d H:i:s', strtotime("$eventList->end_date $eventList->end_time")));
        $eventList->expired_at = $this->getDurationFormate($end->diffInSeconds(now()));
        $eventList->is_expired = now()->gt($end);
        $eventList->end_date = $end->format('d-M-Y');
        $eventList->start_date = $start->format('d-M-Y');
        return response()->json($eventList, 200);
    }
    public function getEventGuest(EventList $eventList) {
        $ids = $eventList->eventTickets()->pluck('id');
        $sales = TicketSales::where('guest_id', '!=', null)->whereIn('ticket_id', $ids)->pluck('guest_id');
        $guest = Guests::whereIn('id', $sales)->get();
        return $guest;
        // return response()->json($eventList->guests()->get(), 200);
    }
    public function getEventSales(EventList $eventList) {
        $ids = $eventList->eventTickets()->pluck('id');
        $sales = TicketSales::with(['guests', 'ticket', 'ticket_number'])->whereIn('ticket_id', $ids)->get();
        // ssl
        return response([
            'sales' => $sales,
            'ticket_sold' => $sales->sum('quantity'),
            'ticket_revenue' => $sales->sum('price'),
        ], 200);
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


    public function checkin(Request $request) {
        if (!$request->ticket_number) {
            return response([
                'type' => 'error',
                'message' => "Opps! Something wrong."
            ]);
        }
        $ticket_number = TicketNumber::where('ticket_number', $request->ticket_number)->first();
        if (!$ticket_number) {
            return response([
                'type' => 'error',
                'message' => "Opps! Code does not match."
            ]);
        }
        if ($ticket_number->status == 'used') {
            return response([
                'type' => 'error',
                'message' => "Opps! Code already used."
            ]);
        } 
        $event = $ticket_number->ticketSales->ticket->event;
        $end = Carbon::parse(date('Y-m-d H:i:s', strtotime("$event->end_date $event->end_time")));
        if (now()->gt($end)) {
            return response([
                'type' => 'error',
                'message' => "Opps! Code Expired."
            ]);
        }
        $ticket_number->update([
            'status' => 'used'
        ]);
        return response([
            'type' => 'success',
            'message' => "Checked in successfully"
        ]);
    }
}