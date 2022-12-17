<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventTickets>
 */
class EventTicketsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // "user_id"    => User::random(1)->first()->id,
            // 'event_id'      => $request->event_id,
            // 'ticketType'    => $request->ticketType,
            // 'ticket_name'   => $request->ticket_name,
            // 'ticket_stock'  => $request->ticket_stock,
            // 'stock_limit'   => $request->stock_limit,
            // 'price'         => $request->price ? $request->price : 0,
            // 'purchase_limit' => $request->purchase_limit,
            // 'questions'      => $request->questions,
            // 'perks'          => $request->perks,
            // 'ticket_description'    => $request->ticket_description,
            // 'isTransferFeesToGuest' => $request->isTransferFeesToGuest,
            // 'settings' => $request->settings,
        ];
    }
}
