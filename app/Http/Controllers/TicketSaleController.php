<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventTickets;
use App\Models\TicketSales;

class TicketSaleController extends Controller
{
    function sale(Request $request){
        // insert to ticket_sales and then update the sold column of event_tickets table
        foreach($request->all() as $key => $value){
            $data = [
                "organizer_id" => $value['organizer_id'],
                "guest_id" => $value['guest_id'],
                "ticket_id" => $value['ticket_id'],
                "ticket_type" => $value['ticket_type'],
                "quantity" => $value['quantity'],
                "commission" => $value['commission'],
                "price" => $value['price'],
                "payment_method" => $value['payment_method'],
                "status" => $value['status'],
            ];

            if(TicketSales::create($data)->id){
                $this->updateSoldColumn($value);
            }
        }
    }

    private function updateSoldColumn($data) {
        $ticket_id = $data['ticket_id'];
        $quantity = $data['quantity'];
        $ticket = EventTickets::find($ticket_id);
        $ticket->sold += $quantity;
        $ticket->update();
    }
}
