<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use Illuminate\Http\Request;
use App\Models\EventTickets;
use App\Models\Guests;
use App\Models\TicketNumber;
use App\Models\TicketSales;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TicketSaleController extends Controller
{
    public function generateTicketNumber($ticket, $guest) {
        $ticket_count = TicketNumber::count();
        $ticket_count = $ticket_count ? $ticket_count : 1;
        $data = [];
        for ($i = 0; $i < (int)$ticket->quantity; $i++) {
            $number = $ticket->id . strtoupper(str()->random(4)) . $ticket_count;
            $data[] = [
                'guest_id' => $guest->id,
                'ticket_number' => $number,
                'ticket_sale_id' => $ticket->id,
            ];
            $ticket_count++;
        }
        TicketNumber::insert($data);
    }
    public function sale(Request $request){
        // insert to ticket_sales and then update the sold column of event_tickets table
        // return $request->all();
        try {
            //code...
            $guest_id = 0;
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
                $guest_id = $data['guest_id'];
                // return $data;
                $ticket = TicketSales::create($data);
                // return $ticket;
                if($ticket->id){
                    $guest = Guests::find($data['guest_id']);
                    $this->generateTicketNumber($ticket, $guest);
                    $this->updateSoldColumn($value); 
                    // Mail::send(TicketMail)
                }
            } 
            if ($guest) {
                Mail::to($guest)->send(new TicketMail($guest));
            }
        } catch (\Throwable $th) {
            throw $th;
            return $th->getMessage();
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
