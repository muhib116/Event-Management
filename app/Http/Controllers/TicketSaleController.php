<?php

namespace App\Http\Controllers;

use App\Mail\OrgSalesMail;
use App\Mail\TicketMail;
use Illuminate\Http\Request;
use App\Models\EventTickets;
use App\Models\Guests;
use App\Models\SiteSetting;
use App\Models\TicketNumber;
use App\Models\TicketSales;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str; 
use Stripe\Stripe;
use Stripe\Charge;

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
        try {
            $guest_id = 0;
            $tickets = []; 
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
                    "sales_id" => Str::orderedUuid(),
                ];
                $guest_id = $data['guest_id']; 
                $ticket = TicketSales::create($data);
                $tickets[] = $ticket; 
                if($ticket->id){
                    $guest = Guests::find($data['guest_id']);
                    $this->generateTicketNumber($ticket, $guest);
                    $this->updateSoldColumn($value);  
                }
            }
            if ($guest) {
                Mail::to($guest)->send(new TicketMail($guest, $tickets));
            }
            return response([
                'target_url' => route('payment.complete')
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            return $th->getMessage();
        }
    }

    public function stripe_pay(Request $request) {
        $secret_key = SiteSetting::where('name', 'stripe_secret_key')->first();
        $key = $secret_key ? $secret_key->value : null;
        Stripe::setApiKey($key);
        $guest_id = 0;
        $tickets = [];
        DB::beginTransaction();
        foreach($request->cards as $key => $value){
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
                "sales_id" => Str::orderedUuid(),
            ];
            $guest_id = $data['guest_id']; 
            $ticket = TicketSales::create($data);
            $tickets[] = $ticket; 
            if(isset($ticket->id)){
                $guest = Guests::find($data['guest_id']);
                $this->generateTicketNumber($ticket, $guest);
                $this->updateSoldColumn($value);  
            }
        }

        try {
            $obj = Charge::create([
                "amount" => (float)($request->total_amount_with_fees) * 100,
                "currency" => "EUR",
                "source" => $request->stripe_token,
                "description" => "This payment is for guest ".$guest->email,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        if ($guest) {
            Mail::to($guest)->send(new TicketMail($guest, $tickets));
            $event = collect($tickets)->first();
            $organizer = User::find($event->organizer_id);
            $ticketSales = EventTickets::find($event->ticket_id)->event;
            Mail::to($organizer)->send(new OrgSalesMail($organizer,$ticketSales, $guest));
        }
        return response([
            'target_url' => route('payment.complete')
        ], 200);
    }

    private function updateSoldColumn($data) {
        $ticket_id = $data['ticket_id'];
        $quantity = $data['quantity'];
        $ticket = EventTickets::find($ticket_id);
        $ticket->sold += $quantity;
        $ticket->update();
    }
}
