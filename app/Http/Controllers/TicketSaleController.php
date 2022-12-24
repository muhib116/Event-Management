<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use Illuminate\Http\Request;
use App\Models\EventTickets;
use App\Models\Guests;
use App\Models\TicketSales;
use Gathuku\Mpesa\Facades\Mpesa;
use Illuminate\Support\Facades\Mail;

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
            $ticket = TicketSales::create($data);
            if($ticket->id){
                // $this->updateSoldColumn($value);
                $guest = Guests::find($data['guest_id']);
                if ($guest) {
                    Mail::to($guest)->send(new TicketMail($guest));
                }
                // Mail::send(TicketMail)
            }
        }
        $simulateResponse=Mpesa::simulateC2B(100, "254708374149", "Testing");
    }

    private function updateSoldColumn($data) {
        $ticket_id = $data['ticket_id'];
        $quantity = $data['quantity'];
        $ticket = EventTickets::find($ticket_id);
        $ticket->sold += $quantity;
        $ticket->update();
    }
}
