<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventTickets;

class EventTicketController extends Controller
{
    function store(Request $request, $event_id) {
        $data = [
            "user_id"    => $request->user_id,
            'event_id'      => $request->event_id,
            'ticketType'    => $request->ticketType,
            'ticket_name'   => $request->ticket_name,
            'ticket_stock'  => $request->ticket_stock,
            'stock_limit'   => $request->stock_limit,
            'price'         => $request->price ? $request->price : 0,
            'purchase_limit' => $request->purchase_limit,
            'questions'      => $request->questions,
            'perks'          => $request->perks,
            'ticket_description'    => $request->ticket_description,
            'isTransferFeesToGuest' => $request->isTransferFeesToGuest,
            'settings' => $request->settings,
        ];
        
        $ticketId = EventTickets::create($data)->id;
        return response()->json(["id" => $ticketId], 200);
    }

    function update(Request $request, $id) {
        $data = [
            'event_id'      => $request->event_id,
            'ticketType'    => $request->ticketType,
            'ticket_name'   => $request->ticket_name,
            'ticket_stock'  => $request->ticket_stock,
            'stock_limit'   => $request->stock_limit,
            'price'         => $request->price,
            'purchase_limit' => $request->purchase_limit,
            'questions'      => $request->questions,
            'perks'          => $request->perks,
            'ticket_description'    => $request->ticket_description,
            'isTransferFeesToGuest' => $request->isTransferFeesToGuest,
            'settings' => $request->settings,
        ];
        
        $res = EventTickets::where(['id'=>$id])->update($data);

        if($res){
            return response()->json(['status' => true], 200);
        }
        return response()->json(['status' => false]);
    }

    function getTicket($event_id){
        $tickets = EventTickets::where(['event_id'=>$event_id])->orderBy('id', 'desc')->get();
        
        if($tickets){
            return response()->json($tickets, 200);
        }

        return response()->json(['status' => false], 200);
    }

    function duplicate($id){
        $ticket = EventTickets::find($id);
        
        if($ticket){
            $newTicket = $ticket->replicate();
            $newTicket = $newTicket->save();
            return response()->json($newTicket, 200);
        }

        return response()->json(['status' => false], 200);
    }

    function deleteTicket($id){
        $ticket = EventTickets::find($id);

        if($ticket){
            $ticket->delete();
            return response()->json(['status'=>true], 200);
        }
    }
}
